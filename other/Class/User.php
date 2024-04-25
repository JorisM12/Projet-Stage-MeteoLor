<?php
class User 
{
    private int $idUser;
    private string $userAlias;
    private string $userMail;
    private string $userPwd;
    private ?string $userMember;
    private string $userRegistration;
    private string $userCity;
    private int $idUserStatut;
    private bool $userArchive;
    public function __construct(int $idUser, string $userAlias, string $userMail, string $userPwd, ?string $userMember, string $userRegistration,string $userCity,int $idUserStatut,bool $userArchive)
    {
        $this->idUser = $idUser;
        $this->userAlias = $userAlias;
        $this->userMail = $userMail;
        $this->userPwd = $userPwd;
        $this->userMember = $userMember;
        $this->userRegistration = $userRegistration;
        $this->userCity = $userCity;
        $this->idUserStatut = $idUserStatut;
        $this->userArchive = $userArchive;
    }
    /**
     * Get the value of userAlias
     */ 
    public function getUserAlias()
    {
        return $this->userAlias;
    }
    /**
     * Set the value of userAlias
     *
     * @return  self
     */ 
    public function setUserAlias($userAlias)
    {
        $this->userAlias = $userAlias;

        return $this;
    }
    /**
     * Get the value of userMail
     */ 
    public function getUserMail()
    {
        return $this->userMail;
    }

    /**
     * Set the value of userMail
     *
     * @return  self
     */ 
    public function setUserMail($userMail)
    {
        $this->userMail = $userMail;

        return $this;
    }
    /**
     * Get the value of userPwd
     */ 
    public function getUserPwd()
    {
        return $this->userPwd;
    }
    /**
     * Set the value of userPwd
     *
     * @return  self
     */ 
    public function setUserPwd($userPwd)
    {
        $this->userPwd = $userPwd;

        return $this;
    }
    /**
     * Get the value of userMember
     */ 
    public function getUserMember()
    {
        return $this->userMember;
    }
    /**
     * Set the value of userMember
     *
     * @return  self
     */ 
    public function setUserMember($userMember)
    {
        $this->userMember = $userMember;

        return $this;
    }
    /**
     * Get the value of userRegistration
     */ 
    public function getUserRegistration()
    {
        return $this->userRegistration;
    }
    /**
     * Set the value of userRegistration
     *
     * @return  self
     */ 
    public function setUserRegistration($userRegistration)
    {
        $this->userRegistration = $userRegistration;

        return $this;
    }

    /**
     * Get the value of idUser
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of userCity
     */ 
    public function getUserCity()
    {
            return $this->userCity;
    }

    /**
     * Set the value of userCity
     *
     * @return  self
     */ 
    public function setUserCity($userCity)
    {
            $this->userCity = $userCity;

            return $this;
    }

    /**
     * Get the value of userArchive
     */ 
    public function getUserArchive()
    {
            return $this->userArchive;
    }

    /**
     * Set the value of userArchive
     *
     * @return  self
     */ 
    public function setUserArchive($userArchive)
    {
            $this->userArchive = $userArchive;

            return $this;
    }
    /**
     * Get the value of idUserStatut
     */ 
    public function getIdUserStatut()
    {
        return $this->idUserStatut;
    }
    /**
     * Set the value of idUserStatut
     *
     * @return  self
     */ 
    public function setIdUserStatut($idUserStatut)
    {
        $this->idUserStatut = $idUserStatut;

        return $this;
    }
}

