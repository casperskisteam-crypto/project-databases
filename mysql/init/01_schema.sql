-- =========================
-- Database
-- =========================
CREATE DATABASE IF NOT EXISTS demo
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE demo;

-- =========================
-- Client
-- =========================
CREATE TABLE Client (
  id_client INT PRIMARY KEY,
  PIB VARCHAR(100) CHARACTER SET utf8mb4,
  pasportni_dani VARCHAR(50),
  telephone VARCHAR(20),
  email1 VARCHAR(100)
) CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- Reservation
-- =========================
CREATE TABLE Reservation (
  id_Reservation INT PRIMARY KEY,
  id_Client INT,
  data_zaizdu DATE,
  data_vyizdu DATE,
  CONSTRAINT fk_reservation_client
    FOREIGN KEY (id_Client) REFERENCES Client(id_client)
) CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- Payment
-- =========================
CREATE TABLE Payment (
  id_Payment INT PRIMARY KEY,
  id_Reservation INT,
  summa DECIMAL(10,2),
  method VARCHAR(20) CHARACTER SET utf8mb4,
  data_payment DATE,
  CONSTRAINT fk_payment_reservation
    FOREIGN KEY (id_Reservation) REFERENCES Reservation(id_Reservation)
) CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- Service
-- =========================
CREATE TABLE Service (
  id_Service INT PRIMARY KEY,
  name VARCHAR(50) CHARACTER SET utf8mb4,
  price INT,
  description TEXT CHARACTER SET utf8mb4
) CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================
-- UseOfService
-- =========================
CREATE TABLE UseOfService (
  id_UseOfService INT PRIMARY KEY,
  id_Reservation INT,
  id_Service INT,
  amount INT,
  total_amount INT,
  CONSTRAINT fk_useofservice_reservation
    FOREIGN KEY (id_Reservation) REFERENCES Reservation(id_Reservation),
  CONSTRAINT fk_useofservice_service
    FOREIGN KEY (id_Service) REFERENCES Service(id_Service)
) CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
