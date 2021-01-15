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

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="fa/css/all.css">
	<script type="text/javascript" src="fa/js/all.js"></script>
	 <script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>



<?php 
//session_start();
$con=new mysqli("localhost","root","","filmes");
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
	<title>filmes</title>
</head>
<body>





<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			<h1>Lista de Filmes <i class="fas fa-film"></i></h1>
<?php 
$stm=$con->prepare('select * from filmes');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {
	echo '<a href="filmes_show.php?filme='.$resultado['id_filme'].'">';
	echo $resultado['titulo'];
	echo "</a>";
	echo ' <i class="fas fa-arrow-right"></i> <a href="filmes_edit.php?filme='.$resultado['id_filme'].'">Editar</a>';
	echo ' <i class="fas fa-arrow-right"></i> <a href="filmes_delete.php?filme='.$resultado['id_filme'].'">eliminar</a>';
	echo "<br>";
}
$stm->close();
 ?>
		</div>
		<div class="col-md-4">
<h1>Autores <i class="fas fa-user-friends"></i></h1>
<?php 
$stm=$con->prepare('select * from atores');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {
	echo '<a href="atores_show.php?ator='.$resultado['id_Ator'].'">';
	echo $resultado['Nome'];
	echo "</a>";
	echo ' <i class="fas fa-arrow-right"></i> <a href="atores_edit.php?ator='.$resultado['id_Ator'].'">Editar</a>';
	echo ' <i class="fas fa-arrow-right"></i> <a href="atores_delete.php?filme='.$resultado['id_Ator'].'">eliminar</a>';
	echo "<br>";
}
$stm->close();
 ?>
		</div>

		<div class="col-md-4">
<h1>Realizadores <i class="fas fa-user-friends"></i></h1>
<?php 
$stm=$con->prepare('select * from realizadores');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {
	echo "<br>";
	echo '<a href="realizadores_show.php?realizador='.$resultado['id_realizador'].'">';
	echo $resultado['nome'];
	echo "</a>";
	echo ' <i class="fas fa-arrow-right"></i> <a href="realizadores_edit.php?realizador='.$resultado['id_realizador'].'">Editar</a>';
	echo ' <i class="fas fa-arrow-right"></i> <a href="realizadores_delete.php?realizador='.$resultado['id_realizador'].'">eliminar</a>';
}

$stm->close();
 ?>
		</div>
	</div>
	<hr>
	<div class="row" >
		<div class="col-md-4 offset-sm-4">
<h1>Links <i class="fas fa-link"></i></h1>
<br>
<a href="filmes_create.php">Adicionar Filmes</a>
<br>
<a href="atores_create.php">Adicionar Atores</a>
<br>
<a href="realizadores_create.php">Adicionar Realizadores</a>

		</div>
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