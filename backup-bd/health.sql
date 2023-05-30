CREATE DATABASE health;

USE DATABASE health;


CREATE TABLE IF NOT EXISTS usuarios (
  id int NOT NULL AUTO_INCREMENT,
  nome varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  usuario varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  senha_usuario varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS pacientes (
  id_paciente int NOT NULL AUTO_INCREMENT,
  nome varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  prontuario varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  medicacao varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  observacoes varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,  
  PRIMARY KEY (id_paciente)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO usuarios (nome, usuario, senha_usuario) VALUES
('Wendel Tonzar', 'wendel@gmail.com', '$2y$10$h8ZgUrhzl9mOY3pjhBJNs.Mna5tmXAGsn35aitbvAwreVtHWHDE6u'),
('Karina Tonzar', 'kahtonzar@gmail.com', '$2y$10$UIyJLzaEqiZVVMMVkc2lzub9LEGHBn7GGn5S1dfgC2xyJv6/cpptu');

INSERT INTO pacientes (nome, prontuario, medicacao, observacoes) VALUES 
('Luiz da Silva', 3036, 'diazepan', 'Tratamento de insônia.'),
('José de Souza', 3037, 'rivotril', 'Tratamento de ansiedade.');
