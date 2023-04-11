<?php
    include "removeProd.html";
    // $con=pg_connect("host=localhost dbname=postgres user=postgres password=postgres") or die("Unable to connect");
    include 'connection.php';
    if(isset($_POST["protype"]))
    {
        $name=$_POST["proname"];
        $category=$_POST["procat"];
        $image=$_POST["proimage"];
        $type=$_POST["protype"];
        $price=$_POST["proprice"];
        if(strstr($category,"select"))
        {?><br>
            <label style="font-size:23px;color:white;margin-left:90px;">    
            <?php echo "Product Category Not Selected";?></label><?php
        }
        else
        {
            $chkp=pg_query($con,"Select * from product where pname='$name' and pimage='$image'");
            if(!$chkp)
            {
                echo "Error";
            }
            if(pg_num_rows($chkp)!=0)
            {
                $res=pg_query($con,"Delete from product where pname='$name' and pimage='$image'");
                if(!$res)
                {
                    echo "Error";
                }
                else 
                {?><br>
                <label style="font-size:23px;color:white;margin-left:60px;">    
                <?php echo "Product Deleted From Menu Successfully";?></label><?php
                }
            }
            else
            {?>
                <label style="font-size:23px;color:white;margin-left:90px;">    
                <?php
                echo "No Such Products Exist.<br>Please recheck.";?></label><?php
            }
        }
    }
    else
    {?><br>
        <label style="font-size:23px;color:white;text-align:center;">    
        <?php echo "Product Type Not Selected";?></label><?php
    }
?>