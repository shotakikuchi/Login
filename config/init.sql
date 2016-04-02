create DATABASE sampledb;

grant all on sampledb .* to dbuser@localhost IDENTIFIED BY 'password';

use sampledb;

DROP TABLE IF EXISTS users;
CREATE table users (
	id int not null auto_increment primary key,
  email varchar(255) unique,
  password varchar(255),
  created datetime,
  modified datetime
);