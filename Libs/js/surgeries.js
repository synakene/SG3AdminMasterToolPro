function initData()
{
    var chir_with_index = [];
    surgeries.forEach(function(surgery){
        chir_with_index[surgery['id']] = surgery;
    });
    surgeries = chir_with_index;

    var mat_with_index = [];
    materials.forEach(function(material){
        mat_with_index[material['id']] = material;
    });
    materials = mat_with_index;
}


function displaySurgery(id) {
    var select = '#surgeries-list tr[data-id=' + id + ']';

    if (jQuery(select).length === 0) {

        var htmlMaterials = '';
        surgeries[id]['materials'].forEach(function(materialId){
            htmlMaterials += '<span class="well well-sm">' + materials[materialId]['name'] + '</span>';
        });

        var html =
            '<tr data-id=1>\n' +
                '<td><span class="surgery-name">' + surgeries[id]['name'] + '</span></td>\n' +
                '<td><span class="surgery-story">' + surgeries[id]['story'] + '</span></td>\n' +
                '<td><span class="surgery-materials">' + htmlMaterials + '</span></td>\n' +
                '<td><span class="surgery-responses">' + surgeries[id]['responses'] + '</span></td>\n' +
                '<td><span class="surgery-compatibles">' + surgeries[id]['compatibles'] + '</span></td>\n' +
                '<td><span class="surgery-emergency"><input type="checkbox" disabled ' + (surgeries[id]['emergency'] === true ? 'checked' : '') + '></span></td>\n' +

                '<td>\n' +
                    '<a class="btn btn-sm btn-primary faa-parent animated-hover modify" href="/chirurgies/' + id + '"><i class="fa fa-wrench fa-fw faa-wrench"></i></a>\n' +
                    '<button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times fa-fw faa-flash"></i></button>\n' +
                '</td>\n' +
            '<tr>';

        console.log(html);
        jQuery('#surgeries-list').append(html);

        /*jQuery(this).find('.delete').off();
        jQuery(this).find('.delete').on('click', function () {
            var data = {'id': jQuery(select).attr('data-id')};
            console.log(data);
            jQuery.ajax({
                method: 'POST',
                url: 'include/ajax-api.php',
                data: {
                    action: "deleteData",
                    type: "surgery",
                    data: data
                }
            })
                .done(function (data) {
                    data = data.split('<br>');
                    if (data[0] === '1') {
                        notify('success', data[1]);
                        jQuery(select).remove();
                    }
                    else {
                        notify('danger', data[1]);
                    }
                });
        });*/
    }
}

initData();

surgeries.forEach(function(surgery){
    displaySurgery(surgery['id']);
});