<?php 
    //Posts class inherits from Dbh
    class Posts extends Dbh {

        //CRUD operations defined below 

        //READ
        public function getPosts() {
            //sql query for getting all posts
            $sql = "SELECT * FROM posts";
            //refers to Dbh connect function (pdo) and then call pre-defined prepare function for executing query
            $stmt = $this->connect()->prepare($sql);
            //execute pre-defined PDO function. Result is stores in $stmt 
            $stmt->execute();

            //while loop for fetching each database item
            while($result = $stmt->fetchAll()) {
                return $result;
            }
        }

        //CREATE
        public function addPost($title, $body, $author) {
            //? ? ? are used for query template
            $sql = "INSERT INTO posts(title, body, author) VALUES(?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$title, $body, $author]);
        }

        //this will only return the post with provided id
        public function editPost($id) {
            $sql = "SELECT * FROM posts WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            //fetch will return specific posts with the given id
            $result = $stmt->fetch();
            return $result;
        }

        //UPDATE
        //this wil update the post with specified id
        public function updatePost($title, $body, $author, $id) {
            $sql = "UPDATE posts SET title = ?, body = ?, author = ? WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$title, $body, $author, $id]);
        }

        //DELETE
        public function deletePost($id) {
            $sql = "DELETE FROM posts WHERE id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
        }
    }