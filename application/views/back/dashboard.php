<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h3 class="text-center">Profil de votre établissement</h3>

<hr>

<div class="row">
    <div class="col-xl-4">
        <?if (!isset($customisation) || $customisation->logo == '') {?>
            <img src="<?echo base_url('assets/img/app/noimage.jpg') ?>" width="250px" height="250px">
        <?} else {?>
            <img class="border" src="<?echo base_url("assets/img/uploads/logos/$customisation->logo") ?>" width="250px" height="250px">
        <?}?>
        <br><br>
        <address>
            <i class="fas fa-map-marker-alt"></i> <strong>Adresse :</strong>
            <?if ($etab->adress == '' && $etab->zipcode == '' && $etab->city == '') {
    echo "<i>Non renseigné</i>";
} else {?>
            <?=ucfirst($etab->adress)?> <br> <?=$etab->postal_code?> <?=strtoupper($etab->city)?></address>
        <?}?>
        <p>
            <i class="fas fa-phone-alt"></i> <strong>Téléphone :</strong>
            <?if ($etab->phone == '') {
    echo "<i>Non renseigné</i>";
} else {
    echo $etab->phone;
}?>
        </p>
        <p>
            <i class="fas fa-wifi"></i> Site web :
            <?if ($etab->web_site == '') {
    echo "Non renseigné";
} else {
    echo $etab->web_site;
}?>
        </p>
        <span><a href="<?echo base_url('etablissement') ?>">Modifier les informations de contact</a></span>
    </div>
    <div class="col-8">
        <div class="p-3">
            <h5><i class="fas fa-store-alt fa-sm"></i>&nbsp;<?=ucfirst($etab->name)?></h5>
            <span><a href="<?echo base_url('etablissement') ?>">Modifier le nom de votre établissement</a></span>
        </div>
        <div class="p-3">
            <h5><i class="fas fa-mobile-alt fa-sm"></i>&nbsp;Accès à votre carte</h5>
            <p>Votre carte est accessible à l'adresse suivante : <span><?echo base_url('/carte/') ?><?=$etab->url?></span></p>
            <span><a href="<?echo base_url('etablissement') ?>">Modifier l'adresse d'accès à votre carte</a></span><br><br>

            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="switch-maintenance" value="<?=$etab->maintenance?>" <?=($etab->maintenance == 1) ? 'checked="checked"' : ''?>>
                <label class="custom-control-label" for="switch-maintenance"><strong>Mode maintenance</strong></label>
            </div>
            <small>En activant le mode maintenance, votre carte ne sera pas accessible par vos clients. Vous pouvez utiliser ce mode le temps de créer ou de mettre à jour votre carte.</small>
        </div>
        <div class="p-3">
            <h5><i class="fas fa-folder-plus fa-sm"></i>&nbsp;Catégories de produits</h5>
            <p>Votre carte contient <?=$count_cat?> catégories.</p>
            <span><a href="<?echo base_url('') ?>">Créer une nouvelle catégorie</a></span>
        </div>

        <div class="p-3">
            <h5><i class="fas fa-pizza-slice fa-sm"></i>&nbsp;Produits</h5>
            <p>Votre carte contient <?=$count_prod?> produits.</p>
            <span><a href="<?echo base_url('') ?>">Créer un nouveau produit</a></span>
        </div>
    </div>
</div>

<script>
    let base_url = '<?echo base_url() ?>';
    let controller = "dashboard/maintenance";
    let url = base_url + controller;

    document.getElementById('switch-maintenance').addEventListener("change", function() {

        let check = this.checked;

        fetch(url, options = {
            method: 'POST',
            headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' },
            body: JSON.stringify({ 'maintenance': check })
        });
        document.location.reload();
    });

</script>