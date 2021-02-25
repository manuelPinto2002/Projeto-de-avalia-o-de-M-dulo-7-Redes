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



<?php 
include('nav.php');
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
	<title>dsiciplina</title>
</head>
<body>





<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			<h1>Lista de Disciplina <i class="fas fa-edit"></i></h1>
<?php 
$stm=$con->prepare('select * from disciplinas');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {
	echo '<a href="disciplinas_show.php?discip='.$resultado['id_disciplina'].'">';
	echo $resultado['disciplina'];
	echo "</a>";
	echo ' <i class="fas fa-arrow-right"></i> <a href="disciplinas_edit.php?disciplina='.$resultado['id_disciplina'].'">Editar</a>';
	echo ' <i class="fas fa-arrow-right"></i> <a href="disciplinas_delete.php?discip='.$resultado['id_disciplina'].'">eliminar</a>';
	echo "<br>";
}
$stm->close();
 ?>
		</div>
		<div class="col-md-4">
<h1>Modulos <i class="fas fa-book"></i></h1>
<?php 
$stm=$con->prepare('select * from modulos');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {
	echo '<a href="modulos_show.php?modulo='.$resultado['id_modulo'].'">';
	echo $resultado['numero'];
	echo "</a>";
	echo ' <i class="fas fa-arrow-right"></i> <a href="modulos_edit.php?modulo='.$resultado['id_modulo'].'">Editar</a>';
	echo ' <i class="fas fa-arrow-right"></i> <a href="modulos_delete.php?modulo='.$resultado['id_modulo'].'">eliminar</a>';
	echo "<br>";
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
<a href="disciplinas_create.php">Adicionar disciplinas</a>
<br>
<a href="modulos_create.php">Adicionar Modulo</a>
<br>
	
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