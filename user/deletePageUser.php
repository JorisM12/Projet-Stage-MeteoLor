<?php
require_once $_SERVER['DOCUMENT_ROOT']."/other/protect/protect.php";
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/ObservationsManager.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT']."/other/Class/Connect.php";
$db = new Connect();
$observationManager = new ObservationsManager($db->getConnection());
$data = $observationManager->selectAllObservations();
$observationTypes = $observationManager->selectAllObservationTypes();
$jsonData = json_encode($data);
$token = token();
$_SESSION['token'] = $token;
$userManager = new UserManager($db->getConnection());
$userData = $userManager->selectOneUser($_SESSION['user_id']);
$displayError = false;
$displayConfirm = false;
$descriptionForm = '';
$typeObsForm = '';
$locationForm = '';

if(isset($_GET['error']) && $_GET['error']== 1)
{
    $displayError = true;
    $descriptionForm = $_GET['description_observation'];
    $typeObsForm = $_GET['type_observation'];
    $locationForm = $_GET['location_observation'];
}
if(isset($_GET['send']) && $_GET['send']== 1)
{
    $displayConfirm = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <link rel="stylesheet" href="/style/css/deletePage.css">
    <link rel="icon" type="image/x-icon" href="../style/images/logo_mini.png">
    <title>Déactivation</title> 
</head>
<body>
    <main>
        <section>
            <p>
                Pour réactiver un compte par la suite, contacter-nous via contact@meteolor.fr
            </p>
            <a href="../other/Treatment/accountTreatment.php?delete=1&id=<?=$_SESSION['user_id'];?>" class="button-type-2">DÉACTIVATION</a>
            <a href="../other/Treatment/accountTreatment.php?anonymize=1&id=<?=$_SESSION['user_id'];?>" class="button-type-2">SUPPRESSION DEFINITIVE</a>
            <a href="../user/receptionUser.php" class="button-type-2">ANNULER</a>

        </section>
    </main>
    <footer>
        <div>
            <p>2023 - Association Météo Lor'</p>
        </div>
    </footer>  
</body>
</html>