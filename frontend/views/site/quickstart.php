<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app', 'Quickstart');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

 <p><img src="<?= yii\helpers\Url::to('@web/images/quickstartguide.png') ?>" width="1024"/></p>

<!--
    <p><?= Yii::t('app', 'Lore ipsum...') ?></p>

    <code><?= __FILE__ ?></code>
-->
</div>
