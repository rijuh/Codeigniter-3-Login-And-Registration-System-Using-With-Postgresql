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