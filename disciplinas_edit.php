<?php


session_start();
if (!isset($_SESSION['login'])) {
    $_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
    //conteúdo



if ($_SERVER['REQUEST_METHOD']=="GET") {
    if (isset($_GET['disciplina'])&& is_numeric($_GET['disciplina'])) {
        $idDisciplina=$_GET['disciplina'];
        $con=new mysqli("localhost","root","","bddisciplina");

        if ($con->connect_errno!=0) {
                echo "<h1>Ocorreu um erro no acesso a base de dados.<br>".$connect_eror."</h1>";
                exit();
        }
        $sql="Select * from disciplinas where id_disciplina=?";
        $stm=$con->prepare($sql);
        if ($stm!=false) {
                $stm->bind_param("i",$idDisciplina);
                $stm->execute();
                $res=$stm->get_result();
                $disciplina=$res->fetch_assoc();
                $stm->close();
        }
    
                  ?>
      <!DOCTYPE html>
      <html>
      <head>
        <title>Editar disciplina</title>
      </head>
      <body>
      <h1>Editar disciplina</h1>


<?php 
$stm=$con->prepare('select * from disciplinas');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {
}
 ?>

      <form action="disciplinas_update.php?disciplina=<?php  echo $disciplina['id_disciplina']; ?>" method="post">
    <label>Disciplina</label><input type="text" name="disciplina" required value="<?php echo $disciplina['discdisciplina'];?>"><br>
    <input type="submit" name="enviar">
</form>
      </body>
      </html>
      <?php
    }   
else{
    echo ("<h1>houve um erro ao precessar o seu pedido.<br> Dentro de segundos sera reencaminhado!</h1>");
    header("refresh:5; url=index.php");
    }
    $stm->close();
    }
}
else{
    echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
    header('refresh:2;url=login.php');
}   
?>