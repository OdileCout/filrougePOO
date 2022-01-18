<?php
include_once('entete.php');
include_once('models/register.php');
include_once('controlers/connectionCtrl.php');
include_once('controlers/profilCtrl.php');
?>
    <main class="container mt-5 blocParam">
    <h1 class="pb-3 titreChangeprof">Changer le profil</h1>
        <div class=""  id="parametre">
            <div class="pt-5 changeProf"> 
                <h3>Supprimer le profil</h3>
                <p>Voulez-vous supprimer votre profil?</p>
                <div class="form-group my-3">
                    <input type="submit" class="btn btn-primary " value="Supprimer" name="suppression" id="suppression" />
                </div>
            </div>
            <form action="" method="POST" class="pt-5 changeProf">
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" class="form-control <?= (isset($_POST['nom']) ? (!isset($formError['nom']) ? 'is-valid' : 'is-invalid') : '') ?>" id="nom" name="nom" value="<?= (isset($_POST['nom']) ? $_POST['nom'] : '') ?>" aria-describedby="nomFeedback" />
                <?php if(isset($formError['nom'])){?>
                    <div class="invalid-feedback" id="nomFeedback">
                        <?php echo  $formError['nom']; ?>
                    </div>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" class="form-control <?= (isset($_POST['prenom']) ? (!isset($formError['prenom']) ? 'is-valid' : 'is-invalid') : '') ?>" id="prenom" name="prenom" value="<?= (isset($_POST['prenom']) ? $_POST['prenom'] : '') ?>" aria-describedby="prenomFeedback" />
                    <?php if(isset($formError['prenom'])){?>
                        <div class="invalid-feedback" id="prenomFeedback">
                            <?php echo  $formError['prenom']; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="phone">Numéro téléphone :</label>
                    <input type="text" class="form-control <?php if(isset($formError['phone']) && !empty($formError['phone'])) echo "is-invalid"; ?>" id="phone" name="phone" value="<?= (isset($_POST['phone']) ? $_POST['phone'] : '') ?>" step="0.01" aria-describedby="phoneFeedback" />
                    <?php if(isset($formError['phone'])){?>
                        <div class="invalid-feedback" id="phoneFeedback">
                            <?php echo $formError['phone']; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="pass">Mot de passe :</label>
                    <input type="password" class="form-control <?php if(isset($_POST['pass']) && !empty( $formError['pass'])) echo 'is-invalid'; ?>" aria-describedby="passFeedback" id="pass" name="pass" value="<?= (isset($_POST['pass']) ? $_POST['pass'] : '') ?>" />
                    <?php if(isset($formError['pass'])){?>
                        <div class="invalid-feedback" id="passFeedback">
                            <?php echo $formError['pass']; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="form-group my-3">
                    <input type="submit" class="btn btn-primary " value="Modifier" name="modificaton" id="modificaton" />
                </div>
            </form>
        </div>
    </main>
<?php
    include_once('piedPage.php');
 ?>