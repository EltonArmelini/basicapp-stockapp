<?php 


namespace src\Model;

use PDO;
use PDOException;
class Database {

    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->db = $_ENV['DB_NAME'];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];
        $this->charset = $_ENV['DB_CHARSET'];
    }

    public function connection(){
        try {
            $connection = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}"; 
            $options = [
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, 
                PDO::ATTR_EMULATE_PREPARES=>false
            ];
            $pdo = new PDO($connection,$this->user,$this->password,$options);
            return $pdo;
        } catch (PDOException $e) {
            echo "Error -> ".$e->getMessage();
        }
    }
}