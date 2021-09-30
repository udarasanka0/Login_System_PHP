<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php 
//checking if a user is logged in
	if(!isset($_SESSION['user_id'])){
		header('Location: index.php');
	}
	$user_list = '';

	//Get the user list
	$query = "SELECT * FROM emp WHERE is_deleted=0 ORDER BY first_name";
	$users = mysqli_query($connection, $query);

	if($users){
		while ($user = mysqli_fetch_assoc($users)){
			$user_list .= "<tr>";
			$user_list .= "<td>{$user['first_name']}</td>";
			$user_list .= "<td>{$user['last_name']}</td>";
			$user_list .= "<td>{$user['contact']}</td>";
			$user_list .= "<td>{$user['email']}</td>";
			$user_list .= "<td> <a href= \"delete-user.php?user_id={$user['id']}\"
			onclick=\"return confirm('Delete this row!');\"> Delete</a></td>";
			$user_list .= "</tr>";
		}
	}else{
		echo "Database query failed";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="main.css">
	<title>Users</title>
</head>
<body>
	<h1>Users</h1>
	<header>
        <div class="appname">User Management System</div>
        <div class="loggedin">Welcome <?php echo $_SESSION['first_name']; ?>! <a href="logout.php">Log Out! </a> </div>
    
	</header>
	
	<main id="userlist">
		
		<h1>Users list <span> <a href="add-user.php"> < Back to add new form </a> </span></h1>

		<table class="masterlist">
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>contact</th>
				<th>email</th>
				<th>Delete</th>
			</tr>

			<?php echo $user_list; ?>
		</table>
	</main>
</body>
</html>