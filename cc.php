<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $pid=$_POST["cupcakes"];
    // $con=pg_connect("host=localhost dbname=postgres user=postgres password=postgres") or die("Unable to connect");
    include 'connection.php';
    $res=pg_query($con,"Select * from product where pid=$pid");
    $row=pg_num_rows($res);
    if($row==1)
    {
        $rcheck=pg_query($con,"Select * from cart where prodid='$pid'");
        if(!$rcheck)
        {
            echo "Error";
        }
        if(pg_num_rows($rcheck)==0)
        {
            if(isset($_COOKIE["user"]))
            {
                $cid=$_COOKIE["user"];
                
                $r=pg_query($con,"Insert into cart values($cid,$pid,1,0,'T')");
            }
        }
    }
    include "cupcake.php";    
?>