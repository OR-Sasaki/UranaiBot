<?php
//IFTT$B$N%j%/%(%9%H(BURL
$url="https://maker.ifttt.com/trigger/RequestURL/with/key/c7A2kJzA4To7mWbo-vkXZh";

//csv$B%U%!%$%k$+$i8@8l$r%i%s%@%`$KA*Br(B=>$lang
$randurl="./language.csv";
$lines = str_getcsv(file_get_contents($randurl) , "\r\n"); 
foreach ($lines as $line) { $garr[] = str_getcsv($line); }
$lang=$garr[0][array_rand($garr[0])];

//csv$B%U%!%$%k$+$i8@8l$r%i%s%@%`$KA*Br(B=>$hitokoto
$randurl="./hitokoto.csv";
$lines = str_getcsv(file_get_contents($randurl) , "\r\n"); 
foreach ($lines as $line) { $garr2[] = str_getcsv($line); }
$hitokoto=$garr2[0][array_rand($garr2[0])];

//$BD+CkM<H=Dj(B
date_default_timezone_set('Asia/Tokyo');
$time=date("G");
if($time<12){
    $ahy="$B8aA0(B";
}elseif($time<18){
    $ahy="$B8a8e(B";
}else{
    $ahy="$BM<J}(B";
}

//$BAw?.%G!<%?(B
$daysent=date("n")."$B7n(B".date("j")."$BF|(B".$ahy."$B$N@j$$$G$9(B";
$lsent=$ahy."$B$N%i%C%-!<$J8@8l$O!V(B ".$lang." $B!W!*(B".$hitokoto;

$data=array(
    "value1"=>$daysent,
    "value2"=>$lsent
);

//HTTP$B@_Dj(B
$options = array(
  'http' => array(
    'method'  => 'POST',
    'content' => json_encode( $data ),
    'header'=>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
    )
);

$result = file_get_contents( $url, false, stream_context_create( $options ) );

?>