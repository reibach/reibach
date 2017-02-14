reibach

... to make a big haul
===============================

Project now based on yii2, Java sucks


More Infos and DemoSite will come soon....






2DOs:

### Abo-und/oder Lizenzsystem zur ABrechnung entwickeln


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


  * Infos solleten ausgeblendet werden können
  


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


--


Anmerkungen, unsortiert:

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


