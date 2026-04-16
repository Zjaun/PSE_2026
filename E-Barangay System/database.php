<?php

    $username   = "root";
    $server     = "localhost";
    $dbName     = "db_pse";
    $dbTable    = "residents";

    $conn = mysqli_connect($server, $username);
    mysqli_select_db($conn, $dbName);

    function addResident(
        $firstName, $lastName, $middleName,
        $dateOfBirth,
        $houseNumber, $streetName, $barangayName, $zipCode, $cityName,
        $type
    ) {
        $formattedDate = date("dMY", strtotime($dateOfBirth));
        $residentNumber = substr($lastName, 0, 3) . "-" . $houseNumber . substr($streetName, 0, 3) . $zipCode . "-" . $formattedDate;
        $residentNumber = strtoupper($residentNumber);
        if (residentNumberExists($residentNumber)) {
            return false;
        }
        global $conn;
        global $dbTable;
        $query_string = "
            INSERT INTO `{$dbTable}` (number, last_name, first_name, middle_name, date_of_birth, house_number, street_name, barangay_name, zip_code, city_name, type)
            VALUES ('$residentNumber', '$lastName', '$firstName', '$middleName', '$dateOfBirth', $houseNumber, '$streetName', '$barangayName', $zipCode, '$cityName', '$type');
        ";
        try {
            $query = mysqli_query($conn, $query_string);
        } catch (mysqli_sql_exception $e) {
            die($e);
        }
        return $residentNumber;
    }

    function residentNumberExists($residentNumber) {
        global $conn;
        global $dbTable;
        $query = mysqli_query($conn, "SELECT * FROM `{$dbTable}` WHERE number = '$residentNumber'");
        return mysqli_num_rows($query) >= 1;
    }

    function getResidents() {
        global $conn;
        global $dbTable;
        $query = mysqli_query($conn, "SELECT * FROM `{$dbTable}`");
        return mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

    function getResident($residentNumber) {
        if (!residentNumberExists($residentNumber)) {
            return false;
        }
        global $conn;
        global $dbTable;
        $query = mysqli_query($conn, "SELECT * FROM `{$dbTable}` WHERE number = '$residentNumber'");
        return mysqli_fetch_assoc($query);
    }

    function editResident(
        $residentNumber,
        $firstName, $lastName, $middleName,
        $dateOfBirth,
        $houseNumber, $streetName, $barangayName, $zipCode, $cityName,
        $type
    ) {
        $formattedDate = date("dMY", strtotime($dateOfBirth));
        $newResidentNumber = substr($lastName, 0, 3) . "-" . $houseNumber . substr($streetName, 0, 3) . $zipCode . "-" . $formattedDate;
        $newResidentNumber = strtoupper($newResidentNumber); // format to uppercase
        if (residentNumberExists($newResidentNumber) && $residentNumber !== $newResidentNumber) {
            return false;
        }
        global $conn;
        global $dbTable;
        $query_string = "
            UPDATE `{$dbTable}` SET
            number = '$newResidentNumber',
            last_name = '$lastName',
            first_name = '$firstName',
            middle_name = '$middleName',
            date_of_birth = '$dateOfBirth',
            house_number = $houseNumber,
            street_name = '$streetName',
            barangay_name = '$barangayName',
            zip_code = $zipCode,
            city_name = '$cityName',
            type = '$type'
            WHERE number = '$residentNumber';
        ";
        try {
            $query = mysqli_query($conn, $query_string);
        } catch (mysqli_sql_exception $e) {
            die($e);
        }
        return $residentNumber;
    }

    function deleteResident($residentNumber) {
        global $conn;
        global $dbTable;
        $query = mysqli_query($conn, "DELETE FROM `{$dbTable}` WHERE number = '$residentNumber'");
    }

    function searchResident($column, $value) {
        global $conn;
        global $dbTable;
        $query = mysqli_query($conn, "SELECT * FROM `{$dbTable}` WHERE $column LIKE '%$value%'");
        return mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

?>