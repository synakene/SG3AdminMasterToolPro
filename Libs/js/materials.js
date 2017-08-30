curCategory = 'all';


function refreshCategoriesInteractions()
{
    jQuery('#category-slider a').off('click');
    jQuery('#category-slider a').on('click', function(){
        var cat = '';
        if (categories.indexOf(this.text) !== -1)
        {
            cat = this.text;
        }
        else if (this.text === "Toutes")
        {
            cat = "all"
        }
        else
        {
            return;
        }

        jQuery('#category-slider-main').text('Catégorie : ' + cat);
        curCategory = cat;
        jQuery('#category-slider-wrapper').slideToggle('fast');
        updateMatDisplay();
        updateMatInteraction();
    });
}


function updateMatDisplay()
{
    jQuery('#materials-list tr[data-category]').each(function(){
        var attr = jQuery(this).attr('data-category');

        if (curCategory === 'all' || curCategory === attr)
        {
            jQuery(this).show();
        }
        else
        {
            jQuery(this).hide();
        }
    });
}


function createInput(id)
{
    var spanName = jQuery('#materials-list').find('tr[data-id=' + id + '] .material-name').text();
    var spanCategory = jQuery('#materials-list').find('tr[data-id=' + id + '] .material-category').text();


    var html ='<input data-id="' + id + '" class="form-control material-name" value="' + spanName + '">';
    jQuery('#materials-list').find('tr[data-id=' + id + '] .material-name').replaceWith(html);


    html = '<select class="form-control material-category"><option>' + spanCategory + '</option>';
    categories.forEach(function(category){
        if (category === '' || category == spanCategory)
        {
            return;
        }
        html += '<option>' + category + '</option>';
    });
    html += '</select>';
    jQuery('#materials-list').find('tr[data-id=' + id + '] .material-category').replaceWith(html);
}


function createSpan(id)
{
    var inputName = jQuery('#materials-list').find('tr[data-id=' + id + '] .material-name').val();
    var inputCategory = jQuery('#materials-list').find('tr[data-id=' + id + '] .material-category').val();


    var html = '<span class="material-name">' + inputName + '</span>';
    jQuery('#materials-list').find('tr[data-id=' + id + '] .material-name').replaceWith(html);


    html = '<span class="material-category">' + inputCategory + '</span>';
    jQuery('#materials-list').find('tr[data-id=' + id + '] .material-category').replaceWith(html);
}


function validate(jQueryTR)
{
    var sendData = {'id':jQuery(jQueryTR).attr('data-id'), 'name':jQuery(jQueryTR).find('.material-name').val(), 'category':jQuery(jQueryTR).find('.material-category').val()};

    jQuery.ajax({
        method: 'POST',
        url: '/include/ajax-api.php',
        data: {
            action: "saveData",
            type: "material",
            data: sendData
        }
    })
        .done(function(data){
            data = data.split('<br>');
            if (data[0] === '1')
            {
                notify('success', data[1]);
                createSpan(jQuery(jQueryTR).attr('data-id'));
                jQuery(jQueryTR).attr('data-category', sendData['category']);
                jQuery(jQueryTR).find('.modify').show();
                jQuery(jQueryTR).find('.validate').hide();
            }
            else
            {
                notify('danger', data[1]);
            }
        });
}


function updateMatInteraction()
{
    jQuery('#materials-list tr[data-category]').each(function(){
        var category = jQuery(this).find('.material-category').text();
        if (category === undefined)
        {
            category = jQuery(this).find('.material-category').text();
        }

        if (curCategory === 'all' || curCategory === category)
        {
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
                validate(that)
            });

            jQuery(this).find('.delete').off();
            jQuery(this).find('.delete').on('click', function(){
                var data = {'id': jQuery(that).attr('data-id')};
                jQuery.ajax({
                    method: 'POST',
                    url: '/include/ajax-api.php',
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
        }
    });
}


function addMaterial()
{
    jQuery.ajax({
        method: 'POST',
        url: '/include/ajax-api.php',
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
                var html = '<tr data-id = ' + id + ' data-category="" tabindex=0>' +
                    '<td><span class="material-name"></span></td>' +
                    '<td><span class="material-category"></span></td>' +
                        '<td>' +
                            '<button class="btn btn-sm btn-primary faa-parent animated-hover modify"><i class="fa fa-wrench faa-wrench"></i></button>' +
                            '<button class="btn btn-sm btn-success faa-parent animated-hover validate" style="display: none"><i class="fa fa-check faa-pulse"></i></button>' +
                            '<button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button>' +
                        '</td>' +
                    '</tr>';
                jQuery('#materials-list').append(html);
                updateMatDisplay();
                updateMatInteraction();

                jQuery('#materials-list tr[data-id=' + id + '] .modify').click()
            }
        });
}


function displayCategories()
{
    var html = '<a href="#" class="list-group-item">Toutes</a>';

    categories.forEach(function (category) {
        if (category !== '')
        {
            html += '<a href="#" class="list-group-item">' + category + '</a>';
        }
        /*else
        {
            categories = categories.splice(categories.indexOf(category), 1);
        }*/
    });

    jQuery('#category-slider').html(html);
    jQuery('#category-slider a').each(function(){
        jQuery(this).on('click', function(){
            jQuery(this).displayMaterials(jQuery(this).text());
        })
    });
}

// Categories interaction
displayCategories();
refreshCategoriesInteractions();
jQuery('#category-slider-main').on('click', function(){jQuery('#category-slider-wrapper').slideToggle('fast')});
jQuery('#category-slider-wrapper').slideToggle(0);
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
        displayCategories();
        refreshCategoriesInteractions();
    }
    else
    {
        notify('danger', 'La catégorie ' + category + ' existe déjà');
    }
});


// Materials interactions
updateMatDisplay();
updateMatInteraction();


// Buttons
jQuery('.button-add').on('click', function(){ addMaterial() });
jQuery('.button-save-all').on('click', function(){
    jQuery('#materials-list tr[data-id]').each(function(){
        if (jQuery(this).find('.modify').css('display') === 'none')
        {
            validate(this);
        }
    })
});