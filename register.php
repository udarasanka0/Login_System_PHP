<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>

<?php 

    $first_name = '';
    $email = '';
    $password = '';
    


if(isset($_POST['submit'])){
        $first_name = $_POST['first_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confermpassword = $_POST['confermpassword'];

        if($password == $confermpassword){

            $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
            $email = mysqli_real_escape_string($connection, $_POST['email']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            $confermpassword = mysqli_real_escape_string($connection, $_POST['confermpassword']);
    
            $hashed_password = sha1($password);
            
    
    
            $query ="INSERT INTO user (first_name, email, password)
            VALUES ('{$first_name}', '{$email}', '{$hashed_password}')";
    
            $result = mysqli_query($connection, $query);
        
        }else{
            echo "Passwords are not equal";
        }
        

        
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
	<title>registration form</title>
</head>
<body>
	<h1>Add New User</h1>
	<header>
        <div class="appname">User Management System</div>
    
	</header>
	
	<main id="userlist">
    <h1>Admin Registration <span> <a href="index.php"> < Back to Login Form </a> </span></h1>

		<div class="container">
            <form action="register.php" method="post">
                <label for="">First Name</label>
                <input type="text" name="first_name" placeholder="Your name.." required>

                <label for="">Email Address</label>
                <input type="email" name="email" placeholder="Your Email.." required>

                <label for="">Password</label>
                <input type="password" name="password" placeholder="Password.." required>

                <label for="">Confirm Password</label>
                <input type="password" name="confermpassword" placeholder="Confirm Password" required>

                

                <input type="submit" name="submit" value="Submit">
                <input type="reset" value="Clear All">

            </form>
        </div>
	</main>
</body>
</html>
<?php mysqli_close($connection); ?>