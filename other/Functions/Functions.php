<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/Connect.php';
/**
 * Vérifie si un utilisateur est adhérent et effectue les modifications appropriées
 * @return array
 */
function memberVerification($statusMember)
{
    $info = [];
    if($statusMember !== NULL)
    {
      $pictogramme = "Vous êtes adhérent(e)";
      $memberTitle = "Vous êtes adhérent(e)";
    }else{
      $pictogramme = "Vous n'êtes pas adhérent(e)";
      $memberTitle = "Vous n'êtes pas adhérent(e)";
    }
    $info = ['pictogramme'=>$pictogramme, 'member title'=>$memberTitle];
    return $info;
}

/**
 * Génère un token de formulaire
 */
function token()
{
  $token = 0;
  for ($i=0; $i < 5; $i++) 
  $token = $token.rand(0,5);
  return $token;
}
/**
 * Vérifie si un alias spécifique est déjà utilisé par un utilisateur dans la base de données.
 *
 * @param PDO $db Connexion à la base de données.
 * @param string $alias L'alias à rechercher dans la table 'users_app'.
 * @return bool Retourne true si l'alias existe déjà dans la base de données, sinon false.
 */
function findUniqueAlias($db, $alias) 
{
  $sql = "SELECT COUNT(id_user) as result FROM `users_app` WHERE alias_user = :alias";
  $stmt = $db->prepare($sql);
  $stmt->execute([':alias' => $alias]);
  $result = $stmt->fetch();
  if($result['result'] > 0) 
  {
    return true;
  }else{
    return false;
  }
}
/**
 * Vérifie si un alias spécifique est déjà utilisé par un utilisateur dans la base de données.
 *
 * @param PDO $db Connexion à la base de données.
 * @param string $mail_user Mail à rechercher dans la table 'users_app'.
 * @return bool Retourne true si le mail existe déjà dans la base de données, sinon false.
 */
function findUniqueMail($db, $mail_user) 
{
  $sql = "SELECT COUNT(id_user) as result FROM `users_app` WHERE mail_user = :mail_user";
  $stmt = $db->prepare($sql);
  $stmt->execute([':mail_user' => $mail_user]);
  $result = $stmt->fetch();
  if($result['result'] > 0) 
  {
    return true;
  }else{
    return false;
  }
}
/**
 * Calcule la longueur d'une chaîne de caractères (alias).
 *
 * @param string $alias La chaîne de caractères (alias) dont on souhaite calculer la longueur.
 * @return int La longueur de la chaîne de caractères (alias).
 */
