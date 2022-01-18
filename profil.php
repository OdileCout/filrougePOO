<?php
include_once('entete.php');
include_once('models/register.php');
include_once('controlers/profilCtrl.php');
?>
<main class="container" id="profil">
    <div class="boutonPageProfil">
        <?php if($profil->role == "administrateur"){?>
            <div class="form-group my-3">
                <form method="POST" action="">
                    <a href=""><input type="submit" class="btn btn-success " value="pageAdmin" name='pageAdmin' id="pageAdmin" /></a>
                </form>
            </div>
        <?php } ?>
    </div>
    <div class="boutonPageProfil">
        <div>
            <p>Bounjour <?php echo $profil->nom ." ". $profil->prenom;?> </p>
            <p>Vous êtes <b class="role"><?= $profil->role ?></b> du site</p>
            <p><?= isset($_SESSION['userId']) ? 'Vous êtes connecté' : '' ?></p>
        </div>
    </div>
</main>
<?php
    include_once('piedPage.php');
 ?>