<?php 
    require_once "../../../DB/Connection.php";
    require_once "../../../models/User.php";
    require_once "../../../controllers/UserController.php";

    UserController::verifyLogin();
    $user = $_SESSION['user'];
?>

<html>
    <head>
        <script>
            function passwordCheck() {
                password = profile.password.value
                password_confirmation = profile.password_confirmation.value
                profile.action = "/Treinamento2020/user/update/<?php echo $user->getId()?>"
                if (password != password_confirmation) { //Se as senhas estiverem diferentes, o redirecionamento não acontecera
                    profile.action = ""
                    alert("As senhas diferem!")
                }
            }
        </script>
    </head>
    <form onsubmit="passwordCheck()" name="profile" enctype="multipart/form-data"  method="post">
        <P>Imagem de perfil atual: <img type="image" src="<?=$user->getPatchProfileImg()."?".date('d/m/Y H:i:s')?>"width="300" height="200"></P>
        <P>Nome: <input name="name" placeholder="name" value="<?php echo $user->getName()?>" required="required"></P>
        <P>Email: <input type="email" name="email" placeholder="email" value="<?php echo $user->getEmail()?>" required></P>
        <P>Tipo de usuário: <select name="type" required></P>
            <option value="" unselected>Selecione um tipo</option>
            <option value="admin"<?php if($user->getType() == "admin"){?> selected <?php }?>>Administrador</option>
            <option value="user" <?php if($user->getType() == "user"){?> selected <?php }?>>Usuário comum</option>
            </select>
        <P>Senha: <input type="password" placeholder="Insira uma senha" name="password" required>
        <input type="password" placeholder="Confirme a senha" name="password_confirmation"required></P>
        <input type="checkbox" name="substImgPrfl" value="yes">Desejo substituir minha imagem de perfil |
        Escolher imagem:<input type="file" name="patchImage" value="<?=$user->getPatchProfileImg()?>"></P>
        <button type="submit" >Atualizar dados</button>
    </form>
</html>

<a href="/Treinamento2020/views/users/dashboard.php"><button>
    Cancelar
</button></a>