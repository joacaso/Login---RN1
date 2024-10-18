-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS users_db;

-- Usar la base de datos
USE users_db;

-- Crear la tabla users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Insertar un usuario de prueba (hash de contraseña)
-- Asegúrate de usar password_hash() para guardar contraseñas cifradas.
INSERT INTO users (username, email, password)
VALUES ('john_doe', 'john@example.com', '$2y$10$useYourHashHere');
