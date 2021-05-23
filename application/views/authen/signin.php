<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h2>Inscription</h2>
<h3>Pour vous inscrire, il vous suffit de renseigner votre email et un mot de passe.</h3>
<i>Vous recevrez un email d'activation à l'adresse e-mail que vous avez indiquée afin de confirmer votre inscription.</i>
<br><br>
<form action="<?echo base_url('inscription/register'); ?>" method="POST">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" value="<? echo set_value('email'); ?>">
		<? echo form_error('email', ' <small class="text-danger">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" name="password" value="<? echo set_value('password'); ?>">
        <small id="password" class="form-text text-muted">Votre mot de passe doit compter au minimum 8 caractères.</small>
		<? echo form_error('password', ' <small class="text-danger">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="confirm_password">Confirmation du mot de passe</label>
        <input type="password" class="form-control" name="confirm_password" value="<? echo set_value('confirm_password'); ?>">
		<? echo form_error('confirm_password', ' <small class="text-danger">', '</small>'); ?>
    </div>
    <button type="submit" class="btn btn-primary">Inscription</button>
</form>