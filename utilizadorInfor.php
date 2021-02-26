<?php 
session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo


 ?>



<!DOCTYPE html>
<html>
<head>
	<title></title>

	<?php  
include('boots.php');
?>
</head>
<body>
	<?
	include('nav.php');
?>


<?php 
//session_start();
$con=new mysqli("localhost","root","","bddisciplina");
if($con->connect_errno!=0){
	echo "Ocorreu um erro no acesso à base de dados".$con->connect_error;
	exit;
}
else{
	if(!isset($_SESSION['login'])){
		$_SESSION['login']="incorreto";
	}
	if($_SESSION['login']=="correto"){



	 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Utilizador</title>
</head>
<body>


<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
<h1>Utilizadores <i class="fas fa-user-friends"></i></h1>
<?php 
$stm=$con->prepare('select * from utilizadores');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {
	echo '<a href="utilizadores_show.php?id_utili='.$resultado['id'].'">';
	echo $resultado['nome'];
	echo "</a>";
	echo ' <i class="fas fa-arrow-right"></i> <a href="utilizadores_delete.php?id_utili='.$resultado['id'].'"><button style="background: #069cc2; border-radius: 6px; padding: 6px; cursor: pointer; color: #fff; border: none; font-size: 16px;">eliminar</button></a>';
	echo "<br>";
}
$stm->close();
 ?>
 <br>
 <br>
 <a href="utilizadores_create.php"><button>Registar</button></a>

		</div>

		
	</div>

	



<?php 
} //end if 
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}

}
 ?>

</body>
</html>

<?php  
}
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}
?>