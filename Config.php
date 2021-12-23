<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$conn = mysqli_connect("localhost","root","","ajaxdb") ;
if(!$conn){
	die("Please Check your database Configuration file ");
}
?>