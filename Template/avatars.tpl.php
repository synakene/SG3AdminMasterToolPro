<?php include("Modules/head.mod.php"); ?>

<?php include("Modules/notify.mod.html"); ?>

<?php include("Modules/nav.mod.php"); ?>

<div id="wrapper">
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Avatars</h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-flag"></i>  <a href="/accueil">Accueil</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-smile-o"></i> Avatars
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <?php
                $admin = Customer::isAdmin();
                foreach ($avatars as $avatar)
                {
                    echo '<div class="well col-xs-12" id="' . $avatar['id'] . '">';
                        echo '<h4>' . $avatar['name'] . '</h4>';
                        echo '<img class="col-xs-12 col-sm-9 col-lg-6" src="/Assets/Avatars/' . $avatar['id'] . '.PNG" alt="Pas encore d\'image">';
                        if ($admin)
                        {
                            // TODO rajouter un wrapper pour eviter les retours a la ligne
                            echo '<div class="form-group input-group">';
                                echo '<span class="input-group-addon">Nom</span>';
                                echo '<input class="form-control avatar-name" placeholder="Nom de l\'avatar" value="' . $avatar['name'] . '">';
                            echo '</div>';

                            echo '<div class="form-group input-group">';
                            echo '<span class="input-group-addon">Pack</span>';
                            echo '<input type="number" class="form-control avatar-pack" placeholder="Pack de l\'avatar" value="' . $avatar['pack'] . '">';
                            echo '</div>';

                            echo '<span class="btn btn-primary save">Sauvegarder</span>';
                        }
                    echo '</div>';
                }
                ?>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>

<?php include("Modules/footer.mod.php"); ?>

<script type="text/javascript" src="/Libs/js/avatars.js"></script>