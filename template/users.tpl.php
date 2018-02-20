<?php include("modules/head.mod.php"); ?>

<?php include("modules/notify.mod.html"); ?>

<?php include("modules/nav.mod.php"); ?>

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
                        <li class="active">
                            <i class="fa fa-wrench"></i> Utilisateurs
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row well list-well">
                <table class="table" id="users-table" class="display" width="100%">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Mail</th>
                        <th>Packs</th>
                        <th>Chirurgies</th>
                        <th>Patients</th>
                        <th>Materiels</th>
                        <th>Questions</th>
                        <th>Admin</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user) {
                        echo '<tr>';
                            echo '<td>' . $user->getId() . '</td>';
                            echo '<td>' . $user->getMail() . '</td>';

                            $packs = $user->getPacks();
                            $packsStr = '';
                            foreach ($packs as $pack)
                            {
                                if ($packsStr !== '')
                                {
                                    $packsStr .= ', ';
                                }
                                $packsStr .= $pack;
                            }
                            echo '<td>' . $packsStr . '</td>';
                            echo '<td>' . $user->getNumSurgeries() . '</td>';
                            echo '<td>' . $user->getNumPatients() . '</td>';
                            echo '<td>' . $user->getNumMaterials() . '</td>';
                            echo '<td>' . $user->getNumQuestions() . '</td>';
                            echo '<td>' . $user->getAdmin() . '</td>';
                            echo '<td>';
                                if ($_SESSION['id'] !== $user->getId()) { echo '<a href="login/' . $user->getId() . '"><span class="btn btn-primary" data-toggle="tooltip" data-original-title="Se connecter en tant que cet utilisateur"><i class="fa fa-user"></i></span></a>';}
                                echo '<a href="/utilisateur/' . $user->getId() . '"<span class="btn btn-warning" data-toggle="tooltip" data-original-title="Modifier l\'utilisateur"><i class="fa fa-wrench"></i></span>';
                        echo '</td>';
                        echo '</tr>';
                    } ?>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>

<?php include("modules/footer.mod.php"); ?>

<script type="text/javascript" src="/libs/js/users.js"></script>