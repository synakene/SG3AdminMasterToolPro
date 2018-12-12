<?php include("modules/head.mod.php"); ?>

<?php include("modules/notify.mod.html"); ?>

<?php include("modules/nav.mod.php"); ?>

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

                        <div class="panel panel-primary">
                            <div class="panel-heading hideable">
                                <i class="fa fa-address-book-o"></i> Dossier d'anesthésie
                            </div>
                            <div class="panel-body" style="display: none">
                                <h3>Antécédents et histoire de la maladie</h3>
                                <textarea class="form-control patient-story"><?php echo $patient->getStory(); ?></textarea><br>

                                <h3>Traitements</h3>
                                <textarea class="form-control patient-treatments"><?php echo $patient->getTreatments(); ?></textarea><br>

                                <h3>Allergie</h3>
                                <div><label>Antibiotique <input class="patient-allergies-antib" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non"></label></div>
                                <div><label>Latex <input class="patient-allergies-latex" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non"></label></div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">Autre</span>
                                    <input type="text" class="form-control patient-allergies-other" placeholder="Non connue">
                                </div>

                                <h3>Examen clinique</h3>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">TA</span>
                                    <input type="text" class="form-control patient-ta" placeholder="valeur1/valeur2">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">FC</span>
                                    <input type="number" class="form-control patient-tc" value="<?php echo $patient->getFc(); ?>">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">Précisions</span>
                                    <textarea class="form-control patient-exam-extra"><?php echo $patient->getExamExtra(); ?></textarea>
                                </div><br/>

                                <h3>Voies aériennes supérieures</h3>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">État dentaire</span>
                                    <input type="text" class="form-control patient-dentalCondition" placeholder="RAI">
                                </div>
                                <div><label>Information risque dentaire <input class="patient-dentalRiskNotice" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non" <?php if ($patient->getDentalRiskNotice()) echo 'checked'; ?>></label></div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">Score de mallanpati</span>
                                    <select class="form-control patient-mallanpati">
                                        <option value="1" <?php if($patient->getMallanpati() == 1) echo 'selected="selected"'; ?>>I</option>
                                        <option value="2" <?php if($patient->getMallanpati() == 2) echo 'selected="selected"'; ?>>II</option>
                                        <option value="3" <?php if($patient->getMallanpati() == 3) echo 'selected="selected"'; ?>>III</option>
                                        <option value="4" <?php if($patient->getMallanpati() == 4) echo 'selected="selected"'; ?>>IV</option>
                                    </select>
                                </div><br/>
                                <div><label>Distance thyro-mentale <input class="patient-thyroid-mental-distance" type="checkbox" data-toggle="toggle" data-on="<65mm" data-off="≥65mm" data-width="100" data-offstyle="primary" <?php if($patient->getThyroidMentalDistance() < 65) echo 'checked'; ?>></label></div>
                                <div><label>Ouverture de bouche <input class="patient-mouth-opening" type="checkbox" data-toggle="toggle" data-on="<35mm" data-off="≥35mm" data-width="100" data-offstyle="primary" <?php if($patient->getMouthOpening() < 35) echo 'checked';?>></label></div>
                                <div><label>Intubation difficile prévisible <input class="patient-difficult-intubation" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non" <?php if ($patient->getDifficultIntubation()) echo 'checked' ;?>></label></div>
                                <div><label>Ventilation difficile au masque prévisible <input class="patient-difficult-ventilation" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non" <?php if ($patient->getDifficultVentilation()) echo 'checked' ;?>></label></div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">ASA</span>
                                    <input type="number" class="form-control patient-asa" placeholder="RAI" value="<?php echo $patient->getAsa() ;?>">
                                </div>
                                <br/>

                                <h3>Examens pré-anésthésiques</h3>
                                <div><label>Groupe 1 <input class="patient-examinations-groupe1" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non"></label></div>
                                <div><label>Groupe 2 <input class="patient-examinations-groupe2" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non"></label></div>
                                <div><label>Phénotype <input class="patient-examinations-phenotype" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non"></label></div>
                                <div><label>RAI <input class="patient-examinations-rai" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non"></label></div>
                                <div><label>Cross <input class="patient-examinations-cross" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non"></label></div>
                                <div><label>NF <input class="patient-examinations-nf" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non"></label></div>
                                <div><label>TP <input class="patient-examinations-tp" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non"></label></div>
                                <div><label>TCA <input class="patient-examinations-tca" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non"></label></div>
                                <div><label>Iono <input class="patient-examinations-iono" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non"></label></div>
                                <div><label>Radiothorax <input class="patient-examinations-radiothorax" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non"></label></div>
                                <div><label>ECG <input class="patient-examinations-ecg" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non"></label></div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">Autre</span>
                                    <input type="text" class="form-control patient-examinations-other" placeholder="Séparer par des virgules">
                                </div>
                                <br/>

                                <h3>Proposition MAR</h3>
                                <div><label>AG <input class="patient-mar-ag" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non" <?php if($patient->getMarProposition() == 1 || $patient->getMarProposition() == 3) echo 'checked' ;?>></label></div>
                                <div><label>ALR <input class="patient-mar-bis" type="checkbox" data-toggle="toggle" data-on="Oui" data-off="Non" <?php if($patient->getMarProposition() == 2 || $patient->getMarProposition() == 3) echo 'checked' ;?>></label></div><br/>

                                <h3>Hospitalisation prévue</h3>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">Hospitalisation</span>
                                    <select class="form-control patient-hospitalisation">
                                        <option value="0" <?php if($patient->getExpectedHospitalisation() == 0) echo 'selected="selected"' ;?>>Conventionnelle</option>
                                        <option value="1" <?php if($patient->getExpectedHospitalisation() == 1) echo 'selected="selected"' ;?>>Ambulatoire</option>
                                        <option value="2" <?php if($patient->getExpectedHospitalisation() == 2) echo 'selected="selected"' ;?>>Réa//SSIPO</option>
                                    </select>
                                </div>
                                <br/>

                                <h3>Stratégie transfusionnelle</h3>
                                <textarea class="form-control patient-transfusion-strategy"><?php echo $patient->getTransfusionStrategy(); ?></textarea><br/>

                                <h3>Visite pré-anesthésique</h3>
                                <textarea class="form-control patient-pre-anesthetic-visit"><?php echo $patient->getPreAnestheticVisit(); ?></textarea><br/>

                                <h3>Prémédication</h3>
                                <h4>La veille</h4>
                                <textarea class="form-control patient-premedication-eve"></textarea><br/>
                                <h4>Le matin</h4>
                                <textarea class="form-control patient-premedication-morning"></textarea><br/>
                                <h4>Précisions</h4>
                                <textarea class="form-control patient-premedication-extra"><?php echo $patient->getPremedicationExtra(); ?></textarea><br/>
                            </div>
                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon">Feedback</span>
                            <textarea class="form-control patient-feedback" placeholder="Ceci apparaitra dans les résultats de l'apprenant"><?php echo $patient->getFeedback(); ?></textarea>
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

<script type="text/javascript">
    var patient = <?php echo json_encode($patient, JSON_UNESCAPED_UNICODE); ?>;
    var materials = <?php echo json_encode($materials, JSON_UNESCAPED_UNICODE); ?>;
    var questions = <?php echo json_encode($questions, JSON_UNESCAPED_UNICODE); ?>;
    var surgeries = <?php echo json_encode($surgeries, JSON_UNESCAPED_UNICODE); ?>;
    var avatars = <?php echo json_encode($avatars, JSON_UNESCAPED_UNICODE); ?>;

    var allergies = <?php echo $patient->getAllergies(); ?>;
    var examinations = <?php echo $patient->getPreAnestheticExaminations(); ?>;
</script>

<script type="text/javascript" src="/libs/js/patient.js"></script>
