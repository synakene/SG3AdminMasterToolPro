<?php include("Modules/head.mod.php"); ?>

<?php include("Modules/notify.mod.html"); ?>

<?php include("Modules/nav.mod.php"); ?>

<div id="wrapper">
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $patient->getFirstname() . ' ' . $patient->getLastname(); ?></h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-flag"></i>  <a href="/accueil">Accueil</a>
                        </li>
                        <li>
                            <i class="fa fa-user"></i> <a href="/patients">Patients</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-pencil"></i> <span><?php echo $patient->getFirstname() . ' ' . $patient->getLastname(); ?></span>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="well clearfix">

                        <div class="col-xs-12 space-under"><button type="button" class="btn btn-primary btn-lg pull-right save" style="margin-right: -15px;"><i class="fa fa-floppy-o"></i> Enregistrer</button></div>

                        <div class="form-group input-group">
                            <span class="input-group-addon">Prénom</span>
                            <input class="form-control patient-firstname" placeholder="Prénom du patient" value="<?php echo $patient->getFirstname(); ?>">
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon">Nom</span>
                            <input class="form-control patient-lastname" placeholder="Nom de famille du patient" value="<?php echo $patient->getLastname(); ?>">
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon">Sexe</span>
                            <select class="form-control patient-sex">
                                <option value="0">Homme</option>
                                <option value="1">Femme</option>
                                <option value="2">Autre</option>
                            </select>
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon">Age</span>
                            <input type="number" class="form-control patient-age" placeholder="Age du patient" value="<?php echo $patient->getAge(); ?>">
                            <span class="input-group-addon">ans</span>
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon">Taille</i></span>
                            <input type="number" class="form-control patient-height" placeholder="Taille du patient en cm" value="<?php echo $patient->getHeight(); ?>">
                            <span class="input-group-addon">cm</i></span>
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon">Poids</span>
                            <input type="number" class="form-control patient-weight" placeholder="Poids du patient en kg" value="<?php echo $patient->getWeight(); ?>">
                            <span class="input-group-addon">kg</span>
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon">Avatar</span>
                            <select class="form-control patient-avatar">
                                <?php
                                    foreach ($avatars as $avatar)
                                    {
                                        $id = $avatar['id'];
                                        $name = $avatar['name'];
                                        echo "<option value =\"$id\">$name</option>";
                                    }
                                ?>
                            </select>
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
                                <i class="fa fa-scissors"></i> Chirurgies
                            </div>
                            <div class="panel-body" style="display: none">
                                <table class="table table-hover">
                                    <thead>
                                        <th>Chirurgie</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="surgeries-list">
                                    <tr data-option="1">
                                        <td>
                                            <select class="surgery-name form-control">
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

<?php include("Modules/footer.mod.php"); ?>

<script>
    var patient = <?php echo json_encode($patient, JSON_UNESCAPED_UNICODE); ?>;
    var materials = <?php echo json_encode($materials, JSON_UNESCAPED_UNICODE); ?>;
    var questions = <?php echo json_encode($questions, JSON_UNESCAPED_UNICODE); ?>;
    var surgeries = <?php echo json_encode($surgeries, JSON_UNESCAPED_UNICODE); ?>;
    var avatars = <?php echo json_encode($avatars, JSON_UNESCAPED_UNICODE); ?>;
</script>

<script type="text/javascript" src="/Libs/js/patient.js"></script>
