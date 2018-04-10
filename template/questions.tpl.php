<?php include("modules/head.mod.php"); ?>

<?php include("modules/notify.mod.html"); ?>

<?php include("modules/nav.mod.php"); ?>

<div id="wrapper">
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Questions
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-flag"></i>  <a href="/accueil">Accueil</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-question"></i> Questions
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

                <!-- Add form -->
                <div class="col-xs-12">
                    <form action="" method="" class="well">
                        <div style="text-align: right; margin-bottom: 19px;">
                            <button type="button" class="btn btn-sm btn-danger faa-parent animated-hover"><i class="fa fa-times faa-flash"></i></button>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon">Identifiant</span>
                            <input type="text" class="form-control id">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon">Question</span>
                            <input type="text" class="form-control question">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon">Réponse par défaut</span>
                            <input type="text" class="form-control response">
                        </div>
                        <input type="submit" class="form-control" value="Ajouter la question">
                    </form>
                </div>

                <!-- Questions list -->
                <div class="col-xs-12">
                    <div class="well list-well loading-parent">
                        <h3>Liste des questions :</h3><br>
                        <div class="loading"><i class="fa fa-cog faa-spin animated"></i></div>
                        <table class="table table-hover">
                            <thead>
                            <th>Identifiant</th>
                            <th>Question</th>
                            <th>Réponse par défaut</th>
                            <th class="no-sort">Action</th>
                            </thead>
                            <tbody id="questions-list">
                            <?php
                            foreach ($questions as $question)
                            {
                                echo '<tr data-id=' . $question->getId() . '>';
                                echo '<td><span class="question-name">' . $question->getName() . '</span></td>';
                                echo '<td><span class="question-question">' . $question->getQuestion() . '</span></td>';
                                echo '<td><span class="question-answer">' . $question->getAnswer() . '</span></td>';
                                echo '<td>';
                                echo '<button class="btn btn-sm btn-primary faa-parent animated-hover modify"><i class="fa fa-wrench faa-wrench"></i></button>';
                                echo '<button class="btn btn-sm btn-success faa-parent animated-hover validate" style="display: none"><i class="fa fa-check faa-pulse"></i></button> ';
                                echo '<button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button>';
                                echo '</td>';
                                echo '</tr>';
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

<?php include("modules/footer.mod.php"); ?>

<script type="text/javascript" src="/libs/js/questions.js"></script>
