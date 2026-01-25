CREATE DATABASE mvc_crud CHARACTER SET utf8mb4;
USE mvc_crud;

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  status TINYINT DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO categories(name) VALUES
('Kitchen Tools'),
('Appliances'),
('Health & Care');
