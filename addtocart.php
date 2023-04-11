<style>
    p
    {
        color: #722727;
        text-align: center;
        font-size: 30px;
    }
</style>
<?php 
    include "catnav.html";
    if(!isset($_COOKIE["user"]))
    {
        ?>
        
        <br><br><br><br>
        <p style="text-align:center;font-size:25px">Login To Check Your Cart</p>
        <br><br><br><br><br>
        <a href="login.html" style="margin-left:580px;font-size:25px;text-decoration:none;padding-left:70px;padding-right:70px;padding-top:10px;padding-bottom:10px;background-color: black;color:white;border-radius:5px;">Login</a>
        <br><br><br><br><a href="page1.html" style="margin-left:580px;font-size:25px;text-decoration:none;padding-left: 70px;padding-right:70px;padding-top:10px;padding-bottom:10px;background-color: black;color:white;border-radius:5px;">Home</a>
        <?php
    }
    else
    {
        $c=$_COOKIE["user"];
        // $con=pg_connect("host=localhost dbname=postgres user=postgres password=postgres") or die("Unable to connect");
        include 'connection.php';
        $res = pg_query($con, "SELECT * from cart where custid=$c and o_status='T'");
    if(!$res)
    {
        echo "Not able to fetch";
    }
    else
    {
        if(pg_num_rows($res)==0)
        {
        ?>
            <br><br><br><br><br>
            <p><i class="fa fa-shopping-cart"></i> Cart Empty</p>
        <?php
        }
        else
        {
        ?>
        <form action="cart.php" method="POST">
        <table cellspacing= 30 cellpadding= 10>
        <tr>
            <th align= "left" style="height: 10px;width: 75x; font-size: 22px;">Item Name</th>
            <th align= "center" style="height: 10px;width: 50px; font-size: 22px;">Item</th>
            <th align= "center" style="height: 10px;width: 130px; font-size: 22px;">Quantity</th>
            <th align= "center" style="height: 10px;width: 130px; font-size: 22px;">Weight</th>
            <th align= "center" style="height: 20px; width: 50px; font-size: 22px;">Price</th>
            <th align= "center" style="height: 20px; width: 50px; font-size: 22px;">Remove</th>
        </tr>
        <?php
            while($row=pg_fetch_assoc($res))
            {
                $iid=$row['prodid'];
                $req=pg_fetch_assoc(pg_query("Select * from product where pid=$iid"));
                
        ?>
        <tr>
            <td align= "center" style="font-size: 20px;"><?php echo $req['pname'];?></td>
            <td><img src="<?php echo $req['pimage'];?>" width="150" height="150"></td>
            <td align= "center">
                    <button name="minus" value="<?php echo $iid;?>" style="color: white;background-color:#722727">-</button>
                    <input type="text" value="<?php echo $row['quantity']?>" size=2>
                    <button name="plus" value="<?php echo $iid;?>" style="color: white;background-color:#722727">+</button>
            </td>
            <td align="center">
                <button name="wminus" value="<?php echo $iid;?>" style="color: white;background-color:#722727">-</button>
                <input type="text" value="<?php echo $row['weight']?>"style="width:28px;height:22px;">
                <button name="wplus" value="<?php echo $iid;?>" style="color: white;background-color:#722727">+</button>&nbsp;KG
            </td>
            <td align= "center" style="font-size: 20px;">Rs.<?php echo $row['price'];?></td>
            <td align="center"><button name="delete" value="<?php echo $iid;?>"style="background: transparent; border:white"><i class="fa fa-trash" style="font-size: 40px;"></i></button></td>
        </tr>
<?php
            }
            ?>
        </table>
        <button class ="button"><a href="bill.php">Place Order</a></button>
        </form>
        <?php    
        }
    }
}
?>