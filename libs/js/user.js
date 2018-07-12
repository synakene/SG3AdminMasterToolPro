var idCustomer;

var surgeriesJson;
var patientsJson;
var materialsJson;
var questionsJson;

var jsons;

function addRemovePack(button)
{
    var id = button.closest('tr').getAttribute('data-id');
    var adding = jQuery(button).attr('data-value') === '1' ? 1 : 0;
    console.log(jQuery(button).attr('data-value'));

    sendData = {
        'idPack': id,
        'adding': adding,
        'idCustomer': idCustomer
    };

    jQuery(button).addClass('disabled');
    jQuery(button).find('i').addClass('fa-cog faa-spin animated');
    jQuery(button).find('i').removeClass('fa-times');
    jQuery(button).find('i').removeClass('fa-plus');
    jQuery(button).off();

    jQuery.ajax({
        method: 'POST',
        url: '/include/ajax-api.php',
        data: {
            action: "addPack",
            data: sendData
        }
    })
        .done(function(data){
            jQuery(button).removeClass('disabled');
            jQuery(button).find('i').removeClass('fa-cog faa-spin animated');
            jQuery(button).on('click', function () {
                addRemovePack(button);
            });

            data = data.split('<br>');
            console.log(data);
            if (data[0] === '1')
            {
                notify('success', data[1]);
                if (jQuery(button).attr('data-value') === '0')
                {
                    jQuery(button).addClass('btn-success').removeClass('btn-danger');
                    jQuery(button).find('i').addClass('fa-plus')/*.removeClass('fa-time')*/;
                    jQuery(button).attr('data-value', '1');
                    jQuery(button).closest('td').attr('data-order', '1');
                }
                else
                {
                    jQuery(button).addClass('btn-danger').removeClass('btn-success');
                    jQuery(button).find('i').addClass('fa-times')/*.removeClass('fa-plus')*/;
                    jQuery(button).attr('data-value', '0');
                    jQuery(button).closest('td').attr('data-order', '0');
                }
            }
            else
            {
                notify('danger', data[1]);
            }
        });
}

function changeMail()
{
    var mail = document.querySelector('.user-mail').value;
    var sendData = {
        'idCustomer': idCustomer,
        'mail': mail
    };

    jQuery.ajax({
        method: 'POST',
        url: '/include/ajax-api.php',
        data: {
            action: "changemail",
            data: sendData
        }
    })
        .done(function(data){
            data = data.split('<br>');
            notify((data[0] === '1' ? 'success' : 'danger'), data[1]);
        });
}

function changePass()
{
    var pass = document.querySelector('.user-password').value;
    var sendData = {
        'idCustomer': idCustomer,
        'pass': pass
    };

    jQuery.ajax({
        method: 'POST',
        url: '/include/ajax-api.php',
        data: {
            action: "changepass",
            data: sendData
        }
    })
        .done(function(data){
            data = data.split('<br>');
            notify((data[0] === '1' ? 'success' : 'danger'), data[1]);
        });
}

function changeAPI()
{
    var pass = document.querySelector('.user-api').value;
    var sendData = {
        'idCustomer': idCustomer,
        'key': pass
    };

    jQuery.ajax({
        method: 'POST',
        url: '/include/ajax-api.php',
        data: {
            action: "changeapi",
            data: sendData
        }
    })
        .done(function(data){
            data = data.split('<br>');
            notify((data[0] === '1' ? 'success' : 'danger'), data[1]);
        });
}

function importJsonLoaded()
{
    if (
        surgeriesJson.length === 0
        || patientsJson.length === 0
        || materialsJson.length === 0
        || questionsJson.length === 0
    ) {
        return;
    }
    jsons = {
        "surgeries": surgeriesJson,
        "patients": patientsJson,
        "materials": materialsJson,
        "questions": questionsJson
    };

    jQuery.ajax({
        method: 'POST',
        url: '/include/ajax-api.php',
        data: {
            action: "importJson",
            idCustomer: idCustomer,
            jsons: jsons
        }
    })
        .done(function(data){
            data = data.split('<br>');
            if (data[0] === '1')
            {
                notify('success', data[1]);
            }
            else
            {
                notify('danger', data[1]);
            }
        });
}

function importJsonSurgeries(event) {
    var result = event.target.result;
    try {
        result = JSON.parse(result);
        surgeriesJson = result;
        importJsonLoaded();
    }
    catch (error)
    {
        notify("danger", "Erreur dans la lecture du fichier des chirurgies");
        console.log(error);
    }
}

