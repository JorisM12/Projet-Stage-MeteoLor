<?php
try {
    $host = 'localhost';
    $dbname = 'meteolor_app';
    $username = 'phpmyadmin';
    $userpdw = 'azerty';

    $db = new PDO ("mysql:host=".$host.";dbname=".$dbname.";charset=utf8",$username,$userpdw);
} catch (exception $e){
    die ($e ->getMessage());
}

class Connect
{
    private string $host = 'localhost';
    private string $dbname = 'meteolor_app';
    private string $username = 'phpmyadmin';
    private string $userpdw = 'azerty';
    private $connection;

    /**
     * Permet la connexion à la base de donnée
     */
    public function getConnection()
    {
        try {
            $this->connection= new PDO ("mysql:host=".$host.";dbname=".$dbname.";charset=utf8",$username,$userpdw);
            } catch (exception $e){
                die ($e ->getMessage());
            }
        return $this->connection; 
    }
}

class UserApp
{
    private $connection;
    private $userStatus;
    private $aliasUser;
    private $memberUser;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->userStatus = $userStatus;
        $this->aliasUser = $aliasUser;
        $this->memberUser = $memberUser;
    }

    /**
     * Réupère l'addresse mail recherchée 
     */
    public function getUserByMail($userMail)
    {
        $sql = "SELECT * FROM users_app WHERE mail_user = :mail_user";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':mail_user '=> $userMail]);
        $stmt->fetch(PDO::FETCH_ASSOC);
        return $stmt;
    }
    /**
     * Récupère le statut de l'utilisateur via son id
     */
    public function getUserStatusById($idUser)
    {
        $sql = "SELECT user_status FROM users_app WHERE id_user = :id_user";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':id_user '=> $idUser]);
        $stmt->fetch(PDO::FETCH_ASSOC);
        return $stmt;
    }
     /**
     * Récupère l'alias de l'utilisateur via son id
     */
    public function getUserAliasById($idUser)
    {
        $sql = "SELECT alias_user FROM users_app WHERE id_user = :id_user";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':id_user '=> $idUser]);
        $stmt->fetch(PDO::FETCH_ASSOC);
        return $this->aliasUser = $stmt;
    } 
     /**
     * Récupère la date d'adhésion de l'utilisateur via son id
     */
    public function getUserMemberById($idUser)
    {
        $sql = "SELECT member_user FROM users_app WHERE id_user = :id_user";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':id_user '=> $idUser]);
        $stmt->fetch(PDO::FETCH_ASSOC);
        return $this->memberUser = $stmt;
    } 
}

class Authentication 
{
    private $user;
    
    public function __construct($db)
    {
        $this->user = new UserApp($db);
    }

    public function login($userMail,$userPwd)
    {
        $userMail =  $this->user->getUserByMail($userMail);
        if($user && password_verify($userPwd,$user['password_user']))
        {
            return true;
        }
    }

}
