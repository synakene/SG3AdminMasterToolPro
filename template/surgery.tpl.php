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

                        <!--<div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-comment-o"></i></span>
                            <textarea class="form-control surgery-story" placeholder="Histoire de la chirurgie"><?php echo $surgery->getStory(); ?></textarea>
                        </div>-->

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" <?php if ($surgery->getEmergency() === true) { echo 'checked'; } ?>>Urgence
                            </label>
                        </div>

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
