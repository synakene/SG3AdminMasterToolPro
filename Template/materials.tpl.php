<?php include("Modules/head.mod.php"); ?>

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
            <div class="col-xs-12">
                <div class="list-group">
                    <a href="#" class="list-group-item active" id="category-slider-main">Catégorie :</a>
                    <div id="category-slider">
                        <a href="#" class="list-group-item">Toutes</a>
                        <?php
                        foreach ($categories as $category)
                        {
                            echo '<a href="#" class="list-group-item">' . $category['category'] . '</a>';
                        }
                        ?>
                        <div>
                            <a href="#" class="list-group-item">
                                <div class="input-group">
                                    <input class="form-control" placeholder="Ajouter une catégorie">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="well">
                    <h3>Liste des matériels :</h3><br>
                    <table class="table table-hover">
                        <thead>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($materials as $material)
                            {
                                echo '<tr data-category='. $material->getCategory() .'>';
                                echo '<td>' . $material->getName() . '</td>';
                                echo '<td>' . $material->getCategory() . '</td>';
                                echo '<td><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button></td>';
                                echo '<tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-xs-12">
                <button type="button" class="btn btn-lg btn-primary">Ajouter un matériel</button>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include("Modules/footer.mod.php"); ?>

<script type="text/javascript" src="/Libs/js/materials.js"></script>
