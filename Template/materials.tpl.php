<?php include("Modules/head.mod.php"); ?>

<?php include("Modules/notify.mod.html"); ?>

<?php include("Modules/nav.mod.php"); ?>

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
                        <i class="fa fa-flag"></i>  <a href="index.html">Accueil</a>
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
                            <a href="#" class="list-group-item">Toutes</a>
                            <?php
                            foreach ($fetchedCategories as $category)
                            {
                                echo '<a href="#" class="list-group-item">' . $category['category'] . '</a>';
                            }
                            ?>
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

            <!-- Material list -->
            <div class="col-xs-12">
                <div class="well">
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
                                echo '<td><span data-id=' . $material->getId() . '>' . $material->getName() . '</span></td>';
                                echo '<td><span data-id=' . $material->getId() . '>' . $material->getCategory() . '</span></td>';
                                echo '<td><button data-id=' . $material->getId() . ' type="button" class="btn btn-sm btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button></td>';
                                echo '<tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Button(s) -->
            <div class="col-xs-12">
                <button type="button" id="button-add" class="btn btn-lg btn-primary">Ajouter un matériel</button>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include("Modules/footer.mod.php"); ?>

<script>
    var categories = <?php echo $categories; ?>;
    console.log(categories);
</script>

<script type="text/javascript" src="/Libs/js/old_materials.js"></script>
