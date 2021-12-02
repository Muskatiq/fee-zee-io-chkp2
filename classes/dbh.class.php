<?php

    class Dbh {
        //credentials for log in to database
        private $host = "localhost";
        private $user = "root";
        private $pwd = "";
        private $dbName = "fee-zee-io";

        public function connect() {
            //throw the error when connection is not succesful
            try {
                $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
                //new PDO - PHP Data Object / interface for connecting to database
                $pdo = new PDO($dsn, $this->user, $this->pwd);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch(PDOException $e){
                die("ERROR: Could not connect. " . $e->getMessage());
            }
            //return created pdo object
            return $pdo;
        }
    }
