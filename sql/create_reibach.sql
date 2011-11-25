CREATE TABLE kunde (
  id NUMERIC default UNIQUEKEY('kunde'),
  firma varchar(27) NOT NULL,
  name varchar(27) NOT NULL,
  vorname varchar(27) NOT NULL,
  plz varchar(5) NOT NULL,
  ort varchar(27) NOT NULL,
  email varchar(100) NOT NULL,
  tel varchar(27) NOT NULL,
  fax varchar(27) NOT NULL,
  mob varchar(27) NOT NULL,
  kategorie varchar(255) NULL,
  UNIQUE (id),
  PRIMARY KEY (id)
);


CREATE TABLE rechnung (
  id NUMERIC default UNIQUEKEY('rechnung'),
  name varchar(255) NOT NULL,
  description text,
  price double,
  startdate date,
  enddate date,
  UNIQUE (id),
  PRIMARY KEY (id)
);


CREATE TABLE article (
  id NUMERIC default UNIQUEKEY('article'),
  rechnung_id int(4) NOT NULL,
  name varchar(255) NOT NULL,
  comment text,
  effort double,
  UNIQUE (id),
  PRIMARY KEY (id)
);

ALTER TABLE article ADD CONSTRAINT fk_rechnung FOREIGN KEY (rechnung_id) REFERENCES rechnung (id) DEFERRABLE;

