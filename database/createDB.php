############################################
#
#	Create a database and tables:
#	STUDENT -- Name and Contact info
#	Stu_Interest
#
#
############################################


CREATE DATABASE college;
USE college;

CREATE TABLE student (
user_id MEDIUMINT UNSIGNED NOT NULL
AUTO_INCREMENT,
last_name VARCHAR(40) NOT NULL, 
first_name VARCHAR(20) NOT NULL,
middle_initial VARCHAR(1) NULL,
street VARCHAR(100) NOT NULL,
city VARCHAR(40) NOT NULL,
state VARCHAR(20) NOT NULL,
zip VARCHAR(10) NOT NULL,
telephone VARCHAR(10) NOT NULL,
major VARCHAR(20) NOT NULL,
minor VARCHAR(20) NULL,
PRIMARY KEY (user_id)
);

CREATE TABLE stu_interest ( 
interest_id MEDIUMINT UNSIGNED NOT NULL
AUTO_INCREMENT,
user_id MEDIUMINT UNSIGNED NOT NULL,
day_class BOOLEAN NOT NULL DEFAULT 0,
night_class BOOLEAN NOT NULL DEFAULT 0,
courses_perSem ENUM('1', '2', '3', '4') default '1',
admission BOOLEAN NOT NULL DEFAULT 0,
financial BOOLEAN NOT NULL DEFAULT 0,
athletics BOOLEAN NOT NULL DEFAULT 0,
student_services BOOLEAN NOT NULL DEFAULT 0,
seek BOOLEAN NOT NULL DEFAULT 0,
wan_lib BOOLEAN NOT NULL DEFAULT 0,
baruch_pac BOOLEAN NOT NULL DEFAULT 0,
honors BOOLEAN NOT NULL DEFAULT 0,
clubs BOOLEAN NOT NULL DEFAULT 0,
academics BOOLEAN NOT NULL DEFAULT 0,
housing BOOLEAN NOT NULL DEFAULT 0,
starr BOOLEAN NOT NULL DEFAULT 0,
wass BOOLEAN NOT NULL DEFAULT 0,
debate BOOLEAN NOT NULL DEFAULT 0,
comments TEXT NULL,
PRIMARY KEY (interest_id),
FOREIGN KEY (user_id) REFERENCES
	student (user_id)
ON DELETE NO ACTION 
ON UPDATE NO ACTION	
);

###################################################
#
#
#	Create user for this database
#		limit privillages to:
#		SELECT and INSERT
#
#
###################################################

GRANT SELECT, INSERT ON college.* TO collegeApp@localhost IDENTIFIED BY 'p4ssw0rd';


