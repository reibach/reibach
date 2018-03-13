<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class SendForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;
    public $mandator;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($billfile,$mandator,$mandator_address)
    {
		
		if (!isset($billfile))
			$billfile = "";
			
		
        return Yii::$app->mailer->compose()
            ->setTo($this->email)
            //->setFrom([$this->email => $this->name])
            ->setFrom([$mandator_address->email => $mandator_address ->prename.' '.$mandator_address ->lastname ])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->attach($billfile)
            ->send();
    }

    /**
     * Sends a copy email to the email address of the mandator.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendCEmail($billfile,$mandator,$mandator_address)
    {
		
		if (!isset($billfile))
			$billfile = "";
			
		
        return Yii::$app->mailer->compose()
            ->setTo($mandator_address->email)
            //->setFrom([$this->email => $this->name])
            ->setFrom([$mandator_address->email => $mandator_address->prename.' '.$mandator_address->lastname ])
            ->setSubject('CopyMail: '.$this->subject)
            ->setTextBody($this->body)
            ->attach($billfile)
            ->send();
    }

    /**
     * Sends an blind copy email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendBCEmail($billfile,$mandator,$mandator_address)
    {
		
		if (!isset($billfile))
			$billfile = "";
			
		
        return Yii::$app->mailer->compose()
            // ->setTo($this->email)
            
            ->setTo("gm@reibach-rechnung.de")
            
            
            //->setFrom([$this->email => $this->name])
            ->setFrom([$mandator_address->email => $mandator_address ->prename.' '.$mandator_address ->lastname ])
            ->setSubject('BlindCopyMail:'.$this->subject)
            ->setTextBody($this->body)
            ->attach($billfile)
            ->send();
    }
}
