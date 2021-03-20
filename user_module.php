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

        public function getUsername(){
            return $this->username;
        }

        public function getRole(){
            return $this->role;
        }

        public function auth($email, $password){
            global $mysql;
            $query = "SELECT role, fio FROM `user` WHERE email='$email' AND password='$password'";
            $result = mysqli_query($mysql, $query);
            if($row = mysqli_fetch_assoc($result)){
                $_SESSION['role'] = $row['role'];
                $_SESSION['fio'] = $row['fio'];
                return true;
            }else{
                return 'Неправильный логин или пароль';
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