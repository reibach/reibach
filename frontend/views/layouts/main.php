<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
//use pceuropa\languageSelection\LanguageSelection;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<div class="wrap">
<div class="wrap">


    <?php
    NavBar::begin([
        //'brandLabel' => Html::img('@web/images/reibach-logo114.png', ['alt'=>'Reibach']).'Reibach',
        'brandLabel' => Html::img('@web/images/logo_weiss_120_ohne.png', ['alt'=>'Reibach']),
        //'brandLabel' => 'Reibach',
        //'brandLabel' => ,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            //'class' => 'navbar-inverse navbar-fixed-top',
            'class' => 'my-navbar navbar-fixed-top',
        ],
    ]);
	//$menuItems[] = ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']];
	//$menuItems[] = ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']];
	//$menuItems[] = ['label' => Yii::t('app', 'Imprint'), 'url' => ['/site/imprint']];
	//$menuItems[] = ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']];  
          
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('app', 'Signup'), 'url' => ['/site/signup']];
        $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
    } else {
		$menuItems[] = ['label' => Yii::t('app', 'Mandators'), 'url' => ['/mandator/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Customers'), 'url' => ['/customer/index']];
		//$menuItems[] = ['label' => Yii::t('app', 'CustomerAddresses'), 'url' => ['/customer-address/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Bills'), 'url' => ['/bill/index']];
		//$menuItems[] = ['label' => Yii::t('app', 'Positions'), 'url' => ['/position/index']];
		//$menuItems[] = ['label' => Yii::t('app', 'Addresses'), 'url' => ['/address/index']];
		//$menuItems[] = ['label' => Yii::t('app', 'Articles'), 'url' => ['/article/index']];
		//$menuItems[] = ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']];
		//$menuItems[] = ['label' => Yii::t('app', 'Imprint'), 'url' => ['/site/imprint']];
		//$menuItems[] = ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']];  
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
            //$menuItems[] = ['label' => Yii::t('app', 'Users'), 'url' => ['/user/index']];
		
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    
    NavBar::end();
    ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Reibach <?= date('Y') ?>&nbsp;
		<?= Html::a(Yii::t('app', 'Imprint'), ['/site/imprint', ''], ['class' => 'profile-link']) ?>&nbsp;
		<?= Html::a(Yii::t('app', 'Contact'), ['/site/contact', ''], ['class' => 'profile-link']) ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
