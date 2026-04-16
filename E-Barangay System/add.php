<?php

    include("database.php");

    if (isset($_POST["add"])) {

        $error = "";
        $residentNumber = "";

        $firstName  = $_POST["firstName"];
        $lastName   = $_POST["lastName"];
        $middleName = $_POST["middleName"];
        $dateOfBirth = $_POST["dateOfBirth"];
        $houseNumber = $_POST["houseNumber"];
        $streetName = $_POST["streetName"];
        $barangayName = $_POST["barangayName"];
        $zipCode = $_POST["zipCode"];
        $cityName = $_POST["cityName"];
        $type = $_POST["type"];
        
        $res = addResident($firstName, $lastName, $middleName, $dateOfBirth, $houseNumber, $streetName, $barangayName, $zipCode, $cityName, $type);
        if (!$res) {
            $error = "Resident already exists.";
        } else {
            $residentNumber = $res;
        }
    }
    
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
    <p><b>ADD RESIDENT</b></p>
    <?php
    
        if (!empty($error)) {
            echo "<b>$error</b>";
        } else {
            if (isset($residentNumber)) {
                echo "<b>Successfully added resident, whose number is: $residentNumber</b>";
            }
        }
    
    ?>
    <form method="POST">
        <table>
            <tr>
                <td>Last Name:</td>
                <td><input type="text" id="a" name="lastName" required><br></td>
            </tr>
            <tr>
                <td>First Name:</td>
                <td><input type="text" id="a" name="firstName" required><br></td>
            </tr>
            <tr>
                <td>Middle Name:</td>
                <td><input type="text" id="a" name="middleName"><br></td>
            </tr>
            <tr>
                <td>Date of Birth:</td>
                <td><input type="date" id="a" name="dateOfBirth" required><br></td>
            </tr>
            <tr>
                <td>Address:</td>
            </tr>
            <tr>
                <td>House Number:</td>
                <td><input type="number" id="a" name="houseNumber" required><br></td>
            </tr>
            <tr>
                <td>Street Name:</td>
                <td><input type="text" id="a" name="streetName" required><br></td>
            </tr>
            <tr>
                <td>Barangay Name:</td>
                <td><input type="text" id="a" name="barangayName" required><br></td>
            </tr>
            <tr>
                <td>Zip Code:</td>
                <td><input type="number" id="a" name="zipCode" min="1000" max="9999" required><br></td>
            </tr>
            <tr>
                <td>City Name:</td>
                <td><input type="text" id="a" name="cityName" required><br></td>
            </tr>
            <tr>
                <td>Type:</td>
                <td>
                    <select name="type">
                        <option value="Homeowner">Homeowner</option>
                        <option value="Tenant">Tenant</option>
                    </select>
                </td>
            </tr>
        </table>
        <br>
        <input type="submit" name="add" value="Add Resident">
    </form>
    <br>
    <button>
        <a href="residents.html">Go Back</a>
    </button>
</body>
</html>