<?php
$host = "localhost";
$username = "root";
$password = "";

try 
{
    $conn = new PDO("mysql:host=$host;dbname=awtexe", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}

$response = array('success' => false);

if(isset($_POST['name']) && $_POST['name']!='' && isset($_POST['phone']) && $_POST['phone']!='' && isset($_POST['email']) && $_POST['email']!='' && isset($_POST['psd']) && $_POST['psd']!='')
{
	$sql = "INSERT INTO contacts(name, phone, email, psd) VALUES('".addslashes($_POST['name'])."', '".addslashes($_POST['phone'])."', '".addslashes($_POST['email'])."', '".addslashes($_POST['psd'])."')";
	
	if($conn->query($sql))
	{
		$response['success'] = true;
		echo'<script> window.location=""; </script> ';
	}
}

// $user = mysqli_query($conn, "SELECT * FROM contacts WHERE email = '$email'");
// if(mysqli_num_rows($user)>0){
// 	echo "Email Id is already Exist! "
// 	exit;
// }

echo json_encode($response);