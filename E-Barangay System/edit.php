<?php

    include("database.php");

    $showSearch = true;
    $showEdit = false;
    $resident = "";
    $error = "";

    if (isset($_POST["search"])) {
        $residentNumber = $_POST["residentNumber"];
        $res = getResident($residentNumber);
        if (!$res) {
            $error = "Resident Number Does Not Exist.";
        } else {
            $showSearch = false;
            $showEdit = true;
            $resident = $res;
        }
    }

    if (isset($_POST["edit"])) {
        $residentNumber = $_POST["residentNumber"];
        
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

        $res = editResident($residentNumber, $firstName, $lastName, $middleName, $dateOfBirth, $houseNumber, $streetName, $barangayName, $zipCode, $cityName, $type);
        if (!$res) {
            $error = "Same Resident Number appears.";
        } else {
            $showSearch = true;
            $showEdit = false;
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
    <?php if ($showSearch): ?>
        <?php if (!empty($error)) echo "<b>$error</b>"; ?>
        <form method="POST">
            Resident Number:
            <input type="text" id="a" name="residentNumber" required>
            <input type="submit" name="search" value="Search Resident">
        </form>
    <?php endif; ?>
    <?php if ($showEdit): ?>
        <form method="POST">
            <table>
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" id="a" name="lastName" value="<?php echo $resident["last_name"]; ?>" required><br></td>
                </tr>
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" id="a" name="firstName" value="<?php echo $resident["first_name"]; ?>" required><br></td>
                </tr>
                <tr>
                    <td>Middle Name:</td>
                    <td><input type="text" id="a" name="middleName" value="<?php echo $resident["middle_name"]; ?>" ><br></td>
                </tr>
                <tr>
                    <td>Date of Birth:</td>
                    <td><input type="date" id="a" name="dateOfBirth" value="<?php echo $resident["date_of_birth"]; ?>" required><br></td>
                </tr>
                <tr>
                    <td>Address:</td>
                </tr>
                <tr>
                    <td>House Number:</td>
                    <td><input type="number" id="a" name="houseNumber" value="<?php echo $resident["house_number"]; ?>" required><br></td>
                </tr>
                <tr>
                    <td>Street Name:</td>
                    <td><input type="text" id="a" name="streetName" value="<?php echo $resident["street_name"]; ?>" required><br></td>
                </tr>
                <tr>
                    <td>Barangay Name:</td>
                    <td><input type="text" id="a" name="barangayName" value="<?php echo $resident["barangay_name"]; ?>" required><br></td>
                </tr>
                <tr>
                    <td>Zip Code:</td>
                    <td><input type="number" id="a" name="zipCode" min="1000" max="9999" value="<?php echo $resident["zip_code"]; ?>" required><br></td>
                </tr>
                <tr>
                    <td>City Name:</td>
                    <td><input type="text" id="a" name="cityName"  value="<?php echo $resident["city_name"]; ?>" required><br></td>
                </tr>
                <tr>
                    <td>Type:</td>
                    <td>
                        <select name="type">
                            <option value="Homeowner" <?php if ($resident["type"] === "Homeowner") echo "selected=\"selected\""; ?>>Homeowner</option>
                            <option value="Tenant" <?php if ($resident["type"] === "Tenant") echo "selected=\"selected\""; ?>>Tenant</option>
                        </select>
                    </td>
                </tr>
            </table>
            <br>
            <input type="hidden" name="residentNumber" value="<?php echo $residentNumber; ?>">
            <input type="submit" name="edit" value="Edit Resident">
        </form>
    <?php endif; ?>
    <br>
    <button>
        <a href="residents.html">Go Back</a>
    </button>
</body>
</html>