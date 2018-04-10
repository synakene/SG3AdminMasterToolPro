var datatable = undefined;

function createInput(id)
{
    var spanName = jQuery('#questions-list').find('tr[data-id=' + id + '] .question-name').text();
    var html ='<input class="form-control question-name" value="' + spanName + '">';
    jQuery('#questions-list').find('tr[data-id=' + id + '] .question-name').replaceWith(html);

    var spanQuestion = jQuery('#questions-list').find('tr[data-id=' + id + '] .question-question').text();
    var html ='<input class="form-control question-question" value="' + spanQuestion + '">';
    jQuery('#questions-list').find('tr[data-id=' + id + '] .question-question').replaceWith(html);

    var spanAnswer = jQuery('#questions-list').find('tr[data-id=' + id + '] .question-answer').text();
    html ='<input class="form-control question-answer" value="' + spanAnswer + '">';
    jQuery('#questions-list').find('tr[data-id=' + id + '] .question-answer').replaceWith(html);
}


function createSpan(id)
{
    var inputName = jQuery('#questions-list').find('tr[data-id=' + id + '] .question-name').val();
    var html = '<span class="question-name">' + inputName + '</span>';
    jQuery('#questions-list').find('tr[data-id=' + id + '] .question-name').replaceWith(html);

    var inputQuestion = jQuery('#questions-list').find('tr[data-id=' + id + '] .question-question').val();
    var html = '<span class="question-question">' + inputQuestion + '</span>';
    jQuery('#questions-list').find('tr[data-id=' + id + '] .question-question').replaceWith(html);

    var inputAnswer = jQuery('#questions-list').find('tr[data-id=' + id + '] .question-answer').val();
    html = '<span class="question-answer">' + inputAnswer + '</span>';
    jQuery('#questions-list').find('tr[data-id=' + id + '] .question-answer').replaceWith(html);
}


function validate(id)
{
    console.log("validate " + id);
    var tr = jQuery('#questions-list tr[data-id=' + id + ']');
    var sendData = {'id':jQuery(tr).attr('data-id'), 'name':jQuery(tr).find('.question-name').val(), 'question':jQuery(tr).find('.question-question').val(), 'answer':jQuery(tr).find('.question-answer').val()};
    console.log(sendData);

    $(tr).find(".validate").removeClass('animated-hover faa-parent').addClass('disabled').off();
    $(tr).find(".validate i").removeClass('faa-pulse fa-check').addClass('faa-spin fa-cog animated');

    jQuery.ajax({
        method: 'POST',
        url: '/include/ajax-api.php',
        data: {
            action: "saveData",
            type: "question",
            data: sendData
        }
    })
        .done(function(data){
            $(tr).find(".validate").removeClass('disabled').addClass('animated-hover faa-parent');
            $(tr).find(".validate i").removeClass('faa-spin fa-cog animated').addClass('faa-pulse fa-check');

            data = data.split('<br>');
            if (data[0] === '1')
            {
                notify('success', data[1]);
                createSpan(jQuery(tr).attr('data-id'));
                jQuery(tr).find('.modify').show();
                jQuery(tr).find('.validate').hide();
            }
            else
            {
                notify('danger', data[1]);
            }

            updateQuestionsInteraction();
        });
}


function remove(id)
{
    let jQueryTR = jQuery('tr[data-id=' + id + ']');
    $(jQueryTR).find('.delete').removeClass('animated-hover faa-parent').addClass('disabled').off();
    $(jQueryTR).find(".delete i").removeClass('faa-flash fa-times').addClass('faa-spin fa-cog animated');

    var data = {'id': id};
    jQuery.ajax({
        method: 'POST',
        url: 'include/ajax-api.php',
        data: {
            action: "deleteData",
            type: "question",
            data: data
        }
    })
        .done(function(data){
            $(jQueryTR).find('.delete').removeClass('disabled').addClass('animated-hover faa-parent');
            $(jQueryTR).find(".delete i").find("i").removeClass('faa-spin fa-cog animated').addClass('faa-flash fa-times');

            data = data.split('<br>');
            console.log(data['id'] + " deleted, return " + data[0]);
            if (data[0] === '1')
            {
                notify('success', data[1]);
                datatable.fnDestroy();
                jQuery(jQueryTR).remove();
                initDatatable();
                jQuery('.loading').fadeOut('fast');
            }
            else
            {
                notify('danger', data[1]);
            }

            updateQuestionsInteraction();
        });
}


