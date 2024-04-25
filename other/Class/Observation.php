<?php

class Observation 
{
    private int $idObservation;
    private int $idTypeObservation;
    private string $descriptionObservation;
    private string $locationObservation;
    private string $linkImageObservation;
    private int $idWeatherStation;
    private int $idUser;
    private bool $archiveObservation;
    public function __construct(int $idObservation, int $idTypeObservation, string $descriptionObservation, string $locationObservation, string $linkImageObservation, int $idWeatherStation, int $idUser, bool $archiveObservation)
    {
        $this->idObservation = $idObservation;
        $this->idTypeObservation = $idTypeObservation;
        $this->descriptionObservation = $descriptionObservation;
        $this->locationObservation = $locationObservation;
        $this->linkImageObservation = $linkImageObservation;
        $this->idWeatherStation = $idWeatherStation;
        $this->idUser = $idUser;
        $this->archiveObservation = $archiveObservation;
    }

    public function getIdObservation()
    {
        return $this->idObservation;
    }

    public function getIdTypeObservation()
    {
        return $this->idTypeObservation;
    }

    public function getDescriptionObservation()
    {
        return $this->descriptionObservation;
    }

    public function getLocationObservation()
    {
        return $this->locationObservation;
    }

    public function getLinkImageObservation()
    {
        return $this->linkImageObservation;
    }

    public function getIdWeatherStation()
    {
        return $this->idWeatherStation;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function isArchiveObservation()
    {
        return $this->archiveObservation;
    }

    public function setIdObservation(int $idObservation)
    {
        $this->idObservation = $idObservation;
    }

    public function setIdTypeObservation(int $idTypeObservation)
    {
        $this->idTypeObservation = $idTypeObservation;
    }

    public function setDescriptionObservation(string $descriptionObservation)
    {
        $this->descriptionObservation = $descriptionObservation;
    }

    public function setLocationObservation(string $locationObservation)
    {
        $this->locationObservation = $locationObservation;
    }

    public function setLinkImageObservation(string $linkImageObservation)
    {
        $this->linkImageObservation = $linkImageObservation;
    }

    public function setIdWeatherStation(int $idWeatherStation)
    {
        $this->idWeatherStation = $idWeatherStation;
    }

    public function setIdUser(int $idUser)
    {
        $this->idUser = $idUser;
    }

    public function setArchiveObservation(bool $archiveObservation)
    {
        $this->archiveObservation = $archiveObservation;
    }
}
