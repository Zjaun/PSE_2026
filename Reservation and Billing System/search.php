<?php

    include("database.php");

    $showFilter = true;
    $showValue = false;
    $column = "";
    $guests = "";

    if (isset($_POST["filter"])) {
        $column = $_POST["column"];
        $showFilter = false;
        $showValue = true;
    }

    if (isset($_POST["search"])) {
        $column = $_POST["column"];
        $value = $_POST["value"];
        $showFilter = true;
        $showValue = false;
        $guests = searchGuests($column, $value);
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
    <?php if ($showFilter): ?>
        <form method="POST">
            Find By:
            <select name="column">
                <option value="guest_id">Guest ID</option>
                <option value="first_name">First Name</option>
                <option value="middle_name">Middle Name</option>
                <option value="last_name">Last Name</option>
                <option value="type">Guest Type</option>
                <option value="registration_date">Registration Date</option>
            </select>
            <input type="submit" name="filter" value="Search">
        </form>
        <br>
    <?php endif; ?>
    <?php if ($showValue): ?>
        <?= "Finding By: $column" ?>
        <form method="POST">
            With Value Being:
            <?php if ($column === "type"): ?>
                <select name="value">
                    <option value="member">Member</option>
                    <option value="non-member">Non-Member</option>
                </select>
            <?php elseif ($column === "registration_date"): ?>
                <input type="date" name="value" required>
            <?php else: ?>
                <input type="text" name="value" required>
            <?php endif; ?>
            <input type="hidden" name="column" value="<?= $column ?>">
            <input type="submit" name="search" value="Search">
        </form>
    <?php endif; ?>
    <?php if (isset($_POST["search"])): ?>
        <table>
            <thead>
                <tr>
                    <td><b>ID</b></td>
                    <td><b>Guest ID</b></td>
                    <td><b>Name</b></td>
                    <td><b>Type</b></td>
                    <td><b>Registration Date</b></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($guests as $guest): ?>
                    <?php
                        $fullName = $guest["first_name"] . " " . $guest["middle_name"] . " " . $guest["last_name"];
                    ?>
                    <tr>
                        <td><?= $guest["id"] ?></td>
                        <td><?= $guest["guest_id"] ?></td>
                        <td><?= $fullName ?></td>
                        <td><?= $guest["type"] ?></td>
                        <td><?= $guest["registration_date"] ?></td>
                        <td>
                            <button><a href="edit.php?id=<?= $guest["id"]?>">Edit</a></button>
                        </td>
                        <td>
                            <button><a href="delete.php?id=<?= $guest["id"]?>">Delete</a></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <br>
    <button><a href="guest.html">Go Back</a></button>
</body>
</html>