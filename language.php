<?php

/**
 * 1. bestehende Sprachdatei sichern

**/
system ('cd /var/www/html/reibach/frontend');
system ('mv messages messages.org');
mkdir messages

// übersetzungsstrings aus der Anwendung holen und ins frontend schreiben 
//root@reibach-dev:/var/www/html/reibach# php yii message/extract  @frontend/config/i18n.php
//generiert: /var/www/html/reibach/frontend/messages/
//de_DE
//nds_NDS
php yii message/extract  @frontend/config/i18n.php



// die neu generierte Sprachdatei
// var/www/html/reibach/frontend/messages/de_DE/app.php
$array_leer = array(...);

// die bisherige Sprachdatei
// var/www/html/reibach/frontend/messages.org/de_DE/app.php
$array_voll = array(...);


$ergebnis = array_merge($array_leer, $array_voll);
//print_r($ergebnis);

foreach ($ergebnis as $key => $value) {
    // $arr[3] wird mit jedem Wert von $arr aktualisiert...
    echo "'{$key}' => '{$value}',\n";
}

?>
