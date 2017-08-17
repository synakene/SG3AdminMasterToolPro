function initData()
{
    // Make index of array same as id for better handling
    var mat_with_index = [];

    // Init dropdown values
    var htmlCategoryDropdown = '';
    var categoriesUsed = [];
    var htmlNameDropdown = '';

    materials.forEach(function(material){
        htmlNameDropdown += '<option data-category="' + material['category'] + '" value="' + material['name'] + '">' + material['name'] + '</option>';
        if (categoriesUsed.indexOf(material['category']) === -1)
        {
            categoriesUsed.push(material['category']);
            htmlCategoryDropdown += '<option value="' + material['category'] + '">' + material['category'] + '</option>';
        }

        mat_with_index[material['id']] = material;
    });

    materials = mat_with_index;

    jQuery('#material-list').find('tr[data-option] material-category select').html(htmlCategoryDropdown);
    jQuery('#material-list').find('tr[data-option] material-name select').html(htmlNameDropdown);
}

function addMaterial(id)
{
    console.log(id);
    console.log(materials[id]);
    var html =
        '<tr data-id=' + id + '>\n' +
            '<td><span class="material-category">' + materials[id]['category'] + '</span></td>\n' +
            '<td><span class="material-name">' + materials[id]['name'] + '</td>\n' +
            '<td><button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button></td>\n' +
        '<tr>';

    jQuery('#materials-list tr[data-option]').before(html);
}

jQuery('.hideable').each(function(){this.style.cursor = 'pointer'})
jQuery('.hideable').on('click', function(){
    jQuery(this.closest('.panel')).find('.panel-body').slideToggle()
});

initData();
materials.forEach(function(material){
    addMaterial(material['id']);
});