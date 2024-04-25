<?php

class WeatherAlert 
{
    private int $idAlert;
    private string $startDateAlert;
    private string $endDateAlert;
    private string $descriptionAlert;
    private int $idTypeAlert;
    private bool $archiveAlert;
    private int $levelAlert;
    private string $nameWeatherAlert;

    /**
     * @param int $idAlert L'identifiant de l'alerte.
     * @param string $startDateAlert La date de début de l'alerte au format "Y-m-d H:i:s".
     * @param string $endDateAlert La date de fin de l'alerte au format "Y-m-d H:i:s".
     * @param string $descriptionAlert La description de l'alerte.
     * @param int $idTypeAlert L'identifiant du type d'alerte.
     * @param bool $archiveAlert Indique si l'alerte est archivée (true) ou non (false).
     */
    public function __construct(int $idAlert, string $startDateAlert, string $endDateAlert, string $descriptionAlert, int $idTypeAlert, bool $archiveAlert, int $levelAlert,string $nameWeatherAlert)
    {
        $this->idAlert = $idAlert;
        $this->startDateAlert = $startDateAlert;
        $this->endDateAlert = $endDateAlert;
        $this->descriptionAlert = $descriptionAlert;
        $this->idTypeAlert = $idTypeAlert;
        $this->archiveAlert = $archiveAlert;
        $this->levelAlert =  $levelAlert;
        $this->nameWeatherAlert = $nameWeatherAlert;
    }
    public function getIdAlert(): int
    {
        return $this->idAlert;
    }
    public function getStartDateAlert(): string
    {
        return $this->startDateAlert;
    }
    public function setStartDateAlert(string $startDateAlert): void
    {
        $this->startDateAlert = $startDateAlert;
    }
    public function getEndDateAlert(): string
    {
        return $this->endDateAlert;
    }
    public function setEndDateAlert(string $endDateAlert): void
    {
        $this->endDateAlert = $endDateAlert;
    }
    public function getDescriptionAlert(): string
    {
        return $this->descriptionAlert;
    }
    public function setDescriptionAlert(string $descriptionAlert): void
    {
        $this->descriptionAlert = $descriptionAlert;
    }
    public function getIdTypeAlert(): int
    {
        return $this->idTypeAlert;
    }
    public function setIdTypeAlert(int $idTypeAlert): void
    {
        $this->idTypeAlert = $idTypeAlert;
    }
    public function isArchiveAlert(): bool
    {
        return $this->archiveAlert;
    }
    public function setArchiveAlert(bool $archiveAlert): void
    {
        $this->archiveAlert = $archiveAlert;
    }
    /**
     * Get the value of nameWeatherAlert
     */ 
    public function getNameWeatherAlert()
    {
        return $this->nameWeatherAlert;
    }

    /**
     * Set the value of nameWeatherAlert
     *
     * @return  self
     */ 
    public function setNameWeatherAlert($nameWeatherAlert)
    {
        $this->nameWeatherAlert = $nameWeatherAlert;

        return $this;
    }
    /**
     * Get the value of levelAlert
     */ 
    public function getLevelAlert()
    {
        return $this->levelAlert;
    }
    /**
     * Set the value of levelAlert
     *
     * @return  self
     */ 
    public function setLevelAlert($levelAlert)
    {
        $this->levelAlert = $levelAlert;

        return $this;
    }
}
