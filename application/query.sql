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

CREATE TABLE userlogin (
	login_id SERIAL PRIMARY KEY,
	name VARCHAR(80),
	email VARCHAR(100),
	password VARCHAR(100)
);

ALTER TABLE userlogin
ADD level VARCHAR(10);