<?php

    $dbUsername     = "root";
    $dbServer       = "localhost";
    $dbName         = "db_pse";
    $tableGuests    = "guests"; // name of table
    $tableRooms     = "rooms";  // name of table

    $conn = mysqli_connect($dbServer, $dbUsername);
    mysqli_select_db($conn, $dbName);

    function guestIdAlreadyExists($guestId) {
        global $conn;
        global $tableGuests;
        $query = mysqli_query($conn, "SELECT * FROM `{$tableGuests}` WHERE guest_id = '$guestId'");
        return mysqli_num_rows($query) >= 1;
    }

    function addGuest(
        $first_name, $middle_name, $last_name,
        $type,
        $registration_date
    ) {
        global $conn;
        global $tableGuests;
        $randomNumber = random_int(0, 99999);
        $randomNumber = sprintf("%05d", $randomNumber);
        $formattedDate = strtoupper(date("dMy", strtotime($registration_date)));
        $guest_id = substr(strtoupper($last_name), 0, 3) . "-" . $randomNumber . "-" . $formattedDate;
        if (guestIdAlreadyExists($guest_id)) {
            return false;
        }
        $queryString = "
            INSERT INTO `{$tableGuests}` (guest_id, last_name, first_name, middle_name, type, registration_date)
            VALUES ('$guest_id', '$last_name', '$first_name', '$middle_name', '$type', '$registration_date')
        ";
        try {
            $query = mysqli_query($conn, $queryString);
        } catch (mysqli_sql_exception $e) {
            die($e);
        }
        return $guest_id;
    }

    function getGuests() {
        global $conn;
        global $tableGuests;
        $query = mysqli_query($conn, "SELECT * FROM `{$tableGuests}`");
        return mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

    function deleteGuest($id) {
        global $conn;
        global $tableGuests;
        $query = mysqli_query($conn, "DELETE FROM `{$tableGuests}` WHERE id = '$id'");
    }

    function getGuestByID($id) {
        global $conn;
        global $tableGuests;
        $query = mysqli_query($conn, "SELECT * FROM `{$tableGuests}` WHERE id = '$id'");
        return mysqli_fetch_assoc($query);
    }

    function getGuestByGuestID($guest_id) {
        global $conn;
        global $tableGuests;
        $query = mysqli_query($conn, "SELECT * FROM `{$tableGuests}` WHERE guest_id = '$guest_id'");
        return mysqli_fetch_assoc($query);
    }
    
    function editGuest(
        $id,
        $first_name, $middle_name, $last_name,
        $type,
        $registration_date
    ) {
        global $conn;
        global $tableGuests;
        $old_guest = getGuestByID($id);
        $guest_id = $old_guest["guest_id"];
        if (strtolower($old_guest["last_name"]) !== strtolower($last_name) || $old_guest["registration_date"] !== $registration_date) {
            $randomNumber = random_int(0, 99999);
            $randomNumber = sprintf("%05d", $randomNumber);
            $formattedDate = strtoupper(date("dMy", strtotime($registration_date)));
            $new_guest_id = substr(strtoupper($last_name), 0, 3) . "-" . $randomNumber . "-" . $formattedDate;
            if (guestIdAlreadyExists($new_guest_id) && $guest_id !== $new_guest_id) {
                return false;
            }
        }
        $queryString = "
            UPDATE `{$tableGuests}` SET
            guest_id = '$guest_id',
            first_name = '$first_name',
            middle_name = '$middle_name',
            last_name = '$last_name',
            type = '$type',
            registration_date = '$registration_date'
            WHERE id = '$id'
        ";
        try {
            $query = mysqli_query($conn, $queryString);
        } catch (mysqli_sql_exception $e) {
            die($e);
        }
    }

    function searchGuests($column, $value) {
        global $conn;
        global $tableGuests;
        $query = mysqli_query($conn, "SELECT * FROM `{$tableGuests}` WHERE `$column` LIKE '%$value%'");
        return mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

    function getRoomCapacity($type) {
        global $conn;
        global $tableRooms;
        $query = mysqli_query($conn, "SELECT `capacity` FROM `{$tableRooms}` WHERE `type` = '$type'");
        return mysqli_fetch_assoc($query)["capacity"] ;
    }

    function getRoomCost($type) {
        global $conn;
        global $tableRooms;
        $query = mysqli_query($conn, "SELECT `cost` FROM `{$tableRooms}` WHERE `type` = '$type'");
        return mysqli_fetch_assoc($query)["cost"] ;
    }


?>