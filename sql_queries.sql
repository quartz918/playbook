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

CREATE TABLE bands(
	band_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	bandname VARCHAR(50) NOT NULL UNIQUE,
	email VARCHAR(255) NOT NULL,
	status INT NOT NULL,
	lat DOUBLE,
	lon DOUBLE,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE band_inst(
	inst_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	inst_name VARCHAR(50),
	inst_part INT,
	band_id INT NOT NULL,
	player_id int,
	leader boolean,
	part_leader boolean,
	FOREIGN KEY (band_id) REFERENCES bands(band_id),
	FOREIGN KEY (player_id) REFERENCES users(id)
);

CREATE TABLE band_members(
	member_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	inst_id INT,
	band_id INT NOT NULL,
	FOREIGN KEY (band_id) REFERENCES bands(band_id),
	FOREIGN KEY (inst_id) REFERENCES band_inst(inst_id),
	FOREIGN KEY (member_id) REFERENCES users(id)

);


CREATE TABLE band_inst_apply(
	application_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	inst_id INT,
	player_id INT,
	status INT,
	FOREIGN KEY (inst_id) REFERENCES band_inst(inst_id),
	FOREIGN KEY (player_id) REFERENCES users(id)
);

CREATE TABLE calendar(
	event_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	band_id INT,
	title VARCHAR(255),
	start_date DATETIME,
	end_date DATETIME,
	venue VARCHAR(255),
	lon DOUBLE,
	lat DOUBLE,
	description LONGTEXT,
	FOREIGN KEY (band_id) REFERENCES bands(band_id)
);
	
	
DESCRIBE band_inst;
DROP TABLE calendar;

ALTER TABLE bands 
	ADD COLUMN lat DOUBLE;

SHOW COLUMNS FROM bands;

SELECT * FROM bands;

CREATE TABLE instruments(
	instrument VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO instruments (instrument) VALUES('cello');
SELECT * FROM band_inst_apply;

UPDATE users SET follow='[]' WHERE username = "k";


SET FOREIGN_KEY_CHECKS = 1;
TRUNCATE TABLE bands;
DROP TABLE band_inst_apply;

LOAD DATA LOCAL INFILE '/home/ulysses/lab/musicdb/misc/inst_adj.txt' 
REPLACE INTO TABLE instruments 
LINES STARTING BY '"' TERMINATED BY '"\n';

INSERT INTO band_inst (inst_name, band_id, inst_part) VALUES ('as', 6, 1), ('fd', 6, 1), ('as', 6, 1);
