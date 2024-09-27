<?php
class UserModel
{
    private $__conn;
    public function  __construct($conn)
    {
        $this->__conn = $conn;
    }

    public function getUserByUsernameAndPassword($username, $password)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("username", $username, PDO::PARAM_STR);
                $stmt->bindParam("password", $password, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function getUserByUsername($username)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "select * from users where username = :username";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("username", $username, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }


    public function getPasswordByUsername($username)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "select password from users where username = :username";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("username", $username, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function registerNewUser($username, $password)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "INSERT INTO users (username, password) 
                        VALUES (:username, :password)";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("username", $username, PDO::PARAM_STR);
                $stmt->bindParam("password", $password, PDO::PARAM_STR);
                $stmt->execute();
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
