# Лабораторна робота №4  
## CRUD-система на PHP + Docker

**Студент:** Приходько Кирило 
**Група:** KI-241  

---

## Опис проєкту
Веб-застосунок, що реалізує **CRUD (Create, Read, Update, Delete)** операції для бази даних готельного типу.  
Проєкт запускається у **Docker-середовищі** та використовує **PDO з підготовленими запитами** для безпечної роботи з базою даних.

---

## Використані технології
- **PHP 8.3**
- **MySQL 8.4**
- **Nginx**
- **PDO (prepared statements)**
- **Docker / Docker Compose**

---

## Структура проєкту
# Лабораторна робота №4  
## CRUD-система на PHP + Docker

**Студент:** Приходько Кирило 
**Група:** KI-241  

---

## Опис проєкту
Веб-застосунок, що реалізує **CRUD (Create, Read, Update, Delete)** операції для бази даних готельного типу.  
Проєкт запускається у **Docker-середовищі** та використовує **PDO з підготовленими запитами** для безпечної роботи з базою даних.

---

## Використані технології
- **PHP 8.3**
- **MySQL 8.4**
- **Nginx**
- **PDO (prepared statements)**
- **Docker / Docker Compose**

---

## Структура проєкту
project-databases/
├── app/
│ ├── public/
│ │ └── index.php
│ ├── src/
│ │ ├── Db.php
│ │ ├── ClientDao.php
│ │ ├── ReservationDao.php
│ │ ├── PaymentDao.php
│ │ ├── ServiceDao.php
│ │ └── UseOfServiceDao.php
│ ├── views/
│ │ ├── layout.php
│ │ └── table/
│ │ ├── index.php
│ │ ├── show.php
│ │ └── form.php
│ └── Dockerfile
├── mysql/
│ └── init/
│ ├── 01_schema.sql
│ └── 02_data.sql
├── .nginx/
│ └── default.conf
├── docker-compose.yml
├── README.md
