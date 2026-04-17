<?php

    include("database.php");

    $message = "";
    $cost = "";

    if (isset($_POST["check"])) {
        $guest_id = $_POST["guest_id"];
        if (!guestIdAlreadyExists($guest_id)) {
            $message = "Guest ID does not exist";
        } else {
            $guest = getGuestByGuestID($guest_id);
            $type = $_POST["room_type"];
            $guests = $_POST["guests"];
            $rooms = ceil($guests / getRoomCapacity($type));
            $days = $_POST["days"];
            $initial_cost = getRoomCost($type) * $days * $rooms;
            $multiplier = 1;
            if ($guest["type"] === "member") {
                $multiplier -= 0.05;
            } else if (($type === "Standard" || $type === "Suite") && $rooms >= 5) {
                $multiplier -= 0.02;
            }
            if ($days >= 7) {
                 $multiplier -= 0.03;
            }
            $cost = $initial_cost * $multiplier;
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
                <td>Guest ID:</td>
                <td><input type="text" name="guest_id" required></td>
            </tr>
            <tr>
                <td>Room Type:</td>
                <td>
                    <select name="room_type">
                        <option value="Standard">Standard</option>
                        <option value="Suite">Suite</option>
                        <option value="Deluxe">Deluxe</option>
                        <option value="Family">Family</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Number of Guests:</td>
                <td><input type="number" name="guests" min="1" required></td>
            </tr>
            <tr>
                <td>Number of Days:</td>
                <td><input type="number" name="days" min="1" required></td>
            </tr>
            <tr><td><input type="submit" name="check" value="Check Pricing"></td></tr>
        </table>
    </form>
    <?php if (empty($message) && isset($_POST["check"])): ?>
        <h3><?php echo "Amount Due: PHP " . number_format($cost, 2); ?></h3>
    <?php endif; ?>
    <br>
    <button><a href="index.html">Go Back</a></button>
</body>
</html>