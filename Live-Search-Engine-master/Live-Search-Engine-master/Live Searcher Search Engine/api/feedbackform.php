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

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['feedback']) && isset($_POST['loc']))
{
	
	$sql = "INSERT INTO feedback (name, email, feedback, loc) VALUES('".addslashes($_POST['name'])."', '".addslashes($_POST['email'])."', '".addslashes($_POST['feedback'])."', '".addslashes($_POST['loc'])."')";
	
	if($conn->query($sql))
	{
		$response['success'] = true;
		echo'<script> window.location="main_home.php"; </script> ';
	}
}

echo json_encode($response);