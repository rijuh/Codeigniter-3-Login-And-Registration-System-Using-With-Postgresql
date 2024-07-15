CREATE TABLE userinfo (
	id BIGSERIAL PRIMARY KEY,
	fname VARCHAR(50),
	mname VARCHAR(50),
	lname VARCHAR(50),
	age INT,
	dob DATE,
	gender VARCHAR(10),
	mobile_no NUMERIC(10, 0),
	email VARCHAR(50)
);

ALTER TABLE userinfo
ADD level VARCHAR(10);

CREATE TABLE userlogin (
	login_id SERIAL PRIMARY KEY,
	name VARCHAR(80),
	email VARCHAR(100),
	password VARCHAR(256)
);

ALTER TABLE userlogin
ADD level VARCHAR(10);

ALTER TABLE userlogin
ADD mobile_no NUMERIC(10, 0);

ALTER TABLE userlogin
ADD user_id INT REFERENCES userinfo(id);

CREATE TABLE education
(
	id SERIAL PRIMARY KEY,
	exam_name VARCHAR(15),
	yop NUMERIC(4,0),
	inst_name VARCHAR(40),
	o_marks INT,
	f_marks INT,
	user_id INT REFERENCES userinfo(id) 
);