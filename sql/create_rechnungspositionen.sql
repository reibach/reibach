CREATE TABLE customer (
  id NUMERIC default UNIQUEKEY('customer'),
  company varchar(27) NOT NULL,
  title varchar(27) NOT NULL,
  firstname varchar(27) NOT NULL,
  lastname varchar(27) NOT NULL,
  street varchar(27) NOT NULL,
  housenumber varchar(27) NOT NULL,
  zipcode varchar(5) NOT NULL,
  place varchar(27) NOT NULL,
  email varchar(100) NOT NULL,
  tel varchar(27) NOT NULL,
  fax varchar(27) NOT NULL,
  mob varchar(27) NOT NULL,
  UNIQUE (id),
  PRIMARY KEY (id)
);


CREATE TABLE bill (
  id NUMERIC default UNIQUEKEY('bill'),
  name varchar(255) NOT NULL,
  description text,
  price double,
  startdate date,
  enddate date,
  UNIQUE (id),
  PRIMARY KEY (id)
);

# Tabelle mit den zu den jeweiligen Rechnungen gehoerenden Positionen
CREATE TABLE bill_position (
  id NUMERIC default UNIQUEKEY('bill_position'),
  bill_id int(4) NOT NULL,
  name varchar(255) NOT NULL,
  comment text,
  effort double,
  UNIQUE (id),
  PRIMARY KEY (id)
);


# Tabelle mit den Positionen
CREATE TABLE position (
  id NUMERIC default UNIQUEKEY('position'),
  bill_id int(4) NOT NULL,
  name varchar(255) NOT NULL,
  comment text,
  effort double,
  UNIQUE (id),
  PRIMARY KEY (id)
);


ALTER TABLE bill_position ADD CONSTRAINT fk_bill FOREIGN KEY (bill_position_id) REFERENCES bill (id) DEFERRABLE;




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
