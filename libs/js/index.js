jQuery('#generator-well button').on('click', function(){
    let type = jQuery(this).attr('data-json');
    let id = jQuery(this).attr('data-id');
    console.log(type);

    var materials = false;
    var questions = false;
    var patients = false;
    var surgeries = false;

    if (type === 'materials' || type ==='all')
    {
        materials = true;
    }
    if (type === 'questions' || type ==='all')
    {
        questions = true;
    }
    if (type === 'patients' || type ==='all')
    {
        patients = true;
    }
    if (type === 'surgeries' || type ==='all')
    {
        surgeries = true;
    }

    jQuery.ajax({
        method: 'POST',
        url: '/include/generatejson.php',
        data: {
            materials: materials,
            questions: questions,
            patients: patients,
            surgeries: surgeries,
            id: id
        }
    })
        .done(function(data){
            if (data === '1')
            {
                var link = document.createElement("a");
                link.download = 'configuration.zip';
                link.href = '/assets/configuration.zip';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        });
});