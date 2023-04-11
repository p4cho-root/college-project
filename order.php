<?php 
        session_start();
        $c=$_COOKIE["user"];
        // $con=pg_connect("host=localhost dbname=postgres user=postgres password=postgres") or die("Unable to connect");
        include 'connection.php';
        if(isset($_POST["pay"]))
        {
            $n=$_POST["oname"];
            $phone=$_POST["pno"];
            $address=$_POST["addr"];
            $pinn=$_POST["pn"];
            $landmark=$_POST["landm"];
            $pdetail=$_POST["pay"];
            $tt=$_SESSION["total"];
            $dd=date("m/d/Y");
            $co=pg_query($con,"Select prodid from cart where custid=$c and o_status='true'");
            $num=pg_num_rows($co);
            $orentry=pg_query($con,"Insert into orders values(nextval('ord'),'$address',$tt,'$dd',$c,$num)");
            $orid=pg_fetch_assoc(pg_query($con,"Select ord_no from orders where address='$address' and cid=$c"));
            $ord=$orid['ord_no'];
            while($row=pg_fetch_assoc($co))
            {
                $ppid=$row['prodid'];
                if(strstr($pdetail,"COD"))
                {
                    $stat='unpaid';
                }
                else
                {
                    $stat='paid';
                }
                $op=pg_query($con,"Insert into order_product values($ord,$ppid,'$stat')");
                if($op)
                {
                    $upcart=pg_query($con,"Update cart set o_status='false' where prodid=$ppid");
                }
            }
            $pentry=pg_query($con,"Insert into payment values(nextval('pay'),'$dd','$pdetail',$ord,'$n','$pinn','$landmark','$phone')");
            if(strstr($pdetail,"COD"))
            {
                include "complete.php";
            }
            else
            {
                include "payment.php";
            }            
        }
        else
        {   
            include "order.html";
            echo "Pay Type Not selected";
        }
?>