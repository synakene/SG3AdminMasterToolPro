//<editor-fold desc="Material handling">

function updateCategory()
{
    var category = jQuery('#materials-list').find('tr[data-option] .material-category select').val();
    var firstMat = '';

    jQuery('#materials-list').find('tr[data-option] .material-name option').each(function(){
        var id = parseInt(jQuery(this).val());

        // If good category AND material not already added
        if (jQuery(this).attr('data-category') === category && surgery['materials'].indexOf(parseInt(id)) === -1)
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
    // Make index of array same as id for better handling
    var mat_with_index = [];

    // Init dropdown values
    var htmlCategoryDropdown = '';
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

// Buttons interactions
// Add material
jQuery('#materials-list tr[data-option] button.validate').on('click', function(){
    var id = parseInt(jQuery('#materials-list').find('tr[data-option] .material-name select').val());
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
    // TODO ajouter des notify PARTOUUUUUT yeahaa
    // TODO valeur existante ou par defaut
    var html =
        '<tr data-id=' + id + '>\n' +
            '<td><span class="question-name">' + questions[id]['questionName'] + '</span></td>\n' +
            '<td><span class="question-question">' + questions[id]['question'] + '</span></td>\n' +
            '<td><input class="question-answer form-control" placeholder="' + questions[id]['answer'] + '"></td>\n' +
            '<td><button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button></td>\n' +
        '<tr>';

    // Insert new row
    jQuery('#questions-list tr[data-option]').before(html);


    // Add delete listener
    // TODO chercher l'index
    /*jQuery('#questions-list tr[data-id=' + id + '] button.delete').on('click', function(){
        surgery['responses'].splice(surgery['materials'].indexOf(id), 1);
        jQuery(this).closest('tr[data-id]').remove();
        updateCategory();
    })*/
}

function updateQuestion()
{
    var activeQuestions = [];
    var nothingAvailable = true;

    // Get active questions to hide doubles
    surgery['responses'].forEach(function(question){
        console.log(question);
        activeQuestions.push(question['id'])
    });

    console.log(activeQuestions);

    jQuery('#questions-list').find('tr[data-option] select.question-name option').each(function(){
        var id = parseInt(jQuery(this).val());
        console.log(id);

        if (id !== -1 && activeQuestions.indexOf(id) === -1)
        {
            // TODO a toast
            nothingAvailable = false;
            console.log(questions[id]);
            // changer le span de droite, a bouger : pas sa place
            //jQuery('#questions-list').find('tr[data-option] span.question-answer').html(questions[id]['answer']);
        }
    });

    if (nothingAvailable === true)
    {
        jQuery('#questions-list').find('tr[data-option] select.question-name').val("-1");
        jQuery('#questions-list').find('tr[data-option] span.question-answer').html("Pas de question disponible");
    }
}

function initQuestionsData()
{
    // Make index of array same as id for better handling
    var questions_with_index = [];

    // Init dropdown values
    var htmlQuestionsDropdown = '<option value="-1"></option>';

    questions.forEach(function(question){
        htmlQuestionsDropdown += '<option value="' + question['id'] + '">' + question['name'] + '</option>';
        questions_with_index[question['id']] = question;
    });

    questions = questions_with_index;

    jQuery('#questions-list').find('tr[data-option] select.question-name').html(htmlQuestionsDropdown);

    // Update availables materials when changing category
    jQuery('#questions-list').find('tr[data-option] select.question-name').on('change', function(){updateQuestion()});
    updateQuestion();
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

//</editor-fold>

// Material data initialization
initMaterialData();
surgery['materials'].forEach(function(material){
    addMaterial(material);
});

initQuestionsData();
surgery['responses'].forEach(function(question){
    addAnswer(question['id']);
});

jQuery('.hideable').each(function(){this.style.cursor = 'pointer'})
jQuery('.hideable').on('click', function(){
    jQuery(this.closest('.panel')).find('.panel-body').slideToggle()
});