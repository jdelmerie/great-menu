<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h3>Mot de passe oublié ?</h3>
<h6>Veuillez indiquer ci-dessous votre adresse email pour pouvoir changer de mot de passe.</h6>

<br>

<form method="POST" action="<? echo base_url('connexion/forgetten_password_check') ?>">
    <div class="form-group">
        <label for="email">Email</label>
        <input name="email" value="<?php echo set_value('email'); ?>" type="email" class="form-control" id="email">
        <?php echo form_error('email', ' <small class="text-danger">', '</small>'); ?>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>

<? if ($this->session->flashdata('success')) {?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <? echo $this->session->flashdata('success')?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?} else if ($this->session->flashdata('error')) {?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <? echo $this->session->flashdata('error')?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?}?>