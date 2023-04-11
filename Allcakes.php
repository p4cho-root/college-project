<?php
    include "catnav.html";
    // $con=pg_connect("host=localhost dbname=postgres user=postgres password=postgres") or die("Unable to connect");
    include 'connection.php';
    $res=pg_query($con,"Select * from product where pcategory='Cakes'");
    if(!$res)
    {
        echo "UNABLE";
    }
    while($row=pg_fetch_assoc($res))
    {
    $prid=$row['pid'];
    $prname=$row['pname'];
    $ptypei=$row['ptype'];
    $primage=$row['pimage'];
    $price=$row['price'];
?>
<form action="acakes.php" method="POST">
    <div class="gallery">
            <a target="_blank" href="#">
                <div class="dropdown">
                    <img src="<?php echo $primage;?>" width="150" height="150">
                    <div class="dropdown-content">
                        <img src="<?php echo $primage;?>" width="200" height="200">        
                        <div class="desc"><?php echo $prname;?><br><?php echo "Rs ".$price;?><br>
                            <button class="button" name="cakes" value= "<?php echo $prid;?>">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </a>
            <div class="desc"><img src="<?php echo $ptypei;?>" width="20" height="20">&nbsp;<?php echo $prname;?><br><?php echo "Rs ".$price;?><br><br>
                <button class="button" name="cakes" value= "<?php echo $prid;?>">Add To Cart</button>
            </div>
    </div>
    <?php
    }
    ?>
</form>
</body>
</html>