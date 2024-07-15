<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-07-09 14:36:28 --> Severity: error --> Exception: syntax error, unexpected token "}" C:\xampp\htdocs\ums\application\models\Ums_model.php 38
ERROR - 2024-07-09 21:22:33 --> Severity: Warning --> Undefined variable $mobile C:\xampp\htdocs\ums\application\controllers\Ums_controller.php 90
ERROR - 2024-07-09 22:56:43 --> Severity: Warning --> Undefined variable $email C:\xampp\htdocs\ums\application\views\Reset_password.php 49
ERROR - 2024-07-09 22:58:59 --> Severity: Warning --> Undefined variable $email C:\xampp\htdocs\ums\application\views\Reset_password.php 49
ERROR - 2024-07-09 22:58:59 --> Severity: Warning --> Undefined variable $mobile C:\xampp\htdocs\ums\application\views\Reset_password.php 55
ERROR - 2024-07-09 23:40:21 --> Severity: error --> Exception: syntax error, unexpected variable "$data", expecting ")" C:\xampp\htdocs\ums\application\models\Ums_model.php 36
ERROR - 2024-07-09 23:43:17 --> Severity: error --> Exception: Call to undefined method CI_Input::pst() C:\xampp\htdocs\ums\application\controllers\Ums_controller.php 200
ERROR - 2024-07-09 23:43:48 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;0&quot;
LINE 1: UPDATE &quot;userlogin&quot; SET 0 = 'password', 1 = 'Riju1'
                               ^ C:\xampp\htdocs\ums\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-09 23:43:48 --> Query error: ERROR:  syntax error at or near "0"
LINE 1: UPDATE "userlogin" SET 0 = 'password', 1 = 'Riju1'
                               ^ - Invalid query: UPDATE "userlogin" SET 0 = 'password', 1 = 'Riju1'
WHERE "email" IS NULL
AND "mobile_no" IS NULL
ERROR - 2024-07-09 23:45:09 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;0&quot;
LINE 1: UPDATE &quot;userlogin&quot; SET 0 = 'password', 1 = 'Riju1'
                               ^ C:\xampp\htdocs\ums\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-09 23:45:09 --> Query error: ERROR:  syntax error at or near "0"
LINE 1: UPDATE "userlogin" SET 0 = 'password', 1 = 'Riju1'
                               ^ - Invalid query: UPDATE "userlogin" SET 0 = 'password', 1 = 'Riju1'
WHERE "email" IS NULL
AND "mobile_no" IS NULL
ERROR - 2024-07-09 23:49:32 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;0&quot;
LINE 1: UPDATE &quot;userlogin&quot; SET 0 = 'password', 1 = 'Riju1'
                               ^ C:\xampp\htdocs\ums\system\database\drivers\postgre\postgre_driver.php 234
ERROR - 2024-07-09 23:49:32 --> Query error: ERROR:  syntax error at or near "0"
LINE 1: UPDATE "userlogin" SET 0 = 'password', 1 = 'Riju1'
                               ^ - Invalid query: UPDATE "userlogin" SET 0 = 'password', 1 = 'Riju1'
WHERE "email" = 'admin@ums.com'
AND "mobile_no" = '8116616454'
