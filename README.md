reibach

... to make a big haul
===============================

Project now based on yii2, Java sucks


More Infos and DemoSite will come soon....


Aktuelle ProduktivAddresse:
https://reibach.federa.de/



2DOs:

  - Rechnung:index: KundenID muss fullname werden 
  
  - Rechnung:view: KundenID muss fullname werden 
  
  
  - SSL - Zertifikat DF: 1.99 / mntl. 
  - Newsletter einbauen
  - Nutzung Cookies bestätigen, Verweis auf Datenschutz
  - Schnellstart (QuickStartGuide)
  - Schritt-für-Schritt-Anleitung
  - Deployment
  - Schalter zur Sprachauswahl bauen
  - Default Sprache hochdeutsch hart verdrahten
  - Sprachauswahl mit Fahnen
  - Dokwiki anlegen
  - Link zum Git
  

Privacy Policy - Datenschutzbestimmungen
Disclaimer - Haftungsausschluss
GTC ( General Terms & Conditions) - AGBs
  
### Schritt-für-Schritt-Anleitung

Erstes Erklärvideo soll folgenden Inhalt haben:
1. Registrieren inklusive AGB bestätigen
2. Anmelden
3. Passwort zurücksetzen



Schnellstart (QuickStartGuide)
1. Registrieren:
  - Benutzername
  - Passwort 
  - AGBs bestätigen
   
   
2. Mandant (Rechnungssteller, deine Firma) bearbeiten 

3. Kunde (Rechnungsempfänger) anlegen

4. Rechnung erstellen






### Abo-und/oder Lizenzsystem zur ABrechnung entwickeln


#### Lizenzsystem #### 
STANDARD:


PROFI:
  * mehrere Mandanten



### Installation eines RBAC-Systems 
siehe auch: 
http://www.yiiframework.com/doc-2.0/guide-security-authorization.html


### Aufteilung backend / frontend

backend:
  - Userverwaltung
  - Mandantenverwaltung
  - Abo und Lizenzverwaltung
  
frontend: 



Daten für eine Rechnung:

Mandant: 


# Kunde:
Auswählen oder neu anlegen


Rechnung:

Positionen:


  * Infos sollten ausgeblendet werden können
  


### Sprachgenerator starten und dokumentieren
  
root@reibach-dev:/var/www/html/reibach# php yii message/extract  @frontend/config/i18n.php

generiert: /var/www/html/reibach/frontend/messages/
de_DE
nds_NDS


https://code.tutsplus.com/tutorials/how-to-program-with-yii2-localization-with-i18n--cms-23140  

gesetzt wird das Ganze in:
/var/www/html/reibach/frontend/config/main.php

//'language'=>'nds_NDS', // german
'language'=>'nds_NDS', // plattdütsch

Schalter mit Fahnen geht noch nicht, siehe:
https://pceuropa.net/yii2-extensions/yii2-language-selection-widget?language=fr
https://github.com/codemix/yii2-localeurls

https://reibach.federa.de/index.php/de_DE
--


Anmerkungen, unsortiert:
--
ListView in PDFs

http://www.codevoila.com/post/4/yii2-listview-example


--
### Debugger / Logging aktivieren:
in /var/www/html/reibach/frontend/config/main-local.php

  allowedIPs' => ['127.0.0.1', '*','::1'] // adjust this to your needs
  //'allowedIPs' => ['127.0.0.1'] // adjust this to your needs


--

--

PDF-Generierung
http://demos.krajee.com/mpdf#settings

--


Amount  - die Menge
Quantity  - die Anzahl
--

Bennenung von models:

Variable $model wird zu tablename, bsp..

$model = Customer::findOne($id);
wird zu:
$customer = Customer::findOne($id);


FRAGE: Wie kann das im Codegenerator gehandhabt werden???

--

BUGS

Translator geht nicht:

in /var/www/html/reibach/frontend/views/site/signup.php


<?= $form->field($model, Yii::t('app', 'password'))->passwordInput() ?> --> NOK

<?= $form->field($model, $passwd)->passwordInput() ?> OK, aber ohne Übersetzung:
                

<?= $form->field($model, Yii::t('app', 'username'))->textInput(['autofocus' => true]) ?>


sobald uebersetzt in /var/www/html/reibach/frontend/messages/de_DE/app.php
	'username' => 'Benutzername',
	
FEHLER: 	Unknown Property
Es ist ein interner Serverfehler aufgetreten. 
                
                
