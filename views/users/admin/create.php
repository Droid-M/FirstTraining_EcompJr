<?php 
    require_once "../../../DB/Connection.php";
    require_once "../../../models/User.php";
    require_once "../../../controllers/UserController.php";
    UserController::verifyLogin();
    UserController::verifyAdmin();   
?>

<html>
    <form onsubmit="passwordCheck()" name="create" enctype="multipart/form-data"  method="post">
        <P>Nome: <input name="name" required></P>
        <P>Email: <input type="email" name="email" required></P>
        <P>Tipo de usuário: <select name="type" required></P>
            <option value="" selected required>Selecione um tipo</option>
            <option value="admin">Administrador</option>
            <option value="user" >Usuário comum</option>
        </select>
        <P>Senha: <input type="password" placeholder="Insira uma senha" name="password" required>
        <input type="password" placeholder="Confirme a senha" name="password_confirmation"required></P>
        <P>Imagem de peril: <input type="file" name="patchImage"></P>
        <button type="submit">Criar usuário</button>
    </form>
</html>

<a href="/Treinamento2020//views/users/dashboard.php">
<button>
    Cancelar
</button></a>

<script>
function passwordCheck() {
	password = create.password.value
	password_confirmation = create.password_confirmation.value
    create.action = "/Treinamento2020/user/store"
	if (password != password_confirmation){
        create.action = ""
		alert("As senhas diferem!")
    }
}
</script>