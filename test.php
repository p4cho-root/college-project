<?php   
    class Login
    {
        private $username,$password;
        function __construct($a,$b)
        {
            $this->username=$a;
            $this->password=$b;
        }
        public function ChkLogin()
        {
            // $con=pg_connect("host=localhost dbname=postgres user=postgres password=postgres") or die("Unable to connect");
            include 'connection.php';
            $result=pg_query($con,"select passwordl from login where username='$this->username'");
            if(pg_num_rows($result)==0)
            {
                return 0;
            }
            else
            {
                $row=pg_fetch_assoc($result); 
                if($this->password==$row['password'])
                {
                    return -1;
                }
                else
                {
                    return 1;
                }
            }
        }
    }
    $uname=$_POST["usernamel"];
    $pass=$_POST["passwordl"];
    $l=new Login($uname,$pass);
    $r=$l->ChkLogin();
    $r=0;
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>
        Login Form Design
    </title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        button
        {
            background-color: black;
            color: white;
            float: right;
        }
        button a
        {
            font-size: 20px;
            width: auto;
            height: auto;
            color: white;
            float: right;
            background-color: black;
            text-decoration: none;
        }
        <?php
            if($r==-1)
            {
                ?>
                .loginbox
                {
                    height: 580px;
                    width: 350px;
                }
                <?php
            }
        ?>
        </style>
    </head>
<body>
<div class="loginbox">
    <img src="ava.png" class="avatar">
<?php
    if($r==0)
    {
        ?>
        <button><a href="page1.html" style="color:white;background-color: black;width: 20px;height: 5px;" value=>X</a></button>
        <?php
        include "login.html";
    }
    else if($r==-1)
    {
        ?>
        <button><a href="login.html" style="color:white;background-color: black;width: 20px;height: 5px;" value=>X</a></button>
        <?php
        include "createAcc.html";
    }
?>