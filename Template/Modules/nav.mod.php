<div id="slider-button" onclick="slider()">
    <i class="fa fa-3x fa-arrow-right faa-passing animated-hover"></i>
</div>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="/accueil" class="navbar-brand" id ="toggle-menu">SG3 Admin Mastertool Pro</a>
    </div>

    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $name ?><b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="/disconnect"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav" id="SideNav">
            <li class="active">
                <a href="#" onclick="slider()"><i class="fa fa-fw fa-arrow-left"></i> Cacher le menu</a>
            </li>
            <li class="active">
                <a href="/accueil"><i class="fa fa-fw fa-flag"></i> Accueil</a>
            </li>
            <li>
                <a href="/chirurgies"><i class="fa fa-fw fa-scissors"></i> Chirurgies</a>
            </li>
            <li>
                <a href="/patients"><i class="fa fa-fw fa-user"></i> Patients</a>
            </li>
            <li>
                <a href="/materiel"><i class="fa fa-fw fa-wrench"></i> Materiel</a>
            </li>
            <li>
                <a href="/questions"><i class="fa fa-fw fa-question"></i> Questions</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>

<script>
function slider()
{
    if (document.getElementById("SideNav").style.display == "none")
    {
        document.getElementById("SideNav").style.display = "inline";
        document.getElementById("wrapper").style.paddingLeft = "225px";
        document.getElementById("toggle-menu").text = "Cacher le menu";
    }
    else
    {
        document.getElementById("SideNav").style.display = "none";
        document.getElementById("wrapper").style.paddingLeft = "0px";
        document.getElementById("toggle-menu").text = "Afficher le menu";
    }
}
</script>