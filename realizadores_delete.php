<?php

session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo



if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (isset($_GET['realizador'])&& is_numeric($_GET['realizador'])) {
		$idRealizador=$_GET['realizador'];
		$con=new mysqli("localhost","root","","filmes");

		if ($con->connect_errno!=0) {
				echo "<h1>Ocorreu um erro no acesso a base de dados.<br>".$connect_eror."</h1>";
				exit();
		}
		$sql="delete from realizadores where id_realizador=?";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
				$stm->bind_param("i",$idRealizador);
				$stm->execute();
				$stm->close();
				echo "<script>alert('realizador eliminado com sucesso');</script>";
				echo "Aguarde um momento.A reencaminhar página";
					header("refresh:2; url=index.php");
		}
	else{
echo "<br>";
echo ($con->error);
echo "<br>";
echo "Aguarde um momento.A reencaminhar página";
echo "<br>";
	header("refresh:2; url=index.php");
		}
	

}	
else{
	echo "<h1>houve um erro ao precessar o seu pedido.<br> Dentro de segundos sera reencaminhado!</h1>";
	header("refresh:2; url=index.php");
	}
}	
else{
	echo "<h1>houve um erro ao precessar o seu pedido.<br> Dentro de segundos sera reencaminhado!</h1>";
	header("refresh:2; url=index.php");
	}



}
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}
?>