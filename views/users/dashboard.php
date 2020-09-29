<?php 
    require_once "../../DB/Connection.php";
    require_once "../../models/User.php";
    require_once "../../controllers/UserController.php";
    
    UserController::verifyLogin();
    UserController::setSession();
    echo "Olá ".$_SESSION['user']->getName()."!";
?>

<br>
<br>
<img src="<?=$_SESSION['user']->getPatchProfileImg()?>" alt="some text" width=300 height=200>
<br>
<div>
    <?php
        if($_SESSION['user']->getType() == 'admin'){
    ?>
        <a href="/Treinamento2020/user/index">Listagem de usuários</a>
        <a href="/Treinamento2020/user/create">Cadastrar novo usuário</a>
    <?php
        }
    ?>
<a href="/Treinamento2020/user/profile">Meu Perfil</a>
</div>
<br>
<br>
<a href="/Treinamento2020/user/logout">Sair</a>