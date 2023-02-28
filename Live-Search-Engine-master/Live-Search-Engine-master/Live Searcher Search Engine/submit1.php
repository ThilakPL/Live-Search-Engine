<?php
   $conn = mysqli_connect("localhost", "root", "", "awtexe");
	 $response = array('success' => false);


	 if(isset($_POST['email'])  && isset($_POST['password']) ){
	 $email=$_POST['email'];
	 $psd=$_POST['password'];
	
	 $user = mysqli_query($conn, "SELECT * FROM contacts WHERE email = '$email'");

	 if(mysqli_num_rows($user) > 0){
   
	   $row = mysqli_fetch_assoc($user);
   
	   if($psd == $row['psd']){
		session_start();
		 $_SESSION["login"] = true;
		 $_SESSION["id"] = $row["id"];
		 $_SESSION["name"] = $row["name"];  // Add this line to send the name
		 $response['success'] = true;
	   }}}

echo json_encode($response);