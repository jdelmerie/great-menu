<?require_once 'partials/header.php'?>
<body class="layout-back">

<div class="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 sidebar">
                <div class="text-center">
                    <h1 class="display-4 text-white">GREAT MENU</h1>
                </div>
                <div>
                    <ul class="nav nav-pills flex-column main-menu my-5">
                        <?if ($maintenance == 1){?>
                        <p class="text-danger">MAINTENANCE</p>
                        <?}?>
                        <a href="<?echo base_url('dashboard') ?>" class="<?echo activate_menu('dashboard');?>"><i class="fas fa-home fa-sm"></i>&nbsp;&nbsp;Tableau de bord</a>
                        <a href="<?echo base_url('etablissement') ?>" class="<?echo activate_menu('etablissement');?>"><i class="fas fa-store-alt fa-sm"></i>&nbsp;&nbsp;Etablissement</a>
                        <a href="<?echo base_url('personnalisation') ?>" class="<?echo activate_menu('personnalisation');?>"><i class="fas fa-highlighter fa-sm"></i>&nbsp;&nbsp;Personnalisation</a>
                        <a href="<?echo base_url('categories') ?>" class="<?echo activate_menu('categories');?>"><i class="fas fa-th-list fa-sm"></i></i>&nbsp;&nbsp;Catégories de produits</a>
                        <a href="<?echo base_url('produits') ?>" class="<?echo activate_menu('produits');?>"><i class="fas fa-pizza-slice fa-sm"></i></i>&nbsp;&nbsp;Produits</a>
                        <a href="<?echo base_url('quantites') ?>" class="<?echo activate_menu('quantites');?>"><i class="fas fa-list-ul fa-sm"></i></i>&nbsp;&nbsp;Quantités</a>
                    </ul>
                </div>
            </div>
 
            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10">
                <div class="bg-white p-4 row flex header-content">
                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-8 col-8">
                        <h2 class="title-view"><?=$title_view?></h2>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-4 col-4">
                        <a class="btn btn-color show" href="<?echo base_url('deconnexion') ?>"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp; Déconnexion</a>
                    </div>
                </div>
                <div class="m-4 bg-white content">
                    <?=$contents?>
                </div>
                <div class="text-center m-3">
                    <small>&copy; <a href="<? echo base_url()?>" target="_blank">Great Menu</a> - <?echo date('Y') ?></small>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>