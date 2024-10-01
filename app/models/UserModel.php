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

    public function updateUserProfile($user_id, $image_url = '', $fullName = '', $bio = '', $gender = '', $birthday = '', $email = '', $shipping_address = '')
    {
        try {
            if (isset($this->__conn)) {
                $sql = "UPDATE users 
                    SET image_url = :image_url, fullName = :fullName, bio = :bio, gender = :gender, birthday = :birthday, email = :email, shipping_address = :shipping_address
                    WHERE id = :user_id";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("image_url", $image_url, PDO::PARAM_STR);
                $stmt->bindParam("fullName", $fullName, PDO::PARAM_STR);
                $stmt->bindParam("bio", $bio, PDO::PARAM_STR);
                $stmt->bindParam("gender", $gender, PDO::PARAM_STR);
                $stmt->bindParam("birthday", $birthday, PDO::PARAM_STR);  // Birthday should be formatted correctly before binding
                $stmt->bindParam("email", $email, PDO::PARAM_STR);
                $stmt->bindParam("shipping_address", $shipping_address, PDO::PARAM_STR);
                $stmt->bindParam("user_id", $user_id, PDO::PARAM_INT);
                $stmt->execute();
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
