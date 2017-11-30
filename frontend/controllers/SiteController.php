<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Mandator;
use frontend\models\Address;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

			$user_id = Yii::$app->user->id;
			
			$mandator_active = Mandator::find()
				->where('user_id = :user_id', [':user_id' => $user_id])
				->one();
			
			// Start der Session
			$session = Yii::$app->session;
			$mandator_active = $session->set('mandator_active', $mandator_active['id']);

            //return $this->render('index', [
                //'model' => $model,                
            //]);   
            return $this->goHome();
          
            //return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,                
            ]);
        }
    }
    

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        //return $this->goHome();
        return $this->render('index');
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', Yii::t('app','Thank you for contacting us. We will respond to you as soon as possible.'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'There was an error sending email.'));
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays GTC page.
     *
     * @return mixed
     */
    public function actionGtc()
    {
        return $this->render('gtc');
    }
    /**
     * Displays disclaimer page.
     *
     * @return mixed
     */
    public function actionDisclaimer()
    {
        return $this->render('disclaimer');
    }
    /**
     * Displays Privacy Policy page.
     *
     * @return mixed
     */
    public function actionPrivacypolicy()
    {
        return $this->render('privacypolicy');
    }
    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays quickstart page.
     *
     * @return mixed
     */
    public function actionQuickstart()
    {
        return $this->render('quickstart');
    }

    /**
     * Displays imprint page.
     *
     * @return mixed
     */
    public function actionImprint()
    {
        return $this->render('imprint');
    }

    /**
     * Displays abo page.
     *
     * @return mixed
     */
    public function actionAbosystem()
    {
        return $this->render('abosystem');
    }


  /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
		//if (Yii::$app->getUser()->login($user)) {
			//return $this->goHome();
		//} else {
			//print "ERROR: ";
			//exit;
		//}	
		
        $address = new Address();
		$address->address_type = 'MANDATOR';

        $mandator = new Mandator();
        $model = new SignupForm();

		//user speichern
		if ($model->load(Yii::$app->request->post())) {
			if ($user = $model->signup()) {
				$address->save();
				//print "<p>AddressID: </p>";
				//print $address->id;
				//print "<p>&nbsp;AddressID</p>";
				$mandator->address_id = $address->id;	
																	
				$mandator->user_id = $user['id'];
				$mandator->save();			
				
				if (Yii::$app->getUser()->login($user)) {
					return $this->goHome();
				}
			}
		}	
		return $this->render('signup', [
			'model' => $model,
		]);
	}


    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
				// Yii::t('app','Signup')
                Yii::$app->session->setFlash('success', Yii::t('app', 'Check your email for further instructions.'));

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Sorry, we are unable to reset password for email provided.'));
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'New password was saved.'));

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
