<?php
    error_reporting(0);
    $cno=$cv=$ct=$opm=$opy=0;
    $cno=$_POST["cardno"];
    $cv=$_POST["cvv"];
    $ct=$_POST["cardt"];
    $opm=$_POST["month"];
    $opy=$_POST["year"];

    if(($cno!=0)||($cv!=0)||($ct!=0)||($opm!=0)||($opy!=0))
    {
    if(strlen($cno)!=16)
    {
        include "payment.html";
        include "error.html";
        echo "Card Number Invalid <br>";

    }
    else if(strlen($cv)!=3)
    {
        include "payment.html";
        include "error.html";
        echo "CVV Invalid";
    }
    else if($opm=="none")
    {
        include "payment.html";
        include "error.html";
        echo "Invalid month";
    }
    else if($opy=="none")
    {
        include "payment.html";
        include "error.html";
        echo "Invalid year"; 
    }
    else if($ct=="none")
    {
        include "payment.html";
        include "error.html";
        echo "Invalid Card type";
    }
    else
    {
        include "complete.php";
        die();
    }
    }
    else
    {
        include "payment.html";
    }
    ?><br><p><button class="button"><a href="order.php" >Cancel</a></button>&nbsp;&nbsp;&nbsp;&nbsp;<button class="button">Pay Now</button></p>
        </form>
    </div>
</body>
</html>