<?php
    session_start();
    require_once('bd.php');
    class User{
        private $username;
        private $role;
        function __construct()
        {
            $this->username =  $_SESSION['username']?$_SESSION['username']:'';
            $this->role = $_SESSION['role'];
        }
        private function checkExistingUsername($username){
            global $mysql;
            $query = "SELECT role FROM `user` WHERE username='$username'";
            $result = mysqli_query($mysql, $query);
            if(mysqli_fetch_row($result)){
                return 'Пользователь с таким именем уже существует';
            }else{
                return true;
            }
        }

        public function getUsername(){
            return $this->username;
        }

        public function getRole(){
            return $this->role;
        }

        public function auth($username, $password){
            global $mysql;
            $query = "SELECT role FROM `user` WHERE username='$username' AND password='$password'";
            $result = mysqli_query($mysql, $query);
            if($row = mysqli_fetch_row($result)){
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $row[0];
                return true;
            }else{
                return false;
            }
        }
        public function registration($username, $password){
            global $mysql;
            if($this->checkExistingUsername($username) !== true){
                return $this->checkExistingUsername($username);
            }else{
                $query = "INSERT INTO `user`(`username`, `password`) VALUES ('$username', '$password')";
                $result = mysqli_query($mysql, $query);
                if($result == 'TRUE'){
                    return true;
                }else{
                    return false;
                }
            }
        }
        public function logout(){
            session_destroy();
            header('refresh:0; url=login.php');
        }
    }
    $user = new User;
    if(isset($_GET['logout'])){
        $user->logout();
    }
?>