function aliasLength($alias)
{
    $length = strlen($alias);
    return $length;
}
function treatmentImage ($nameImageOrigin,$heightUser,$widthUser,$imageSource,$roadImage){
  $formatImage = new SplFileInfo($nameImageOrigin);
  $extension = ($formatImage->getExtension());
  $size = getimagesize($imageSource);
  list($width, $height) = $size;
  $ratio = $width/$height;
  if($widthUser/$heightUser > $ratio){
    $widthUser = $heightUser*$ratio;
  } else {
    $heightUser = $widthUser/$ratio;
  };
  $NewImageWhite = imagecreatetruecolor($widthUser,$heightUser);
  $image = imagecreatefromstring(file_get_contents($imageSource));
  imagecopyresampled($NewImageWhite, $image, 0, 0, 0, 0, $widthUser, $heightUser, $width, $height);
  switch ($extension) {
    case 'jpg': 
      imagejpeg($NewImageWhite,$roadImage, 75);
      break;
    case 'avif':
      imageavif($NewImageWhite,$roadImage, 75);
      break;
    case 'png':
      imagepng($NewImageWhite,$roadImage);
      break;
    case 'gif':
      imagegif($NewImageWhite,$roadImage, 75);
      break;

  default:
    imagejpeg($NewImageWhite,$roadImage, 75); 
    break;
  }
  imagedestroy($NewImageWhite);
  imagedestroy($image);
};
function imageName(string $nameUser,string $dateObservation, string $extension):string
{
  $result = '../../other/Download/UserImageObs/IMG-'.$nameUser.'-'.str_replace([" ","/"],["-","-"],$dateObservation).'.'.$extension;

  
  return $result;
}
function getWeatherDataForUser($city)
{
  $cityNameUser = strtolower($city);
  $cityName = ucfirst($cityNameUser);
  $apiUrl = 'https://geo.api.gouv.fr/communes?codePostal='.$city.'&fields=code,nom,centre';
  $lat ='';
  $lon ='';
  $response = file_get_contents($apiUrl);
  if ($response !== false) {
      $data = json_decode($response, true);
      if ($data !== null) {
        $filteredDataToday = array();
        $filteredDataWeek = array();
        foreach ($data as $objet) {
          if (1 === 1) {
            $filteredData[] = $objet; 
            $lon = $filteredData[0]['centre']['coordinates'][0];
            $lat = $filteredData[0]['centre']['coordinates'][1];
            $apiWeatherUrl = 'https://api.open-meteo.com/v1/meteofrance?latitude='.$lat.'&longitude='.$lon.'&hourly=weathercode,windgusts_10m&daily=weathercode,temperature_2m_max,temperature_2m_min&timezone=auto';
            $getData = file_get_contents($apiWeatherUrl);
            if ($getData === false) {
              die('Erreur lors de la récupération des données.');
            }
            $resultData = json_decode($getData, true);
          }
        }
      } else {
        echo 'Erreur lors de la conversion JSON';
      }
    } else {
      echo 'Erreur lors de la requête API';
    }
    $tabWeather = [];
    $tabWeather['today-morning-wmo'] = $resultData['hourly']['weathercode'][9];
    $tabWeather['today-afternoon-wmo'] = $resultData['hourly']['weathercode'][15];
    $tabWeather['today-morning-gust'] = $resultData['hourly']['windgusts_10m'][9];
    $tabWeather['today-afternoon-gust'] = $resultData['hourly']['windgusts_10m'][15];

    foreach ($resultData['daily']['time'] as $key) {
      $tabWeather['other'] = ['wmoj+1' => $resultData['daily']['weathercode'][1],['wmoj+2' => $resultData['daily']['weathercode'][2]],['tmaxj+0' => $resultData['daily']['temperature_2m_max'][0]],['tmaxj+1' => $resultData['daily']['temperature_2m_max'][1]],['tmaxj+2' => $resultData['daily']['temperature_2m_max'][2]],['tminJ+0' => $resultData['daily']['temperature_2m_min'][0]],['tminj+1' => $resultData['daily']['temperature_2m_min'][1]],['tminj+2' => $resultData['daily']['temperature_2m_min'][2]]];  
  }
  return $tabWeather;
}
function getWeatherSnowData()
{
  $apiWeatherUrl = 'https://api.open-meteo.com/v1/dwd-icon?latitude=48.035&longitude=7.0122&hourly=freezinglevel_height&daily=apparent_temperature_min,snowfall_sum,windgusts_10m_max&timezone=auto';

  $getData = file_get_contents($apiWeatherUrl);
  $resultData = json_decode($getData, true);
  $tabWeather = [];
    $tabWeather['today-morning-iso'] = $resultData['hourly']['freezinglevel_height'][9];
    $tabWeather['today-afternoon-iso'] = $resultData['hourly']['freezinglevel_height'][15];
    $tabWeather['today-night-iso'] = $resultData['hourly']['freezinglevel_height'][22];
    $tabWeather['today-temp-min'] = $resultData['daily']['apparent_temperature_min'][1];
    $tabWeather['today-snow'] = $resultData['daily']['snowfall_sum'][1];

  return $tabWeather;
}
function weatherIcon($idIcon) {
  $result = 100;
  switch ($idIcon) {
      case 0:
      $result = 'JOURCLAIRFichier16';
      break;
      
      case 01:
      $result = 'PEUNUAGEUXFichier4';
      break;
      case 02:
      $result = 'PEUNUAGEUXFichier4';
      break;
      case 03:
      $result = 'NUAGEUXFichier3';
      break;
      case 05:
      $result = 'LEGERBROUILLARDFichier5';
      break;
      case 06:
      $result = 'LEGERBROUILLARDFichier5';
      break;
      case 07:
      $result = 'LEGERBROUILLARDFichier5';
      break;
      case 10:
      $result = 'LEGERBROUILLARDFichier5';
      break;
      case 10:
      $result = 'LEGERBROUILLARDFichier5';
      break;
      case 17:
      $result = 'PEUORAGEUXFichier11';
      break;
      case 18:
      $result = 'ORAGEFichier12';
      break;
      case 20:
      $result = 'pluiefaibleFichier21';
      break;
      case 21:
      $result = 'pluiefaibleFichier21';
      break;
      case 22:
      $result = 'NEIGEFAIBLEFichier6';
      break;
      case 23:
      $result = 'NEIGEPLUIEFichier9';
      break;
      case 24:
      $result = 'verglas';  // Pluie verglaçante
      break;
      case 25:
      $result = 'aversesFichier23';
      break;
      case 26:
      $result = 'aversesFichier23';
      break;
      case 27:
      $result = 'aversesFichier23';
      break;
      case 28:
      $result = 'LEGERBROUILLARDFichier5';
      break;
      case 29:
      $result = 'ORAGEFichier12';
      break;
      case 36:
      $result = 'NEIGEFAIBLEFichier6';
      break;
      case 37:
      $result = 'neigeForte';
      break;
      case 38:
      $result = 'NEIGEFAIBLEFichier6';
      break;
      case 39:
      $result = 'neigeForte';
      break;
      case 40:
      $result = 'LEGERBROUILLARDFichier5';
      break;
      case 41:
      $result = 'LEGERBROUILLARDFichier5';
      break;
      case 42:
      $result = 'LEGERBROUILLARDFichier5';
      break;
      case 43:
      $result = 'LEGERBROUILLARDFichier5';
      break;
      case 44:
      $result = 'LEGERBROUILLARDFichier5';
      break;
      case 45:
      $result = 'LEGERBROUILLARDFichier5';
      break;
      case 46:
      $result = 'LEGERBROUILLARDFichier5';
      break;
      case 47:
      $result = 'LEGERBROUILLARDFichier5';
      break;
      case 48:
      $result = 'LEGERBROUILLARDFichier5';
      break;
      case 49:
      $result = 'LEGERBROUILLARDFichier5';
      break;
      case 50:
      $result = 'pluiefaibleFichier21';
      break;
      case 51:
      $result = 'pluiefaibleFichier21';
      break;
      case 52:
      $result = 'pluiefaibleFichier21';
      break;
      case 53:
      $result = 'pluiefaibleFichier21';
      break;
      case 54:
      $result = 'pluiefaibleFichier21';
      break;
      case 55:
      $result = 'pluiefaibleFichier21';
      break;
      case 56:
      $result = 'verglas';
      break;
      case 57:
      $result = 'verglas';
      break;
      case 59:
      $result = 'pluiefaibleFichier21';
      break;
      case 59:
      $result = 'pluieFichier22';
      break;
      case 60:
      $result = 'pluieFichier22';
      break;
      case 61:
      $result = 'pluieFichier22';
      break;
      case 62:
      $result = 'pluieFichier22';
      break;
      case 63:
      $result = 'pluieFichier22';
      break;
      case 64:
      $result = 'pluieFichier22';
      break;
      case 65:
      $result = 'pluieFichier22';
      break;
      case 66:
      $result = 'verglas';
      break;
      case 67:
      $result = 'verglas';
      break;
      case 68:
      $result = 'NEIGEPLUIEFichier9';
      break;
      case 69:
      $result = 'NEIGEPLUIEFichier9';
      break;
      case 70:
      $result = 'NEIGEFAIBLEFichier6';
      break;
      case 71:
      $result = 'neigeForte';
      break;
      case 72:
      $result = 'NEIGEFAIBLEFichier6';
      break;
      case 73:
      $result = 'neigeForte';
      break;
      case 74:
      $result = 'NEIGEFAIBLEFichier6';
      break;
      case 75:
      $result = 'neigeForte';
      break;
      case 76:
      $result = 'NEIGEFAIBLEFichier6';
      break;
      case 77:
      $result = 'NEIGEFAIBLEFichier6';
      break;
      case 78:
      $result = 'NEIGEFAIBLEFichier6';
      break;
      case 79:
      $result = 'NEIGEFAIBLEFichier6';
      break;
      case 80:
      $result = 'aversesFichier23'; // Averses de pluie
      break;
      case 81:
      $result = 'aversesFichier23'; // Averses de pluie
      break;
      case 82:
      $result = 'aversesFichier23'; // Averses de pluie
      break;
      case 83:
      $result = 'aversesFichier23'; // Averses de pluie
      break;
      case 84:
      $result = 'aversesFichier23'; // Averses de pluie
      break;
      case 85:
      $result = 'NEIGEFAIBLEFichier6'; // Averses de neige
      break;
      case 86:
      $result = 'NEIGEMODEREEFichier7'; // Averses de neige modérée
      break;
      case 87:
      $result = 'aversesFichier23'; // Averses de grésil
      break;
      case 88:
      $result = 'aversesFichier23'; // Averses de grésil
      break;
      case 89:
      $result = 'aversesFichier23'; // Averses de grele
      break;
      case 90:
      $result = 'aversesFichier23'; // Averses de grele
      break;
      case 91:
      $result = 'ORAGEFichier12'; 
      break;
      case 92:
      $result = 'ORAGEFichier12'; 
      break;
      case 93:
      $result = 'ORAGEFichier12'; 
      break;
      case 94:
      $result = 'ORAGEFichier12'; 
      break;
      case 95:
      $result = 'ORAGEUXFichier10'; // Averses orageuses
      break;
      case 96:
      $result = 'ORAGEFORTFichier13'; 
      break;
      case 97:
      $result = 'ORAGEFORTFichier13'; 
      break;
      case 98:
      $result = 'ORAGEFichier12'; 
      break;
      case 99:
      $result = 'ORAGEFORTFichier13'; 
      break;
      default:
          break;
  }
  return $result; 
}
function formatDateToFrench($firstDate) {
  $originalDate = substr($firstDate, 0, 12);
  $formattedDate = date('Y/m/d', strtotime($originalDate));
  $date = new DateTime($formattedDate);
  $jourSemaine = $date->format('l');
  $jourMois = $date->format('j');
  $mois = $date->format('n');
  $annee = $date->format('Y');
  $jourSemaineFr = '';

  switch ($jourSemaine) {
      case 'Monday':
          $jourSemaineFr = 'Lundi';
          break;
      case 'Tuesday':
          $jourSemaineFr = 'Mardi';
          break;
      case 'Wednesday':
          $jourSemaineFr = 'Mercredi';
          break;
      case 'Thursday':
          $jourSemaineFr = 'Jeudi';
          break;
      case 'Friday':
          $jourSemaineFr = 'Vendredi';
          break;
      case 'Saturday':
          $jourSemaineFr = 'Samedi';
          break;
      case 'Sunday':
          $jourSemaineFr = 'Dimanche';
          break;
  }
  $moisFr = '';
  switch ($mois) {
      case 1:
          $moisFr = 'janvier';
          break;
      case 2:
          $moisFr = 'février';
          break;
      case 3:
          $moisFr = 'mars';
          break;
      case 4:
          $moisFr = 'avril';
          break;
      case 5:
          $moisFr = 'mai';
          break;
      case 6:
          $moisFr = 'juin';
          break;
      case 7:
          $moisFr = 'juillet';
          break;
      case 8:
          $moisFr = 'août';
          break;
      case 9:
          $moisFr = 'septembre';
          break;
      case 10:
          $moisFr = 'octobre';
          break;
      case 11:
          $moisFr = 'novembre';
          break;
      case 12:
        $moisFr = 'décembre';
        break;
  }
  return $jourSemaineFr . ' ' . $jourMois . ' ' . $moisFr . ' ' . $annee;
}

