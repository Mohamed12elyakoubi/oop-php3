<?php
    class Database {
        public $pdo;

        public function __construct($db = "root", $user="root", $pwd="", $host="localhost:3306")
        {
            try {
                $this->pdo = new PDO("mysql:host=$host; dbname=$db", $user, $pwd);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "connected to database $db";
            }
            catch(PDOException $e){
                echo("Connection failed: " . $e->getMessage());
            }
        }
        public function addUser(string $Name, string $password, string $hashedPassword = null) {
            if ($hashedPassword === null) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            }
        
            $sql = 'INSERT INTO users (Name, password) VALUES (:name, :pass)';
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':name', $Name);
            $stmt->bindParam(':pass', $hashedPassword);
        
            $stmt->execute();
        }
        public function getUser($id = null)
        {
            $sql = 'SELECT * FROM users';
            $result = null;
    
            if ($id !== null) {
                $sql = 'SELECT * FROM users WHERE id = :id';
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $stmt = $this->pdo->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
    
            return $result;
        }
    }

?>
