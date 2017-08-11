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
                            <i class="fa fa-flag"></i>  <a href="/accueil">Questions</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-question"></i> Materiel
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">

                <!-- Button(s) -->
                <div class="col-xs-12 space-under">
                    <button type="button" class="btn btn-lg btn-primary button-add">Ajouter une question</button>
                    <button type="button" class="btn btn-lg btn-success button-save-all">Tout sauvegarder</button>
                </div>

                <!-- Material list -->
                <div class="col-xs-12">
                    <div class="well">
                        <h3>Liste des matériels :</h3><br>
                        <table class="table table-hover">
                            <thead>
                            <th>Question</th>
                            <th>Réponse</th>
                            <th>Action</th>
                            </thead>
                            <tbody id="questions-list">
                            <?php
                            foreach ($questions as $question)
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
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Button(s) -->
                <div class="col-xs-12">
                    <button type="button" class="btn btn-lg btn-primary button-add">Ajouter une question</button>
                    <button type="button" class="btn btn-lg btn-success button-save-all">Tout sauvegarder</button>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>

<?php include("Modules/footer.mod.php"); ?>

<script type="text/javascript" src="/Libs/js/questions.js"></script>
