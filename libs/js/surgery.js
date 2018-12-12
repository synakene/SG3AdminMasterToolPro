//<editor-fold desc="Material handling">

function updateCategory()
{
    var category = jQuery('#materials-list').find('tr[data-option] .material-category select').val();
    var firstMat = '';

    jQuery('#materials-list').find('tr[data-option] .material-name option').each(function(){
        var id = parseInt(jQuery(this).val());

        // If good category AND material not already added
        if ((jQuery(this).attr('data-category') === category || (category === '0' && id !== -1)) && surgery['materials'].indexOf(parseInt(id)) === -1)
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
        jQuery("#materials-list tr[data-option] button.validateMaterial").addClass('disabled');
        jQuery(jQuery('#materials-list').find('tr[data-option] .material-name option')[0]).show()
        jQuery('#materials-list').find('tr[data-option] .material-name select').val('-1');
    }
    else
    {
        jQuery("#materials-list tr[data-option] button.validateMaterial").removeClass('disabled');
    }
}

function initMaterialData()
{
    // Make index of array same as id for better handling
    var mat_with_index = [];

    // Init dropdown values
    var htmlCategoryDropdown = '<option value="0">Tous</option>';
    var categoriesUsed = [];
    var htmlNameDropdown = '<option data-category="" value="-1">Pas de matériel disponible</option>';

    materials.forEach(function(material){
        htmlNameDropdown += '<option data-category="' + material['category'] + '" value="' + material['id'] + '">' + material['name'] + '</option>';
        if (categoriesUsed.indexOf(material['category']) === -1)
        {
            categoriesUsed.push(material['category']);
            htmlCategoryDropdown += '<option value="' + material['category'] + '">' + material['category'] + '</option>';
        }

        mat_with_index[material['id']] = material;
    });

    materials = mat_with_index;

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
        surgery['materials'].splice(surgery['materials'].indexOf(id), 1);
        jQuery(this).closest('tr[data-id]').remove();
        updateCategory();
    })
}



// Material data initialization
initMaterialData();
surgery['materials'].forEach(function(material){
    addMaterial(material);
});

// Add material button
jQuery('#materials-list tr[data-option] button.validate').on('click', function(){
    var id = parseInt(jQuery('#materials-list').find('tr[data-option] .material-name select').val());
    console.log("adding " + id + "listener");
    if (id !== -1 && surgery['materials'].indexOf(id) === -1)
    {
        addMaterial(id);
        surgery['materials'].push(id);
        updateCategory();
    }
});

//</editor-fold>

//<editor-fold desc="Questions handling">


