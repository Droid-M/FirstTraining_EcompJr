<?php

class User{
    private $id;
    private $name;
    private $email;
    private $type;
    private $password;

    public function __construct($id, $name, $email, $type) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->type = $type;
    }

    public static function find($email, $password) {
        $result = mysqli_query(Connection::getConnection(), "Select * from users where email = '{$email}' and password = '{$password}'");
        if(mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            return new User($user['id'], $user['name'], $user['email'], $user['type'],$user['patchImage']);
        }
        return false;
    }

    public static function get($id){
    }

    public static function create($name, $email, $type, $password, $password_confirmation){
    }

    public static function all(){
        $result = mysqli_query(Connection::getConnection(), "Select * from users");
        $nRows= mysqli_num_rows($result);
        $users=[];
        for($i=0; $i < $nRows; $i++) {
            $user = mysqli_fetch_assoc($result);
            $users[$i] = new User($user['id'], $user['name'], $user['email'], $user['type'], $user['patchImage']);
        }
        return $users;
    }

    public static function delete($id){
    }

    public static function update($id, $name, $email, $type, $password, $password_confirmation){
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
}
