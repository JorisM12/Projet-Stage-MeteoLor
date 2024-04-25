<?php
header("location: ../../user/buildPage.html");
require_once $_SERVER['DOCUMENT_ROOT']."/other/protect/protect.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/css/climatology.css">
    <link rel="icon" type="image/x-icon" href="../style/images/logo_mini.ico">
    <title>Climatologie de Metz</title>  
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
                         <li><img src=<?=$memberStatus['pictogramme'];?> alt="statut adhérent" title=<?=$memberStatus['member title'];?> class="picto"></li>
                    </ul>
                    <div>
                        <a href="../other/Functions/logout.php" title="Se déconnecter"> <img id="btn-logout" src="../style/images/login.png" alt=""></a>
                    </div>
                </nav>
            </div>
        </div>
        <div class="container-logo">
            <a href="../user/dashboardUser.php"><img src="../style/images/logo.png" alt="logo Météolor"></a>
            <h1>MÉTÉO LOR'</h1>
        </div>
        <nav>
            <ul>
                <li><a href="../user/postObservation.php" title="Poster une observation">Poster une observation</a></li>
                <li><a href="../user/weatherMap.php" title="Prévisions">Carte de prévision</a></li>
                <li><a href="../user/climatology.php" title="Données stations">Données stations</a></li>
                <li><a href="../user/myAccount.php" title="Mon compte">Mon compte</a></li>
                <li><img src="../style/images/g.png" alt="statut adhérent" title="Adhérent"></li>
            </ul>
            <div id="log-out">
                <a href="../other/Functions/logout.php" title="Se déconnecter"> <img src="../style/images/login.png" alt=""></a>
            </div>
        </nav>
        <h2 class="title-type-1">Climatologie de Metz(57)</h2>
    </header>
    <main>
        <section class="container-type-1">
            <nav>
                <a class="btn-selected-table" href="#" title="Affichage au mois">MOIS</a>
                <a href="#" title="Affichage journée">JOUR</a>
                <a href="#" title="Affichageà l'année">ANNEE</a>
            </nav>
            <nav id="nav-mobile-view">
                <div>
                </div>
                <form action="#" method="get">
                    <select class="input-type-1" name="station-name" id="station-name">
                        <option value="0" selected>Selectionner une station</option>
                        <option value="1">Metz</option>
                        <option value="2">Nancy</option>
                        <option value="3">Verdun</option>
                    </select>
                    <button class="input-type-1" type="submit">VOIR</button>
                </form>  
            </nav>
            <div id="table-mobile-view">
                <nav>
                    <a href=""><div></div></a>
                    <p>
                        27/06/2023
                    </p>
                    <a href=""><div></div></a>
                </nav>
                <ul>
                    <li>T°C max: 24</li>
                    <li>T°C min: 13</li>
                    <li>Pluie 24h: 5mm</li>
                    <li>Humidité moyenne: 67%</li>
                    <li> Rafale max: 45km/h</li>
                </ul>
            </div>
            <div id="select-day-mobile">
                <nav>
                    <a href=""><div></div></a>
                    <p>
                        Juin 2023
                    </p>
                    <a href=""><div></div></a>
                </nav>
                <ul>
                    <li> <a href="#">Lundi 27 </a></li>
                    <li>Mardi 28</li>
                    <li>Lundi 27</li>
                    <li>Mardi 28</li>
                    <li>Lundi 27</li>
                    <li>Mardi 28</li>
                    <li>Lundi 27</li>
                    <li>Mardi 28</li>
                    <li>Lundi 27</li>
                    <li>Mardi 28</li>
                    <li>Lundi 27</li>
                    <li>Mardi 28</li>
                    <li>Lundi 27</li>
                    <li>Mardi 28</li>
                </ul>
            </div>
            <table>
                <thead>
                    <th>
                        Date
                    </th>
                    <th>
                        T°C max
                    </th>
                    <th>
                        T°C min
                    </th>
                    <th>
                        Pluie 24h(mm)
                    </th>
                    <th>
                        Ensoeillement(h)
                    </th>
                    <th>
                        Rafale max (km/h)
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            Lundi 26
                        </td>
                        <td>
                            27.6
                        </td>
                        <td>
                            11.8
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            4
                        </td>
                        <td>
                           34
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Lundi 26
                        </td>
                        <td>
                            27.6
                        </td>
                        <td>
                            11.8
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            4
                        </td>
                        <td>
                           34
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Lundi 26
                        </td>
                        <td>
                            27.6
                        </td>
                        <td>
                            11.8
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            4
                        </td>
                        <td>
                           34
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Lundi 26
                        </td>
                        <td>
                            27.6
                        </td>
                        <td>
                            11.8
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            4
                        </td>
                        <td>
                           34
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Lundi 26
                        </td>
                        <td>
                            27.6
                        </td>
                        <td>
                            11.8
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            4
                        </td>
                        <td>
                           34
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Lundi 26
                        </td>
                        <td>
                            27.6
                        </td>
                        <td>
                            11.8
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            4
                        </td>
                        <td>
                           34
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Lundi 26
                        </td>
                        <td>
                            27.6
                        </td>
                        <td>
                            11.8
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            4
                        </td>
                        <td>
                           34
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Lundi 26
                        </td>
                        <td>
                            27.6
                        </td>
                        <td>
                            11.8
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            4
                        </td>
                        <td>
                           34
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Lundi 26
                        </td>
                        <td>
                            27.6
                        </td>
                        <td>
                            11.8
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            4
                        </td>
                        <td>
                           34
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Lundi 26
                        </td>
                        <td>
                            27.6
                        </td>
                        <td>
                            11.8
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            4
                        </td>
                        <td>
                           34
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <img src="../style/images/graoh.png" alt="">
            </div>
            <div>
                <img src="../style/images/graoh.png" alt="">
            </div>
        </section>
        <nav class="container-type-3">
            <p>Choisir une station:</p>
            <ul>
                <li class="station-selected"> <a href="">Metz(57) </a></li>
                <li>Nancy(54)</li>
                <li>Verdun(55)</li>
                <li>Thionville(57)</li>
            </ul>
        </nav>
    </main>
    <footer>
        <div>
            <p>2023 - Association Météo Lor'</p>
        </div>
    </footer>    
</body>
<script src="../script/script-burger-menu.js"></script>
</html>
