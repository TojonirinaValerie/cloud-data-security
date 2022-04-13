<div class="row">
    <div id="connection" class="col-sm-12"
    <?php
        if($this->input->post('connexion')) echo "style=\"display: block\"";
        else echo "style=\"display: none\"";
    ?>>
        <div class="block-form">
            <div class="classe-form">
                <h2>Connectez-vous</h2><br>
                <form method="POST" action="<?php //echo site_url('accueil/connexion');?>">
                    <p>
                        <label class="custom-field">
                            <input type="text" name="pseudo" id="pseudo" class="input-text" required>
                            <span class="placeholder">Pseudo</span>
                        </label>
                    </p>
                    <p>
                        <label class="custom-field">
                            <input type="password" name="mdp" id="mdp" class="input-text" value="" required>
                            <span class="placeholder">Mot de passe</span>
                        </label>
                    </p>
                    <p>
                        <input type="submit" class="boutton" value="Se connecter" name="connexion"/>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>