<?php

    include("database.php");

    $residentNumber = "";
    $income = "";
    $error = "";
    $cedula = 5;

    if (isset($_POST["calculate"])) {
        $residentNumber = $_POST["residentNumber"];
        $income = $_POST["income"];
        if (!residentNumberExists($residentNumber)) {
            $error = "Resident Number Does Not Exist.";
        } else {
            $resident = getResident($residentNumber);
            if ($resident["type"] === "Tenant") {
                $cedula += 25;
            }
            $cedula += floor($income / 1000);
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
    <h1>E-BARANGAY SYSTEM | CEDULA MODULE</h1>
    <?php if (!empty($error)): ?>
        <?= "<b>$error</b>" ?>
    <?php endif; ?>
    <form method="POST">
        <table>
            <tr>
                <td>Resident Number:</td>
                <td><input type="text" id="a" name="residentNumber" value="<?= $residentNumber ?>" required><br></td>
            </tr>
            <tr>
                <td>Gross Annual Income:</td>
                <td><input type="number" id="a" name="income" min="0" value="<?= $income ?>" required><br></td>
            </tr>
        </table>
        <input type="submit" name="calculate" value="Calculate">
    </form>
    <?php if (empty($error) && isset($_POST["calculate"])): ?>
        <?= "<br>Community Tax Certificate: <b>PHP $cedula</b><br>" ?>
    <?php endif; ?>
    <br>
    <button>
        <a href="residents.html">Go Back</a>
    </button>
</body>
</html>