<html>
<style>
    body
    {
        background-color: antiquewhite;
    }
    button
    {
        font-size: 20px;
        color:rgb(71, 8, 8);
        margin-top:30px;
        border:2px solid rgb(71, 8, 8);
        width: 100%;
        height:40px;
        background-color:beige;
        text-align: start;
        margin-bottom: 0px;
    }
    button:hover
    {
        color: white;
        background-color: rgb(71, 8, 8);
    }
</style>
<body>
<form action="ordetail.php" method="POST">
<?php 
    error_reporting(0);
    echo "<br>";
    include "cad.html";
    // $con=pg_connect("host=localhost user=postgres password=postgres dbname=postgres")or die("Unable to connect");
    include 'connection.php';
    $o=pg_query($con,"Select * from orders");
    while($row=pg_fetch_assoc($o))
    {
        $ord=$row['ord_no'];
        $p=pg_fetch_assoc(pg_query($con,"Select * from payment where order_no=$ord"));
?>
<button name="cust" value="<?php echo $ord;?>" onclick="ordetail.php"><label style="margin-left:40px;float:center;"><?php echo $p['fullname'];?></label>
<label style="float:right;">Rs:<?php echo $row['total'];?></label>
<label style="float:left;padding-left:40px;">(<?php echo $row['pno'];?>)</label>
</button>
<?php 
    }
?>
</form>
</body>