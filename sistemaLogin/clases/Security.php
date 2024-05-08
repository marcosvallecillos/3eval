<?php
class Security extends Conexion
{
    private $loginPage = "login.php";
    private $homePage = "index.php";
    private $registerPage = "inicio.php";

    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function checkLoggedIn()
    {
        if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]) {
            header("Location: " . $this->loginPage);
        }else{
            header("Location: " . $this->registerPage);
        }
    }

    public function doLogin()
    {
        if (count($_POST) > 0) {
            $user = $this->getUser($_POST["userName"]);
            $_SESSION["loggedIn"] = $this->checkUser($user, $_POST["userPassword"]) ? $user["userName"] : false;
            if ($_SESSION["loggedIn"]) {
                header("Location: " . $this->homePage);
            } else {
                return "Incorrect User Name or Password";
            }
        } else {
            return null;
        }
    }

    public function getUserData(){
        if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
            return $_SESSION["loggedIn"];
        }
    }

    private function checkUser($user, $userPassword)
    {
        if ($user) {
            //return $this->checkPassword($user["userPassword"], $userPassword);
            return $this->checkPassword($user["securePassword"], $userPassword);
        } else {
            return false;
        }
    }

    private function checkPassword($securePassword, $userPassword)
    {
        return password_verify($userPassword, $securePassword);
        //return ($userPassword === $securePassword);
    }

    private function getUser($userName)
    {
        $sql = "SELECT * FROM users WHERE userName = '$userName'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    public function singUp(){
        if (count($_POST) > 0) {
            $name = $_POST["userName"]; 
            $password = $_POST["userPassword"];
            $securePassword= password_hash($password, PASSWORD_DEFAULT);
            $id = random_int(12,1000);
            $sql = "INSERT INTO users(userId, userName, userPassword, securePassword) VALUES ('$id','$name','$password','$securePassword')";
            $result = $this->conn->query($sql);
        }
    }
}