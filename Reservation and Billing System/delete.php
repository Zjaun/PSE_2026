<?php

    include("database.php");

    if (isset($_GET["id"])) {
        deleteGuest($_GET["id"]);
        header("Location: view.php");
    }

?>