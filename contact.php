<?php
include_once('entete.php');
?>
    <section class="sectionContact">
        <div >
        <p class="retour"></p>
        </div>
        <div class="section1Contact">
            <h1>NOUS CONTACTER</h1>
            <div class="formulaire">
                <form id="contact_form" action="contact.php" method="POST" enctype="multipart/form-data">
                    <div class="formInput">
                        <div class="rowss">
                            <label class="required" for="name">Votre nom:</label>
                            <input id="name" class="input" name="name" type="text" value="" size="30" />
                        </div>
                        <div class="rowss">
                            <label class="required" for="email">Votre adresse email:</label>
                            <input id="email" class="input" name="email" type="text" value="" size="30" />
                        </div>
                        <div class="rowss">
                            <label class="required" for="phone">Numéro téléphone:</label>
                            <input id="phone" class="input" name="phone" type="text" value="" size="30" />
                        </div>
                    </div>
                    <div class="rowss">
                        <label class="required" for="message">Votre message:</label>
                        <textarea id="message" class="input" name="message" rows="7" cols="30"></textarea>
                    </div>
                    <input id="submit_button" type="submit" onclick="sendEmail();" value="Envoyer" />
                </form>
            </div>
        </div>
        <div class="section2Contact">
            <div class="firstBlocSection2">
                <i class="fas fa-home"></i>
                <p>5 rue des Sablons, Compiègne 60200, FRANCE</p>
            </div>
            <div class="twiceBlocSection2">
                <i class="fas fa-phone-alt"></i>
                <p>+33 67 42 53 88</p>
            </div>
        </div>
        <div class="section3Contact">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2595.0901542809825!2d2.8424036159320765!3d49.42610956851812!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e7d66ed9468989%3A0x1752c687d760aa7d!2sCompiegne!5e0!3m2!1sfr!2sfr!4v1613059651585!5m2!1sfr!2sfr"
                frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </section>
<?php
    include_once('piedPage.php');
 ?>