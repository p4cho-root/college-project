<html>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<?php 
// $con=pg_connect("host=localhost user=postgres dbname=postgres password=postgres") or die("Unable to connect");
include 'connection.php';
if(isset($_POST["cust"]))
{
    $ono=$_POST["cust"];
    $or=pg_fetch_assoc(pg_query($con,"Select * from orders where ord_no=$ono"));
    $pa=pg_fetch_assoc(pg_query($con,"Select * from payment where order_no=$ono"));

    include "cad.html";
?>
<style>
body
{
    background-color: antiquewhite;
}
.ordered
{
    margin-top: -40px;   
    background-color: beige;
    margin-left:30%;
    width:500px;
    height: auto;
    border:2px solid brown;
}
</style>
<body><br>
<br>
<div class="ordered">
    <h1 style="text-align:center;font-size:30px;">Order</h1>
    <label style="font-size:22px;margin-left:20px;padding-right:75px;">Items</label><label style="font-size:25px;">:<label><br>
    <?php 
        $custpr=pg_query($con,"Select * from cart where custid=(select cid from orders where ord_no=$ono) and o_status='false'");
        while($row=pg_fetch_assoc($custpr))
        {
            $pd=$row['prodid'];
            $q=$row['quantity'];
            $price=$row['price'];
            $w=$row['weight'];
            $pros=pg_fetch_assoc(pg_query($con,"Select pname from product where pid=$pd"));
            $prname=$pros['pname'];
        ?>
        <label style="margin-left:170px;font-size:20px;padding-bottom:5px;"><?php echo $prname;?></label>
        <?php
            
            if(($w=='0.5')||($w=='1')||($w=='1.5')||($w=='2'))
            {
        ?>
            <label style="font-size:20px;">(<?php echo $w;?>KG)</label>
        <?php
            }
            ?>
            <label style="font-size:20px;">(<?php echo $q;?>)</label>
            <label style="font-size:20px;">(<?php echo $price;?>)</label>
            <?php
        }
    ?><br><br>
    <label style="margin-left:20px;font-size:20px;">Total</label>
    <label style="margin-left:84px;font-size:20px;">:</label>
    <label style="font-size:20px;margin-left:10px;">Rs.<?php echo $or['total'];?></label><br><br>
    <label style="margin-left:20px;font-size:20px;">Delivery To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<?php echo $pa['fullname'];?></label><br>
    <label style="margin-left:168px;font-size:20px;"><?php echo $or['address'];?></label>
    <label style="font-size:20px;">-<?php echo $pa['pin'];?></label><br>
    <label style="margin-left:170px;font-size:20px;">Near &nbsp;<?php echo $pa['landmark'];?></label><br><br>
    <label style="margin-left:20px;font-size:20px;">Phone Number &nbsp;:&nbsp;&nbsp;&nbsp;<?php echo $pa['phone'];?></label><br><br>
    <label style="margin-left:20px;font-size:20px;">Payment Status :&nbsp;&nbsp;&nbsp;<?php 
    if(strstr($pa['details'],"COD"))
    {
        echo "Cash On Delivery";
    }
    else
    {
        echo "Paid Online";
    }
    ?></label><br><br>
    <label style="margin-left:20px;font-size:20px;">Date</label>
    <label style="margin-left:84px;font-size:20px;">:</label>
    <label style="font-size:20px;margin-left:10px;"><?php echo $or['ord_date'];?></label><br><br>
</div></body>
<?php
}
?>
</html>