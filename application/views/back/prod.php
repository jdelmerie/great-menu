<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h5>Affichage des produits par catégories</h5>

<ul class="nav nav-tabs">
    <?foreach ($categories as $categorie) {?>
        <li class="nav-item">
            <a class="nav-link <? echo isset($cat_id) && $categorie->id ==  $cat_id ? 'active' : ""?>" href="<? echo base_url("/produits/categories/$categorie->id")?>"><?=ucfirst($categorie->name)?></a>
        </li>
    <?}?>
</ul>

<? echo isset($display) ? $display : "" ?>

<br><br>
<a href="<? echo base_url('produits/nouveau')?>" class="btn btn-primary btn-sm">Ajouter un produit</a>



