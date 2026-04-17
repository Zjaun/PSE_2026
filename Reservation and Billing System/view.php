<?php

    include("database.php");

    $guests = getGuests();

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
    <br>
    <button><a href="guest.html">Go Back</a></button>
</body>
</html>