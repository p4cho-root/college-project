<?php 
    $ad=$_GET['admin'];
    $password=$_GET['adpassword'];
    if($ad=="root")
    {
        if($password=="admin")
        {
            include "admin_home.html";
        }
        else
        {
            include "admin.html";
            echo "Incorrect Password";
            ?></div></body></html><?php
        }
    }
    else
    {
        include "admin.html";
        echo "Incorrect Password";
        ?></div></body></html><?php 
    }
?>