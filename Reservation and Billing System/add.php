<?php

    include("database.php");

    $message = "";

    if (isset($_POST["add"])) {
        $first_name = $_POST["first_name"];
        $middle_name = $_POST["middle_name"];
        $last_name = $_POST["last_name"];
        $type = $_POST["type"];
        $registration_date = $_POST["date"];
        $res = addGuest($first_name, $middle_name, $last_name, $type, $registration_date);
        if (!$res) {
            $message = "Generated Guest ID already exists. Try again.";
        } else {
            $message = "Successfully added guest whose ID is: $res";
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
    <h1>RESERVATION AND BILLING SYSTEM</h1>
    <?php if (!empty($message)): ?>
        <h3><?= $message ?></h3>
    <?php endif; ?>
    <form method="POST">
        <table>
            <tr>
                <td>First Name:</td>
                <td><input type="text" name="first_name" required></td>
            </tr>
            <tr>
                <td>Middle Name:</td>
                <td><input type="text" name="middle_name"></td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td><input type="text" name="last_name" required></td>
            </tr>
            <tr>
                <td>Type:</td>
                <td>
                    <select name="type">
                        <option value="member">Member</option>
                        <option value="non-member">Non-Member</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Date of Registration:</td>
                <td><input type="date" name="date" required></td>
            </tr>
            <tr><td><input type="submit" name="add" value="Add Guest"></td></tr>
        </table>
    </form>
    <br>
    <button><a href="guest.html">Go Back</a></button>
</body>
</html>