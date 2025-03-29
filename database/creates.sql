CREATE TABLE IF NOT EXISTS estado (
  id SERIAL PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  abreviacao VARCHAR(2) NOT NULL
);

CREATE TABLE IF NOT EXISTS cidade (
  id SERIAL PRIMARY KEY,
  estado_id INT NOT NULL,
  nome VARCHAR(255) NOT NULL,
  CONSTRAINT fk_estado FOREIGN KEY (estado_id) REFERENCES estado(id)
);

CREATE TABLE IF NOT EXISTS fabricante (
  id SERIAL PRIMARY KEY,
  descricao VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS modelo (
  id SERIAL PRIMARY KEY,
  descricao VARCHAR(255) NOT NULL,
  fabricante_id INT NOT NULL,
  CONSTRAINT fk_fabricante FOREIGN KEY (fabricante_id) REFERENCES fabricante(id)
);

CREATE TABLE IF NOT EXISTS tipo_veiculo (
  id SERIAL PRIMARY KEY,
  descricao VARCHAR(100) NOT NULL,
  valor DECIMAL(10,2) NOT NULL
);

CREATE TABLE IF NOT EXISTS veiculo (
  id SERIAL PRIMARY KEY,
  placa VARCHAR(7) NOT NULL,
  modelo_id INT NOT NULL,
  tipo_veiculo_id INT NOT NULL,
  CONSTRAINT fk_modelo FOREIGN KEY (modelo_id) REFERENCES modelo(id),
  CONSTRAINT fk_tipo_veiculo FOREIGN KEY (tipo_veiculo_id) REFERENCES tipo_veiculo(id)
);

CREATE TABLE IF NOT EXISTS praca (
  id SERIAL PRIMARY KEY,
  numero INT NOT NULL,
  cidade_id INT NOT NULL,
  CONSTRAINT fk_cidade FOREIGN KEY (cidade_id) REFERENCES cidade(id)
);

CREATE TABLE IF NOT EXISTS ticket (
  id SERIAL PRIMARY KEY,
  valor DECIMAL(10,2) NOT NULL,
  data_hora TIMESTAMP NOT NULL,
  veiculo_id INT NOT NULL,
  praca_id INT NOT NULL,
  CONSTRAINT fk_veiculo FOREIGN KEY (veiculo_id) REFERENCES veiculo(id),
  CONSTRAINT fk_praca FOREIGN KEY (praca_id) REFERENCES praca(id)
);
