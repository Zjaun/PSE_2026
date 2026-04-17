# [PSE 2026] E-Barangay Mock System

## Pre-requisites
- Must have [XAMPP](https://www.apachefriends.org/download.html) installed;
- Initialize database named `db_pse`, create table `residents` with the following fields:

    ```sql
    id             int          AUTO_INCREMENT PRIMARY_KEY
    number         VARCHAR(255) NOT NULL       UNIQUE
    last_name      VARCHAR(255) NOT NULL
    first_name     VARCHAR(255) NOT NULL
    middle_name    VARCHAR(255) NULL
    date_of_birth  DATE         NOT NULL
    house_number   int          NOT NULL
    street_name    VARCHAR(255) NOT NULL
    barangay_name  VARCHAR(255) NOT NULL
    zip_code       int NOT NULL
    city_name      VARCHAR(255) NOT NULL
    type           VARCHAR(255) NOT NULL
    ```
