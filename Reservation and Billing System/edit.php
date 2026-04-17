<?php

    include("database.php");

    $message = "";

    if (isset($_POST["edit"])) {
        $id = $_POST["id"];
        $first_name = $_POST["first_name"];
        $middle_name = $_POST["middle_name"];
        $last_name = $_POST["last_name"];
        $type = $_POST["type"];
        $registration_date = $_POST["date"];
        $res = editGuest($id, $first_name, $middle_name, $last_name, $type, $registration_date);
        if ($res === false) {
            $message = "Generated Guest ID already exists. Try again.";
        } else {
            header("Location: view.php");
        }
    }

    if (!isset($_GET["id"])) {
        header("Location: view.php");
    }

    $guest = "";

    if (isset($_GET["id"])) {
        $guest = getGuestByID($_GET["id"]);
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
                <td><input type="text" name="first_name" value="<?= $guest["first_name"] ?>" required></td>
            </tr>
            <tr>
                <td>Middle Name:</td>
                <td><input type="text" name="middle_name" value="<?= $guest["middle_name"] ?>"></td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td><input type="text" name="last_name" value="<?= $guest["last_name"] ?>" required></td>
            </tr>
            <tr>
                <td>Type:</td>
                <td>
                    <select name="type">
                        <option value="member" <?php if ($guest["type"] === "member") echo "selected"?> >Member</option>
                        <option value="non-member" <?php if ($guest["type"] === "non-member") echo "selected"?>>Non-Member</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Date of Registration:</td>
                <td><input type="date" name="date" value="<?= $guest["registration_date"] ?>" required></td>
            </tr>
            <tr><td><input type="submit" name="edit" value="Edit Guest"></td></tr>
            <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
        </table>
    </form>
    <br>
    <button><a href="guest.html">Go Back</a></button>
</body>
</html>