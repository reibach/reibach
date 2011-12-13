CREATE TABLE mandator (
  id NUMERIC default UNIQUEKEY('mandator'),
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
  name varchar(255) NOT NULL,
  description text,
  price double,
  paystatus int(1),
  billdate date,
  UNIQUE (id),
  PRIMARY KEY (id)
);

ALTER TABLE bill ADD CONSTRAINT fk_customer FOREIGN KEY (customer_id) REFERENCES customer (id) DEFERRABLE;

--# Tabelle mit den freien Positionen //-->
CREATE TABLE article (
  id NUMERIC default UNIQUEKEY('article'),
  name varchar(255) NOT NULL,
  comment text,
  price double,
  UNIQUE (id),
  PRIMARY KEY (id)
);


-- # Tabelle mit den zu den jeweiligen Rechnungen gehoerenden Positionen -->
CREATE TABLE position (
  id NUMERIC default UNIQUEKEY('position'),
  bill_id int(4) NOT NULL,
  name varchar(255) NOT NULL,
  comment text,
  price double,
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
