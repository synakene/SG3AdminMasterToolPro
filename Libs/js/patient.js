//<editor-fold desc="Material handling">

function updateCategory()
{
    var category = jQuery('#materials-list').find('tr[data-option] .material-category select').val();
    var firstMat = '';

    jQuery('#materials-list').find('tr[data-option] .material-name option').each(function(){
        var id = parseInt(jQuery(this).val());

        // If good category AND material not already added
        if (jQuery(this).attr('data-category') === category && patient['materials'].indexOf(parseInt(id)) === -1)
        {
            if (firstMat === '')
            {
                firstMat = jQuery(this).val();
                jQuery('#materials-list').find('tr[data-option] .material-name select').val(firstMat);
            }
            jQuery(this).show();
        }
        else
        {
            jQuery(this).hide();
        }
    });

    // No material available
    if (firstMat === '')
    {
        jQuery("#materials-list tr[data-option] button.validate").addClass('disabled');
        jQuery(jQuery('#materials-list').find('tr[data-option] .material-name option')[0]).show()
        jQuery('#materials-list').find('tr[data-option] .material-name select').val('-1');
    }
    else
    {
        jQuery("#materials-list tr[data-option] button.validate").removeClass('disabled');
    }
}

function initMaterialData()
{
    // Init dropdown values
    var htmlCategoryDropdown = '';
    var categoriesUsed = [];
    var htmlNameDropdown = '<option data-category="" value="-1">Pas de matériel disponible</option>';

    for (var materialId in materials)
    {
        htmlNameDropdown += '<option data-category="' + materials[materialId]['category'] + '" value="' + materials[materialId]['id'] + '">' + materials[materialId]['name'] + '</option>';
        if (categoriesUsed.indexOf(materials[materialId]['category']) === -1)
        {
            categoriesUsed.push(materials[materialId]['category']);
            htmlCategoryDropdown += '<option value="' + materials[materialId]['category'] + '">' + materials[materialId]['category'] + '</option>';
        }

    }

    jQuery('#materials-list').find('tr[data-option] .material-category select').html(htmlCategoryDropdown);
    jQuery('#materials-list').find('tr[data-option] .material-name select').html(htmlNameDropdown);

    // Update availables materials when changing category
    jQuery('#materials-list').find('tr[data-option] .material-category select').on('change', function(){updateCategory()});
    updateCategory();
}

function addMaterial(id)
{
    var html =
        '<tr data-id=' + id + '>\n' +
        '<td><span class="material-category">' + materials[id]['category'] + '</span></td>\n' +
        '<td><span class="material-name">' + materials[id]['name'] + '</td>\n' +
        '<td><button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button></td>\n' +
        '<tr>';

    // Insert new row
    jQuery('#materials-list tr[data-option]').before(html);


    // Add delete listener
    jQuery('#materials-list tr[data-id=' + id + '] button.delete').on('click', function(){
        patient['materials'].splice(patient['materials'].indexOf(id), 1);
        jQuery(this).closest('tr[data-id]').remove();
        updateCategory();
    })
}

// Material data initialization
initMaterialData();
patient['materials'].forEach(function(material){
    addMaterial(material);
});

// Add material button
jQuery('#materials-list tr[data-option] button.validate').on('click', function(){
    var id = parseInt(jQuery('#materials-list').find('tr[data-option] .material-name select').val());
    if (id !== -1 && patient['materials'].indexOf(id) === -1)
    {
        addMaterial(id);
        patient['materials'].push(id);
        updateCategory();
    }
});

//</editor-fold>

//<editor-fold desc="Questions handling">

function addAnswer(id)
{
    if (questions[id] === undefined)
    {
        return false;
    }

    var html =
        '<tr data-id=' + id + '>\n' +
        '<td><span class="question-name">' + questions[id]['name'] + '</span></td>\n' +
        '<td><span class="question-question">' + questions[id]['question'] + '</span></td>\n' +
        '<td><input class="question-answer form-control" placeholder="' + questions[id]['answer'] + '"></td>\n' +
        '<td><button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button></td>\n' +
        '</tr>';

    // Insert new row
    jQuery('#questions-list tr[data-option]').before(html);


    // Add delete listener
    jQuery('#questions-list tr[data-id=' + id + '] button.delete').on('click', function(){
        var i = 0;
        patient['responses'].forEach(function(response){
            if (response['id'] === id)
            {
                patient['responses'].splice(i, 1);
                return;
            }
            ++i;
        });
        jQuery(this).closest('tr[data-id]').remove();
        showHideQuestions();
    })
}


function showHideQuestions()
{
    var activeQuestions = [];
    var firstId = -1;

    // Get active questions to hide doubles
    patient['responses'].forEach(function(question){
        activeQuestions.push(question['id'])
    });

    // Hide and show options
    jQuery('#questions-list').find('tr[data-option] select.question-name option').each(function(){
        var id = parseInt(jQuery(this).val());

        if (id !== -1 && activeQuestions.indexOf(id) === -1)
        {
            if (firstId === -1)
            {
                firstId = id;
            }

            jQuery(this).show();
        }
        else
        {
            jQuery(this).hide();
        }
    });

    jQuery('#questions-list').find('tr[data-option] select.question-name').val(firstId);
    updateQuestionHelper();
}


function updateQuestionHelper()
{
    var id = jQuery('#questions-list').find('tr[data-option] select.question-name').val();

    // If no question available
    if (id === -1 || questions[id] === undefined)
    {
        question = '';
        answer = '';
    }
    else
    {
        question = questions[id]['question'];
        answer = questions[id]['answer'];
    }

    jQuery('#questions-list').find('tr[data-option] span.question-question').html(question);
    jQuery('#questions-list').find('tr[data-option] span.question-answer').html(answer);
}


