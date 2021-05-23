<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h2>Connexion</h2>
<h4>Connectez-vous à votre interface admin</h4>
<form action="<?echo base_url('connexion/connect'); ?>" method="POST">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" value="<? echo set_value('email'); ?>">
        <? echo form_error('email', ' <small class="text-danger">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" name="password" value="<? echo set_value('password'); ?>">
        <? echo form_error('password', ' <small class="text-danger">', '</small>'); ?>
    </div>
    <a href="<? echo base_url('connexion/forgetten_password')?>">Mot de passe oublié ?</a><br>
    <button type="submit" class="btn btn-primary">Se connecter</button>
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