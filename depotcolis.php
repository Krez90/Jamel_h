<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=jamel_h;charset=utf8','root','');

    if(isset($_SESSION['id'])){

     $requser = $bdd->prepare("SELECT * FROM clients WHERE id = ?");
     $requser->execute([$_SESSION['id']]);
     $user = $requser->fetch();

    if(isset($_POST['envoyer'])){
///////////////////////////////////////////////PREPARATION INSERER COLIS BDD/////////////////////////////////////////
        $kg = htmlspecialchars($_POST['kilogramme']);
        $dimension = htmlspecialchars($_POST['dimension']);
        $type = htmlspecialchars($_POST['type_objet']);
        $livraison = htmlspecialchars($_POST['livraison']);
        $depart = htmlspecialchars($_POST['depart']);
        $arriver = htmlspecialchars($_POST['reception']);
        $description = htmlspecialchars($_POST['description']);

       
    if(!empty($_POST['kilogramme']) AND !empty($_POST['dimension']) AND !empty($_POST['type_objet']) AND !empty($_POST['livraison']) AND !empty($_POST['depart'])
        AND !empty($_POST['reception']) AND !empty($_POST['description'])){

            $insertcolis = $bdd->prepare("INSERT INTO annonces (kg, dimension, type_objet, mode_livraison, depart, reception, description) VALUES (?,?,?,?,?,?,?)");
            $insertcolis->execute([$kg, $dimension, $type, $livraison, $depart, $arriver, $description]);
            $erreur = "Votre colis a bien été déposé";
            $last_id = $bdd->lastInsertId();
            $last_id = intval($last_id);
            $insert_liaison = $bdd->prepare("INSERT INTO clients_annonces (id_client, id_annonce) VALUES (?,?)");
            $insert_liaison->execute([$_SESSION['id'], $last_id]);
            
            
        }else{
            $erreur = "Tous les champs doivent être remplis";
        }
    }
?>
<!doctype html>

<html class="no-js" lang="fr">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jamel_H</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.html"><i class="menu-icon fa fa-dashboard"></i>Bonjour <?php echo $user['prenom'];?></a>
                    </li>
                    <h3 class="menu-title">Menu</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="profil.php?id=<?php echo $_SESSION['id']?>" class="dropdown-toggle"  aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Tableau de bord</a>

                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="" class="dropdown-toggle"  aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Envoyer votre colis</a>

                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="editprofil.php" class="dropdown-toggle"  aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Profil</a>

                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle"  aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Mes paiements</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

    
        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger"></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                <i class="fa fa-check"></i>
                                <p>Server #1 overloaded.</p>
                            </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                <i class="fa fa-info"></i>
                                <p>Server #2 overloaded.</p>
                            </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                <i class="fa fa-warning"></i>
                                <p>Server #3 overloaded.</p>
                            </a>
                            </div>
                        </div>

                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-email"></i>
                                <span class="count bg-primary"></span>
                            </button>

                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href=""><i class="fa fa-user"></i> Tableau bord</a>

                            <a class="nav-link" href="#"><i class="fa fa-user"></i> Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="editprofil.php"><i class="fa fa-cog"></i> Profil</a>

                            <a class="nav-link" href="deconnexion.php"><i class="fa fa-power-off"></i> Se déconnecter</a>
                        </div>
                    </div> 

                    <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                          
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language">
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-fr"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-it"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
        
            <div class="col-md">
                <div class="stat-text"><h1>Envoyer un colis</div><br>
                    <div class="card">
                        <div class="login-form">
                            <form method="POST">

                                <div class="form-group">
                                <div class="info"><h1>Informations colis et livraisons</h1></div><br>

                                <div class="form-group">
                                    <label>Kg :</label>
                                        <input type="number" name="kilogramme" class="form-control" value="" placeholder="Kilogramme">
                                </div>

                                <div class="form-group">
                                    <label for="dimensions">Dimensions du colis</label>
                                        <input list="dimensions" id="monNavigateur" class="form-control" name="dimension"/>
                                        <datalist id="dimensions">
                                        <option value="Documents">
                                        <option value="Petit colis">
                                        <option value="Gros colis">
                                        </datalist>
                                </div>

                                <div class="form-group">
                                    <label for="type_objet">Type d'objet</label>
                                        <input list="type_objet" id="monNavigateur" class="form-control" name="type_objet"/>
                                        <datalist id="type_objet">
                                        <option value="Standard">
                                        <option value="Fragile">
                                        <option value="Précieux">
                                        </datalist>
                                </div>

                                <div class="form-group">
                                    <label for="livraison">Mode de livraison</label>
                                        <input list="livraison" id="monNavigateur" class="form-control" name="livraison"/>
                                        <datalist id="livraison">
                                        <option value="Entreprise">
                                        <option value="Domicile">
                                        
                                        </datalist>
                                </div>

                                    <label>Départ du colis </label>
                                        <input type="text" name="depart" class="form-control" value="" placeholder="Exemple : 12 rue clé des champs ou hôtel stenda ">
                                </div>

                                <div class="form-group">
                                    <label>Réception du colis </label>
                                        <input type="text" name="reception" class="form-control" value="" placeholder="Exemple : 12 rue clé des champs ou hôtel stenda">
                                </div>

                                <div class="form-group">
                                    <label>Description du colis</label>
                                        <input type="text" name="description" class="form-control" value="" placeholder="Description">
                                </div>

                                

                                <button type="submit" name="envoyer" class="btn btn-primary btn-flat m-b-30 m-t-30">Envoyer</button>

                            </form>
                            <?php
                            if(isset($erreur)){echo $erreur;}
                            ?>
                        </div>
                    </div>
            </div>


        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>


</body>

</html>
<?php
}else{
    
}
?>