<?php

class WeatherStation
{
    private int $idStation;
    private string $nameStation;
    private string $locationStation;
    private string $latlonStation;
    private string $ownerStation;
    private bool $availability;

    public function __construct(int $idStation,string $nameStation,string $locationStation,string $latlonStation,string $ownerStation,bool $availability) {
        
        $this->idStation = $idStation;
        $this->nameStation = $nameStation;
        $this->locationStation = $locationStation;
        $this->latlonStation = $latlonStation;
        $this->ownerStation = $ownerStation;
        $this->availability = $availability;
    }
    /**
     * Get the value of idStation
     */ 
    public function getIdStation()
    {
        return $this->idStation;
    }
    /**
     * Set the value of idStation
     *
     * @return  self
     */ 
    public function setIdStation($idStation)
    {
        $this->idStation = $idStation;

        return $this;
    }
    /**
     * Get the value of nameStation
     */ 
    public function getNameStation()
    {
        return $this->nameStation;
    }
    /**
     * Set the value of nameStation
     *
     * @return  self
     */ 
    public function setNameStation($nameStation)
    {
        $this->nameStation = $nameStation;

        return $this;
    }
    /**
     * Get the value of locationStation
     */ 
    public function getLocationStation()
    {
        return $this->locationStation;
    }
    /**
     * Set the value of locationStation
     *
     * @return  self
     */ 
    public function setLocationStation($locationStation)
    {
        $this->locationStation = $locationStation;

        return $this;
    }

    /**
     * Get the value of latlonStation
     */ 
    public function getLatlonStation()
    {
        return $this->latlonStation;
    }

    /**
     * Set the value of latlonStation
     *
     * @return  self
     */ 
    public function setLatlonStation($latlonStation)
    {
        $this->latlonStation = $latlonStation;

        return $this;
    }

    /**
     * Get the value of ownerStation
     */ 
    public function getOwnerStation()
    {
            return $this->ownerStation;
    }

    /**
     * Set the value of ownerStation
     *
     * @return  self
     */ 
    public function setOwnerStation($ownerStation)
    {
            $this->ownerStation = $ownerStation;

            return $this;
    }

    /**
     * Get the value of availability
     */ 
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * Set the value of availability
     *
     * @return  self
     */ 
    public function setAvailability($availability)
    {
        $this->availability = $availability;

        return $this;
    }
}
