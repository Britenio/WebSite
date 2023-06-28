<?php
	//error_reporting(E_ALL ^ E_NOTICE);
?>

<!DOCTYPE html>
<html lang="en">
<?php
	//session_start();
	if(isset($_SESSION["username"])) 
	{ 
		header("location: index.php"); 
		exit;
	}
	require_once "dbconnect.php";
	$email = $password = "";
	$email_err = $password_err = "";
	if(isset($_POST["login"]) && $_POST["login"]=="Login") 
	{
		$email = trim($_POST["email"]); if(empty(trim($_POST["email"]))) 
		{
			$email_err = "Please enter an Email.";
		}
		else
		{
			$email = trim($_POST["email"]);
		}
		if(empty(trim($_POST["password"])))
		{
			$password_err = "Please enter a Password.";
		}
		else
		{
			$password = trim($_POST["password"]);
		}
		if(empty($email_err) && empty($password_err))
		{
			$sql = "SELECT email,password FROM tblusers WHERE email='$email'";
			$result = mysqli_query($connection,$sql);
			$tblusers = mysqli_fetch_assoc($result); 
		if($tblusers)
		{
			if($tblusers['password'] === ($password))
			{ 
				session_start();
				$_SESSION['username'] = $email;
				header('location: index.php');
			}
		else
		{
			$password_err = "Password is Incorrect.";
		}
		}
	else
	{
		$email_err = "email does not exist.";
	}
	mysqli_close($connection);
		}	
	} 
?>

<body>
<?php require 'master.php';?>
	<style type="text/css">
   .login
   {
      background: #f7f7f7;
      padding: 20px;
      border: 1px solid blue;
      margin: 50px 0px;
    }
    .err-msg
	{
      color:red;
    }
    .login form
	{
      border: 1px solid #e8e8e8;
      padding: 10px;
      background: #f3f3f3;
    }
  </style>

<div class="container-fluid">
 <div class="row">
   <div class="col-sm-4">
   </div>
   <div class="col-sm-4">
	<div class="container text-center">
	</div>
	
	<p class ="text-success text-center"></p>
	<form action="loginpage.php" method="post">
		<h2>LOGIN</h2>

	<div class="form-group <?php echo (!empty($Email_err)) ? 'has-error' : '';?>">
		<label>Email</label>
		<input type="text" name="email" class="form-control" placeholder="email" value="<?php echo $email;?>">
		<span class="help-block"><?php echo $email_err; ?></span>
	
	<div class="form-group <?php echo (!empty($Password_err)) ? 'has-error' : '';?>">
		<label>Password</label>
		<input type="password" name="password" class="form-control" placeholder="password" value="<?php $password;?>">
		<span class="help-block"><?php echo $password_err; ?></span>
		
		<input type="submit" class="btn btn-info" value="Login" name="login">
	</form>
</body>
<?php require_once 'footer.php';?>
</html>
