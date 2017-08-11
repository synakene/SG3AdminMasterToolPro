function createInput(id)
{
    var spanName = jQuery('#questions-list').find('tr[data-id=' + id + '] .question-name').text();
    var html ='<input class="form-control question-name" value="' + spanName + '">';
    jQuery('#questions-list').find('tr[data-id=' + id + '] .question-name').replaceWith(html);

    var spanAnswer = jQuery('#questions-list').find('tr[data-id=' + id + '] .question-answer').text();
    html ='<input class="form-control question-answer" value="' + spanAnswer + '">';
    jQuery('#questions-list').find('tr[data-id=' + id + '] .question-answer').replaceWith(html);
}


function createSpan(id)
{
    var inputName = jQuery('#questions-list').find('tr[data-id=' + id + '] .question-name').val();
    var html = '<span class="question-name">' + inputName + '</span>';
    jQuery('#questions-list').find('tr[data-id=' + id + '] .question-name').replaceWith(html);


    var inputAnswer = jQuery('#questions-list').find('tr[data-id=' + id + '] .question-answer').val();
    html = '<span class="question-answer">' + inputAnswer + '</span>';
    jQuery('#questions-list').find('tr[data-id=' + id + '] .question-answer').replaceWith(html);
}


function validate(id)
{
    var tr = jQuery('#questions-list tr[data-id=' + id + ']');
    var sendData = {'id':jQuery(tr).attr('data-id'), 'name':jQuery(tr).find('.question-name').val(), 'answer':jQuery(tr).find('.question-answer').val()};

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
        });
}


function updateQuestionsInteraction()
{
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
            validate(jQuery(that).attr('data-id'));
        });

        jQuery(this).find('.delete').off();
        jQuery(this).find('.delete').on('click', function(){
            var data = {'id': jQuery(that).attr('data-id')};
            jQuery.ajax({
                method: 'POST',
                url: 'ajax-api.php',
                data: {
                    action: "deleteData",
                    type: "material",
                    data: data
                }
            })
                .done(function(data){
                    data = data.split('<br>');
                    if (data[0] === '1')
                    {
                        notify('success', data[1]);
                        jQuery(that).remove();
                    }
                    else
                    {
                        notify('danger', data[1]);
                    }
                });
        })
    });
}


function addQuestion()
{
    jQuery.ajax({
        method: 'POST',
        url: '/include/ajax-api.php',
        data: {
            action: "getValidId",
            type: "question"
        }
    })
        .done(function(data){
            console.log(data);
            data = data.split('<br>');
            if (data[0] === '1')
            {
                var id = data[1];
                var html = '<tr data-id = ' + id + '>' +
                    '<td><span class="question-name"></span></td>' +
                    '<td><span class="question-answer"></span></td>' +
                    '<td>' +
                        '<button class="btn btn-sm btn-primary faa-parent animated-hover modify"><i class="fa fa-wrench faa-wrench"></i></button>' +
                        '<button class="btn btn-sm btn-success faa-parent animated-hover validate" style="display: none"><i class="fa fa-check faa-pulse"></i></button>' +
                        '<button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button>' +
                    '</td>' +
                    '</tr>';

                jQuery('#questions-list').append(html);
                updateQuestionsInteraction();

                jQuery('#questions-list tr[data-id=' + id + '] .modify').click();
            }
            else
            {
                notify('danger', 'Impossible de créer une question, contactez votre webmaster.');
            }
        });
}

// Table interactions
updateQuestionsInteraction();

// Buttons
jQuery('.button-add').on('click', function(){ addQuestion() });
jQuery('.button-save-all').on('click', function(){
    jQuery('#materials-list tr[data-id]').each(function(){
        if (jQuery(this).find('.modify').css('display') === 'none')
        {
            validate(this);
        }
    })
});