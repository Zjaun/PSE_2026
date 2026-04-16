<?php

    include("database.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>E-BARANGAY SYSTEM | RESIDENTS MODULE</h1>
    <table>
        <thead>
            <tr>
                <td><b>ID</b></td>
                <td><b>Resident Number</b></td>
                <td><b>Full Name</b></td>
                <td><b>Date of Birth</b></td>
                <td><b>Address</b></td>
                <td><b>Resident Type</b></td>
            </tr>
        </thead>
        <tbody>
        <?php
            $residents = getResidents();
            foreach ($residents as $resident) {
                $id = $resident["id"];
                $residentNumber = $resident["number"];
                $lastName = $resident["last_name"];
                $middleName = $resident["middle_name"];
                $firstName = $resident["first_name"];
                $fullName = $firstName . " " . $middleName . " " . $lastName;
                $dateOfBirth = $resident["date_of_birth"];
                $houseNumber = $resident["house_number"];
                $streetName = $resident["street_name"];
                $barangayName = $resident["barangay_name"];
                $zipCode = $resident["zip_code"];
                $cityName = $resident["city_name"];
                $address = $houseNumber . " " . $streetName . ", " . $barangayName . ", " . $zipCode . ", " . $cityName;
                $residentType = $resident["type"];
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$residentNumber</td>";
                echo "<td>$fullName</td>";
                echo "<td>$dateOfBirth</td>";
                echo "<td>$address</td>";
                echo "<td>$residentType</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
    <br>
    <button>
        <a href="residents.html">Go Back</a>
    </button>
</body>
</html>