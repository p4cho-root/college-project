<?php
    
    $uid=0;
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $name=$_POST["cname"];
    $username=$_POST["username"];
    $phone=$_POST["phone"];
    $mail= $_POST["mail"];
    $pwd=$_POST["password"];
    $cpassword=$_POST["cpassword"];

    $password = password_hash($pwd, PASSWORD_DEFAULT);

    //for matching the mail
    function test_input($em)
    {
        if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $em))
        {
            return false;
        }
        else
            return true;
    }
    // $con=pg_connect("host=localhost dbname=postgres user=postgres password=postgres") or die("Unable to connect");
    include 'connection.php';
    if((test_input($mail)==false)&&($mail!="")) 
    {
        include "createAcc.html";
        ?>
        <label style="color:aquamarine">INVALID EMAIL FORMAT</label>
        </div>
        </body>
        </html>
        <?php
    }
    else if($pwd==$cpassword)
    {
        $chkuname=pg_query($con,"Select * from login where username='$username'");
        $cun=pg_num_rows($chkuname);
        if($cun==1)
        {
            include "createAcc.html";
            ?>
            <label style="color:aquamarine">USERNAME ALREADY TAKEN<br>TRY ANOTHER</label>
            </div>
            </body>
            </html>
            <?php  
        }
        else
        {
            $result=pg_query($con,"Insert into customers values(nextval('customer'),'$phone','$mail','$name')");
            $getcid=pg_fetch_assoc(pg_query($con,"Select cid from customers where email='$mail' and phone='$phone'"));
            $cid=$getcid['cid'];
            $res=pg_query($con,"Insert into login values(nextval('log'),'$username','$password',$cid)");
            $getlid=pg_fetch_assoc(pg_query($con,"Select lid from login where username='$username'"));
            $lid=$getlid['lid'];
            $webu=pg_query($con,"Insert into webuser values('C',$lid)");
            setcookie("user",$cid);
        }
    }
    else
    {
        include "createAcc.html";
        ?>
        <label style="color:aquamarine">Confirm Password Does Not Match</label>
        </div>
        </body>
        </html>
        <?php
    }
    ?>