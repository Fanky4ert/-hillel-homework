CREATE DATABASE hillel_homework COLLATE utf8mb4_general_ci;
USE hillel_homework;

CREATE TABLE users (
id  INT UNSIGNED NOT NULL AUTO_INCREMENT,
createdAt DATETIME  NOT NULL,
email VARCHAR (35) NOT NULL,
name VARCHAR (25) NOT NULL,
pass VARCHAR (255) NOT NULL,
PRIMARY KEY (id),
UNIQUE (email)
);

CREATE TABLE projects (
id  INT UNSIGNED NOT NULL AUTO_INCREMENT,
userId INT UNSIGNED NOT NULL,
name VARCHAR (25) NOT NULL,
PRIMARY KEY (id)
);

CREATE TABLE tasks (
id  INT UNSIGNED NOT NULL AUTO_INCREMENT,
createdAt DATETIME NOT NULL,
status ENUM('backlog', 'to-do', 'in_progress', 'done') NOT NULL,
header VARCHAR (50) NOT NULL,
description VARCHAR (255) NOT NULL,
link VARCHAR (255) NULL,
endTime  DATETIME,
userId INT UNSIGNED NOT NULL,
projectId INT UNSIGNED NOT NULL,
PRIMARY KEY (id)
);

create index userId on projects(userId);
create index projectId on tasks(projectId);