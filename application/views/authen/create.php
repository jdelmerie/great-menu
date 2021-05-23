<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h2>Enregistrer votre établissement</h2>
<h6>Renseignez les informations concernant votre établissement</h6>

<div class="bg-success p-2 text-white small mb-3">
    Ce formulaire vous permet de créer votre établissement avant d'accéder au tableau de bord et personnabliser votre carte.
</div>

<form action="<?echo base_url('connexion/add_etabs') ?>" method="POST">
    <div class="row">
        <div class="form-group col-xl-6">
            <label class="font-weight-bold" for="nom">Nom de l'établissement</label>
            <input type="text" name="nom" class="form-control" placeholder="Nom de l'établissement" value="<? echo set_value('nom'); ?>">
            <? echo form_error('nom', ' <small class="text-danger">', '</small>'); ?>
        </div>

        <div class="col-xl-6">
            <label class="font-weight-bold" for="url">Adresse web d'accès à votre carte</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend"><span class="input-group-text"><?echo base_url('/carte/') ?></span></div>
                <input type="text" name="url" class="form-control" placeholder="ex : nomdevotreresto" value="<? echo set_value('url'); ?>">
            </div><? echo form_error('url', ' <small class="text-danger">', '</small>'); ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-xl-6">
            <label class="font-weight-bold" for="adresse">Adresse</label>
            <input type="text" name="adresse" class="form-control" placeholder="Numéro et nom de la rue" value="<? echo set_value('adresse'); ?>">
            <? echo form_error('adresse', ' <small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group col-xl-3">
            <label class="font-weight-bold" for="code_postale">Code Postale</label>
            <input max="5" type="text" name="code_postale" class="form-control" placeholder="Code Postale" value="<? echo set_value('code_postale'); ?>">
            <? echo form_error('code_postale', ' <small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group col-xl-3">
            <label class="font-weight-bold" for="ville">Ville</label>
            <input type="text" name="ville" class="form-control" placeholder="Ville" value="<? echo set_value('ville'); ?>">
            <? echo form_error('ville', ' <small class="text-danger">', '</small>'); ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-xl-6">
            <label class="font-weight-bold" for="telephone">Téléphone</label>
            <input type="text" name="telephone" class="form-control" placeholder="Téléphone" value="<? echo set_value('telephone'); ?>">
            <? echo form_error('telephone', ' <small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group col-xl-6" for="site">
            <label class="font-weight-bold">Site web</label>
            <input type="text" name="site" class="form-control" placeholder="Site web" value="<? echo set_value('site'); ?>">
            <? echo form_error('site', ' <small class="text-danger">', '</small>'); ?>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Créer l'établissement</button>
</form>