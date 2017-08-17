<?php include("Modules/head.mod.php"); ?>

<?php include("Modules/notify.mod.html"); ?>

<?php include("Modules/nav.mod.php"); ?>

<div id="wrapper">
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Chirurgies</h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-flag"></i>  <a href="/accueil">Accueil</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-wrench"></i> Chirurgies
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">

                <!-- Button(s) -->
                <div class="col-xs-12 space-under">
                    <button type="button" class="btn btn-lg btn-primary button-add">Ajouter une chirurgie</button>
                    <button type="button" class="btn btn-lg btn-success button-save-all">Tout sauvegarder</button>
                </div>

                <!-- Material list -->
                <div class="col-xs-12">
                    <div class="well list-well">
                        <h3>Liste des matériels :</h3><br>
                        <table class="table table-hover">
                            <thead>
                            <th>Nom</th>
                            <th>Histoire</th>
                            <th>Matériel</th>
                            <th>Questions</th>
                            <th>Patients</th>
                            <th>Urgence</th>
                            </thead>
                            <tbody id="surgeries-list"></tbody>
                        </table>
                    </div>
                </div>

                <!-- Button(s) -->
                <div class="col-xs-12">
                    <button type="button" class="btn btn-lg btn-primary button-add">Ajouter une chirurgie</button>
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
    var surgeries = <?php echo $surgeriesJson; ?>;
    var materials = <?php echo $materialsJson; ?>;
</script>

<script type="text/javascript" src="/Libs/js/surgeries.js"></script>
