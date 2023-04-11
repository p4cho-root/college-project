<html>
    <head>
    <link  rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body{
            margin: 0;
            padding: 0;
            background-size: cover;
            background-position: center;
            background-color: antiquewhite;

        }
        .loginbox
        {
            width:380px;
            height: 490px;
            background-color: black;
            color: white;
            top: 50%;
            left: 50%;
            position: absolute;
            transform: translate(-50%,-50%);
            box-sizing: border-box;
            border:2px solid black;
        }
        .loginbox h1{
            text-align: center;
            font-size: 30px;
            list-style: none;
            text-decoration: underline;
            text-underline-position: under;
        }
        a
        {
            text-decoration:none;
            font-size: 22px;
            color:white;
            position:relative;
            margin-left:250px;
            bottom:60px;
            right:135px;
            left: 350px;
            top:-20px;
            padding-left: 60px;
            padding-top: 5px;
            padding-right:60px;
            padding-bottom: 5px;
            background: #722727;
            border-radius:10px;
            
        }
        .message{
            margin-left:10px;
            /* top:500px; */
            margin-top:250px;
            color:white;
            text-align:center;
            font-size:23px;
            font-weight :1000;
            
        }
        a:hover{
            cursor: pointer;
            background: #c03636;
            color: #000;
        }
        .button:hover
        {
            cursor: pointer;
            background: #c03636;
            color: #000;
        }
        .button
        {
            font-size: 22px;
            color:white;
            position:relative;
            margin-left:40px;
            margin-top:10px;
            background-color:#722727; 
            border-radius:5px;
            width: 300px;
            height:50px;
            border: 2px solid black;
        }
        .loginbox p
        {
            color:white;
        }
    </style>
    <body>
<?php 
    if(isset($_COOKIE["user"]))
    {
        $cid=$_COOKIE["user"];
        // $con=pg_connect("host=localhost dbname=postgres user=postgres password=postgres") or die("Unable to connect");
        include 'connection.php';
        include "profile.html";
        $resn=pg_fetch_assoc(pg_query($con,"Select username from login where cid=$cid"));
        $resp=pg_fetch_assoc(pg_query($con,"Select * from customers where cid=$cid"));
?>
        
        <p style="margin-left: 30px;font-size:20px;margin-top:35px;">UserName:
        <?php echo $resn['username'];?></p>
        <p style="margin-left: 30px;font-size:20px;margin-top:35px;">Name:
        <?php echo $resp['name'];?></p>
        <p style="margin-left: 30px;font-size:20px;margin-top:35px;">Phone Number:
        <?php echo $resp['phone'];?></p>
        <p style="margin-left: 30px;font-size:20px;margin-top:35px;">Email:
        <?php echo $resp['email'];?></p>
        <form method="POST" action="prof.php">
        <button name="logout" class="button" value="Log Out">Log Out</button>
        <br><a href="page1.html" style="border-radius:5px;border:2px solid black;padding-left:125px;padding-right:115px;padding-top:9px;padding-bottom:9px;margin-left:-310px;top:50px;font-size:25px">Home</a>
        <!--<button class="button"><input type="checkbox" name="action" value="up">Update Profile</button>--->
        </form>
    <?php
    }
    if(!isset($_COOKIE["user"]))
    {
        // include "profile.html";
    ?>
     <div class="loginbox">
            <h1 >YOUR PROFILE</h1>
    </div>
    <br>
    <div class="message">
    <p class=" animate__animated animate__zoomIn">Login To Check Your Profile.</p>
    </div>
    <?php
    ?>
    <br><br><br><br><br>
    <a href="login.html">Login</a><br><br><br>
    <a href="page1.html">Home</a>

    <?php
    }
    ?>
    </body>
</html>