<?php
error_reporting(0);
$pattern = "/\d{2}\/\d{2}\/\d{2}/";

$mysqli = new mysqli("localhost","root","root","scotchbox");

if($mysqli === false)
{
    die("ERROR: Could not connect. ".$mysqli->connect_error);
}

$sql  = "SELECT * FROM sweetwater_test ";

$res = $mysqli->query($sql);

$all_comments =  array();
while($row  = $res->fetch_array()){
    preg_match($pattern,$row['comments'],$match);
    if(($match[0] !== null)){
        $date = $match[0];
        $sql = "UPDATE `sweetwater_test`  SET `shipdate_expected`= STR_TO_DATE('".$date."', '%m/%d/%yy') WHERE `orderid` = ".$row['orderid']."  ";
        $res1 = $mysqli->query($sql);
    }

    $all_comments[] = $row['comments'];

}

$candy = array();
$call_me = array();
$referred_me = array();
$signature = array();
$misc = array();
foreach($all_comments as $comment){

    if(preg_match('/candy/i',$comment,$match)){
        $candy[]=$comment;
    }
    elseif (preg_match('/call me/i',$comment)){
        $call_me[]=$comment;
    }
    elseif (preg_match('/referred me/i',$comment)){
        $referred_me[]=$comment;
    }
    elseif (preg_match('/signature requirements upon delivery/i',$comment)){
        $signature[]= $comment;
    }
    else{
        $misc[]= $comment;
    }

}
echo "Candy Messages----";
echo " <br />";
foreach($candy as $candy){
    echo $candy."<br />";
}
echo " <br />";
echo "Callme Messages----";
echo " <br />";
foreach($call_me as $call_me){
    echo $call_me."<br />";
}
echo " <br />";
echo "Referred Messages----";
echo " <br />";
foreach($referred_me as $referred_me) {
    echo $referred_me."<br />";
}
echo " <br />";
echo "Signature Messages----";
echo " <br />";
foreach($signature as $signature) {
    echo $signature."<br />";
}
echo " <br />";
echo "Misc Messages----";
echo " <br />";
foreach($misc as $misc) {
    echo $misc."<br />";
}

