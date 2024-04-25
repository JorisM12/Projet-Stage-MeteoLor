<?php
require_once $_SERVER['DOCUMENT_ROOT']."/other/Functions/Functions.php";
class UserManager 
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    /**
     * Retourne un utilisateur selon son ID
     */
    public function selectOneUser($idUser)
    {
        $sql = "SELECT *
        FROM users_app
        INNER JOIN user_status ON users_app.id_user_status = user_status.id_user_status
        WHERE id_user = :id_user;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_user' => $idUser]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * Retourne l'ensemble des utilisateurs
     */
    public function selectAllUsers()
    {
        $sql = "SELECT * FROM users_app";
        $stmt=$this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Récupère le statut de l'utilisateur via son id
     */
    public function getUserStatusById($idUser)
    {
        $sql = "SELECT *
        FROM users_app
        INNER JOIN user_status ON users_app.id_user_status = user_status.id_user_status
        WHERE id_user = :id_user;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_user' => $idUser]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getAllUserStatus()
    {
        $sql = "SELECT * FROM user_status";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Enregistre ou modifie un utilisateur
     */
    public function saveUser(int $idUser, string $alias_user, string $mail_user, string $password_user, mixed $member_user, string $city_user)
    {
    if ($idUser === 0) {
        $sql = "INSERT INTO users_app (alias_user, mail_user, password_user, registration_date_user, member_user, id_user_status, city_user) VALUE (:alias_user, :mail_user, :password_user, NOW(),NULL ,2, :city_user)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':alias_user' => $alias_user,
            ':mail_user' => $mail_user,
            ':password_user' => $password_user,
            ':city_user' => $city_user
        ]);
    } else {
        $sql = "UPDATE users_app SET alias_user = :alias_user, mail_user = :mail_user, password_user = :password_user, member_user = :member_user, city_user = :city_user WHERE id_user = :id_user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':alias_user' => $alias_user,
            ':mail_user' => $mail_user,
            ':password_user' => $password_user,
            ':member_user' => $member_user,
            ':city_user' => $city_user,
            ':id_user' => $idUser
        ]);
    }
}
    /**
     * Déactive un utilisateur
     */
    public function archiveUser(int $idUser)
    {
        $sql= "UPDATE users_app SET user_archive = 1 WHERE id_user=:id_user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_user' => $idUser]);
    }
    /**
     * Anonymise un utilisateur
     */
    public function anonymizeUser(int $idUser)
    {
        $sql = "UPDATE users_app SET alias_user = :alias_user, mail_user = :mail_user, password_user = :password_user, city_user = :city_user WHERE id_user = :id_user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':alias_user' => 'JohnDoe',
            ':mail_user' => 'john.doe@mail.fr',
            ':password_user' => '',
            ':city_user' => 'Paris 75000',
            ':id_user' => $idUser
        ]);
    }
    public function forgotPwd($idUser,$password_user)
    {
        $sql = "UPDATE users_app SET password_user = :password_user WHERE id_user = :id_user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':password_user' => $password_user,
            ':id_user' => $idUser
        ]);
    }
}


