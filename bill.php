<?php
    session_start();
    $c=99;
    if(isset($_COOKIE["user"]))
    {
        $c=$_COOKIE["user"];
    }
    include "catnav.html";
    // $con=pg_connect("host=localhost dbname=postgres password=postgres user=postgres") or die("Unable to connect");
    include 'connection.php';
?>
<html>
    <style>
        .orderbox
        {
            color: rgb(24,2,2);
            margin-left:450px;
            text-align: center;
            width: 400px;
            height: auto;
            border: 2px solid rgb(24,2,2);
            background-color: beige;
        }
        .it
        {
            margin-left:80px;
            width:240px;
            height:auto;
            color: rgb(24,2,2);
            font-size: 20px;
            padding-bottom: 10px;
        }
    </style>
    <body>
        <div class="orderbox">
            <p style="font-size:25px;color:rgb(24,2,2);">Your Order</p>
            <div class="it">
                <table cellspacing=7 cellpadding=7>
                <tr>
                <th align="center">Item Name</th>
                <th align="center">Quantity</th>
                <th align="center">Price</th>
                </tr>
                <tr>
                <td align="center">------------</td>
                <td align="center">-----------</td>
                <td align="center">------</td>
                </tr>
                <?php 
                $prs=pg_query($con, "SELECT * from cart where custid=$c and o_status='T'");
                if(!$prs)
                {
                    echo "Error Occured.<br>Please try again after sometime";
                }
                else
                {
                    $sum=0;
                    while($row=pg_fetch_assoc($prs))
                    {
                        $iid=$row['prodid'];
                        $req=pg_fetch_assoc(pg_query("Select * from product where pid=$iid"));
                        $sum=$sum+($row['price']*$row['quantity']);
                ?>
                <tr style="font-size:15px;">
                    <?php 
                        $cat=strcmp("Cakes",$req['pcategory']);
                        if($cat==0)
                        {
                            ?>
                            <td align="center" style="font-size:20px;"><?php echo $req['pname'];?>(<?php echo $row['weight'];?>KG)</td>
                            <?php
                        }
                        else
                        {
                        ?>
                            <td align="center" style="font-size: 20px;"><?php echo $req['pname'];?></td>
                    <?php 
                        }
                    ?>
                    <td align="center" style="font-size:20px;"><?php echo $row['quantity'];?></td>
                    <td align="center" style="font-size:20px;"><?php echo $row['price'];?></td>
                </tr>
                <?php
                }
                $g=$sum*0.05;
                $_SESSION["total"]=$sum+$g;
                ?>
                <tr>
                <td align="center">------------</td>
                <td align="center">-----------</td>
                <td align="center">------</td>
                </tr>
                <tr>
                <td align="center">Sub Total:</td>
                <td align="center"></td>   
                <td align="center"><?php echo $sum;?></td>
                </tr>
                <tr>
                <td align="center">GST(5%):</td>
                <td align="center"></td>   
                <td align="center"><?php echo $g?></td>
                </tr>
                <tr>
                <td align="center">------------</td>
                <td align="center">-----------</td>
                <td align="center">------</td>
                </tr>
                <tr>
                <td align="center">Total:</td>
                <td align="center"></td>   
                <td align="center"><?php echo $sum+$g;?></td>
                </tr>
                </table>
                    <?php
                }
            ?>
            </div>
            <a href="addtocart.php" style="float:left;margin-top:8px;padding:8px;padding-left:10px;padding-right:10px;border-radius:5px;border:2px solid black;background-color:#722727;color:white;">Update</a>
            <a href="order.html" style="float:right;margin-top:8px;padding:8px;padding-left:10px;padding-right:10px;border-radius:5px;border:2px solid black;background-color:#722727;color:white;">Pay Now</a>
        </div>
    </body>
</html>