function importJsonPatients(event) {
    var result = event.target.result;
    try {
        result = JSON.parse(result);
        patientsJson = result;
        importJsonLoaded();
    }
    catch (error)
    {
        notify("danger", "Erreur dans la lecture du fichier des patients");
        console.log(error);
    }
}

function importJsonMaterials(event) {
    var result = event.target.result;
    try {
        result = JSON.parse(result);
        materialsJson = result;
        importJsonLoaded();
    }
    catch (error)
    {
        notify("danger", "Erreur dans la lecture du fichier des matériels");
        console.log(error);
    }
}

function importJsonQuestions(event) {
    var result = event.target.result;
    try {
        result = JSON.parse(result);
        questionsJson = result;
        importJsonLoaded();
    }
    catch (error)
    {
        notify("danger", "Erreur dans la lecture du fichier des questions");
        console.log(error);
    }
}

function importJson()
{
    surgeriesJson = [];
    patientsJson = [];
    materialsJson = [];
    questionsJson = [];

    // Surgeries loading
    var file = document.getElementById('file-surgeries').files[0];
    var reader = new FileReader();
    try {
        reader.readAsText(file, 'UTF-8');
        reader.onload = importJsonSurgeries;
    }
    catch (error) {
        notify("danger", "Erreur pendant le chargement du fichier des chirurgies.")
    }

    // Surgeries loading
    file = document.getElementById('file-patients').files[0];
    reader = new FileReader();
    try {
        reader.readAsText(file, 'UTF-8');
        reader.onload = importJsonPatients;
    }
    catch (error) {
        notify("danger", "Erreur pendant le chargement du fichier des patients.")
    }

    // Surgeries loading
    file = document.getElementById('file-materials').files[0];
    reader = new FileReader();
    try {
        reader.readAsText(file, 'UTF-8');
        reader.onload = importJsonMaterials;
    }
    catch (error) {
        notify("danger", "Erreur pendant le chargement du fichier des matériels.")
    }

    // Questions loading
    file = document.getElementById('file-questions').files[0];
    reader = new FileReader();
    try {
        reader.readAsText(file, 'UTF-8');
        reader.onload = importJsonQuestions;
    }
    catch (error) {
        notify("danger", "Erreur pendant le chargement du fichier des questions.")
    }
}

jQuery(document).ready( function () {
    var splittedUrl = window.location.href.split('/');
    idCustomer = splittedUrl[splittedUrl.length-1];

    jQuery('#avatars-packs').dataTable({
        "language": { "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json" }
    });

    jQuery('#avatars-packs .btn').on('click', function(){
        addRemovePack(this);
    });

    jQuery('.user-mail').parent().find('button').on('click', function() {
        changeMail();
    });

    jQuery('.user-password').parent().find('button').on('click', function() {
        changePass();
    });

    jQuery('.user-api').parent().find('button').on('click', function() {
        changeAPI();
    });

    jQuery('#import-json').on('click', function(){
        importJson();
    });

    jQuery('label[for=file-surgeries]').on('drop', function(e){
        e.preventDefault();
        jQuery('#file-surgeries')[0].files = e.originalEvent.dataTransfer.files;
    });

    jQuery('label[for=file-patients]').on('drop', function(e){
        e.preventDefault();
        jQuery('#file-patients')[0].files = e.originalEvent.dataTransfer.files;
    });

    jQuery('label[for=file-materials]').on('drop', function(e){
        e.preventDefault();
        jQuery('#file-materials')[0].files = e.originalEvent.dataTransfer.files;
    });

    jQuery('label[for=file-questions]').on('drop', function(e){
        e.preventDefault();
        jQuery('#file-questions')[0].files = e.originalEvent.dataTransfer.files;
    });

    jQuery('#delete-user').on('click', function(e){
        //e.preventDefault();
        validate = confirm('Êtes-vous certain de vouloir supprimer cet utilisateur ?\nCela supprimera également toutes les chirurgies, patients, matériel et questions crées pas cet utilisateur')
        console.log(validate);
        if (!validate)
        {
            console.log('nop');
            e.preventDefault();
        }
        console.log(e);
    });

    jQuery('#generate-json').on('click', function(){
        let id = jQuery(this).attr('data-id');

        jQuery.ajax({
            method: 'POST',
            url: '/include/generatejson.php',
            data: {
                materials: true,
                questions: true,
                patients: true,
                surgeries: true,
                id: id
            }
        })
            .done(function(data){
                if (data == '1')
                {
                    var link = document.createElement("a");
                    link.download = 'configuration.zip';
                    link.href = '/assets/configuration.zip';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            });
    });
} );