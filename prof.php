<?php
    $p=$_POST["logout"];
    if($p=="Log Out")
    {
        setcookie("user", "", time() - 3600);
    }
    include "profile.php";
?>