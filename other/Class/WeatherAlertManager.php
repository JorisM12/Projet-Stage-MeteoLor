<?php
class WeatherAlertManager 
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    /**
     * Cette méthode permet de récupérer les informations d'un type d'alerte météo à partir de son identifiant
     * @param int $idAlertType ID du type d'alerte météo à récupérer.
     *
     * @return array Retourne l'alerte demandée
     */
    public function selectOneTypeAlert($idAlertType)
    {
        $sql = "SELECT * FROM weather_alert_types  WHERE id_weather_alert_type = :id_alert_type";
        $stmt=$this->db->prepare($sql);
        $stmt->execute([":id_alert_type"=>$idAlertType]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * Récupère tous les types d'alertes météo présents dans la base de données.
     * @return array Retourne un tableau contenant tous les types d'alertes météo.
     */
    public function selectAllTypeAlert()
    {
        $sql = "SELECT * FROM weather_alert_types";
        $stmt=$this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function saveWeatherAlert(int $idAlert ,int $typeAlert, string $startDate, string $startTime, string $endDate, string $endTime, string $description, int $level_alert)
    {
        if($idAlert === 0)
        {
            $dateTimeStart = $startDate.' '.$startTime;
            $dateTimeEnd = $endDate.' '.$endTime;
            $sql = "INSERT INTO weather_alerts (post_weather_alert, start_date_weather_alert, end_date_weather_alert, description_weather_alert, id_weather_alert_type, 	level_weather_alert) VALUE (NOW(), :dateTimeStart, :dateTimeEnd, :description_weather_alert,:id_weather_alert_type, :level_weather_alert)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
            ':dateTimeStart'=>$dateTimeStart,
            ':dateTimeEnd'=>$dateTimeEnd,
            ':description_weather_alert'=>$description,
            ':id_weather_alert_type'=>$typeAlert,
            ':level_weather_alert'=>$level_alert
        ]);
        }else{
            $sql = "UPDATE weather_alerts SET archive_weather_alert = 1 WHERE id_weather_alert = :id_weather_alert ";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id_weather_alert' =>$idAlert
            ]);
        }   
    }
   public function weatherAlertVerify()
   {
        $sql = "SELECT id_weather_alert FROM weather_alerts WHERE start_date_weather_alert < NOW() AND end_date_weather_alert > NOW() AND archive_weather_alert = 0";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
   }
   public function selectOneAlert($idAlert)
    {
        $sql = "SELECT *,DATE_FORMAT(start_date_weather_alert,'%d/%m/%Y %H:%i:%s ') as start_date,DATE_FORMAT(end_date_weather_alert,'%d/%m/%Y %H:%i:%s') as end_date FROM weather_alerts INNER JOIN weather_alert_types ON weather_alert_types.id_weather_alert_type = weather_alerts.id_weather_alert_type  WHERE id_weather_alert = :id_weather_alert";
        $stmt=$this->db->prepare($sql);
        $stmt->execute([":id_weather_alert"=>$idAlert]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function selectAllAlertFutur()
    {
        $sql = "SELECT *,DATE_FORMAT(start_date_weather_alert,'%d/%m/%Y %H:%i:%s ') as start_date,DATE_FORMAT(end_date_weather_alert,'%d/%m/%Y %H:%i:%s') as end_date FROM weather_alerts INNER JOIN weather_alert_types ON weather_alert_types.id_weather_alert_type = weather_alerts.id_weather_alert_type WHERE start_date_weather_alert > NOW()";
        $stmt=$this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}