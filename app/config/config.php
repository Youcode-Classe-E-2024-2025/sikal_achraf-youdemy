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

    CREATE TABLE IF NOT EXISTS courses (
        `course_id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(50) NOT NULL,
        `description` varchar(2000) DEFAULT NULL,
        `user_id` int(11) NOT NULL,
        `category_id` int(11) NOT NULL,
        `price` int(11) DEFAULT NULL,
        `primary_subject` varchar(100) DEFAULT NULL,
        `course_image` varchar(1024) DEFAULT NULL,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`course_id`),
        KEY `title` (`title`,`user_id`,`price`,`primary_subject`,`created_at`)
    );
    CREATE TABLE IF NOT EXISTS categories(
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `category` varchar(50) NOT NULL,
        PRIMARY KEY (`id`),
        KEY `category` (`category`)
    )

";