var categories = [];
var curCategory = "all";
var i = 1;

function interactWithMat(index)
{
    jQuery('#materials-list tr[data-id]').each(function(){
        if (jQuery(this).attr('data-id') === index)
        {
            // Si bon index créé 2 inputs pour mat et cat.
            jQuery(this).find('td span').each(function(){
                jQuery(this).replaceWith('<input type="text" data-id="' + jQuery(this).attr('data-id') + '" class="form-control" value="' + jQuery(this).text() + '" tabindex="0">')
            });

            var that = this;
            // Créer le listener ajax quand focus out
            jQuery(this).find('td input').off()
            jQuery(this).find('td input').focusout(function(){
                var category = jQuery('input[data-id]').eq(1).val();
                jQuery(that).attr('data-category', category);
                updateCategories();
                var data = {'id':jQuery('input[data-id]').attr('data-id'), 'name':jQuery('input[data-id]').eq(0).val(), 'category':category};
                console.log(data);
                if (categories.indexOf(category) === -1)
                {
                    console.log('new category');
                    categories.push(category);
                }

                that = this;
                // TODO réseau chiant : bloquer la modif tant que pas de validation
                jQuery.ajax({
                    method: 'POST',
                    url: 'ajax-api.php',
                    data: {
                        action: "saveData",
                        type: "material",
                        data: data
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
            });
        }
        else
        {
            jQuery(this).find('td input').each(function(){
                jQuery(this).replaceWith('<span data-id="' + jQuery(this).attr('data-id') + '">' + jQuery(this).val() + '</span>')
            });
        }
        ++i;
    })
}

function updateMatDisplay() {
    jQuery('#materials-list tr[data-category]').each(function(){
        var attr = jQuery(this).attr('data-category');

        if (curCategory === "all" || curCategory === attr)
        {
            jQuery(this).show();

            // Create inputs on focus
            jQuery(this).off();
            jQuery(this).focusin(function(){
                interactWithMat(jQuery(this).attr('data-id'));
            });
        }
        else
        {
            jQuery(this).hide();
        }
        ++i;
    });
}
updateMatDisplay();


function changeCategoryHandlerInit() {
    jQuery('#category-slider a').off('click');
    jQuery('#category-slider a').on('click', function(){
        if (categories.indexOf(this.text) !== -1)
        {
            jQuery('#category-slider-main').text('Catégorie : ' + this.text);
            curCategory = this.text;
            jQuery('#category-slider-wrapper').slideToggle('fast');
            updateMatDisplay();
        }
        else if (this.text === "Toutes")
        {
            jQuery('#category-slider-main').text('Catégorie : Toutes');
            curCategory = "all";
            jQuery('#category-slider-wrapper').slideToggle('fasr');
            updateMatDisplay();
        }
    });
}
changeCategoryHandlerInit();


// Add category button interactivity
$('#add-category button').on('click', function(){
    var category = $('#add-category input').val();
    if(category == '')
    {
        notify('danger', 'La catégorie n\'a pas de nom');
    }
    else if (categories.indexOf($('#add-category input').val()) === -1)
    {
        notify('success', 'Catégorie ' + category + ' créée');
        categories.push(category);
        updateCategories();
    }
    else
    {
        notify('danger', 'La catégorie ' + category + ' existe déjà');
    }
});

function updateCategories()
{
    $('tr[data-category]').each(function(){
        var category = jQuery(this).attr('data-category');

        if (categories.indexOf(category) == -1)
        {
            categories.push(category);
        }
    });

    jQuery('#category-slider').html('');

    jQuery('#category-slider').append('<a href="#" class="list-group-item">Toutes</a>');
    categories.forEach(function(element){
        jQuery('#category-slider').append('<a href="#" class="list-group-item">' + element + '</a>');
    });

    changeCategoryHandlerInit();
}
updateCategories();


// Add slider interactivity
jQuery('#category-slider-main').on('click', function(){jQuery('#category-slider-wrapper').slideToggle('fast')});


// Add create material interactivity
jQuery('#button-add').on('click', function(){
    jQuery.ajax({
        method: 'POST',
        url: 'ajax-api.php',
        data: {
            action: "getValidId",
            type: "material"
        }
    })
        .done(function(data){
            console.log(data);
            data = data.split('<br>');
            if (data[0] === '1')
            {
                var id = data[1];
                console.log(id);
                var html = '<tr data-id = ' + id + ' data-category="" tabindex=0>' +
                    '<td><input data-id=' + id + ' class="form-control value="" tabindex=0></td>' +
                    '<td><input data-id=' + id + ' class="form-control value="" tabindex=0></td>' +
                    '<td><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button></td>' +
                    '</tr>';
                jQuery('#materials-list').append(html);
                updateMatDisplay();
            }
        });
});


jQuery('#materials-list button[data-id]').on('click', function(){
    var data = {'id':jQuery(this).atr('data-id')};

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
            }
            else
            {
                notify('danger', data[1]);
            }
        });
});

