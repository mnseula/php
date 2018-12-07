<?php

$pattern = "/\d{2}\/\d{2}\/\d{2}/";

$mysqli = new mysqli("localhost","root","root","scotchbox");

if($mysqli === false)
{
    die("ERROR: Could not connect. ".$mysqli->connect_error);
}

$sql  = "SELECT * FROM sweetwater_test ";

$res = $mysqli->query($sql);

//print_r($row = $res->fetch_array());
$all_comments =  array();
while($row  = $res->fetch_array()){
    //$all_comments['id'] = $row['orderid'];
    //$string = implode(" ",$row['comments']);
    if (preg_match($pattern,$row['comments'],$match)){
        //print $match[0];exit;
//        $sql = "UPDATE `sweetwater_test`  SET `shipdate_expected`= DATE_FORMAT($match[0],'%M %d %Y')  ";
//        $res = $mysqli->query($sql);
    }

    $all_comments[] = $row['comments'];

}
//print_r($all_comments);

//- Comments about candy
//- Comments about call me / don't call me
//- Comments about who referred me
//- Comments about signature requirements upon delivery
//- Miscellaneous comments (everything else)
$candy = array();
$call_me = array();
$referred_me = array();
$signature = array();
$misc = array();
foreach($all_comments as $comment){

    if(preg_match('/candy/i',$comment,$match)){
        $candy[]=$comment;
        //print $match[0];
	//exit;
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
    //print_r($candy);
    //print_r($call_me);
}
print_r ($candy);
print_r ($call_me);
print_r ($referred_me);
print_r ($signature);
print_r ($misc);
