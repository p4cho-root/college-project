<?php
    include "addProd.html";
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
            <?php
            echo "Product Category Not Selected";?></label><?php
        }
        else
        {
            $chkp=pg_query($con,"Select * from product where pname='$name' and pimage='$image'");
            if(!$chkp)
            {
                echo "Error";
            }
            if(pg_num_rows($chkp)==0)
            {
            $res=pg_query($con,"Insert into product values(nextval('prod'),'$name','$category','$type','$image',$price)");
            if(!$res)
            {
                
                echo "Error";
            }
            else
            {?><br>
                <label style="font-size:23px;color:white;margin-left:90px;">    
                <?php
                echo "Product Added To Menu Successfully";?></label><?php
            }
            }
        }
    }
    else
    {?><br>
        <label style="font-size:23px;color:white;margin-left:90px;">    
        <?php
        echo "Product Type Not Selected";?></label><?php
    }
?>