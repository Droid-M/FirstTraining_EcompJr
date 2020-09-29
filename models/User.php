<?php

define("imgExtension", ".extensaoQualquer");

class User{
    private $id;
    private $name;
    private $email;
    private $type;
    private $password;
    private $patchProfileImg;

    public function __construct($id, $name, $email, $type, $patchProfileImg) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->type = $type;
        $this->patchProfileImg = $patchProfileImg;
    }

    public static function find($email, $password) {
        $result = mysqli_query(Connection::getConnection(), "Select * from users where email = '{$email}' and password = '{$password}'");
        if(mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            return new User(
                $user['id'],
                $user['name'],
                $user['email'],
                $user['type'],
                $user['patchImage']);
        }
        return false;
    }

    public static function get($id){
        $result = mysqli_query(Connection::getConnection(), "Select * from users where id = '{$id}'");
        if(mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            return new User(
                $user['id'],
                $user['name'],
                $user['email'],
                $user['type'],
                $user['patchImage']);
        }
        return false;
    }

    public static function create( $name, $email, $type, $password, $password_confirmation, $patchImage ) {
        if ($password == $password_confirmation)
            if (!self::find($email, $password)) {
                $newIdGener = self::getIdNewbieUser();
                $newPatchImg = USer::copyImage($patchImage, $newIdGener);
                mysqli_query(Connection::getConnection(), "Insert into users values (default,
                    '{$name}',
                    '{$email}',
                    '{$password}',
                    '{$type}',
                    '{$newPatchImg}')");
            }
    }

    public static function all() {
        $result = mysqli_query( Connection::getConnection(), "Select * from users" );
        $nRows= mysqli_num_rows($result);
        $users=[];
        for($i=0; $i < $nRows; $i++) {
            $user = mysqli_fetch_assoc($result);
            $users[$i] = new User(
                $user['id'],
                $user['name'],
                $user['email'],
                $user['type'],
                $user['patchImage']);
        }
        return $users;
    }

    public static function delete($id){
        self::deleteImgProfile($id);
        mysqli_query(Connection::getConnection(), "Delete from users where id = '{$id}'");
    }

    public static function update($id, $name, $email, $type, $password, $password_confirmation, $patchImage) {
        if ($password_confirmation == $password) {
            if(isset($patchImage)) {
                $newPatchImg = USer::copyImage($patchImage, $id);
                mysqli_query(Connection::getConnection(), "Update users set 
                    name='{$name}',
                    email='{$email}',
                    type='{$type}',
                    password='{$password}',
                    patchImage='{$newPatchImg}'
                    where id='{$id}'");
                if(empty($patchImage))
                    self::deleteImgProfile($id);
            }
            else {
                mysqli_query(Connection::getConnection(), "Update users set
                name='{$name}',
                email='{$email}',
                type='{$type}',
                password='{$password}'
                where id='{$id}'");
            }
        }
    }

    public function getId(){
        return $this->id;
    }
    
    public function getType(){
        return $this->type;
    }

    public function getName(){
        return $this->name;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function getPassword(){
        return $this->password;
    }

    public function setType($name){
        $this->name = $name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getPatchProfileImg() {
        if(empty($this->patchProfileImg))
            return "/Treinamento2020/profileImages/Newbie".imgExtension;
        return $this->patchProfileImg;
    }

    public function setPatchProfileImg($patchProfileImg) {
        $this->patchProfileImg = $patchProfileImg;
    }

    private static function copyImage($patch, $id){
        if(move_uploaded_file($patch, "profileImages/{$id}".imgExtension))
            return "/Treinamento2020/profileImages/{$id}".imgExtension;
        return "";
    }

    private static function getIdNewbieUser() {
        $result = mysqli_query(Connection::getConnection(), "Select auto_increment from 
        information_schema.tables where table_name = 'users' and table_schema = 'backend'");
        return (int) mysqli_fetch_assoc($result)["auto_increment"];
    }

    private static function deleteImgProfile($id) {
        if( file_exists("profileImages/{$id}".imgExtension ))
            unlink("profileImages/{$id}".imgExtension);
    }
}
