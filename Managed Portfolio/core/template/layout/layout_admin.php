<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Administration de votre portfolio</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= WEB_SITE ?>css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?= WEB_SITE ?>metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= CSS_PATH ?>sb-admin-2.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="<?= WEB_SITE ?>morrisjs/morris.css" rel="stylesheet">    
    <!-- Custom Fonts -->
    <link href="<?= CSS_PATH ?>/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Accès réservé - Pannel d'administration</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <?= $notifications ?>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Voir toutes les notifications</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i>Profile administrateur</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?= Tools::generLinkControllerAction("Admin","index");?>"><i class="fa fa-dashboard fa-fw"></i> Aperçu général</a>
                        </li>
                        <li>
                            <a href="<?= Tools::generLinkControllerAction("Admin","manageAbout");?>"><i class="fa fa-user fa-fw"></i> Mon profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-folder fa-fw"></i> Gestion des projets<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","nouveauProjet");?>"> Ajouter un projet</a>
                                </li>
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","manageProject");?>"> Gérer les projets</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-tumblr fa-fw"></i> Gestion des type de projets<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","nouveauTypeProjet")?>"> Ajouter un type projet</a>
                                </li>
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","gererTypeProjet")?>"> Gérer les types projets</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-group fa-fw"></i> Equipes de projets<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","ajouterEquipe")?>"> Nouvelle équipe de projet</a>
                                </li>
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","gererEquipe")?>"> Gérer les équipes</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Membre des équipes<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","ajouterMembreEquipe")?>"> Nouveau membre</a>
                                </li>
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","gererEquipe")?>"> Gérer les membre</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-info fa-fw"></i> Gestion des compétences<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","addCompetence")?>"> Ajouter une compétence</a>
                                </li>
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","manageCompetence")?>"> Gérer les compétences</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-flask fa-fw"></i>Expérience<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","addEvent")?>"> Nouvelle expérience</a>
                                </li>
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","manageEvent")?>"> Gérer les expérences</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-lightbulb-o fa-fw"></i>Skills<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","addSkill")?>"> Nouveau skill</a>
                                </li>
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","manageSkill")?>"> Gérer les skills</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-database fa-fw"></i>Gestion des variables<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","addVariable")?>"> Nouvelle variable</a>
                                </li>
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","manageVariable")?>"> Gérer les variables</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Gestion du pannel<span class="fa arrow"></span></a>
                             <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","manageMembers");?>"> <i class="fa fa-edit fa-fw"></i> Gestion des accès</a>
                                </li>
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","inscription");?>"> <i class="fa fa-edit fa-fw"></i>Créer un accès</a>
                                </li>
                                <li>
                                    <a href="<?= Tools::generLinkControllerAction("Admin","logout");?>"><i class="fa fa-sign-out fa-fw"></i>Déconnexion</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Information Sur la page en cours -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?= $title ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- Block information apperçu général -->
            <div class="row">
                <div class="col-lg-12 col-md-6">
                  <?= $informations ?>
                  <?= $core ?>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="<?= JS_PATH ?>libs/jquery-1.9.1.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= JS_PATH ?>libs/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?= WEB_SITE?>metisMenu/metisMenu.min.js"></script>
    <!-- Morris Charts JavaScript -->
    <script src="<?= WEB_SITE ?>/morrisjs/morris.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?= JS_PATH ?>sb-admin-2.js"></script>
</body>
</html>