<?php
    error_reporting(0);
    // error_reporting(0);

    $r=2;
    $uname=$_GET["usernamel"];
    $pass=$_GET["passwordl"];

    class Login
    {
        
        private $username,$password;
        function Login($a,$b)
        {
            $this->username=$a;
            $this->password=$b;
        }
        public function ChkLogin()
        {
            $un=$this->username;
            $pa=$this->password;

            include 'connection.php';

            // $con=pg_connect("host=localhost dbname=postgres user=postgres password=postgres") or die("Unable to connect");
            $result=pg_query($con,"select passwordl from login where username='$un'");
            $row=pg_fetch_assoc($result);
            $cr=pg_num_rows($result);
            if($cr<0)
            {
                return -1;
            }
            else
            {
                if(!$row)
                {
                    echo "Error";
                }
                // else if($pa==$row['passwordl'])
                else if(password_verify($pa, $row['passwordl']));
                {
                    return 0;
                    
                }
                // else
                // {
                //     return 1;
                // }
            }
        }
    }

    if(isset($_COOKIE["user"]))
    {
        include "login.html";
        ?>
        <label style="color:aquamarine">Already Logged In.<br>No Need To Login</label>
        </div>
        </body>
        </html>
        <?php
    }
    else
    {
        $l=new Login($uname,$pass);
        $r=$l->ChkLogin();
        if($r==-1)
        {
            include "login.html";//Create Account
            ?>
        <label style="color:aquamarine">Account Not Found!!<br>Create Account To Login.</label>
        </div>
        </body>
        </html>
        <?php
        }
        else if($r==0)
        {
            $con=pg_connect("host=localhost dbname=postgres user=postgres password=postgres") or die("Unable to connect");
            // include "connection.php"
            $getcid=pg_fetch_assoc(pg_query($con,"Select cid from login where username='$uname'"));
            $cid=$getcid['cid'];
            setcookie("user","$cid");
            include "page1.html";
        }
        else if($r==1)
        {
            include "login.html";
        ?>
        <label style="color:aquamarine">Incorrect Password!!!<br>Try Again</label>
        </div>
        </body>
        </html>
        <?php
        }
    }
?>