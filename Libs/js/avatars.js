/*window.onload(function(){

});*/

$(document).ready(function(){
    var elements = window.location.pathname.split('/');
    var potentialId = elements[elements.length-1];

    if (typeof(potentialId) != "boolean" && !isNaN(potentialId))
    {
        jQuery('html, body').animate({
            scrollTop: jQuery('#' + potentialId).offset().top-30
        }, 1000);
    }
});

function save(id)
{
    var sendData = {
        'id': id,
        'name': jQuery('#' + id).find('.avatar-name').val(),
        'pack': jQuery('#' + id).find('.avatar-pack').val()
    };

    jQuery.ajax({
        method: 'POST',
        url: '/include/ajax-api.php',
        data: {
            action: "updateAvatar",
            data: sendData
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
}

jQuery('.save').on('click', function(){
    save(jQuery(this).closest('div').attr('id'));
});