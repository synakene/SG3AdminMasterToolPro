<?php include("modules/head.mod.php"); ?>

<?php include("modules/notify.mod.html"); ?>

<?php include("modules/nav.mod.php"); ?>

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
                            <i class="fa fa-scissors"></i> Chirurgies
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">

                <!-- Button(s) -->
                <div class="col-xs-12 space-under">
                    <a href="/creer-chirurgie"><button type="button" class="btn btn-lg btn-primary button-add">Ajouter une chirurgie</button></a>
                </div>

                <!-- Surgeries list -->
                <div class="col-xs-12">
                    <div class="well list-well">
                        <h3>Liste des chirurgies :</h3><br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="hidden">Id</th>
                                    <th>Nom</th>
                                    <!--<th>Histoire</th>-->
                                    <th class="no-sort">Matériel</th>
                                    <th class="no-sort">Questions</th>
                                    <th class="no-sort">Patients</th>
                                    <th>Urgence</th>
                                    <th><!--style="width: 95px; display: flex;"-->Actions</th>
                                </tr>
                            </thead>
                            <tbody id="surgeries-list">
                            <?php foreach ($surgeries as $surgery)
                            {
                                echo '</tr>';

                                echo '<td class="hidden" data-id="' . $surgery->getId() . '">' . $surgery->getId() . '</td>';
                                echo '<td>' . $surgery->getName() . '</td>';

                                echo '<td>';
                                foreach ($surgery->getMaterials() as $material) { echo '<a href="/materiel"><span class="btn btn-default">' . $materials[$material]->getName() . '</span></a>'; }
                                echo '</td>';

                                echo '<td>';
                                foreach ($surgery->getResponses() as $question) { echo '<a href="/questions"><span class="btn btn-default">' . $question['questionName'] . '</span></a>'; }
                                echo '</td>';

                                echo '<td>';
                                foreach ($surgery->getCompatibles() as $patient) { echo '<a href="/patients/' . $patient . '"><span class="btn btn-default">' . $patients[$patient]->getFirstname() . ' ' . $patients[$patient]->getLastname() . '</span></a>'; }
                                echo '</td>';
                                echo '<td><span class="hidden">' . $surgery->getEmergency() . '</span><label class="switch"><input type="checkbox" ' . ($surgery->getEmergency() === true ? 'checked' : '') . ' disabled><span class="slider round"></span></label></td>';

                                echo '<td>';
                                echo '<a href="/chirurgies/' . $surgery->getId() . '"><button data-toggle="tooltip" data-original-title="Modifier" class="btn btn-sm btn-primary faa-parent animated-hover modify"><i class="fa fa-wrench faa-wrench"></i></button></a>';
                                echo '<button data-toggle="tooltip" data-original-title="Supprimer" class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button>';
                                echo '</td></tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Button(s) -->
                <div class="col-xs-12 space-under">
                    <a href="/creer-chirurgie"><button type="button" class="btn btn-lg btn-primary button-add">Ajouter une chirurgie</button></a>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>

<?php include("modules/footer.mod.php"); ?>

<script type="text/javascript" src="/libs/js/surgeries.js"></script>
