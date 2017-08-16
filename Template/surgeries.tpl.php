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
                            <i class="fa fa-flag"></i>  <a href="/accueil">Chirurgies</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-wrench"></i> Materiel
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
                            <tbody id="surgeries-list">
                            <?php
                            /*foreach ($questions as $question)
                            {
                                echo '<tr data-id=' . $question->getId() . '>';
                                echo '<td><span class="question-name">' . $question->getName() . '</span></td>';
                                echo '<td><span class="question-answer">' . $question->getAnswer() . '</span></td>';
                                echo '<td>';
                                echo '<button class="btn btn-sm btn-primary faa-parent animated-hover modify"><i class="fa fa-wrench faa-wrench"></i></button>';
                                echo '<button class="btn btn-sm btn-success faa-parent animated-hover validate" style="display: none"><i class="fa fa-check faa-pulse"></i></button>';
                                echo '<button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button>';
                                echo '</td>';
                                echo '<tr>';
                            }*/
                            ?>
                            <tr data-id=1>
                                <td><span class="surgery-name">Césarienne</span></td>
                                <td><span class="surgery-story">Le papa il a mis la graine dans le ventre de la maman...</span></td>
                                <td><span class="surgery-materials">billot fesse, clef a molette</span></td>
                                <td><span class="surgery-responses">tabac : oui depuis 2 semaines, lgo : pas depuis 3 mois</span></td>
                                <td><span class="surgery-compatibles">Nathalie Barreau, Jacqueline Duchmol</span></td>
                                <!--<td><div class="surgery-emergency checkbox"><input type="checkbox"></div></td>-->
                                <td><span class="surgery-emergency"><input disabled type="checkbox"></span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary faa-parent animated-hover modify"><i class="fa fa-wrench fa-fw faa-wrench"></i></button>
                                    <button class="btn btn-sm btn-success faa-parent animated-hover validate" style="display: none"><i class="fa fa-check fa-fw faa-pulse"></i></button>
                                    <button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times fa-fw faa-flash"></i></button>
                                </td>
                            <tr>
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

<script> var surgeries = <?php echo $surgeriesJson; ?>; </script>

<script type="text/javascript" src="/Libs/js/surgeries.js"></script>
