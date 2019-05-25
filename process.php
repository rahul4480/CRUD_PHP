<?php

	session_start();
	$name = '';
	$id = 0;
	$location = '';
	$update = false;

	$conn = mysqli_connect("localhost","root","","crud");
	if(isset($_POST['save']))
	{
		$name = $_POST['name'];
		$location = $_POST['location'];

		if(!empty($name) && !empty($location))
		{
			$sql = "INSERT INTO data(name,location) VALUES ('$name','$location')";

			if ($conn->query($sql) === TRUE) 
			{
	    		echo "New record created successfully";
			}	 
			else 
			{
	    		echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$_SESSION['message'] = "Record has been saved!";
			$_SESSION['msg_type'] = "success";

			header("location: index.php");
		}
		else{
			echo "<p style='color:red; text-align:center;'>". "Don't leave the fields empty!!" ."</p>";
			header( "refresh:2;url= index.php" );
			
		}
	}

	if(isset($_GET['delete']))
	{
		$id = $_GET['delete'];
		$conn->query("DELETE FROM data WHERE id=$id");

		$_SESSION['message'] = "Record has been deleted";
		$_SESSION['msg_type'] = "danger"
		?>
		<script>
    		window.location = 'index.php';
		</script>
	<?php }

	if(isset($_GET['edit']))
	{
		$id = $_GET['edit'];
		$update = true;
		$result = $conn->query("SELECT * FROM data WHERE id=$id");
			if(@count(result) == 1){
			$row = $result->fetch_array();
			$name = $row['name'];
			$location = $row['location'];}
		
	}

	if(isset($_POST['update']))
	{
		$id = $_POST['id'];
		$name = $_POST['name'];
		$location = $_POST['location'];

		$conn->query("UPDATE data SET name='$name', location='$location' WHERE id=$id ");

		$_SESSION['message'] = "Record has been updated!";
		$_SESSION['msg_type'] = "warning";

		header('location: index.php');	
	}


?>