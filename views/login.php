<?php
    session_start(); 
?>
<html>
    <form action="/Treinamento2020/user/check" method="post">
        Email: <input type="email" name="email" value="" placeholder="Insira seu email aqui" required>      
        Senha: <input name="password" type="password" placeholder="Insira sua senha aqui" required>
        <button type="submit"> Entrar </button>        
    </form>
</html>