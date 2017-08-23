<?php include("Modules/head.mod.php"); ?>

<?php include("Modules/notify.mod.html"); ?>

<?php include("Modules/nav.mod.php"); ?>

    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Patients</h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-flag"></i>  <a href="/accueil">Accueil</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-wrench"></i> Patients
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row">

                    <!-- Button(s) -->
                    <div class="col-xs-12 space-under">
                        <button type="button" class="btn btn-lg btn-primary button-add">Ajouter un patient</button>
                    </div>

                    <!-- Material list -->
                    <div class="col-xs-12">
                        <div class="well list-well">
                            <h3>Liste des matériels :</h3><br>
                            <table class="table table-hover">
                                <thead>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Sexe</th>
                                <th>Age</th>
                                <th>Taille</th>
                                <th>Poids</th>
                                <th>Matériel</th>
                                <th>Questions</th>
                                <th>Chirurgies</th>
                                <th style="width: 95px; display: flex;">Actions</th>
                                </thead>
                                <tbody id="surgeries-list">
                                <?php foreach ($patients as $patient)
                                {
                                    echo '<tr data-id=' . $patient->getId() . '>';
                                    echo '<td>' . $patient->getFirstname() . '</td>';
                                    echo '<td>' . $patient->getLastname() . '</td>';

                                    echo '<td><i class="fa ' . ($patient->getSex() === '1' ? 'fa-female' : 'fa-male') . '"></i></td>';

                                    echo '<td>' . $patient->getAge() . ' ans</td>';
                                    echo '<td>' . $patient->getHeight() . ' cm</td>';
                                    echo '<td>' . $patient->getWeight() . ' kg</td>';

                                    echo '<td>';
                                    foreach ($patient->getMaterials() as $material) { echo '<span class="btn btn-default">' . $materials[$material]->getName() . '</span>'; }
                                    echo '</td>';

                                    echo '<td>';
                                    foreach ($patient->getResponses() as $question) { echo '<span class="btn btn-default">' . $question['questionName'] . '</span>'; }
                                    echo '</td>';

                                    echo '<td>';
                                    foreach ($patient->getSurgeries() as $surgery) { echo '<span class="btn btn-default">' . $surgeries[$surgery]->getName() . '</span>'; }
                                    echo '</td>';

                                    echo '<td>';
                                    echo '<a href="/patients/' . $patient->getId() . '"><button class="btn btn-sm btn-primary faa-parent animated-hover modify"><i class="fa fa-fw fa-wrench faa-wrench"></i></button></a> ';
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
                        <button type="button" class="btn btn-lg btn-primary button-add">Ajouter un patient</button>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>

<?php include("Modules/footer.mod.php"); ?>