function initDatatable()
{
    $('.loading').fadeIn('fast');
    datatable = $('table.table').dataTable({
        "language": {"url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"},
        columnDefs: [
            { targets: 'no-sort', orderable: false }
        ],
    });
}

function updateQuestionsInteraction()
{
    $('.loading').fadeIn('fast');
    if (datatable != undefined)
    {
        datatable.fnDestroy()
    }
    initDatatable();

    jQuery('#questions-list tr[data-id]').each(function(){
        var that = this;

        // Modify interaction
        jQuery(this).find('.modify').off();
        jQuery(this).find('.modify').on('click', function(){
            jQuery(that).find('.modify').hide();
            jQuery(that).find('.validate').show();
            createInput(jQuery(that).attr('data-id'));
        });

        // Validate interaction
        jQuery(this).find('.validate').off();
        jQuery(this).find('.validate').on('click', function(){
            jQuery(this).find('.validate').off();
            validate(jQuery(that).attr('data-id'));
        });

        jQuery(this).find('.delete').off();
        jQuery(this).find('.delete').on('click', function(){
            jQuery(this).find('.delete').off();
            remove(jQuery(that).attr('data-id'));
            /*var data = {'id': jQuery(that).attr('data-id')};
            console.log(data);
            jQuery.ajax({
                method: 'POST',
                url: 'include/ajax-api.php',
                data: {
                    action: "deleteData",
                    type: "question",
                    data: data
                }
            })
                .done(function(data){
                    data = data.split('<br>');
                    console.log(data['id'] + " deleted, return " + data[0]);
                    if (data[0] === '1')
                    {
                        notify('success', data[1]);
                        jQuery(that).remove();
                    }
                    else
                    {
                        notify('danger', data[1]);
                    }
                });*/
        });
    });

    $('.loading').fadeOut('fast');
}


function addQuestion()
{
    $('form .id').val('');
    $('form .question').val('');
    $('form .response').val('');

    $('form').slideDown(400, function() {
        $('form input .id').focus();
    });
}


function createQuestion()
{
    let name = $('form .id').val();
    let question = $('form .question').val();
    let response = $('form .response').val();


    if (name === '' || question === '' || response === '')
    {
        notify("danger", "Informations manquantes");
        return;
    }

    $('form input[type=submit]').prop('disabled', true);

    var sendData = {
        id: 'new',
        name: name,
        question: question,
        answer: response
    };

    jQuery.ajax({
        method: 'POST',
        url: '/include/ajax-api.php',
        data: {
            action: "saveData",
            type: "question",
            data: sendData
        }
    })
        .done(function(data){
            $('form input[type=submit]').prop('disabled', false);

            data = data.split('<br>');
            if (data[0] === '1')
            {
                $('form').slideUp();
                notify('success', data[1]);

                let tr = '<tr data-id="' + data[2] + '">' +
                    '<td><span class="question-name">' + name + '</span></td>' +
                    '<td><span class="question-question">' + question + '</span></td>' +
                    '<td><span class="question-answer">' + response + '</span></td>' +
                    '<td>' +
                    '<button class="btn btn-sm btn-primary faa-parent animated-hover modify"><i class="fa fa-wrench faa-wrench"></i></button>' +
                    '<button class="btn btn-sm btn-success faa-parent animated-hover validate" style="display: none"><i class="fa fa-check faa-pulse"></i></button>&nbsp' +
                    '<button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button>' +
                    '</td></tr>';

                datatable.fnDestroy();
                $('#questions-list').append(tr);

                updateQuestionsInteraction();
            }
            else
            {
                notify('danger', data[1]);
            }
        });
}


$(document).ready(function() {
    // Table interactions
    updateQuestionsInteraction();

    // Buttons
    jQuery('.button-add').on('click', function(){ addQuestion() });
    jQuery('.button-save-all').on('click', function(){
        jQuery('#questions-list tr[data-id]').each(function(){
            var id = jQuery(this).attr('data-id');
            if (jQuery(this).find('.modify').css('display') === 'none')
            {
                validate(id);
            }
        })
    });

    // Add question form interaction
    jQuery('form').hide();
    jQuery('form button.btn-danger').on('click', function(){
        $('form').slideUp(400);
    });
    jQuery('form').on('submit', function(e){
        e.preventDefault();
        createQuestion();
    })
});