<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h3>Nouveau mot de passe</h3>
<h6>Veuillez saisir votre nouveau mot de passe</h6>

<br>

<form method="POST" action="<? echo base_url('connexion/update_password') ?>">
<input type="hidden" value="<?=$email?>" name="email">
    <div class="form-group">
        <label for="password">Mot de passe *</label>
        <input name="password" type="password" class="form-control" id="password" aria-describedby="passwordhelp">
        <small id="passwordhelp" class="form-text text-muted">Le mot de passe doit compter au minimum 8 caractères.</small>
        <?php echo form_error('password', ' <small class="text-danger">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="confirm_password">Confirmation du mot de passe *</label>
        <input name="confirm_password" type="password" class="form-control" id="confirm_password">
        <?php echo form_error('confirm_password', ' <small class="text-danger">', '</small>'); ?>
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>