function addAnswer(id)
{
    if (questions[id] === undefined)
    {
        console.log('question inconnu');
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
        surgery['responses'].forEach(function(response){
            if (response['id'] === id)
            {
                surgery['responses'].splice(i, 1);
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
    surgery['responses'].forEach(function(question){
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
    // Make index of array same as id for better handling
    var questions_with_index = [];

    // Init dropdown values
    var htmlQuestionsDropdown = '';

    questions.forEach(function(question){
        htmlQuestionsDropdown += '<option value="' + question['id'] + '">' + question['name'] + '</option>';
        questions_with_index[question['id']] = question;
    });

    htmlQuestionsDropdown += '<option value="-1">Pas de questions disponible</option>';

    questions = questions_with_index;

    jQuery('#questions-list').find('tr[data-option] select.question-name').html(htmlQuestionsDropdown);

    // Update availables materials when changing category
    jQuery('#questions-list').find('tr[data-option] select.question-name').on('change', function(){updateQuestionHelper()});
}


// Data init
initQuestionsData();
surgery['responses'].forEach(function(question){
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
        surgery['responses'].push({'id': id, 'name': questions[id]['questionName'], 'question': questions[id]['question'], 'answer': ''});
        showHideQuestions();
    }
});

//</editor-fold>

//<editor-fold desc="Patients handling">

function showHidePatients()
{
    var firstId = -1;

    // Hide and show options
    jQuery('#patients-list').find('tr[data-option] select.patient-name option').each(function(){
        var id = parseInt(jQuery(this).val());

        if (id !== -1 && surgery['compatibles'].indexOf(id) === -1)
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

    jQuery('#patients-list').find('tr[data-option] select.patient-name').val(firstId);
}

function addPatient(id)
{
    var html =
        '<tr data-id=' + id + '>' +
            '<td><span class="patient-name">' + patients[id]['firstname'] + ' ' + patients[id]['lastname'] + '</span></td>' +
            '<td><button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button></td>' +
        '<tr>';

    // Insert new row
    jQuery('#patients-list tr[data-option]').before(html);

    // Add delete listener
    jQuery('#patients-list tr[data-id=' + id + '] button.delete').on('click', function(){
        surgery['compatibles'].splice(surgery['compatibles'].indexOf(id), 1);
        jQuery(this).closest('tr[data-id]').remove();
        showHidePatients();
    });
}


function initPatientsData()
{
    // Make index of array same as id for better handling
    var patientsWithIndex = [];

    // Init dropdown values
    var htmlPatientsDropdown = '';

    patients.forEach(function(patient){
        htmlPatientsDropdown += '<option value="' + patient['id'] + '">' + patient['firstname'] + ' ' + patient['lastname'] + '</option>';
        patientsWithIndex[patient['id']] = patient;
    });

    htmlPatientsDropdown += '<option value="-1">Pas de patient disponible</option>';

    patients = patientsWithIndex;

    jQuery('#patients-list').find('tr[data-option] select.patient-name').html(htmlPatientsDropdown);
}


// Data init
initPatientsData();
surgery['compatibles'].forEach(function(patient){
    addPatient(patient);
});
showHidePatients();


// Add button interaction
jQuery('#patients-list tr[data-option] button.validate').on('click', function(){
    var id = parseInt(jQuery('#patients-list').find('tr[data-option] select.patient-name').val());

    if (id != undefined && id !== -1)
    {
        addPatient(id);
        surgery['compatibles'].push(id);
        showHidePatients();
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
    surgery['responses'].forEach(function(element){
        element['answer'] = jQuery('#questions-list tr[data-id=' + element['id'] + '] .question-answer').val()
    });

    surgery['name'] = jQuery('.surgery-name').val();
    surgery['lastEval'] = jQuery('input.surgery-last-eval').val();
    surgery['emergency'] = jQuery('input.surgery-emergency:checked').length === 1
    surgery['consultation'] = jQuery('input.surgery-emergency:checked').length === 1;
    surgery['story'] = jQuery('textarea.surgery-story').val();
    surgery['preAnestheticVisit'] = jQuery('textarea.surgery-pre-anesthetic-visit').val();
    surgery['marPropositionText'] = jQuery('input.surgery-mar-proposition-text').val();
    surgery['feedback'] = jQuery('textarea.surgery-feedback').val();

    var mar = 0;
    mar += jQuery('input.surgery-mar-ag:checked').length === 1 ? 1 : 0;
    mar += jQuery('input.surgery-mar-bis:checked').length === 1 ? 2 : 0;
    surgery.marProposition = mar;

    // Prevent from click bashing
    btn = jQuery('button.save');
    jQuery(btn).off();
    jQuery(btn).addClass('disabled');
    jQuery(btn).find('i').removeClass('fa-floppy-o');
    jQuery(btn).find('i').addClass('fa-cog faa-spin animated');

    // Prepare data to send
    var sendData = {
        'id': surgery['id'],
        'emergency': surgery['emergency'],
        'compatibles': surgery['compatibles'],
        'materials': surgery['materials'],
        'responses': surgery['responses'],
        'name': surgery['name'],
        'story': surgery['story'],
        'surgery': surgery
    };

    jQuery.ajax({
        method: 'POST',
        url: '/include/ajax-api.php',
        data: {
            action: "saveData",
            type: "surgery",
            data: sendData
        }
    })
        .done(function(data){
            jQuery(btn).on('click', function(){
                save();
            });
            jQuery(btn).removeClass('disabled');
            jQuery(btn).find('i').removeClass('fa-cog faa-spin animated');
            jQuery(btn).find('i').addClass('fa-floppy-o');

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
    save()
});

jQuery(window).bind('keydown', function(event) {
    if ((event.ctrlKey || event.metaKey) && event.which === 83) {
        event.preventDefault();
        save();
    }
});