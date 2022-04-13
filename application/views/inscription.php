<!--Inscription-->
<div class="row">
    <div id="inscription" class="col-sm-12"
    <?php
        if($this->input->post('inscription')) echo "style=\"display: block\"";
        else echo "style=\"display: none\"";
    ?>>
        <div class="block-form">
            <div class="classe-form">
                <h2>Inscription</h2><br>
                <form method="POST" action="" id="form-inscription">
                    <p>
                        <label class="custom-field">
                            <input type="text" required name="pseudo" id="ipseudo" class="input-text" value="<?php echo $this->input->post('pseudo');?>">
                            <span class="placeholder">Pseudo</span>
                        </label>
                        <p id="erreur_pseudo">
                            <span class="message-er" id="message_pseudo">Le pseudo ne doit contenir que des lettres et des chiffres<br> Longueur max: 50 caractères</span>
                        </p>
                    </p>
                    <p>
                        <label class="custom-field">
                            <input type="password" required name="mdp" id="imdp" class="input-text">
                            <span class="placeholder">Mot de passe</span>
                        </label>
                        <p id="erreur_mdp">
                            <span class="message-er" id="message_mdp">min: 8 caractères</span>
                        </p>
                    </p>
                    <p>
                        <label class="custom-field">
                            <input type="password" required name="mdp1" id="imdp1" class="input-text">
                            <span class="placeholder">Confirmation du mot de passe</span>
                        </label>
                        <p id="erreur_cmdp">
                            <span class="message-er">Entrer le même mot de passe</span>
                        </p>
                    </p>
                    <p>
                        <label class="custom-field">
                            <input type="text" required name="mail" id="imail" class="input-text" value="<?php echo $this->input->post('mail');?>">
                            <span class="placeholder">Adresse mail</span>
                        </label>
                        <p id="erreur_mail">
                            <span class="message-er">Adresse mail invalide</span>
                        </p>
                    </p>
                    <p>
                        <input type="submit" class="boutton" value="S'inscrire" name="inscription" id="btn_submit"/>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>