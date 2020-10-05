
<?php 
    include("../config/db.php");
    $pdo = Config::getPdo();
?>
<form action="process/ajouterDoc.php" method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <h5>Document hors cours : (livre, tuto)</h5>
                                                        <select name="typeCours" id="typeCours" class="form-control" required>
                                                            <option value="livre">Livre</option>
                                                            <option value="tuto">Tutoriel</option>
                                                        </select>
                                                        <select name="module" id="module" class="form-control" required>
                                                    <?php 
                                                        $pdo = Config::getPdo();
                                                        $query = "SELECT * FROM module WHERE ?";
                                                        $sql = $pdo->prepare($query);
                                                        $sql->execute([1]);
                                                        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                                        var_dump($result);
                                                        foreach($result as $row) {
                                                    ?>
                                                        <option value="<?php echo $row["id_module"] ?>"><?php echo $row["nom_module"] ?> </option>
                                                        <?php 
                                          }
                                        ?>
                                                    </select>

                                                    </div>
                                                    <div class="form-group">
                                                        <input type="file" name="file[]" id="doc" required>
                                                    </div>
                                                    <br>
                                                    <center>
                                                    <button class="btn btn-primary" style="width:50%;">Ajouter</button>
                                                    </center>
                                                </form>