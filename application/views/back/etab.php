<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="bg-success p-2 text-white small mb-3">
    Ce formulaire correspond aux informations de base de votre établissement telles que son nom, son adresse, etc... L'adresse web d'accès à votre carte est très importante.
</div>

<?if ($this->session->flashdata('error')) {?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <?echo $this->session->flashdata('error') ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?} else if ($this->session->flashdata('success')) {?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <?echo $this->session->flashdata('success') ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?}?>

<form action="<?echo base_url('etablissement/edit') ?>" method="POST">
    <div class="row">
        <div class="form-group col-xl-6">
            <label class="font-weight-bold" for="nom">Nom de l'établissement <i class="fas fa-star fa-xs input_required"></i></label>
            <input type="text" name="nom" class="form-control" placeholder="Nom de l'établissement" value="<? echo set_value('nom', $etab->name); ?>">
            <? echo form_error('nom', ' <small class="text-danger">', '</small>'); ?>
        </div>

        <div class="col-xl-6">
            <label class="font-weight-bold" for="url">Adresse web d'accès à votre carte <i class="fas fa-star fa-xs input_required"></i></label>
            <div class="input-group mb-3">
                <div class="input-group-prepend"><span class="input-group-text"><?echo base_url('/carte/') ?></span></div>
                <input id="urlqrcode" type="text" name="url" class="form-control" placeholder="ex : nomdevotreresto" value="<? echo set_value('url', $etab->url); ?>">
            </div><? echo form_error('url', ' <small class="text-danger">', '</small>'); ?>

            <div>
                <label class="font-weight-bold" for="qrcode">QR Code d'accès à votre carte</label>
                <div id="qrcode"><img src="<? echo base_url($link)?>" alt=""></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-xl-6">
            <label class="font-weight-bold" for="adresse">Adresse <i class="fas fa-star fa-xs input_required"></i></label>
            <input type="text" name="adresse" class="form-control" placeholder="Numéro et nom de la rue" value="<? echo set_value('adresse', $etab->adress); ?>">
            <? echo form_error('adresse', ' <small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group col-xl-3">
            <label class="font-weight-bold" for="code_postale">Code Postale <i class="fas fa-star fa-xs input_required"></i></label>
            <input max="5" type="text" name="code_postale" class="form-control" placeholder="Code Postale" value="<? echo set_value('code_postale', $etab->postal_code); ?>">
            <? echo form_error('code_postale', ' <small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group col-xl-3">
            <label class="font-weight-bold" for="ville">Ville <i class="fas fa-star fa-xs input_required"></i></label>
            <input type="text" name="ville" class="form-control" placeholder="Ville" value="<? echo set_value('ville', $etab->city); ?>">
            <? echo form_error('ville', ' <small class="text-danger">', '</small>'); ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-xl-6">
            <label class="font-weight-bold" for="telephone">Téléphone</label>
            <input type="text" name="telephone" class="form-control" placeholder="Téléphone" value="<? echo set_value('telephone', $etab->phone); ?>">
            <? echo form_error('telephone', ' <small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group col-xl-6" for="site">
            <label class="font-weight-bold">Site web</label>
            <input type="text" name="site" class="form-control" placeholder="Site web" value="<? echo set_value('site', $etab->web_site); ?>">
            <? echo form_error('site', ' <small class="text-danger">', '</small>'); ?>
        </div>
    </div>

    <hr>
    <button type="submit" class="btn btn-primary btn-sm">Enregistrer les informations de l'établissement</button>
</form>

