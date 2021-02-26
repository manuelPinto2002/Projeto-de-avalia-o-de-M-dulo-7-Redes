<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>

<?php  
include('boots.php');
?>

<div class="login">
  <div class="heading">
<form method="post" action="processa_login.php">
	<br>	<br>	<br>	<br>	<br>	<br>	<br>	<br>
<div class="loginpanel">
  <div class="txt">
     <input type="text" name="user_name"  required />
    <label for="user" class="entypo-user"></label>
  </div>
  <div class="txt">
     <input type="password" name="password"required/>
    <label for="pwd" class="entypo-lock"></label>
  </div>
  <div class="buttons">
    	<input type="submit" name="login">
    <span>
      <a href="utilizadores_create.php" class="entypo-user-add register">Register</a>
    </span>
  </div>
  
</div>

<span class="resp-info"></span>
      
      </form>
 		</div>
 </div>


</body>
</html>


















