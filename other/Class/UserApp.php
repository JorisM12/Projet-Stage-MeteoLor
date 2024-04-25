<?php
class UserApp
{
    private $connection;

    public function __construct($db)
    {
        $this->connection = $db;
    }
    /**
     * Réupère l'adresse mail recherchée 
     */
    public function getUserByMail($userMail)
    {
        $sql = "SELECT * FROM users_app WHERE mail_user = :mail_user";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':mail_user' => $userMail]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * Récupère le statut de l'utilisateur via son id
     */
    public function getUserStatusById($idUser)
    {
        $sql = "SELECT user_status FROM users_app WHERE id_user = :id_user INNER JOIN user_status ON users_app.id_user_status = user_status.id_user_status";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':id_user' => $idUser]);
        return $stmt->fetchColumn();
    }
    /**
     * Récupère l'alias de l'utilisateur via son id
     */
    public function getUserAliasById($idUser)
    {
        $sql = "SELECT alias_user FROM users_app WHERE id_user = :id_user";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':id_user' => $idUser]);
        return $stmt->fetchColumn();
    }
    /**
     * Récupère la date d'adhésion de l'utilisateur via son id
     */
    public function getUserMemberById($idUser)
    {
        $sql = "SELECT member_user FROM users_app WHERE id_user = :id_user";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':id_user' => $idUser]);
        return $stmt->fetchColumn();
    }
}