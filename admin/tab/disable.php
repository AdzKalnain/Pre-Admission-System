<?php
    require_once ("../../include/initialize.php");

    $query = "UPDATE admissionbatch SET is_active = 0";
    if ($result = mysqli_query($mysqli, $query)) {
        message("Saved!","success");
        header("location: ../controller.php?page=setting");
    } else {
        message("Something went wrong please try again", "error");
        header("location: ../controller.php?page=setting");
    }
?>