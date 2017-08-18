<?php include("Modules/head.mod.php"); ?>

<?php include("Modules/notify.mod.html"); ?>

<?php include("Modules/nav.mod.php"); ?>

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
                            <i class="fa fa-scissors"></i> <a href="/accueil">Chirurgies</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-pencil"></i> <?php echo $surgery->getName(); ?>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="well">
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-file-o"></i></span>
                            <input class="form-control" placeholder="Nom de la chirurgie" value="<?php echo $surgery->getName(); ?>">
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-comment-o"></i></span>
                            <textarea class="form-control" placeholder="Histoire de la chirurgie"><?php echo $surgery->getStory(); ?></textarea>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="">Urgence
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
                                    <tr data-id=1>
                                        <td><span class="patient-name">Nathalie Barreau</span></td>
                                        <td><button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button></td>
                                    <tr>
                                    <tr data-option="1">
                                        <td>
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
    var surgery = <?php echo json_encode($surgery, JSON_UNESCAPED_UNICODE); ?>;
    var materials = <?php echo json_encode($materials, JSON_UNESCAPED_UNICODE); ?>;
    var questions = <?php echo json_encode($questions, JSON_UNESCAPED_UNICODE); ?>;
</script>

<script type="text/javascript" src="/Libs/js/surgery.js"></script>-->
