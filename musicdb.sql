USE musicdb;
SHow tables;
CREATE TABLE users(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(50) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE my_instruments(
	id INT NOT NULL,
	instruments VARCHAR(50),
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
DESCRIBE users;

ALTER TABLE instruments 
	ADD COLUMN description VARCHAR(255) ;

SHOW COLUMNS FROM bands;

SELECT * FROM users;

CREATE TABLE instruments(
	instrument VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO instruments (instrument) VALUES('cello');
SELECT * FROM following;

UPDATE users SET follow='[]' WHERE username = "k";

CREATE TABLE bands(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
	members JSON
);

TRUNCATE TABLE instruments;
DROP TABLE instruments;

LOAD DATA LOCAL INFILE '/home/ulysses/lab/musicdb/misc/inst_adj.txt' 
REPLACE INTO TABLE instruments 
LINES STARTING BY '"' TERMINATED BY '"\n';

