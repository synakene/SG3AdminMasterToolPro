function displaySurgery(id) {
    var select = '#surgeries-list tr[data-id=' + id + ']';

    if (jQuery(select).length === 0) {

        var html =
            '<tr data-id=1>\n' +
            '<td><span class="surgery-name">' + surgeries[id]['name'] + '</span></td>\n' +
            '<td><span class="surgery-story">' + surgeries[id]['story'] + '</span></td>\n' +
            '<td><span class="surgery-materials">' + /*surgeries[id]['materials']*/ + '</span></td>\n' +
            '<td><span class="surgery-responses">' + /*surgeries[id]['responses']*/ + '</span></td>\n' +
            '<td><span class="surgery-compatibles">' + /*surgeries[id]['compatibles']*/ + '</span></td>\n' +
            '<td><span class="surgery-emergency"><input ' + 'disabled' /* TODO condition */ + ' type="checkbox"></span></td>\n' +

            '<td>\n' +
            '<button class="btn btn-sm btn-primary faa-parent animated-hover modify"><i class="fa fa-wrench fa-fw faa-wrench"></i></button>\n' +
            '<button class="btn btn-sm btn-success faa-parent animated-hover validate" style="display: none"><i class="fa fa-check fa-fw faa-pulse"></i></button>\n' +
            '<button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times fa-fw faa-flash"></i></button>\n' +
            '</td>\n' +
            '<tr>';

        jQuery('#surgeries-list').append(html);

        /*// Modify interaction
        jQuery(select).find('.modify').off();
        jQuery(select).find('.modify').on('click', function () {
            jQuery(select).find('.modify').hide();
            jQuery(select).find('.validate').show();
            createInput(id);
        });

        // Validate interaction
        jQuery(select).find('.validate').off();
        jQuery(select).find('.validate').on('click', function () {
            validate(jQuery(select).attr('data-id'));
        });

        jQuery(this).find('.delete').off();
        jQuery(this).find('.delete').on('click', function () {
            var data = {'id': jQuery(select).attr('data-id')};
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


var chir_with_index = [];
surgeries.forEach(function(surgery){
    chir_with_index[surgery['id']] = surgery;
});
surgeries = chir_with_index;

surgeries.forEach(function(surgery){
    displaySurgery(surgery['id']);
});