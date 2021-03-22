<?php

error_reporting(E_ALL ^ E_WARNING); 
function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

$host    = $_REQUEST['ip'];
$port    = $_REQUEST['port'];
$port_int=intval($port);
$message = $_REQUEST['message'];


if(empty($_REQUEST['tip'])){


	$len =strlen($message);

	if($len==24){
			$_REQUEST['tip']="1";


	}

	else{$_REQUEST['tip']="2";}



}
$tipo    = intval($_REQUEST['tip']);


$msg_byte="";



if($tipo==2){
for($i=0;$i<8;$i++){

	$dosi=$i*2;

	$dummy= substr($message,$dosi,2);

	$decim=hexdec($dummy);
	
	$decim_str=chr($decim); 
	
	$msg_byte.= $decim_str;

}

$str_con="tcp://".$host;	

//echo "Message To server :".$msg_byte;
// create socket
/*
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket\n");
// connect to server
$result = socket_connect($socket, $host, $port_int) or die("Could not connect to server\n");


// send string to server
socket_write($socket, $msg_byte, strlen($msg_byte)) or die("Could not send data to server\n");



$result = socket_read ($socket,strlen($msg_byte) ) or die("Could not read server response\n");
//echo "Se leyo al socket";  

console_log(bin2hex($result));
echo "Reply From Server  :".bin2hex($result);
// close socket
//socket_close($socket);
*/



$fp = fsockopen($str_con, $port_int, $errno, $errstr,5);

if (!$fp) 
{
	echo -1;
} 


else 
{
	
	fwrite($fp, $msg_byte);

	$result= fread($fp, 10);

	$lectura=substr(bin2hex($result),6,4);
	
	$decim=hexdec($lectura);

	echo $decim;
	fclose($fp);
}


}



else{



for($i=0;$i<12;$i++){

	$dosi=$i*2;

	$dummy= substr($message,$dosi,2);

	$decim=hexdec($dummy);
	
	$decim_str=chr($decim); 
	
	$msg_byte.= $decim_str;


}




$str_con="tcp://".$host;	

//echo "Message To server :".$msg_byte;
// create socket
/*
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket\n");
// connect to server
$result = socket_connect($socket, $host, $port_int) or die("Could not connect to server\n");


// send string to server
socket_write($socket, $msg_byte, strlen($msg_byte)) or die("Could not send data to server\n");



$result = socket_read ($socket,strlen($msg_byte) ) or die("Could not read server response\n");
//echo "Se leyo al socket";  

console_log(bin2hex($result));
echo "Reply From Server  :".bin2hex($result);
// close socket
//socket_close($socket);
*/



$fp = fsockopen($str_con, $port_int, $errno, $errstr,5);

if (!$fp) 
{
echo -1;} 


else 
{
	
	fwrite($fp, $msg_byte);

	$result= fread($fp, 12);

	$lectura=substr(bin2hex($result),18,4);
	
	$decim=hexdec($lectura);


	$ma=20/65535*$decim;

	echo $ma;

	fclose($fp);
}






}






/*
$fp = stream_socket_client($str_con, $errno, $errstr);
if (!$fp) {
    echo "ERROR: $errno - $errstr<br />\n";
} 

else{

	fwrite($fp, $msg_byte);
	echo fread($fp, 1024);
}
*/
?>