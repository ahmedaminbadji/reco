<?php 


require_once("../config/db.php");
session_start();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Aprenant</title>
        <link rel="stylesheet" href="../static/css/bootstrap.min.css">
        <link rel="stylesheet" href="../static/css/simple-sidebar.css">
        <script src="../static/js/jquery.js"></script>
        <script src="../static/js/bootstrap.min.js"></script>
    </head>

    <body >
        <div class="d-flex" id="wrapper">

            <!-- Sidebar -->
            <div class="bg-dark border-right text-white" id="sidebar-wrapper" style="border-right-color: #100 !important;">
              <div class="sidebar-heading">Aprenant</div>
              <div class="list-group list-group-flush">
              <a href="#" id="accueil" class="list-group-item list-group-item-action bg-dark text-white ">Accueil</a>
              <a href="#" id="gestionDoc" class="list-group-item list-group-item-action bg-dark text-white">Gestion document</a>
        
              <a href="#" id="testes" class="list-group-item list-group-item-action bg-dark text-white">Testes</a>
              <a href="#" id="messagerie" class="list-group-item list-group-item-action bg-dark text-white">Messagerie</a>
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
                       <?php $_SESSION["user"] ?>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                         <a class="dropdown-item" href="../deconnexion.php">
                         Déconnexion
                     </a>
                   
                      </div>
                    </li>
                  </ul>
                </div>
              </nav>
        
              <div class="container-fluid">
                <div id="content">
                    <div class="container-fluid">
                    <h3>Tout les documents supplémentaires : </h3>
    <?php 
        $i=0;
        $pdo = Config::getPdo();
        $query = "SELECT * FROM document_sup WHERE doc_principale = ?";
        $sql = $pdo->prepare($query);
        $sql->execute([$_SESSION["cour_actuel"]]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row) {
            if($i==0){

           
    ?>
    <div class="row">
        <?php 
         }
        ?>
        <div class="col-md-3">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <?php 
                          $query = "SELECT * FROM document WHERE id_document = ?";
                          $sql = $pdo->prepare($query);
                          $sql->execute([$_SESSION["cour_actuel"]]);
                          $result2 = $sql->fetch(PDO::FETCH_ASSOC);
                        $id_module = $result2["id_module"];
                        $query = "SELECT * FROM module WHERE id_module = ?";
                        $sql = $pdo->prepare($query);
                        $sql->execute([$id_module]);
                        $result2 = $sql->fetch(PDO::FETCH_ASSOC);
                        echo $result2["nom_module"];
                    ?>
                </h4>
                <p class="card-text">Document supplémentaire</p>
                <a href="../pdf.php?path=<?php echo $row["emplacement"] ?>" class="btn btn-primary">Consulter Document</a>
            </div>
            </div>
        <?php $i++;?>
        </div>
        <?php   if($i==4){

           
?>
    </div>
    <?php 
         $i=0; }
        
        ?>
    <?php 
                                          }
             ?>

                    </div>
                </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        
          </div>
          <script>
            $("#menu-toggle").click(function(e) {
              e.preventDefault();
              $("#wrapper").toggleClass("toggled");
            });
          
            $("#gestionDoc").click(function(){
              $("#content").load("/reco/aprenant/gestionDoc.php");
            });
            $("#testes").click(function(){
              $("#content").load("/reco/aprenant/testes.php");
            });
            $("#messagerie").click(function(){
              $("#content").load("/reco/aprenant/messagerie.php");
            });
            $("#accueil").click(function(){
              $("#content").load("/reco/aprenant/accueil.php");
            });
          </script>
    </body>
</html>