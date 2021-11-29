<?php 
session_start();
//connecting to database using the oops method
	$mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));

	$id = 0;
	$name = '';
    $location = '';
    $update = false;

//save session
	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$location = $_POST['location'];

	$_SESSION['message'] = "Record has been saved";
	$_SESSION['msg_type'] = "success";

//insertion from html page into database query
	$mysqli->query("INSERT INTO data (name,location) VALUES('$name','$location')")or die($mysqli->error);

//redirecting to homepage
	header("location:index.php");

	}
//delete session
if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	$mysqli->query("DELETE FROM data WHERE id = $id") or die($mysqli->error());

	$_SESSION['message'] = "Record has been deleted";
	$_SESSION['msg_type'] = "danger";

	header("location:index.php");
}

//back session

if (isset($_GET['edit'])) {
	$id =$_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
	if (count ($result) == 1) {
		$row = $result->fetch_array();
		$name = $row['name'];
		$location = $row['location'];

	}
}

if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$location = $_POST['location'];

	$mysqli -> query("UPDATE data SET name = '$name',location ='$location' WHERE id = $id") or die($mysqli-> error); 

	$_SESSION['message'] = "Record has been updated";
	$_SESSION['msg_type'] = "warning"; 
	header("location:index.php");

}

?>