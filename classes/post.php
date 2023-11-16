<?php
    require_once 'user.php';
    require_once 'DBconfig.php';

    class Post extends DBconfig {
        public $title;
        public $description;
        public $content;
        public $created_on;
        public $updated_on;
        public $deleted_on;
        public $user_id;

        public function addPost($data) {
            try {
                $title = $data['title'];
                $description = $data['description'];
                $content = $data['content'];
                
                $this->title = $title;
                $this->description = $description;
                $this->content = $content;
                $this->created_on = date('Y-m-d H:i:s');
                $this->updated_on = date('Y-m-d H:i:s');
                $this->deleted_on = null;
                $this->user_id = $_SESSION['user_id'];
        
                $this->connect();
        
                $sql = "INSERT INTO posts (title, description, content, created_on, updated_on, deleted_on, user_id) VALUES (:title, :description, :content, :created_on, :updated_on, :deleted_on, :user_id)";
                $stmt = $this->conn->prepare($sql);
        
                $stmt->bindParam(':title', $this->title);
                $stmt->bindParam(':description', $this->description);
                $stmt->bindParam(':content', $this->content);
                $stmt->bindParam(':created_on', $this->created_on);
                $stmt->bindParam(':updated_on', $this->updated_on);
                $stmt->bindParam(':deleted_on', $this->deleted_on);
                $stmt->bindParam(':user_id', $this->user_id);
        
                if ($stmt->execute()) {
                    return "New post successfuly created";
                } else {
                    return "Something went wrong, please try again";
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
        
        public function getUserPosts($user_id) {
            try {
                $this->connect();
        
                $sql = "SELECT * FROM posts WHERE user_id = :user_id ORDER BY created_on DESC";
                $stmt = $this->conn->prepare($sql);
        
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->execute();
        
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function getAllPosts() {
            try{
                $this->connect();

                $sql = "SELECT * FROM posts ORDER BY created_on DESC";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function getPaginatedPosts($start, $limit) {
            try {
                $this->connect();
        
                $sql = "SELECT * FROM posts ORDER BY created_on DESC LIMIT :start, :limit";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':start', $start, PDO::PARAM_INT);
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->execute();
        
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
        

        public function getPost($post_id) {
            try {
                $this->connect();
        
                $sql = "SELECT * FROM posts WHERE id = :post_id";
                $stmt = $this->conn->prepare($sql);
        
                $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
                $stmt->execute();
        
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
        
        public function updatePost($data, $post_id) {
            try {
                $title = $data['title'];
                $description = $data['description'];
                $content = $data['content'];
        
                $this->title = $title;
                $this->description = $description;
                $this->content = $content;
                $this->updated_on = date('Y-m-d H:i:s');
        
                $this->connect();
        
                $sql = "UPDATE posts SET title = :title, description = :description, content = :content, updated_on = :updated_on WHERE id = :post_id";
                $stmt = $this->conn->prepare($sql);
        
                $stmt->bindParam(':title', $this->title);
                $stmt->bindParam(':description', $this->description);
                $stmt->bindParam(':content', $this->content);
                $stmt->bindParam(':updated_on', $this->updated_on);
                $stmt->bindParam(':post_id', $post_id);
        
                if ($stmt->execute()) {
                    echo "Post successfully updated";
                } else {
                    echo "Something went wrong, please try again";
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function deletePost() {
            $pID = $_GET['id'];
        
            $sql = "DELETE FROM posts WHERE id=:postId";
            $this->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':postId', $pID);
            $stmt->execute();
        
            header("Location: ./managePost.php");
            exit;
        }
        
    }
?>