function tempColor($value) {
  $result = '';
    switch ($value) {
      case -15:
        $result = '147,69,255';
        break;
      case -14:
        $result = '0,0,255';
        break;
      case -13:
        $result = '0,19,255';
        break;
      case -12:
        $result = '0,39,255';
        break;
      case -11:
        $result = '0,59,255';
        break;
      case -10:
        $result = '0,78,255';
        break;
      case -9:
        $result = '0,98,255';
        break;
      case -8:
        $result = '0,118,255';
        break;
      case -7:
        $result = '0,137,255';
        break;
      case -6:
        $result = '0,157,255';
        break;
      case -5:
        $result = '0,177,255';
        break;
      case -4:
        $result = '0,196,255';
        break;
      case -3:
        $result = '0,216,255';
        break;
      case -2:
        $result = '0,236,255';
        break;
      case -1:
        $result = '0,255,255';
        break;
      case 0:
        $result = '19,255,236';
        break;
      case 1:
        $result = '39,255,216';
        break;
      case 2:
        $result = '59,255,196';
        break;
      case 3:
        $result = '78,255,177';
        break;
      case 4:
        $result = '98,255,157';
        break;
      case 5:
        $result = '118,255,137';
        break;
      case 6:
        $result = '137,255,118';
        break;
      case 7:
        $result = '157,255,98';
        break;
      case 8:
        $result = '177,255,78';
        break;
      case 9:
        $result = '196,255,59';
        break;
      case 10:
        $result = '216,255,39';
        break;
      case 11:
        $result = '236,255,19';
        break;
      case 12:
        $result = '255,255,0';
        break;
      case 13:
        $result = '255,236,0';
        break;
      case 14:
        $result = '255,216,0';
        break;
      case 15:
        $result = '255,196,0';
        break;
      case 16:
        $result = '255,177,0';
        break;
      case 17:
        $result = '255,157,0';
        break;
      case 18:
        $result = '255,137,0';
        break;
      case 19:
        $result = '255,118,0';
        break;
      case 20:
        $result = '255,98,0';
        break;
      case 21:
        $result = '255,78,0';
        break;
      case 22:
        $result = '255,59,0';
        break;
      case 23:
        $result = '255,39,0';
        break;
      case 24:
        $result = '255,19,0';
        break;
      case 25:
        $result = '237,0,3';
        break;
      case 26:
        $result = '225,0,3';
        break;
      case 27:
        $result = '202,0,3';
        break;
      case 28:
        $result = '187,0,3';
        break;
      case 29:
        $result = '164,0,2';
        break;
      case 30:
        $result = '133,0,2';
        break;
      case 31:
        $result = '124,0,2';
        break;
      case 32:
        $result = '128,0,128';
        break;
      case 34:
        $result = '148,0,188';
        break;
      case 35:
        $result = '171,0,238';
        break;
      case 36:
        $result = '255,0,255';
        break;
      case 37:
        $result = '226,0,226';
        break;
      case 38:
        $result = '171,0,171';
        break;
      case 39:
        $result = '124,0,124';
        break;
      case 40:
        $result = '86,0,86';
        break;
      case 41:
        $result = '151,39,199';
        break;
      case 42:
        $result = '189,0,189';
        break;
      case 43:
        $result = '255,0,255';
        break;
      default:
        $result = '213,0,255';
        break;
    }
    return $result;
  }
  function precipitationColor($value) {
    $result = '';
     if($value < 5)
     {
        $result = '#B5C6E0';
     }
     elseif ($value >= 5 && $value <= 15) 
     {
        $result = '#6B8DC1';
     }
     elseif ($value > 15) 
     {
       $result = '#2154A2';
     }
    return $result;
  }
  function isNight($hour,$value){
    $hourVerify = substr($hour,0,2);
    $result = '';
    if($hourVerify > 20 || $hourVerify < 6 ){
        switch ($value) {
        case 'JOURCLAIRFichier16':
        $result = 'NUITCLAIREFichier15';
        break;
        case 'PEUNUAGEUXFichier4':
        $result = 'nuitnuageuxFichier17';
        break;
        case 'LEGERBROUILLARDFichier5':
        $result = 'nuitnuageuxFichier17';
        break;
        case 'NUAGEUXFichier3':
        $result = 'nuitnuageuxFichier17';
        break;
        case 'ORAGEUXFichier10':
        $result = 'nuitorageFichier19';
        break;
        case 'aversesFichier23':
        $result = 'nuitaverseFichier18';
        break;
        default:
            $result = $value;
            break;
        }
    }else{
      $result = $value;
    }
  return $result;
}
  function windDir($value) {
    $result = '';
    if($value <= 292 && $value >= 247){
        $result = 'ouest.png';
    }
    else if ($value > 292 && $value <= 338){
        $result = 'nord-ouest.png';
    }
    else if ($value > 338){
        $result = 'nord.png';
    }
    else if ($value >= 0 &&  $value <= 22 ){
        $result = 'nord.png';
    }
    else if ($value > 22 && $value <= 68){
        $result = 'nord-est.png';
    }
    else if ($value > 68 && $value <= 113){
        $result = 'est.png';
    }
    else if ($value > 113 && $value <= 158){
        $result = 'sud-est.png';
    }
    else if ($value > 158 && $value <= 203){
        $result = 'sud.png';
    }
    else if ($value > 203 && $value < 247){
        $result = 'sud-ouest.png';
    }
    else {
        $result = 'ouest.png';
    }
    return $result;
}
function weatherMapIsUpdate()
{
  $database = new Connect();
  $db = $database->getConnection();
  $sql = "SELECT DATE_FORMAT(date_weather_forcast,'%d/%m/%Y') as lastDate FROM weather_forcast WHERE id_weather_forcast = ( SELECT MAX(id_weather_forcast) FROM weather_forcast)";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result;
}
  
  