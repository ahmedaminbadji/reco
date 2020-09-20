<?php 
session_start();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Admin</title>
        <link rel="stylesheet" href="../static/css/bootstrap.min.css">
        <link rel="stylesheet" href="../static/css/simple-sidebar.css">
        <script src="../static/js/jquery.js"></script>
        <script src="../static/js/bootstrap.min.js"></script>
    </head>

    <body >
        <div class="d-flex" id="wrapper">

            <!-- Sidebar -->
            <div class="bg-dark border-right text-white" id="sidebar-wrapper" style="border-right-color: #100 !important;">
              <div class="sidebar-heading">Enseignant   </div>
              <div class="list-group list-group-flush">
              <a href="#" class="list-group-item list-group-item-action bg-dark text-white " id="accueil">Accueil</a>
              <a href="#" class="list-group-item list-group-item-action bg-dark text-white" id="gestionDoc">Gestion Document  </a>
        
              <a href="#" class="list-group-item list-group-item-action bg-dark text-white" id="gestionTest">Gestion des testes  </a>
              <a href="#" class="list-group-item list-group-item-action bg-dark text-white" id="groupes">Groupes</a>
              <a href="#" class="list-group-item list-group-item-action bg-dark text-white" id="messagerie">Messagerie</a>
        
            </div>
            </div>
            <!-- /#sidebar-wrapper -->
        
            <!-- Page Content -->
            <div id="page-content-wrapper">
        
              <nav class="navbar navbar-expand-lg navbar-light bg-dark border-bottom">
                <button class="btn btn-danger" id="menu-toggle">Side Bar </button>
        
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <?php echo $_SESSION["user"]; ?>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                         <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         Déconnexion
                     </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     
                    </form>
                      </div>
                    </li>
                  </ul>
                </div>
              </nav>
        
              <div class="container-fluid" id="content">
             
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        
          </div>
          <script>
            $("#menu-toggle").click(function(e) {
              e.preventDefault();
              $("#wrapper").toggleClass("toggled");
            });
            $(document).ready(function(){
              $("#content").load("/reco/ens/accueil.php");
            });
            $("#gestionDoc").click(function(){
              $("#content").load("/reco/ens/gestionDocument.php");
            });
            $("#gestionTest").click(function(){
              $("#content").load("/reco/ens/gestionTestes.php");
            });
            $("#groupes").click(function(){
              $("#content").load("/reco/ens/groupes.php");
            });
            $("#messagerie").click(function(){
              $("#content").load("/reco/ens/messagerie.php");
            });
            $("#accueil").click(function(){
              $("#content").load("/reco/ens/accueil.php");
            });
          </script>
    </body>
</html>