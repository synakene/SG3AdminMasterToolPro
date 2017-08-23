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
                            <th style="width: 95px; display: flex;">Actions</th>
                            </thead>
                            <tbody id="surgeries-list">
                            <?php foreach ($surgeries as $surgery)
                            {
                                echo '<tr data-id=' . $surgery->getId() . '>';
                                    echo '<td>' . $surgery->getName() . '</td>';
                                    echo '<td>' . $surgery->getStory() . '</td>';

                                    echo '<td>';
                                    foreach ($surgery->getMaterials() as $material) { echo '<span class="btn btn-default">' . $materialsNames[$material] . '</span>'; }
                                    echo '</td>';

                                    echo '<td>';
                                    foreach ($surgery->getResponses() as $question) { echo '<span class="btn btn-default">' . $question['questionName'] . '</span>'; }
                                    echo '</td>';

                                    echo '<td>';
                                    foreach ($surgery->getCompatibles() as $patient) { echo '<span class="btn btn-default">' . $patientsNames[$patient] . '</span>'; }
                                    echo '</td>';
                                    echo '<td><input type="checkbox" disabled ' . ($surgery->getEmergency() === true ? 'checked' : '') . '></td>';

                                    echo '<td>';
                                    echo '<a href="/chirurgies/' . $surgery->getId() . '"><button class="btn btn-sm btn-primary faa-parent animated-hover modify"><i class="fa fa-fw fa-wrench faa-wrench"></i></button></a> ';
                                    echo '<button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-fw fa-times faa-flash"></i></button>';
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