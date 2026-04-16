<?php

    include("database.php");

    $residents = "";
    $showValue = false;
    $showFilter = true;
    $filter = "";
    $validatedFields = ["date_of_birth", "house_number", "zip_code", "type"];
    $needsValidation = false;

    if (isset($_POST["search"])) {
        $column = $_POST["filter"];
        $value = $_POST["value"];
        $showFilter = true;
        $showValue = false;
        $residents = searchResident($column, $value);   
    } else if (isset($_POST["filter"])) {
        $filter = $_POST["column"];
        $needsValidation = in_array($filter, $validatedFields);
        $showValue = true;
        $showFilter = false;
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
    <?php if ($showFilter): ?>
    <form method="POST">
        Filter:
        <select name="column">
            <option value="number">Resident Number</option>
            <option value="first_name">First Name</option>
            <option value="middle_name">Middle Name</option>
            <option value="date_of_birth">Date of Birth</option>
            <option value="house_number">House Number</option>
            <option value="street_name">Street Name</option>
            <option value="barangay_name">Barangay Name</option>
            <option value="zip_code">Zip Code</option>
            <option value="city_name">City Name</option>
            <option value="type">Resident Type</option>
        </select>
        <input type="submit" name="filter">
    </form>
    <?php endif; ?>
    <?php if ($showValue): ?>
    <form method="POST">
        Value:
        <?php if ($needsValidation): ?>
            <?php if ($filter === "house_number"): ?>
                <input type="number" name="value" required>
            <?php endif; ?>
            <?php if ($filter === "zip_code"): ?>
                <input type="number" name="value" min="1000" max="9999" required>
            <?php endif; ?>
            <?php if ($filter === "date_of_birth"): ?>
                <input type="date" name="value" required>
            <?php endif; ?>
            <?php if ($filter === "type"): ?>
                <select name="value">
                    <option value="Homeowner">Homeowner</option>
                    <option value="Tenant">Tenant</option>
                </select>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (!$needsValidation): ?>
            <input type="text" name="value" required>
        <?php endif; ?>
        <input type="hidden" name="filter" value="<?= $filter ?>">
        <input type="submit" name="search">
    </form>
    <?php endif; ?>
    <?php if (isset($_POST["search"])): ?>
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
    <?php endif; ?>
    <br>
    <button>
        <a href="residents.html">Go Back</a>
    </button>
</body>
</html>  