<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use cinghie\cookieconsent\widgets\CookieWidget;
 
AppAsset::register($this);

?>
<link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/reibach.ico" type="image/x-icon" />

<?= 
CookieWidget::widget([ 
        'message' => Yii::t('app', 'This website uses cookies to ensure you get the best experience on our website.'),
        'dismiss' => Yii::t('app', 'Got It'),
        'learnMore' => Yii::t('app','More info'),
        'link' => 'https://rechnung-reibach.de/index.php?r=site%2Fprivacypolicy&1=',
        'theme' => 'dark-bottom'
]); 

?>

<div style="
		# background-color:lawngreen;
		position: absolute;
        right: 1em;
        top: 50;
        # width: 250px;
	">
<?= 
	\powerkernel\flagiconcss\Flag::widget([
	    'tag' => 'span', // flag tag
		'country' => 'xx', // where xx is the ISO 3166-1-alpha-2 code of a country,
		'squared' => false, // set to true if you want to have a squared version flag
		'options' => [] // tag html options
	]); 
?>	
	
<?php
//Yii::$app->language = 'de';
 $languageItem = new cetver\LanguageSelector\items\DropDownLanguageItem([
     'languages' => [
         'en' => '<span class="flag-icon flag-icon-gb"></span> English',
         'nd' => '<span class="flag-icon flag-icon-nd"></span> Plattd&uuml;tsch',
         'de' => '<span class="flag-icon flag-icon-de"></span> Deutsch',
     ],
     'options' => ['encode' => false],
 ]);
 $languageItem = $languageItem->toArray();
 $languageDropdownItems = \yii\helpers\ArrayHelper::remove($languageItem, 'items');
 echo \yii\bootstrap\ButtonDropdown::widget([
     'label' => $languageItem['label'],
     'encodeLabel' => false,
     'options' => ['class' => 'btn-default'],
     'dropdown' => [
         'items' => $languageDropdownItems
     ]
 ]);
?>
</div>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?= Yii::$app->view->registerMetaTag([
			'name' => 'description',
			'content' => 'Reibach - das online Rechnungsprogramm. Kostenlos und quelloffen.'
		]);  ?>
    <?= Yii::$app->view->registerMetaTag([
			'name' => 'keywords',
			'content' => 'Reibach, Rechnungsprogramm, Rechnung, Faktura, Angebote, 
			Plattdeutsch, Niederdeutsch, Einfach, Kostenlos, Kunden, Positionen, 
			Mahnwesen, Steuer, Unternehmer, Freischaffende, Kleinunternehmer, 
			Open Source, Umsonst, Offen, Linux, Sicher, Freiberufler'
		]);  ?>
    
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
<?php
$session = Yii::$app->session;
$mandator_active = $session->get('mandator_active');
//echo "mandator_active:".$mandator_active;



    NavBar::begin([
        //'brandLabel' => Html::img('@web/images/reibach-logo114.png', ['alt'=>'Reibach']).'Reibach',
        'brandLabel' => Html::img('@web/images/logo_weiss_120_ohne.png', ['alt'=>'Reibach']),
        //'brandLabel' => 'Reibach',
        //'brandLabel' => ,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
            //'class' => 'my-navbar navbar-fixed-top',
        ],
    ]);
	//$menuItems[] = ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']];
	//$menuItems[] = ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']];
	//$menuItems[] = ['label' => Yii::t('app', 'Imprint'), 'url' => ['/site/imprint']];
	//$menuItems[] = ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']];  
          
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => ''];
        // $menuItems[] = ['label' => Yii::t('app', 'Signup'), 'url' => ['/site/signup']];
        $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
    } else {
		$menuItems[] = ['label' => Yii::t('app', 'Mandators'), 'url' => ['/mandator/view', 'id'=>$mandator_active]];
		//$menuItems[] = ['label' => Yii::t('app', 'Mandators'), 'url' => ['/mandator/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Customers'), 'url' => ['/customer/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Offers'), 'url' => ['/offer/index']];
		//$menuItems[] = ['label' => Yii::t('app', 'CustomerAddresses'), 'url' => ['/customer-address/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Bills'), 'url' => ['/bill/index']];
		//$menuItems[] = ['label' => Yii::t('app', 'Positions'), 'url' => ['/position/index']];
		//$menuItems[] = ['label' => Yii::t('app', 'Addresses'), 'url' => ['/address/index']];
		//$menuItems[] = ['label' => Yii::t('app', 'Articles'), 'url' => ['/article/index']];
		//$menuItems[] = ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']];
		//$menuItems[] = ['label' => Yii::t('app', 'Imprint'), 'url' => ['/site/imprint']];
		//$menuItems[] = ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']];  
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'get')
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
		<?= Html::a(Yii::t('app', 'Disclaimer'), ['/site/disclaimer', ''], ['class' => 'profile-link']) ?>&nbsp;
		<?= Html::a(Yii::t('app', 'Privacy Policy'), ['/site/privacypolicy', ''], ['class' => 'profile-link']) ?>&nbsp;
		<?= Html::a(Yii::t('app', 'GTC'), ['/site/gtc', ''], ['class' => 'profile-link']) ?>&nbsp;
		<?= Html::a(Yii::t('app', 'Contact'), ['/site/contact', ''], ['class' => 'profile-link']) ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
