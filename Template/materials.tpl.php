<?php include("Modules/head.mod.php"); ?>

<?php include("Modules/notify.mod.html"); ?>

<?php include("Modules/nav.mod.php"); ?>

<div id="wrapper">
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Materiel
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-flag"></i>  <a href="/accueil">Accueil</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-wrench"></i> Materiel
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">

                <!-- Category handler -->
                <div class="col-xs-12">
                    <div class="list-group">
                        <a href="#" class="list-group-item active" id="category-slider-main">Catégorie : Toutes</a>
                        <div id="category-slider-wrapper">
                            <div id="category-slider">
                            </div>
                            <div>
                                <a href="#" class="list-group-item">
                                    <div id="add-category" class="input-group">
                                        <input class="form-control" placeholder="Ajouter une catégorie">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button(s) -->
                <div class="col-xs-12 space-under">
                    <button type="button" class="btn btn-lg btn-primary button-add">Ajouter un matériel</button>
                    <button type="button" class="btn btn-lg btn-success button-save-all">Tout sauvegarder</button>
                </div>

                <!-- Material list -->
                <div class="col-xs-12">
                    <div class="well list-well">
                        <h3>Liste des matériels :</h3><br>
                        <table class="table table-hover">
                            <thead>
                                <th>Nom</th>
                                <th>Catégorie</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="materials-list">
                                <?php
                                foreach ($materials as $material)
                                {
                                    echo '<tr data-id=' . $material->getId() . ' data-category="'. $material->getCategory() .'" tabindex=0>';
                                    /*echo '<td><span data-id=' . $material->getId() . '>' . $material->getName() . '</span></td>';
                                    echo '<td><span data-id=' . $material->getId() . '>' . $material->getCategory() . '</span></td>';*/
                                        echo '<td><span class="material-name">' . $material->getName() . '</span></td>';
                                        echo '<td><span class="material-category">' . $material->getCategory() . '</span></td>';
                                        echo '<td>';
                                            echo '<button class="btn btn-sm btn-primary faa-parent animated-hover modify"><i class="fa fa-wrench faa-wrench"></i></button>';
                                            echo '<button class="btn btn-sm btn-success faa-parent animated-hover validate" style="display: none"><i class="fa fa-check faa-pulse"></i></button>';
                                            echo '<button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button>';
                                        echo '</td>';
                                    echo '<tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Button(s) -->
                <div class="col-xs-12">
                    <button type="button" class="btn btn-lg btn-primary button-add">Ajouter un matériel</button>
                    <button type="button" class="btn btn-lg btn-success button-save-all">Tout sauvegarder</button>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>

<?php include("Modules/footer.mod.php"); ?>

<script>
    var categories = <?php echo $categories; ?>;
</script>

<script type="text/javascript" src="/Libs/js/materials.js"></script>
