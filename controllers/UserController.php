<?php 

session_start();

class UserController{

    public function index(){
    }

    public function create(){
    }

    public function store(){
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
    }
    
    public static function verifyAdmin() {
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