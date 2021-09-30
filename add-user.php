<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>

<?php 

    $first_name = '';
    $last_name = '';
    $contact = '';
    $email = '';


    if(isset($_POST['submit'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];

        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $contact = mysqli_real_escape_string($connection, $_POST['contact']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);


        $query ="INSERT INTO emp (first_name, last_name, contact, email,  is_deleted)
        VALUES ('{$first_name}', '{$last_name}', '{$contact}', '{$email}', 0)";

        $result = mysqli_query($connection, $query);

        if($result) {
            header('Location: users.php?user_added=true');
        } else {
            echo "Faild to add the new record";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="main.css">
	<title>Add new Users</title>
</head>
<body>
	<h1>Add New User</h1>
	<header>
        <div class="appname">User Management System</div>
        <div class="loggedin">Welcome <?php echo $_SESSION['first_name']; ?>! <a href="logout.php">Log Out! </a> </div>
    
	</header>
	
	<main id="userlist">
    <h1>Add New Employee <span> <a href="users.php">employee List > </a> </span></h1>

		<div class="container">
            <form action="add-user.php" method="post">
                <label for="">First Name</label>
                <input type="text" name="first_name" placeholder="Your name.." required>

                <label for="">Last Name</label>
                <input type="text" name="last_name" placeholder="Your last name.." required>

                <label for="">Contact No</label>
                <input type="tele" name="contact" placeholder="Your Contact No.." required>

                <label for="">Email Address</label>
                <input type="email" name="email" placeholder="Your Email.." required>

                <input type="submit" name="submit" value="Submit">
                <input type="reset" value="Clear All">

            </form>
        </div>
	</main>
</body>
</html>