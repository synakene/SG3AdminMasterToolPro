<?php include("modules/head.mod.php"); ?>

<?php include("modules/notify.mod.html"); ?>

<?php include("modules/nav.mod.php"); ?>

<div id="wrapper">
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $surgery->getName(); ?></h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-flag"></i>  <a href="/accueil">Accueil</a>
                        </li>
                        <li>
                            <i class="fa fa-scissors"></i> <a href="/chirurgies">Chirurgies</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-pencil"></i> <?php echo $surgery->getName(); ?>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="well clearfix">

                        <div class="col-xs-12 space-under"><button type="button" class="btn btn-primary btn-lg pull-right save" style="margin-right: -15px;"><i class="fa fa-floppy-o"></i> Enregistrer</button></div>

                        <div class="form-group input-group">
                            <span class="input-group-addon">Nom</span>
                            <input class="form-control surgery-name" placeholder="Nom de la chirurgie" value="<?php echo $surgery->getName(); ?>">
                        </div>


                        <div><label>Consultation <input class="surgery-emergency" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non" <?php if($surgery->getConsultation()) echo 'checked' ;?>></label></div>


                        <div class="panel panel-primary">
                            <div class="panel-heading hideable">
                                <i class="fa fa-wrench"></i> Matériel
                            </div>
                            <div class="panel-body" style="display: none">
                                <table class="table table-hover">
                                    <thead>
                                    <th>Catégorie</th>
                                    <th>Matériel</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody id="materials-list">
                                    <tr data-option="1">
                                        <td class="material-category">
                                            <select class="form-control">
                                                <option value="cat1">Cat1</option>
                                                <option value="cat1">Cat1</option>
                                                <option value="cat1">Cat1</option>
                                            </select>
                                        </td>
                                        <td class="material-name">
                                            <select class="form-control">
                                                <option value="cat1">Cat1</option>
                                                <option value="cat1">Cat1</option>
                                                <option value="cat1">Cat1</option>
                                            </select>
                                        </td>
                                        <td><button class="btn btn-sm btn-success faa-parent animated-hover validate"><i class="fa fa-plus faa-pulse"></i></button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="panel panel-primary">
                            <div class="panel-heading hideable">
                                <i class="fa fa-question"></i> Questions
                            </div>
                            <div class="panel-body" style="display: none">
                                <table class="table table-hover">
                                    <thead>
                                    <th>Identifiant</th>
                                    <th>Question</th>
                                    <th>Réponse</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody id="questions-list">
                                    <tr data-option="1">
                                        <td>
                                            <select class="form-control question-name">
                                                <option value="cat1">Cat1</option>
                                                <option value="cat1">Cat1</option>
                                                <option value="cat1">Cat1</option>
                                            </select>
                                        </td>
                                        <td><span class="question-question">blah</span></td>
                                        <td><span class="question-answer">blah</span></td>
                                        <td><button class="btn btn-sm btn-success faa-parent animated-hover validate"><i class="fa fa-plus faa-pulse"></i></button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="panel panel-primary">
                            <div class="panel-heading hideable">
                                <i class="fa fa-user"></i> Patients
                            </div>
                            <div class="panel-body" style="display: none">
                                <table class="table table-hover">
                                    <thead>
                                    <th>Patient</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody id="patients-list">
                                    <tr data-option="1">
                                        <td>
                                            <select class="patient-name form-control">
                                                <option value="cat1">Cat1</option>
                                                <option value="cat1">Cat1</option>
                                                <option value="cat1">Cat1</option>
                                            </select>
                                        </td>
                                        <td><button class="btn btn-sm btn-success faa-parent animated-hover validate"><i class="fa fa-plus faa-pulse"></i></button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="panel panel-primary">
                            <div class="panel-heading hideable">
                                <i class="fa fa-address-book-o"></i> Dossier d'anésthésie
                            </div>
                            <div class="panel-body" style="display: none">
                                <h3>Évaluation pré-anesthésique</h3>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">Date</span>
                                    <input type="number" class="form-control surgery-last-eval" placeholder="Dernière évaluation" value="<?php echo $surgery->getLastEval(); ?>">
                                    <span class="input-group-addon">jours avant</span>
                                </div>
                                <div><label>Consultation <input class="surgery-consultation" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non" <?php if($surgery->getConsultation()) echo 'checked' ;?>></label></div>
                                <div><label>Urgence <input class="surgery-emergency" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non" <?php if($surgery->getEmergency()) echo 'checked' ;?>></label></div>

                                <h3>Antécédents et histoire de la maladie</h3>
                                <textarea class="form-control surgery-story"><?php echo $surgery->getStory(); ?></textarea><br/>

                                <h3>Proposition MAR</h3>
                                <div><label>AG <input class="surgery-mar-ag" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non" <?php if($surgery->getMarProposition() == 1 || $surgery->getMarProposition() == 3) echo 'checked' ;?>></label></div>
                                <div><label>ALR <input class="surgery-mar-bis" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non" <?php if($surgery->getMarProposition() == 2 || $surgery->getMarProposition() == 3) echo 'checked' ;?>></label></div><br/>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">Détails</span>
                                    <input type="text" class="form-control surgery-mar-proposition-text" value="<?php echo $surgery->getMarPropositionText(); ?>">
                                </div>

                                <h3>Visite pré-anesthésique</h3>
                                <textarea class="form-control surgery-pre-anesthetic-visit"><?php echo $surgery->getPreAnestheticVisit(); ?></textarea><br/>
                            </div>
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon">Feedback</span>
                            <textarea class="form-control surgery-feedback" placeholder="Ceci apparaitra dans les résultats de l'apprenant"><?php echo $surgery->getFeedback(); ?></textarea>
                        </div>

                        <button type="button" class="btn btn-primary btn-lg pull-right save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Enregistrer</button>

                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>

<?php include("modules/footer.mod.php"); ?>

<script>
    var surgery = <?php echo json_encode($surgery, JSON_UNESCAPED_UNICODE); ?>;
    var materials = <?php echo json_encode($materials, JSON_UNESCAPED_UNICODE); ?>;
    var questions = <?php echo json_encode($questions, JSON_UNESCAPED_UNICODE); ?>;
    var patients = <?php echo json_encode($patients, JSON_UNESCAPED_UNICODE); ?>;
</script>

<script type="text/javascript" src="/libs/js/surgery.js"></script>
