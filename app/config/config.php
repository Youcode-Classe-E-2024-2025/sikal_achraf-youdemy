<?php

/**
 * Database config
 */
define('DBHOST', 'localhost');
define('DBNAME', 'YouDemy');
define('DBUSER', 'root');
define('DBPASS', '');
define('DB', 'mysql');

define('APP_NAME', 'YouDemy');

define('ROOT', 'http://localhost/sikal_achraf-youdemy/public');

const TABLES = "
    CREATE TABLE IF NOT EXISTS Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    lastname VARCHAR(50) NOT NULL,
    firstname Varchar(50) NOT NULL,
    email VARCHAR(100),
    password VARCHAR(250),
    slug VARCHAR(100),
    role ENUM('student', 'teacher', 'admin') DEFAULT 'student',
    about VARCHAR(2000) NULL,
    Company VARCHAR(100) NULL ,
    Country VARCHAR(50) NULL,
    Address VARCHAR(100) NULL,
    Phone VARCHAR(20) NULL,
    job VARCHAR(30) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
";