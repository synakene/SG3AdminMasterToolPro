function deletePatient(id)
{
    // TODO mettre des anti-spammer PARTOUUUUT
    var closestTr = jQuery('tr[data-id=' + id + ']');

    // Anti bashing
    jQuery(closestTr).find('button.delete').off();
    jQuery(closestTr).find('button').addClass('disabled');
    jQuery(closestTr).find('button.delete').removeClass('animated-hover');
    jQuery(closestTr).find('button.delete i').removeClass('fa-times-o faa-flash');
    jQuery(closestTr).find('button.delete i').addClass('fa-cog faa-spin animated');

    jQuery.ajax({
        method: 'POST',
        url: '/include/ajax-api.php',
        data: {
            action: "deleteData",
            type: "patient",
            data: {'id': id}
        }
    })
        .done(function(data){
            data = data.split('<br>');
            if (data[0] === '1')
            {
                notify('success', data[1]);
                jQuery(closestTr).closest('tr').remove();
            }
            else
            {
                jQuery(closestTr).find('button.delete').on('click', function(){
                    deletePatient(id);
                });
                jQuery(closestTr).find('button').removeClass('disabled');
                jQuery(closestTr).find('button.delete').addClass('animated-hover');
                jQuery(closestTr).find('button.delete i').addClass('fa-times-o faa-flash');
                jQuery(closestTr).find('button.delete i').removeClass('fa-cog faa-spin animated');

                notify('danger', data[1]);
            }
        });
}

jQuery('button.delete').on('click', function(){
    deletePatient(jQuery(this).closest('tr').attr('data-id'));
});

jQuery(document).ready(function(){
    jQuery('[data-toggle="tooltip"]').tooltip({
        animated: 'fade',
        placement: 'left',
        html: true
    });
});