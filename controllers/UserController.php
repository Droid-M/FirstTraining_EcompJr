<?php 

session_start();

class UserController{

    public function index(){
        header("Location:/Treinamento2020/views/users/admin/index.php");
    }

    public function create(){
        header("Location:/Treinamento2020/views/users/admin/create.php");
    }

    public function store() {
        //Verificação necessária para evitar algum erro de índice:
        if( isset(
            $_POST['name'],
            $_POST['email'],
            $_POST['type'],
            $_POST['password'],
            $_POST['password_confirmation'] ) ) {
                User::create(
                $_POST['name'],
                $_POST['email'],
                $_POST['type'],
                $_POST['password'],
                $_POST['password_confirmation'],
                $_FILES['patchImage']['tmp_name'] );
        }
        header("Location:/Treinamento2020/views/users/dashboard.php");
    }

    public function edit($id){
    }

    public function profile(){
    }

    public function update($id){
    }

    public function delete($id){
    }

    public static function all(){
        return User::all();
    }
    
    public function check(){
        $userLogged = user::find($_POST['email'], $_POST['password']);
        if ($userLogged) {
            $_SESSION['user'] = $userLogged;
            header("Location:/Treinamento2020/views/users/dashboard.php");
        }
        else{
            header("Location:/Treinamento2020/views/login.php");
        }
    }

    public static function verifyLogin() {
        if(empty($_SESSION)) {
            header("Location:/Treinamento2020/views/home.php");
        }
    }
    
    public static function verifyAdmin() {
        if($_SESSION['user']->getType() != "admin") {
            header("Location:/Treinamento2020/views/home.php");
        }
    }

    public static function logout() {
        self::dropSession();
        header("Location:/Treinamento2020/views/home.php");
    }

    public static function get($id){
    }

    public static function setSession() {
        if(!isset($_SESSION)) { 
            session_start(); 
        }
    }

    public static function dropSession() {
        if(isset($_SESSION))
            session_unset();
    }
}
