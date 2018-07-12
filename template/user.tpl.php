<?php include("modules/head.mod.php"); ?>

<?php include("modules/notify.mod.html"); ?>

<?php include("modules/nav.mod.php"); ?>

<link rel="stylesheet" href="/libs/css/user.css">

<div id="wrapper">
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Utilisateurs</h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-flag"></i>  <a href="/accueil">Accueil</a>
                        </li>
                        <li>
                            <i class="fa fa-users"></i> <a href="/utilisateurs">Utilisateurs</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-pencil"></i> <span><?php echo $user->getMail(); ?></span>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row well">
                <h2>Identifiants</h2>
                <div class="form-group input-group">
                    <span class="input-group-addon">Mail</span>
                    <input class="form-control user-mail" placeholder="Mail de l'utilisateur" value="<?php echo $user->getMail(); ?>">
                    <span class="input-group-btn"><button class="btn btn-primary">Changer le mail</button></span>
                </div>

                <div class="form-group input-group">
                    <span class="input-group-addon">Mot de passe</span>
                    <input class="form-control user-password" placeholder="Mot de passe de l'utilisateur">
                    <span class="input-group-btn"><button class="btn btn-primary">Changer le mot de passe</button></span>
                </div>

                <div class="form-group input-group">
                    <span class="input-group-addon">Clef API</span>
                    <input class="form-control user-api" placeholder="Clef de l'API Synabank" value="<?php echo $user->getApiKey(); ?>">
                    <span class="input-group-btn"><button class="btn btn-primary">Changer la clef</button></span>
                </div>

                <h2>Packs de l'utilisateur</h2>
                <table id="avatars-packs" class="display" style="width: 100%">
                    <thead>
                        <th>Pack</th>
                        <th>Nombre d'avatars</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php /** @var array $packs */ foreach ($packs as $pack) { ?>
                            <tr data-id="<?php echo $pack['pack']?>">
                                <td><?php echo $pack['pack']; ?></td>
                                <td><?php echo $pack['count']; ?></td>
                                <?php if (in_array($pack['pack'], $user->getPacks())) { ?>
                                    <td data-order="0"><button data-value="0" class="btn btn-danger"><i class="fa fw fa-times"></i></button></td>
                                <?php } else { ?>
                                    <td data-order="1"><button data-value="1" class="btn btn-success"><i class="fa fw fa-plus"></i></button></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <h2>Importer des données</h2>
                <div id="import-jsons-wrapper" class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <label for="file-surgeries" class="panel panel-primary">
                            <div class="panel-heading">
                                <h4><i class="fa fa-scissors"></i> Chirurgies</h4>
                            </div>
                            <div class="panel-body">
                                <input id="file-surgeries" type="file" accept=".json" class="form-control">
                            </div>
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <label for="file-patients" class="panel panel-green">
                            <div class="panel-heading">
                                <h4><i class="fa fa-user"></i> Patients</h4>
                            </div>
                            <div class="panel-body">
                                <input id="file-patients" type="file" accept=".json" class="form-control">
                            </div>
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <label for="file-materials" class="panel panel-yellow">
                            <div class="panel-heading">
                                <h4><i class="fa fa-wrench"></i> Materiel</h4>
                            </div>
                            <div class="panel-body">
                                <input id="file-materials" type="file" accept=".json" class="form-control">
                            </div>
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <label for="file-questions" class="panel panel-red">
                            <div class="panel-heading">
                                <h4><i class="fa fa-question"></i> Questions</h4>
                            </div>
                            <div class="panel-body">
                                <input id="file-questions" type="file" accept=".json" class="form-control">
                            </div>
                        </label>
                    </div>
                    <div class="col-xs-12"><button id="import-json" class="col-xs-12 btn btn-primary"><h3>Importer</h3></button></div>
                </div>

                <br/>
                <h2>Actions</h2>
                <div id="actions" class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <a href="/login/<?php echo $user->getId(); ?>">
                            <button class="col-xs-12 btn btn-primary"><i class="fa fa-user"></i> Se connecter</button>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <a id="delete-user" href="/supprimer-utilisateur/<?php echo $user->getId(); ?>">
                            <button class="col-xs-12 btn btn-danger"><i class="fa fa-times"></i> Supprimer le compte</button>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <button id="generate-json" class="col-xs-12 btn btn-success faa-parent animated-hover" data-id="<?php echo $user->getId(); ?>">
                            <i class="fa fa-flask faa-shake"></i> Générer les fichiers
                        </button>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>

<?php include("modules/footer.mod.php"); ?>

<script type="text/javascript" src="/libs/js/user.js"></script>