<?php 
error_reporting(0);
$c=$_COOKIE["user"];
$pw=$mw=3;
$act=$p=$m=0;
$act=$_POST["delete"];
$p=$_POST["plus"];
$m=$_POST["minus"];
$pw=$_POST["wplus"];
$mw=$_POST["wminus"];
// $con=pg_connect("host=localhost dbname=postgres user=postgres password=postgres") or die("Unable to connect");
include 'connection.php';

    if($p>1000)
    {
        $req=pg_fetch_assoc(pg_query($con,"Select quantity from cart where custid=$c and prodid=$p"));
        $qnt=$req['quantity'];
        $qnt=$qnt+1;
        $upq=pg_query($con,"Update cart set quantity=$qnt where custid=$c and prodid=$p");
        if(!$upq)
        {
            echo "error";
        }
    }
    else if($m>1000)
    {    
        $req=pg_fetch_assoc(pg_query($con,"Select quantity from cart where custid=$c and prodid=$m"));
        $qnt=$req['quantity'];
        if($qnt!=1)
        {
            $qnt=$qnt-1;
        }
        $upq=pg_query($con,"Update cart set quantity=$qnt where custid=$c and prodid=$m");
        if(!$upq)
        {
            echo "error";
        }
    }
    else if($act>1000)
    {
        $remove=pg_query($con,"Delete from cart where prodid=$act");
        if(!$remove)
        {
            echo "error";
        }
    }
    else if($pw!=3)
    {
        $res=pg_fetch_assoc(pg_query($con,"Select * from product where pid=$pw"));
        $rw=strcmp($res['pcategory'],"Cakes");
        if($rw==0)
        {
            $req=pg_fetch_assoc(pg_query($con,"Select * from cart where custid=$c and prodid=$pw"));
            $qnt=$req['weight'];
            $prc=$res['price'];
            $qnt=$qnt+0.5;
            if($qnt!=2.5)
            {
                $upq=pg_query($con,"Update cart set weight=$qnt where custid=$c and prodid=$pw");
                if(!$upq)
                {
                    die("Error");
                }
                $p=($prc*(0.4));
                $prc=$req['price']+$p;
                $upp=pg_query($con,"Update cart set price=$prc where custid=$c and prodid=$pw");
                if(!$upp)
                {
                    die("Error");
                }
            }
        }
    }
    if($mw!=3)
    {
        $res=pg_fetch_assoc(pg_query($con,"Select * from product where pid=$mw"));
        $rw=strcmp($res['pcategory'],"Cakes");
        if($rw==0)
        {
            $req=pg_fetch_assoc(pg_query($con,"Select * from cart where custid=$c and prodid=$mw"));
            $qnt=$req['weight'];
            $prc=$res['price'];
            if($qnt>0.5)
            {
                $qnt=$qnt-0.5;
                $p=($prc*(0.4));
                $prc=$req['price']-$p;
            }
            $upq=pg_query($con,"Update cart set weight=$qnt where custid=$c and prodid=$mw");
            if(!$upq)    
            {
                die("Error");
            }
            $upp=pg_query($con,"Update cart set price=$prc where custid=$c and prodid=$mw");
            if(!$upp)
            {
                die("Error");
            }

        }
    }
include "addtocart.php";
?>