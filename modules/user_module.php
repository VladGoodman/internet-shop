<?php
    session_start();
    require_once('bd.php');
    class User{
        private $fio;
        private $role;
        private $email;
        
        function __construct()
        {
            $this->fio =  $_SESSION['fio']?$_SESSION['fio']:'';
            $this->role =  $_SESSION['role']?$_SESSION['role']:'';
            $this->email =  $_SESSION['email']?$_SESSION['email']:'';
        }

        private function checkExistingEmail($email){
            global $mysql;
            $query = "SELECT role FROM `user` WHERE email='$email'";
            $result = mysqli_query($mysql, $query);
            if($result){
                if(mysqli_fetch_row($result)){
                    return 'Пользователь с таким email уже существует';
                }else{
                    return true;
                }
            }
            
        }

        public function getFio(){
            return $this->fio;
        }

        public function getRole(){
            return (int) $this->role;
        }

        public function getEmail(){
            return $this->email;
        }

        public function auth($email, $password){
            global $mysql;
            $query = "SELECT role, fio, email FROM `user` WHERE email='$email' AND password='$password'";
            $result = mysqli_query($mysql, $query);
            if($row = mysqli_fetch_assoc($result)){
                $_SESSION['role'] = $row['role'];
                $_SESSION['fio'] = $row['fio'];
                $_SESSION['email'] = $row['email'];
                if(!isset($_SESSION['basket'])){
                    $_SESSION['basket'] = [];
                }
                return true;
            }else{
                return 'Неправильный логин или пароль';
            }
        }

        public function getUserOrders($email){
            global $mysql;
            $query = "SELECT * FROM `orders` WHERE user='$email'";
            $result = mysqli_query($mysql, $query);
            if($result){
                $result_array = [];
                while($row = mysqli_fetch_assoc($result)){
                    $result_array[] = $row;
                }
                return $result_array;
            }else{
                return false;
            }
            
        }


        public function registration($fio, $email, $password){
            global $mysql;
            if($this->checkExistingEmail($email) !== true){
                return $this->checkExistingEmail($email);
            }else{
                $query = "INSERT INTO `user`(`fio`, `password`, `email`) VALUES ('$fio', '$password', '$email')";
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