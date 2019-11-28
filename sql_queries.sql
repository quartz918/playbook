USE musicdb;
SHow tables;
CREATE TABLE users(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(50) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE follow(
	rel_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_id INT,
	follow_id INT,
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (follow_id) REFERENCES users(id),
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE instruments(
	instrument_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	instrument_name VARCHAR(50),
	user_id INT,
	description LONGTEXT,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE bands(
	band_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	bandname VARCHAR(50) NOT NULL UNIQUE,
	email VARCHAR(255) NOT NULL,
	leader INT,
	status INT NOT NULL,
	lat DOUBLE,
	lon DOUBLE,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (leader) REFERENCES users(id)
);

CREATE TABLE band_inst(
	inst_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	inst_name VARCHAR(50),
	voice_id INT,
	band_id INT NOT NULL,
	player_id int,
	leader boolean,
	FOREIGN KEY (band_id) REFERENCES bands(band_id),
	FOREIGN KEY (player_id) REFERENCES users(id),
	FOREIGN KEY (voice_id) REFERENCES band_voices(voice_id)
);

CREATE TABLE band_members(
	member_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	inst_id INT,
	band_id INT NOT NULL,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (band_id) REFERENCES bands(band_id),
	FOREIGN KEY (inst_id) REFERENCES band_inst(inst_id),
	FOREIGN KEY (member_id) REFERENCES users(id)

);


CREATE TABLE band_inst_apply(
	application_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	inst_id INT,
	player_id INT,
	status INT,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
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
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (band_id) REFERENCES bands(band_id)
);

CREATE TABLE band_voices(
	voice_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	band_id INT,
	voice_name VARCHAR(255),
	voice_leader INT,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (band_id) REFERENCES bands(band_id),
	FOREIGN KEY (voice_leader) REFERENCES users(id)
);


CREATE TABLE event_attend(
	attend_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	event_id INT,
	user_id INT,
	status INT,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (event_id) REFERENCES calendar(event_id),
	FOREIGN KEY (user_id) REFERENCES users(id)
	);
DESCRIBE band_inst;
DROP TABLE band_members;

ALTER TABLE band_inst_apply 
	ADD COLUMN voice_id INT;

SHOW COLUMNS FROM bands;

SELECT * FROM band_voices;
SELECT * FROM band_inst;
CREATE TABLE instruments(
	instrument VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO instruments (instrument) VALUES('cello');
SELECT * FROM band_inst_apply;

UPDATE users SET follow='[]' WHERE username = "k";


SET FOREIGN_KEY_CHECKS = 1;
TRUNCATE TABLE bands;
DROP TABLE instruments;

LOAD DATA LOCAL INFILE '/home/ulysses/lab/musicdb/misc/inst_adj.txt' 
REPLACE INTO TABLE instruments 
LINES STARTING BY '"' TERMINATED BY '"\n';

INSERT INTO band_inst (inst_name, band_id, inst_part) VALUES ('as', 6, 1), ('fd', 6, 1), ('as', 6, 1);



SET FOREIGN_KEY_CHECKS = 0; 
DELETE FROM band_inst WHERE voice_id = 1; 
DELETE FROM band_voices WHERE voice_id = 1; 
SET FOREIGN_KEY_CHECKS = 1;