function initQuestionsData()
{
    // Init dropdown values
    var htmlQuestionsDropdown = '';

    for (var question in questions)
    {
        htmlQuestionsDropdown += '<option value="' + questions[question]['id'] + '">' + questions[question]['name'] + '</option>';
    }

    htmlQuestionsDropdown += '<option value="-1">Pas de questions disponible</option>';


    jQuery('#questions-list').find('tr[data-option] select.question-name').html(htmlQuestionsDropdown);

    // Update availables materials when changing category
    jQuery('#questions-list').find('tr[data-option] select.question-name').on('change', function(){updateQuestionHelper()});
}


// Data init
initQuestionsData();
patient['responses'].forEach(function(question){
    addAnswer(question['id']);
    jQuery('#questions-list tr[data-id=' + question['id'] + '] input.question-answer').val(question['answer'])
});
showHideQuestions();

// Add button interaction
jQuery('#questions-list tr[data-option] button.validate').on('click', function(){
    var id = parseInt(jQuery('#questions-list').find('tr[data-option] select.question-name').val());

    if (id != undefined && id !== -1)
    {
        addAnswer(id);
        patient['responses'].push({'id': id, 'answer': ''});
        showHideQuestions();
    }
});

//</editor-fold>

//<editor-fold desc="Surgeries handling">

function showHideSurgeries()
{
    var firstId = -1;

    // Hide and show options
    jQuery('#surgeries-list').find('tr[data-option] select.surgery-name option').each(function(){
        var id = parseInt(jQuery(this).val());

        if (id !== -1 && patient['surgeries'].indexOf(id) === -1)
        {
            if (firstId === -1)
            {
                firstId = id;
            }

            jQuery(this).show();
        }
        else
        {
            jQuery(this).hide();
        }
    });

    jQuery('#surgeries-list').find('tr[data-option] select.surgery-name').val(firstId);
}

function addSurgery(id)
{
    var html =
        '<tr data-id=' + id + '>' +
        '<td><span class="surgery-name">' + surgeries[id]['name'] + '</span></td>' +
        '<td><button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button></td>' +
        '<tr>';

    // Insert new row
    jQuery('#surgeries-list tr[data-option]').before(html);

    // Add delete listener
    jQuery('#surgeries-list tr[data-id=' + id + '] button.delete').on('click', function(){
        patient['surgeries'].splice(patient['surgeries'].indexOf(id), 1);
        jQuery(this).closest('tr[data-id]').remove();
        showHideSurgeries();
    });
}


function initSurgeriesData()
{
    // Make index of array same as id for better handling
    var surgeriesWithIndex = [];

    // Init dropdown values
    var htmlSurgeriesDropdown = '';

    for (var surgeryId in surgeries)
    {
        htmlSurgeriesDropdown += '<option value="' + surgeries[surgeryId]['id'] + '">' + surgeries[surgeryId]['name'] + '</option>';
    }

    htmlSurgeriesDropdown += '<option value="-1">Pas de chirurgie disponible</option>';

    jQuery('#surgeries-list').find('tr[data-option] select.surgery-name').html(htmlSurgeriesDropdown);
}


// Data init
initSurgeriesData();
patient['surgeries'].forEach(function(patient){
    addSurgery(patient);
});
showHideSurgeries();
jQuery('.patient-sex').val(patient['sex']);


// Add button interaction
jQuery('#surgeries-list tr[data-option] button.validate').on('click', function(){
    var id = parseInt(jQuery('#surgeries-list').find('tr[data-option] select.surgery-name').val());

    if (id != undefined && id !== -1)
    {
        addSurgery(id);
        patient['surgeries'].push(id);
        showHideSurgeries();
    }
});

//</editor-fold>

jQuery('.hideable').each(function(){this.style.cursor = 'pointer'});
jQuery('.hideable').on('click', function(){
    jQuery(this).closest('.panel').find('.panel-body').slideToggle()
});

function save()
{
    // Take updated answer values
    patient['responses'].forEach(function(element){
        element['answer'] = jQuery('#questions-list tr[data-id=' + element['id'] + '] .question-answer').val()
    });

    patient['firstname'] = jQuery('.patient-firstname').val();
    patient['lastname'] = jQuery('.patient-lastname').val();
    patient['sex'] = jQuery('.patient-sex').val();
    patient['age'] = jQuery('.patient-age').val();
    patient['height'] = jQuery('.patient-height').val();
    patient['weight'] = jQuery('.patient-weight').val();

    // Prevent from click bashing
    jQuery('button.save').off();
    jQuery('button.save').addClass('disabled');
    jQuery('button.save i').removeClass('fa-floppy-o');
    jQuery('button.save i').addClass('fa-cog faa-spin animated');

    // Prepare data to send
    var sendData = {
        'id': patient['id'],
        'surgeries': patient['surgeries'],
        'materials': patient['materials'],
        'responses': patient['responses'],
        'firstname': patient['firstname'],
        'lastname': patient['lastname'],
        'sex': patient['sex'],
        'age': patient['age'],
        'height': patient['height'],
        'weight': patient['weight']
    };

    jQuery.ajax({
        method: 'POST',
        url: '/include/ajax-api.php',
        data: {
            action: "saveData",
            type: "patient",
            data: sendData
        }
    })
        .done(function(data){
            jQuery('button.save').on('click', function(){
                save();
            });
            jQuery('button.save').removeClass('disabled');
            jQuery('button.save i').removeClass('fa-cog faa-spin animated');
            jQuery('button.save i').addClass('fa-floppy-o');

            jQuery('h1.page-header').text(patient['firstname'] + ' ' + patient['lastname']);
            jQuery('ol.breadcrumb .active span').text(patient['firstname'] + ' ' + patient['lastname'])

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

jQuery('button.save').on('click', function(){
    save();
});