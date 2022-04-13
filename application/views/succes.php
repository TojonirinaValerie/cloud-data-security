<div class="panel_alert_succes">
    <p>Inscription terminée</p>
    <form method="POST" action="<?php echo base_url().'accueil.html'; ?>">
        <input type="text" value="<?php if(isset($pseudo)) echo $pseudo; ?>" name="pseudo" hidden/>
        <input type="text" value="<?php if(isset($id)) echo $id; ?>" name="id" hidden/>
        <input type="submit" value="Continuer" name="succes" class="boutton">
    </form>
</div>
<div class="blur blur-succes"></div>