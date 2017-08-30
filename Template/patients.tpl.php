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
                        <a href="/creer-patient"><button type="button" class="btn btn-lg btn-primary button-add">Ajouter un patient</button></a>
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

                                    if ($patient->getSex() === 0)
                                    {
                                        $sexIcon = 'fa-mars';
                                    }
                                    else if ($patient->getSex() === 1)
                                    {
                                        $sexIcon = 'fa-venus';
                                    }
                                    else
                                    {
                                        $sexIcon = 'fa-genderless';
                                    }
                                    echo '<td><i class="fa ' . $sexIcon . '"></i></td>';

                                    echo '<td>' . $patient->getAge() . ' ans</td>';
                                    echo '<td>' . $patient->getHeight() . ' cm</td>';
                                    echo '<td>' . $patient->getWeight() . ' kg</td>';

                                    echo '<td>';
                                    foreach ($patient->getMaterials() as $material) { echo '<a href="/materiel"><span class="btn btn-default">' . $materials[$material]->getName() . '</span></a>'; }
                                    echo '</td>';

                                    echo '<td>';
                                    foreach ($patient->getResponses() as $question) { echo '<a href="/questions"><span class="btn btn-default">' . $question['questionName'] . '</span></a>'; }
                                    echo '</td>';

                                    echo '<td>';
                                    foreach ($patient->getSurgeries() as $surgery) { echo '<a href="/chirurgies/' . $surgery . '"><span class="btn btn-default">' . $surgeries[$surgery]->getName() . '</span></a>'; }
                                    echo '</td>';

                                    echo '<td>';
                                    echo '<a href="/patients/' . $patient->getId() . '"><button class="btn btn-sm btn-primary faa-parent animated-hover modify"><i class="fa fa-wrench faa-wrench"></i></button></a> ';
                                    echo '<button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button>';
                                    echo '</td>';
                                    echo '<tr>';
                                    // TODO betters buttons
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Button(s) -->
                    <div class="col-xs-12">
                        <a href="/creer-patient"><button type="button" class="btn btn-lg btn-primary button-add">Ajouter un patient</button></a>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>

<?php include("Modules/footer.mod.php"); ?>

<script type="text/javascript" src="/Libs/js/patients.js"></script>
