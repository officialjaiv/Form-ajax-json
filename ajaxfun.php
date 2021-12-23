<?php

function add_form() {

	include ('Config.php');
	 
	$Add_User = $conn -> Query("INSERT INTO form (Name,Contact_No,Email,Profile,Password)Values('".$_POST['Name']."','".$_POST['Contact_No']."','".$_POST['Email']."','".$_POST['Profile']."','".$_POST['Password']."')");
	if($Add_User)
	{
		echo "Yes";
	} 
}

function update_form() {

	include ('Config.php');
	 
	$Update_User = $conn -> Query("UPDATE form SET Name='".$_POST['Name']."', Contact_No='".$_POST['Contact_No']."',Email='".$_POST['Email']."',Profile='".$_POST['Profile']."',Password='".$_POST['Password']."' WHERE Id = ".$_POST['Id']."");

	if($Update_User)
	{
		echo "Update";
	} 
}
  	
function delete_form() {

	include ('Config.php');
	 
	$Delete_User = $conn -> Query("DELETE FROM form WHERE Id='".$_POST['Id']."'");

	if($Delete_User)
	{
		echo "Delete";
	} 
}

function login(){

	include "Config.php";

	$check_user = "SELECT count(*) as cntUser FROM form WHERE Email='".$_POST['Email']."' and Password='".$_POST['Password']."'";
	$result = mysqli_query($conn,$check_user);
	$row = mysqli_fetch_array($result);

	$count = $row['cntUser'];

	if($count > 0){
		echo "Yes";
	}else{
		echo 0;
	}
}


	if(isset($_POST['hidden_add_form'])){
		add_form();
	}

	if(isset($_POST['hidden_update_form'])){
		update_form();
	}

	if(isset($_POST['hidden_delete'])){
		delete_form();
	}

	if(isset($_POST['hidden_login'])){
		login();
	}

?>