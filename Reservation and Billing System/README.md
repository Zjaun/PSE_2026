# [PSE 2026] Reservation and Billing Mock System

## Pre-requisites
- Must have [XAMPP](https://www.apachefriends.org/download.html) installed;
- Initialize database named `db_pse`;
- Create table `guests` with the following fields:

    ```sql
    id                int          AUTO_INCREMENT PRIMARY_KEY
    guest_id          VARCHAR(255) NOT NULL       UNIQUE
    last_name         VARCHAR(255) NOT NULL
    first_name        VARCHAR(255) NOT NULL
    middle_name       VARCHAR(255) NULL
    registration_date DATE         NOT NULL
    type              VARCHAR(255) NOT NULL
    ```

- Create table `rooms` with the following fields:

    ```sql
    id       int            AUTO_INCREMENT PRIMARY_KEY
    type     VARCHAR(255)   NOT NULL
    cost     DECIMAL(10, 2) NOT NULL
    capacity int            NOT NULL
    ```
