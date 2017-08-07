var categories = [];
var category = "all";
var i = 1;
var current_th = -1;

function interactWithMat(index)
{
    jQuery('#materials-list tr[data-id]').each(function(){
        if (jQuery(this).attr('data-id') === index)
        {
            jQuery(this).find('td span').each(function(){
                jQuery(this).replaceWith('<input data-id="' + jQuery(this).attr('data-id') + '" class="form-control" value="' + jQuery(this).text() + '" tabindex="0">')
            });

            jQuery(this).find('td input').off()
            jQuery(this).find('td input').focusout(function(){
                var that = this;
                var data = [jQuery('input[data-id]').attr('data-id'), jQuery('input[data-id]').eq(0).val(), jQuery('input[data-id]').eq(1).val()];
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
                            jQuery(that).focus();
                        }
                    })
            })
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

        if (category === "all" || category === attr)
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


function changeCategoryHanlderInit() {
    jQuery('#category-slider a').off('click');
    jQuery('#category-slider a').on('click', function(){
        console.log(categories)
        if (categories.indexOf(this.text) !== -1)
        {
            jQuery('#category-slider-main').text('Catégorie : ' + this.text);
            category = this.text;
            jQuery('#category-slider').slideToggle('fast');
            updateMatDisplay();
        }
        else if (this.text === "Toutes")
        {
            jQuery('#category-slider-main').text('Catégorie : Toutes');
            category = "all";
            jQuery('#category-slider').slideToggle('fast');
            updateMatDisplay();
        }
    });
}
changeCategoryHanlderInit();


// List the categories
i = 1
$('#category-slider a').each(function(){
    if (categories.indexOf(this.text) === -1 && i !== 1 && i !== jQuery('#category-slider a').length)
    {
        categories.push(this.text);
    }
    ++i;
});


// Add slider interactivity
jQuery('#category-slider-main').on('click', function(){jQuery('#category-slider').slideToggle()})


// Add a new category
jQuery('#category-slider button').on('click', function(){
    var name = jQuery('#category-slider input').val();
console.log(categories.indexOf(this.text));
    if (categories.indexOf(this.text) === -1)
    {
        jQuery('#category-slider > div').before('<a href="#" class="list-group-item">' + name + '</a>')
        categories.push(name);
        changeCategoryHanlderInit();
        console.log(categories)
        console.log(name)
    }
});

jQuery('#button-add').on('click', function(){
    id = 11;
    var html = '<tr data-id = ' + id + ' data-category="" tabindex=0>' +
        '<td><input data-id="4" class="form-control value="" tabindex=0></td>' +
        '<td><input data-id="4" class="form-control value="" tabindex=0></td>' +
        '<td><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button></td>' +
        '</tr>';
    jQuery('#materials-list').append(html);
    // TODO ajouter le listener
})