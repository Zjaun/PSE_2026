<?php

    include("database.php");

    if (isset($_POST["delete"])) {
        deleteResident($_POST["residentNumber"]);
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
    <form method="POST">
        Resident Number:
        <input type="text" id="a" name="residentNumber" required>
        <input type="submit" name="delete">
    </form>
    <br>
    <button>
        <a href="residents.html">Go Back</a>
    </button>
</body>
</html>