<?php
include_once("database.php");


function hashPassword($password, $salt) {
    $hash_password = hash("SHA512", base64_encode(str_rot13(hash("SHA512", str_rot13($salt . $password)))));
    return $hash_password;
}

function curPageURL() {
	$pageURL = $_SERVER["REQUEST_URI"];
	$pos1 = strrpos($pageURL,'.');
	$pos2 = strrpos($pageURL,'/');
	$pos3 = $pos1-$pos2;
	$pageURL = substr("$pageURL", $pos2+1,$pos3-1); 
	return $pageURL;
}

function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[rand(0, $max)];
    }
    return $str;
}

function curPageFULLURL() {
	$pageURL = 'http';
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

function redirect_to($location = NULL){
	if($location!=NULL)
			{	unset($_SESSION['prev']);
				header("location:{$location}");
				exit;
			}
}
	
 function dateconvert($date,$func) {
 

$mo_name = array('Jan','Feb','Mar','Apr','May','June','July','Aug','Sep','Oct','Nov','Dec');

$months_no = array('jan'=>'01',
				   'feb'=>'02',
				   'mar'=>'03',
				   'apr'=>'04',
				   'may'=>'05',
				   'june'=>'06',
				   'july'=>'07',
				   'aug'=>'08',
				   'sep'=>'09',
				   'oct'=>'10',
				   'nov'=>'11',
				   'dec'=>'12');

if ($func == 0){ //insert conversion
list($month, $day, $year) = explode('/', $date);
$date = "$year-$month-$day";
return $date;
}

if ($func == 1){ //insert conversion
list($year, $month, $day) = explode('/', $date);
$date = "$year-$month-$day";
return $date;
}
if ($func == 2){ //output conversion
list($year, $month, $day) = explode('-', $date);
$date = "$year/$month/$day";
return $date;
}

if ($func == 3){ //output conversion
list($year, $month, $day) = explode('-', $date);

$date = $day." ".$mo_name[$month-1];
return $date;
}
if ($func == 4){ //output conversion
list($year, $month, $day) = explode('-', $date);
$date = "$month/$day/$year";
return $date;
}

if ($func == 5){ //output conversion
list($year, $month, $day) = explode('-', $date);

$date =$mo_name[$month-1]." ".$year;
return $date;
}
if ($func == 6){ //insert conversion	
list($year, $month, $day) = explode('/', $date);
$date = "$month-$day-$year";
return $date;
}

if ($func == 7){ //output conversion
list($year, $month, $day) = explode('-', $date);

$date =$day." ".$mo_name[$month-1]." , ".$year;
return $date;
}


if ($func == 8){ //insert conversion	
list($month, $day, $year) = explode('-', $date);
$month = strtolower($month);
$date = "20$year-$months_no[$month]-$day";
return $date;
}

}

function get_day_left($dt1,$dt2){

list($y1, $m1, $d1) = explode('-', $dt1);
list($y2, $m2, $d2) = explode('-', $dt2);

$start =  mktime(0,0,0,$m1,$d1,$y1);
$end =  mktime(0,0,0,$m2,$d2,$y2);

$day = floor(($end-$start)/86400);

return $day;
 }

function format_phone($phone){
	$arr1 = array("foo", "bar", "hello", "world");
	$arr1 = str_split($phone);
	return "(".$arr1[0].$arr1[1].$arr1[2].") ".$arr1[3].$arr1[4].$arr1[5]." ".$arr1[6].$arr1[7].$arr1[8].$arr1[9];
}


function sendEmail($to,$subject,$message){

		$body = "<html>
					<head>
					<title>HTML email</title>
					</head>
					<body>
					";
		$body.='<table style="width:100%;border:solid 3px #ccc; border-radius:5px 5px 0px 0px; border-bottom:none">
		<tr>
		<td colspan="3">
		<p style="text-align:center"><img src="http://liquidatevape.com/images/logo.jpg" height="70"></p>
		</td>
		</tr>
		</table>
		<table style="width:100%;border:solid 3px #ccc;  border-bottom:none; border-top:none">
		<tr>
		<td width="5%">			
		</td>		
		<td>';

		$body.=$message;
		$body.='</td>		
		<td width="5%">			
		</td>
		</tr>
		</table>

		<table style="width:100%;border:solid 3px #ccc; border-radius:0px 0px 5px 5px; border-top:none">
		<tr>
		<td colspan="3">
		<p style="text-align:center;color:#006666; font-size:13px;">Copyright &copy;2017, liquidatevape.com. All Rights Reserved.</p>
		<p style="text-align:center; color:#000; font-size:13px;">This email was sent to '.$to.'. If you no longer wish to receive these emails you may manage your <a href="account.php" style="color:#006666">communication preferences</a> at any time. </p>
		</td>
		</tr>
		</table>';
					
		$body.="		
					</body>
					</html>
			";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <support@liquidatevape.com>' . "\r\n";
		mail($to,$subject,$body,$headers);

}

function get_banner($data){
	return SITE_ADMIN."banners/".$data;
}

function get_image($data){
	return SITE_BASE."images/".$data;
}


function sendEmailbySender($to,$subject,$message,$email){

		$body = "<html>
					<head>
					<title>HTML email</title>
					</head>
					<body>
					";
		$body.='<table style="width:100%;border:solid 3px #ccc; border-radius:5px 5px 0px 0px; border-bottom:none">
		<tr>
		<td colspan="3">
		<p style="text-align:center"><img src="http://liquidatevape.com/images/logo.jpg" height="70"></p>
		</td>
		</tr>
		</table>
		<table style="width:100%;border:solid 3px #ccc;  border-bottom:none; border-top:none">
		<tr>
		<td width="5%">			
		</td>		
		<td>';

		$body.=$message;
		$body.='</td>		
		<td width="5%">			
		</td>
		</tr>
		</table>

		<table style="width:100%;border:solid 3px #ccc; border-radius:0px 0px 5px 5px; border-top:none">
		<tr>
		<td colspan="3">
		<p style="text-align:center;color:#006666; font-size:13px;">Copyright &copy;2017, liquidatevape.com. All Rights Reserved.</p>
		<p style="text-align:center; color:#000; font-size:13px;">This email was sent to '.$email.'. If you no longer wish to receive these emails you may manage your <a href="account.php" style="color:#006666">communication preferences</a> at any time. </p>
		</td>
		</tr>
		</table>';
					
		$body.="		
					</body>
					</html>
			";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.$email.'>' . "\r\n";
		mail($to,$subject,$body,$headers);

}

function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}
?>