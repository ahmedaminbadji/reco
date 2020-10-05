<br><br>
<?php 
    include("../config/db.php");
?>
<h2>LIste des testes</h2>
<ul class="list-group">
<?php 
  $pdo = Config::getPdo();
  $query = "SELECT * FROM teste WHERE  ?";
  $sql = $pdo->prepare($query);
  $sql->execute([1]);
  $result = $sql->fetchAll(PDO::FETCH_ASSOC);
  foreach($result as $row) {
?>
  <li class="list-group-item">
  <?php echo $row["type_teste"] . " || "; ?>
                                        <?php 
                                          $pdo = Config::getPdo();
                                          $query = "SELECT * FROM module WHERE  id_module = ?";
                                          $sql = $pdo->prepare($query);
                                          $sql->execute([$row["module"]]);
                                          $result = $sql->fetch(PDO::FETCH_ASSOC);
                                          echo $result["nom_module"];
                                    ?>
<a href="test.php?id=<?php echo $row["id_teste"]; ?>" class="btn btn-primary">Passer </a>
                                    
                                       
  </li>
  <?php 
}
?>
</ul>