<?php
require_once $_SERVER['DOCUMENT_ROOT']."/other/Functions/Functions.php";
class ObservationsManager 
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function selectOneObservationType($idType)
    {
        $sql = "SELECT * FROM observation_types  WHERE id_type_observation = :id_type_observation ";
        $stmt=$this->db->prepare($sql);
        $stmt->execute([":id_type_observation"=>$idType]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function selectAllObservationTypes()
    {
        $sql = "SELECT * FROM observation_types";
        $stmt=$this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectOneObservation($idObservation)
    {
        $sql = "SELECT *,DATE_FORMAT(date_observation, '%d/%m/%Y') as date, DATE_FORMAT(date_observation, '%H:%i') as hour FROM observations INNER JOIN observation_types ON observations.id_type_observation = observation_types.id_type_observation WHERE id_observation = :id_observation";
        $stmt=$this->db->prepare($sql);
        $stmt->execute([":id_observation "=>$idObservation]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function selectAllObservations()
    {
        $sql = "SELECT *,DATE_FORMAT(date_observation, '%d/%m/%Y') as date, DATE_FORMAT(date_observation, '%H:%i') as hour FROM observations INNER JOIN observation_types ON observations.id_type_observation = observation_types.id_type_observation INNER JOIN users_app ON observations.id_user = users_app.id_user WHERE archive_observation = 0";
        $stmt=$this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectAllObservationsOneDay()
    {
        $sql = "SELECT *,DATE_FORMAT(date_observation, '%d/%m/%Y') as date, DATE_FORMAT(date_observation, '%H:%i') as hour FROM observations INNER JOIN observation_types ON observations.id_type_observation = observation_types.id_type_observation INNER JOIN users_app ON observations.id_user = users_app.id_user WHERE archive_observation = 0 AND DATE_FORMAT(date_observation, '%d/%m/%Y') = DATE_FORMAT(NOW(), '%d/%m/%Y')";
        $stmt=$this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectAllObservationsByUser($idUser)
    {
        $sql = "SELECT *, DATE_FORMAT(date_observation, '%d/%m/%Y') as date, DATE_FORMAT(date_observation, '%H:%i') as hour FROM observations INNER JOIN observation_types ON observations.id_type_observation = observation_types.id_type_observation INNER JOIN users_app ON observations.id_user = users_app.id_user WHERE observations.id_user = :id_user AND archive_observation = 0 ORDER BY id_observation DESC";
        $stmt=$this->db->prepare($sql);
        $stmt->execute([':id_user' =>$idUser]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function saveObservation(string $locationObservation,string $lat,string $lon, int $idObservation ,string $dateObservation, string $descriptionObservation, string $linkPictureObservation, float $valueObservation,  $idWeatherStation, int $idTypeObservation, int $idUser)
    {
        
        if($idObservation === 0)
        {
            $sql = "INSERT INTO observations (date_observation,location_observation, lat_observation,lon_observation,description_observation, link_picture_observation, value_observation, id_weather_station, id_type_observation, id_user) VALUES (NOW(),:location_observation,:lat_observation,:lon_observation , :description_observation ,:link_picture_observation,:value_observation, :id_weather_station, :id_type_observation ,:id_user)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':location_observation' => $locationObservation,
                ':lat_observation' => $lat,
                ':lon_observation' => $lon,
                ':description_observation' => $descriptionObservation,
                ':link_picture_observation' => $linkPictureObservation,
                ':value_observation' => $valueObservation,
                ':id_weather_station' => $idWeatherStation,
                ':id_type_observation' => $idTypeObservation,
                ':id_user' => $idUser  
            ]);
        }else{
            $sql = "UPDATE observations SET 
            location_observation = :location_observation,
            lat_observation = :lat_observation,
            lon_observation = :lon_observation,
            description_observation = :description_observation,
            link_picture_observation = :link_picture_observation,
            value_observation = :value_observation,
            id_weather_station = :id_weather_station,
            id_type_observation = :id_type_observation,
            id_user = :id_user WHERE id_observation = :id_observation";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
            ':location_observation' => $locationObservation,
            ':lat_observation' => $lat,
            ':lon_observation' => $lon,
            ':description_observation' => $descriptionObservation,
            ':link_picture_observation' => $linkPictureObservation,
            ':value_observation' => $valueObservation,
            ':id_weather_station' => $idWeatherStation,
            ':id_type_observation' => $idTypeObservation,
            ':id_user' => $idUser,
            ':id_observation' => $idObservation
            ]);
        }   
    }

    public function archiveObservation($idObservation)
    {
        $sql = "UPDATE observations SET  archive_observation = 1 WHERE id_observation = :id_observation";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_observation' => $idObservation]);

    }
    public function archiveLastObservationByUser($idUser)
    {
        $sql = "SELECT id_observation FROM observations WHERE id_user = :id_user ORDER BY id_observation DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_user' => $idUser]);
        $result = $stmt->fetch();
        //return $result[0];
        $sql = "UPDATE observations SET archive_observation = 1  WHERE id_observation = ".$result[0];
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }
    public function saveImageObservation(array $data,$dateObservation,$userName)
    {
        $imageData = $data['tmp_name'];
        $imageName = $data['name'];
        $formatImage = new SplFileInfo($imageName);
        $extension = ($formatImage->getExtension());
        $linkImage = imageName($userName,$dateObservation,$extension);
        $newImage = treatmentImage($imageName,300,300,$imageData,$linkImage);
        return $linkImage;
    }
}


