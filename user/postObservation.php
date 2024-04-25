<?php
//header("location: ../../user/buildPage.html");
require_once $_SERVER['DOCUMENT_ROOT']."/other/protect/protect.php";
require_once $_SERVER['DOCUMENT_ROOT']."/other/Functions/Functions.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/ObservationsManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/other/Class/Connect.php';
$db = new Connect();
$observationManager = new ObservationsManager($db->getConnection());
$memberStatus =  memberVerification($_SESSION['user_member']);
//Récupération type d'observations
$observationTypes = $observationManager->selectAllObservationTypes();
$token = token();
$_SESSION['token'] = $token;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/css/postObservation.css">
    <link rel="icon" type="image/x-icon" href="../style/images/logo_mini.ico">
    <title>Tableau de bord</title>  
</head>
<body>
    <header>
        <div id="header-mobile-view">
            <a href="../user/dashboardUser.php"><img src="../style/images/logo_mini.png" alt="logo"></a>
            <div id="burger-menu">
                
            </div>
            <div class="bloc-burger-menu">
                <nav>
                    <img src="../style/images/x.png" alt="fermer le menu" id="btn-close-menu">
                    <ul>
                        <li><a href="../user/postObservation.php" title="Poster une observation">Poster une observation</a></li>
                        <li><a href="../user/weatherMap.php" title="Prévisions">Carte de prévision</a></li>
                        <li><a href="../user/climatology.php" title="Données stations">Données stations</a></li>
                        <li><a href="../user/myAccount.php" title="Mon compte">Mon compte</a></li>
                        <li><?=$memberStatus['pictogramme'];?></li>
                        <li><a href="../other/Functions/logout.php" title="Se déconnecter"> Se déconnecter</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="container-logo">
            <a href="../user/dashboardUser.php"><img src="../style/images/logo.png" alt="logo Météolor"></a>
        </div>
        <nav>
            <ul>
                <li><a href="../user/postObservation.php" title="Poster une observation">Poster une observation</a></li>
                <li><a href="../user/weatherMap.php" title="Prévisions">Carte de prévision</a></li>
                <li><a href="../user/climatology.php" title="Données stations">Données stations</a></li>
                <li><a href="../user/myAccount.php" title="Mon compte">Mon compte</a></li>
                <li><?=$memberStatus['pictogramme'];?></li>
                <li><a href="../other/Functions/logout.php" title="Se déconnecter"> Se déconnecter</a></li>
            </ul>
        </nav>
        <h2 class="title-type-1">POSTER UNE OBSERVATION</h2>
    </header>
    <main>
        <section class="container-type-1">
            <form action="../other/Treatment/observationTreatment.php" method="post" enctype="multipart/form-data">
                <p>Séléctionner un phénomène:</p>
                <div class="container-type-2">   
                    <div>
                        <?php
                            foreach ($observationTypes as $type) {
                        ?>
                            <input type="radio" id="typeObs_<?= $type['id_type_observation'];?>"
                            name="type_observation" value=<?= $type['id_type_observation'];?>>
                            <label for="typeObs_<?= $type['id_type_observation'];?>"><?= $type['name_observation_type'];?></label><br>
                        <?php
                            }
                        ?>
                        <!-- <label for="value_observation">Valeur:</label>
                        <input type="text" name="value_observation"> -->
                    </div>
                </div>
                <div id="liste-mobile-view">
                    <select class="input-type-1" name="type_observation" id="type_observation">
                    <option value="" selected>Choisir un phénomène</option>
                        <?php
                            foreach ($observationTypes as $type ) {   
                        ?>
                        <option value=<?= $type['id_type_observation'];?>><?=$type['name_observation_type'];?></option>
                        <?php
                            }
                        ?>
                    </select>                               
                </div>
                <div>
                    <label for="description_observation">Description:</label>
                    <input class="input-type-1" type="text" name="description_observation">
                    <label for="location_observation">Localisation (Ville + code postal) : </label>
                    <input class="input-type-1"  id='cityName' type="text" name="location_observation">
                    <label for="image_observation">Joindre une image:</label>
                    <input class="input-type-1" type="file" name="image_observation">
                </div>
                <input type="hidden" name="token" value=<?=$token;?>>
                <input type="hidden" name="id_user" value=<?=$_SESSION['user_id'];?>>
                <button class="button-type-1" type="submit">ENVOYER</button>
            </form>
        </section>
        <div id="suggestions"></div>
    </main>
    <footer>
        <div>
            <p>2023 - Association Météo Lor'</p>
        </div>
    </footer>    
</body>
<!-- <script>
    const apiUrl = 'https://geo.api.gouv.fr/communes?nom=';
    const cityInput = document.querySelector('#cityName');
    const suggestionsCity = document.querySelector('#suggestions');
    cityInput.addEventListener('input', () => {
    const inputValue = cityInput.value.trim();
    if (inputValue.length >= 2) {
      fetch(apiUrl + inputValue + '&fields=codesPostaux,mairie&boost=population&limit=5')
        .then(response => response.json())
        .then(data => {
          displaySuggestions(data);
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
    } else {
      suggestionsCity.innerHTML = '';
    }
  });
  function displaySuggestions(suggestions) {
    suggestionsCity.innerHTML = '';
    suggestions.forEach(suggestion => {
      const suggestionCity = document.createElement('div');
      suggestionCity.className = 'autocomplete-suggestion';
      suggestionCity.textContent = suggestion.nom+' '+suggestion.codesPostaux;
      suggestionCity.addEventListener('click', () => {
        let codePostale = suggestion.codesPostaux;
        cityInput.value = suggestion.nom + ' ' + codePostale[0];
        suggestionsCity.innerHTML = '';
      });
      suggestionsCity.appendChild(suggestionCity);
    });
  }

</script> -->
<script src="../script/script-burger-menu.js"></script>
<script src="../script/script-city-suggestion.js"></script>
<script src="../script/script-post-observation.js"></script>
</html>
