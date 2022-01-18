<?php
include_once('entete.php');
include_once('models/register.php');
include_once('controlers/connectionCtrl.php');
?>
<main id="corpsConnexion">
  <div class="container mt-5 pt-5 mb-5 connexion">
    <form action="" method="POST" class="pt-5" id="inscript">
      <fieldset>
        <legend style="vertical-align: center; text-align: center;">
          <font style="vertical-align: center; text-align: center;">
            <font style="vertical-align: center; text-align: center;">Connexion</font>
          </font>
        </legend>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control <?= (isset($_POST['email']) ? (!isset($formErrorLogin['email']) ? 'is-valid' : 'is-invalid') : '') ?>" id="email" name="email" value="<?= (isset($_POST['email']) ? $_POST['email'] : '') ?>" aria-describedby="emailFeedback" />
               <?php if(isset($formErrorLogin['email'])){?>
                <div class="invalid-feedback" id="emailFeedback">
                    <?php echo  $formErrorLogin['email']; ?>
                </div>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control <?= (isset($_POST['password']) ? (!isset($formErrorLogin['password']) ? 'is-valid' : 'is-invalid') : '') ?>" id="password" name="password" value="<?= (isset($_POST['password']) ? $_POST['password'] : '') ?>" aria-describedby="passwordFeedback" />
                <?php if(isset($formErrorLogin['password'])){?>
                    <div class="invalid-feedback" id="passwordFeedback">
                        <?php echo  $formErrorLogin['password']; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="form-group my-3">
                <input type="submit" class="btn btn-primary " value="Se connecter" name='connexionButton' id="connexionButton" />
            </div>
    </form>
    <?php if(isset($failed)){?>
      <div class="invalid-feedback" id="passwordFeedback">
          <?php echo  $failed; ?>
      </div>
    <?php } ?>
    <div class="lienInscription">
      <p><a href="inscription.php">Pas de compte</a></p>
    </div>
  </div>
</main>
<?php
    include_once('piedPage.php');
 ?>