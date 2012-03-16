CREATE TABLE mandator (
  id NUMERIC default UNIQUEKEY('mandator'),
  company varchar(150) NOT NULL,
  slogan varchar(255),
  title varchar(50) NOT NULL,
  firstname varchar(150) NOT NULL,
  lastname varchar(150) NOT NULL,
  street varchar(150) NOT NULL,
  housenumber varchar(6) NOT NULL,
  zipcode varchar(5) NOT NULL,
  place varchar(255),
  email varchar(150) ,
  website varchar(150) ,
  tel varchar(27) ,
  fax varchar(27) ,
  mobil varchar(27) ,
  bankname varchar(27) ,
  bankaccount varchar(27) ,
  bankcodenumber varchar(27) ,
  iban varchar(27) ,
  bic varchar(27) ,
  taxoffice varchar(27) ,
  vatnumber varchar(27) ,
  taxnumber varchar(27) ,
  comment text,
  UNIQUE (id),
  PRIMARY KEY (id)
);

-- INSERT INTO mandator ( bankaccount,fax,taxnumber ) VALUES " + "      ( 'David Powell', 25, 'New Zealand' ) ");

-- INSERT INTO  mandator (bankaccount) values ('140180666');

-- # as a default
-- INSERT INTO mandator (bankaccount,fax,taxnumber,bankname,website,mobil,street,zipcode,tel,vatnumber,bankcodenumber,lastname,firstname,housenumber,slogan,title,taxoffice,email,company,place,bic,comment,iban) values ('140180666', 'Tel: +49(0)4748 442438', 'Steuer-Nr.: 36/37/11311', 'KSK OHZ', 'http://federa.de', 'Tel: +49(0)175 2717291', 'Buxhorner Weg', '27729', 'Tel: +49(0)4748 442437' , 'USt-ldNr: DE567890987654', 'BLZ: 29152300', 'Mittler', 'Guenter', '15', 'Internet - Support - Sicherheit', 'Herr', 'FA OHZ', 'E-Mail:guenter@federa.de', 'federa', 'Holste', 'DE3456789876543','kommentar' , 'ibanche') ;

CREATE TABLE customer (
  id NUMERIC default UNIQUEKEY('customer'),
  company varchar(150) NOT NULL,
  title varchar(50) NOT NULL,
  firstname varchar(150) NOT NULL,
  lastname varchar(150) NOT NULL,
  street varchar(150) NOT NULL,
  housenumber varchar(6) NOT NULL,
  zipcode varchar(5) NOT NULL,
  place varchar(255),
  email varchar(150) ,
  tel varchar(27) ,
  fax varchar(27) ,
  mobil varchar(27) ,
  comment text,
  UNIQUE (id),
  PRIMARY KEY (id)
);


CREATE TABLE bill (
  id NUMERIC default UNIQUEKEY('bill'),
  customer_id int(4) NOT NULL,
  mandator_id int(4) NOT NULL,
  description text,
  price double,
  pay_id int(1) DEFAULT NULL,
  billdate date,
  UNIQUE (id),
  PRIMARY KEY (id)
);

ALTER TABLE bill ADD CONSTRAINT fk_customer FOREIGN KEY (customer_id) REFERENCES customer (id) DEFERRABLE;

--# Tabelle mit den freien Positionen //-->
CREATE TABLE article (
  id NUMERIC default UNIQUEKEY('article'),
  name varchar(255) NOT NULL,
  unit varchar(10),
  comment text,
  price double,
  UNIQUE (id),
  PRIMARY KEY (id)
);


-- # Tabelle mit den zu den jeweiligen Rechnungen gehoerenden Positionen -->
CREATE TABLE position (
  id NUMERIC default UNIQUEKEY('position'),
  bill_id int(4) NOT NULL,
  pos_num varchar(2) DEFAULT NULL,
  quantity double (6) DEFAULT NULL,
  unit varchar(10),
  name varchar(255) NOT NULL,
  comment text,
  price double (6),
  tax double (6),
  amount double (6),
  UNIQUE (id),
  PRIMARY KEY (id)
);


ALTER TABLE position ADD CONSTRAINT fk_bill FOREIGN KEY (bill_id) REFERENCES bill (id) DEFERRABLE;


CREATE TABLE project (
  id NUMERIC default UNIQUEKEY('project'),
  name varchar(255) NOT NULL,
  description text,
  price double,
  startdate date,
  enddate date,
  UNIQUE (id),
  PRIMARY KEY (id)
);

CREATE TABLE task (
  id NUMERIC default UNIQUEKEY('task'),
  project_id int(4) NOT NULL,
  name varchar(255) NOT NULL,
  comment text,
  effort double,
  UNIQUE (id),
  PRIMARY KEY (id)
);

ALTER TABLE task ADD CONSTRAINT fk_project FOREIGN KEY (project_id) REFERENCES project (id) DEFERRABLE;
COMMIT;
