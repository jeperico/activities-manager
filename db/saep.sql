CREATE DATABASE saep_db;

USE saep_db;


CREATE TABLE Teacher (
    id_teacher INT AUTO_INCREMENT PRIMARY KEY,
    name_teacher VARCHAR(100) NOT NULL,
    email_teacher VARCHAR(100) UNIQUE NOT NULL,
    password_teacher VARCHAR(100) NOT NULL
);


CREATE TABLE Class (
    id_class INT AUTO_INCREMENT PRIMARY KEY,
    name_class VARCHAR(100) NOT NULL,
    fk_id_teacher INT,
    FOREIGN KEY (fk_id_teacher) REFERENCES Teacher(id_teacher)
);


CREATE TABLE Activity (
    id_activity INT AUTO_INCREMENT PRIMARY KEY,
    description_activity varchar(100),
    fk_id_class INT,
    FOREIGN KEY (fk_id_class) REFERENCES Class(id_class)
);

INSERT INTO Teacher (name_teacher, email_teacher, password_teacher) 
VALUES 
('Alice Silva', 'alice.silva@escola.com', 'senha123'),
('Bruno Oliveira', 'bruno.oliveira@escola.com', 'senha456'),
('Carla Ferreira', 'carla.ferreira@escola.com', 'senha789'),
('Diego Santos', 'diego.santos@escola.com', 'senha101'),
('Elena Costa', 'elena.costa@escola.com', 'senha202');

INSERT INTO Class (name_class, fk_id_teacher)
VALUES 
('DS1', 1),
('DS2', 2),
('DS3', 3),
('DS4', 4),
('DS5', 5);


INSERT INTO Activity (description_activity, fk_id_class)
VALUES 
('Atividade sobre frações', 1),
('Experimento de eletricidade', 2),
('Trabalho sobre Revolução Francesa', 3),
('Exercício de reação química', 4),
('Pesquisa sobre ecossistemas', 5);
