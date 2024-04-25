<?php
class Authentication 
{
    private $user;

    public function __construct($db)
    {
        $this->user = new UserApp($db);
    }
    public function login($userMail, $userPwd)
    {
        $user = $this->user->getUserByMail($userMail);
        if ($user && password_verify($userPwd, $user['password_user'])) {
            return true;
        } else {
            return false;
        }
    }
}

