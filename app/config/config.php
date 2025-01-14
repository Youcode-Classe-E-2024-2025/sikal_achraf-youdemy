<?php

/**
 * Database config
 */
define('DBHOST', 'localhost');
define('DBNAME', 'YouDemy');
define('DBUSER', 'root');
define('DBPASS', '');
define('DB', 'mysql');

const TABLES = "
    CREATE TABLE IF NOT EXISTS Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    lastname VARCHAR(50) NOT NULL,
    firstname Varchar(50) NOT NULL,
    email VARCHAR(100),
    password VARCHAR(250),
    role ENUM('Manager', 'User') DEFAULT 'User',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);

    CREATE TABLE IF NOT EXISTS categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE
    );

    CREATE TABLE IF NOT EXISTS projects (
    project_id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(255) NOT NULL,
    project_owner_id INT,
    category_id INT,
    status ENUM('Planned', 'Active', 'On Hold', 'Completed', 'Cancelled') DEFAULT 'Planned',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE SET NULL,
    FOREIGN KEY (project_owner_id) REFERENCES users(user_id) ON DELETE SET NULL
    );

    CREATE TABLE IF NOT EXISTS Tasks (
    task_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    project_id INT,
    assign_id INT,
    status ENUM('To Do', 'In Progress', 'Done') DEFAULT 'To Do',
    task_type ENUM('Simple', 'Bug', 'Feature') DEFAULT 'Simple',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(project_id),
    FOREIGN KEY (assign_id) REFERENCES Users(user_id) ON DELETE SET NULL
    );

    insert into categories(category_name) values('Frontend'),('Backend'),('UI'),('UX');

    CREATE TABLE IF NOT EXISTS TeamMembers (
    user_id INT,
    project_id INT,
    PRIMARY KEY (user_id, project_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (project_id) REFERENCES projects(project_id) ON DELETE CASCADE);

    CREATE TABLE IF NOT EXISTS Permissions (
    Permission_id INT AUTO_INCREMENT PRIMARY KEY,
    role_attr varchar(255),
    Permission varchar(255),
    PRIMARY KEY (Permission,role),
    FOREIGN KEY (role_attr) REFERENCES users(role) ON DELETE CASCADE);

";