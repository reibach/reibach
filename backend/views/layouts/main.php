<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
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
        top: 65;
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Reibach Backend',
        //'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
		$menuItems[] = ['label' => Yii::t('app', 'Gii'), 'url' => ['/gii']];
		$menuItems[] = ['label' => Yii::t('app', 'Adrs'), 'url' => ['/adr/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Users'), 'url' => ['/user/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Mandators'), 'url' => ['/mandator/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Customers'), 'url' => ['/customer/index']];
		$menuItems[] = ['label' => Yii::t('app', 'Bills'), 'url' => ['/bill/index']];
		$menuItems[] = ['label' => Yii::t('app', 'ABOs'), 'url' => ['/abo/index']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
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

        <p class="pull-left">&copy; Reibach <?= date('Y') ?></p>

        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
