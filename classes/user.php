<?php
    session_start();
    require_once 'DBconfig.php';

    class User extends DBconfig {
        public $username;
        public $password;

        public function register($data) {
            try{
                $username = $data['username'];
                $password = password_hash($data['password'], PASSWORD_DEFAULT);

                if(empty($username) || empty($password)) {
                    throw new Exception("No username and/or password given");
                }

                $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

                $this->connect();
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);

                if($stmt->execute()) {
                    return "{$username} is added";
                }

            }catch(Exception $e){
                return $e->getMessage();
            }
        }

        public function getUsers() {
            try {
                $this->connect();

                $sql = "SELECT * FROM users";

                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
        
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch(Exception $e){
                return $e->getMessage();
            }
        }

        public function userLogin($data) {
            try {
                $username = $data['username'];
                $password = $data['password'];
        
                if (empty($username) || empty($password)) {
                    throw new Exception("Please provide both username and password");
                }
        
                $sql = "SELECT * FROM users WHERE username = :username";
                $this->connect();
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->execute();
        
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if (!$user || !password_verify($password, $user['password'])) {
                    throw new Exception("Invalid username or password");
                }
        
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
        
                header("Location: admin.php");
                exit();
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function deleteUser() {
            $uID = $_GET['id'];
        
            $sql = "DELETE FROM users WHERE id=:userId";
            $this->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':userId', $uID);
            $stmt->execute();
        
            header("Location: ./manageUsers.php");
            exit;
        }
        

        public function logout() {
            session_unset();
            session_destroy();
    
            header("Location: index.php");
            exit();
        }
    }
?>