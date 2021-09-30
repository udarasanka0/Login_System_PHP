<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php 
//checking if a user is logged in
	if(!isset($_SESSION['user_id'])){
		header('Location: index.php');
    }
    if(isset($_GET['user_id'])){
        $user_id = mysqli_real_escape_string($connection, $_GET['user_id']);

    $query = "UPDATE emp SET is_deleted = 1 WHERE id = {$user_id} LIMIT 1";
    $result = mysqli_query($connection, $query);

        if($result){
            header('Location: users.php?msg=user_deleted');
        }else{
            header('Location: users.php?err=delete faied');
        }
    }else{
        header('Location: users.php');
    }
    ?>