<?php
class Connect
{
    private string $host = '';
    private string $dbname = '';
    private string $username = '';
    private string $userpdw = '';
    private $connection;
    /**
     * Permet la connexion à la base de données
     */
    public function getConnection()
    {
        try {
            $this->connection = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname.";charset=utf8", $this->username, $this->userpdw);
        } catch (PDOException $e) {
            die ($e->getMessage());
        }
        return $this->connection; 
    }
}
