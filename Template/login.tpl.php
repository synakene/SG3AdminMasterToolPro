<?php include("Modules/head.mod.php"); ?>

<div class="row" style="margin: auto 0">
    <div class="col-md-4 col-md-offset-4 col-xs-12">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Connexion requise</h3>
            </div>
            <div class="panel-body">
                <form action="/Include/Connect.php" method="post">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Mot de passe" name="password" type="password" value="">
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <button type="submit" class="btn btn-lg btn-success btn-block">Connexion</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("Modules/footer.mod.php"); ?>
