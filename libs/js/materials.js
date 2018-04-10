var curCategory = 'Toutes';
var datatable;
var event;

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
            cat = "Toutes"
        }
        else
        {
            return;
        }

        jQuery('#category-slider-main').text('Catégorie : ' + cat);
        curCategory = cat;
        jQuery('#category-slider-wrapper').slideToggle('fast');
        updateMatInteraction();
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


function validateMaterial(jQueryTR)
{
    var sendData = {'id':jQuery(jQueryTR).attr('data-id'), 'name':jQuery(jQueryTR).find('.material-name').val(), 'category':jQuery(jQueryTR).find('.material-category').val()};

    $(jQueryTR).find(".validate").removeClass('animated-hover faa-parent').addClass('disabled').off();
    $(jQueryTR).find(".validate i").removeClass('faa-pulse fa-check').addClass('faa-spin fa-cog animated');

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
            $(jQueryTR).find(".validate").removeClass('disabled').addClass('animated-hover faa-parent');
            $(jQueryTR).find(".validate i").removeClass('faa-spin fa-cog animated').addClass('faa-pulse fa-check');

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

            updateMatInteraction();
        });
}


function deleteMaterial(jQueryTR)
{
    $(jQueryTR).find('.delete').removeClass('animated-hover faa-parent').addClass('disabled').off();
    $(jQueryTR).find(".delete i").removeClass('faa-flash fa-times').addClass('faa-spin fa-cog animated');

    var data = {'id': jQuery(jQueryTR).attr('data-id')};
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
            $(jQueryTR).find('.delete').removeClass('disabled').addClass('animated-hover faa-parent');
            $(jQueryTR).find(".delete i").find("i").removeClass('faa-spin fa-cog animated').addClass('faa-flash fa-times');

            data = data.split('<br>');
            if (data[0] === '1')
            {
                notify('success', data[1]);

                let oldSearch = $('.dataTables_filter input').val();
                let sorting = datatable.fnSettings().aaSorting[0];

                datatable.fnDestroy();
                jQuery(jQueryTR).remove();

                updateMatInteraction();
                datatable.fnFilter(oldSearch);
                datatable.fnSettings().aaSorting = sorting;
            }
            else
            {
                notify('danger', data[1]);
            }
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

    // Show or hide line with category
    $.fn.dataTableExt.afnFiltering.push(function(oSettings, aData, iDataIndex) {
        var nTr = oSettings.aoData[iDataIndex].nTr;
        return (curCategory == "Toutes" || nTr.getAttribute("data-category") == curCategory);
    });
}


// Refresh table and add button interactions
function updateMatInteraction()
{
    console.log("update table");

    if (datatable != undefined)
    {
        datatable.fnDestroy()
    }
    initDatatable();

    jQuery('#materials-list tr[data-category]').each(function(){
        var category = jQuery(this).find('.material-category').text();
        if (category === undefined)
        {
            category = jQuery(this).find('.material-category').text();
        }

        if (curCategory === 'Toutes' || curCategory === category)
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
                validateMaterial(that)
            });

            // Delete interaction
            jQuery(this).find('.delete').off();
            jQuery(this).find('.delete').on('click', function(){
                deleteMaterial(that);
            });
        }
    });
    $('.loading').fadeOut('fast');
}


function addMaterial()
{
    options = "";

    $('#category-slider a').each(function() {
        if (this.innerText !== "Toutes")
        {
            options += '<option value="' + this.innerText + '">' + this.innerText + '</option>';
        }
    });

    $('form select').html(options);
    if (curCategory !== 'Toutes') $('form select').val(curCategory);
    $('form input[type=text]').val('');

    $('form').slideDown(400, function() {
        $('form input[type=text]').focus();
    });
}

function createMaterial(e)
{
    if ($('form input[type=text]').val() === '')
    {
        notify("danger", "Veuillez indiquer un nom pour le matériel");
        return;
    }

    $('form input[type=submit]').prop('disabled', true);

    var sendData = {'id': 'new', 'name':jQuery('form input[type=text]').val(), 'category':jQuery('form select').val()};

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
            $('form input[type=submit]').prop('disabled', false);

            data = data.split('<br>');
            if (data[0] === '1')
            {
                $('form').slideUp();
                notify('success', data[1]);

                let tr = '<tr data-id="' + data[2] + '" data-category="' + sendData['category'] + '">' +
                    '<td><span class="material-name">' + sendData['name'] + '</span></td>' +
                    '<td><span class="material-category">' + sendData['category'] + '</span></td>' +
                    '<td>' +
                    '<button class="btn btn-sm btn-primary faa-parent animated-hover modify"><i class="fa fa-wrench faa-wrench"></i></button>' +
                    '<button class="btn btn-sm btn-success faa-parent animated-hover validate" style="display: none"><i class="fa fa-check faa-pulse"></i></button>&nbsp' +
                    '<button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button>' +
                    '</td></tr>';

                let oldSearch = $('.dataTables_filter input').val();
                let sorting = datatable.fnSettings().aaSorting[0];

                datatable.fnDestroy();
                $('#materials-list').append(tr);

                updateMatInteraction();
                datatable.fnFilter(oldSearch);
                datatable.fnSettings().aaSorting = sorting;
            }
            else
            {
                notify('danger', data[1]);
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


$(document).ready( function () {
    // Categories interaction
    displayCategories();
    refreshCategoriesInteractions();
    jQuery('#category-slider-main').on('click', function(){jQuery('#category-slider-wrapper').slideToggle('fast')});
    jQuery('#category-slider-wrapper').slideToggle(0);
    jQuery('#add-category button').on('click', function(){
        var category = $('#add-category input').val();
        if(category == '')
        {
            notify('danger', 'La catégorie n\'a pas de nom');
        }
        else if (categories.indexOf($('#add-category input').val()) === -1)
        {
            notify('success', 'Catégorie ' + category + ' créée');
            $('#add-category input').val('');
            categories.push(category);
            displayCategories();
            refreshCategoriesInteractions();
        }
        else
        {
            notify('danger', 'La catégorie ' + category + ' existe déjà');
        }
    });


    // Init and update datatable and its interactions
    updateMatInteraction();

    // Add form initialisation
    $('form').hide();
    $('form').submit(function(e) {
        e.preventDefault();
        createMaterial(e);
    });
    // Cancel button for material creation
    jQuery('form button').on('click', function() {
        $('form').slideUp();
    });

    // Add material button
    jQuery('.button-add').on('click', function(){ addMaterial() });

    // Save all button
    jQuery('.button-save-all').on('click', function(){
        jQuery('#materials-list tr[data-id]').each(function(){
            if (jQuery(this).find('.modify').css('display') === 'none')
            {
                validateMaterial(this);
            }
        })
    });
});