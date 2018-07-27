$(document).ready(function(){
    //<editor-fold desc="Material handling">

    function updateCategory()
    {
        var category = jQuery('#materials-list').find('tr[data-option] .material-category select').val();
        var firstMat = '';

        jQuery('#materials-list').find('tr[data-option] .material-name option').each(function(){
            var id = parseInt(jQuery(this).val());

            // If good category AND material not already added
            if ((jQuery(this).attr('data-category') === category || (category === '0' && id !== -1)) && patient['materials'].indexOf(parseInt(id)) === -1)
            {
                if (firstMat === '')
                {
                    firstMat = jQuery(this).val();
                    jQuery('#materials-list').find('tr[data-option] .material-name select').val(firstMat);
                }
                jQuery(this).show();
            }
            else
            {
                jQuery(this).hide();
            }
        });

        // No material available
        if (firstMat === '')
        {
            jQuery("#materials-list tr[data-option] button.validate").addClass('disabled');
            jQuery(jQuery('#materials-list').find('tr[data-option] .material-name option')[0]).show()
            jQuery('#materials-list').find('tr[data-option] .material-name select').val('-1');
        }
        else
        {
            jQuery("#materials-list tr[data-option] button.validate").removeClass('disabled');
        }
    }

    function initMaterialData()
    {
        // Init dropdown values
        var htmlCategoryDropdown = '<option value="0">Tous</option>';
        var categoriesUsed = [];
        var htmlNameDropdown = '<option data-category="" value="-1">Pas de matériel disponible</option>';

        materials.forEach(function(material){
            htmlNameDropdown += '<option data-category="' + material.category + '" value="' + material.id + '">' + material.name + '</option>';
            if (categoriesUsed.indexOf(material.category) === -1)
            {
                categoriesUsed.push(material.category);
                htmlCategoryDropdown += '<option value="' + material.category + '">' + material.category + '</option>';
            }
        });

        jQuery('#materials-list').find('tr[data-option] .material-category select').html(htmlCategoryDropdown);
        jQuery('#materials-list').find('tr[data-option] .material-name select').html(htmlNameDropdown);

        // Update availables materials when changing category
        jQuery('#materials-list').find('tr[data-option] .material-category select').on('change', function(){updateCategory()});
        updateCategory();
    }

    function addMaterial(id)
    {
        var material = $.grep(materials, function(mat)
        {
            return mat.id == id;
        })[0];

        if (material === undefined)
        {
            console.log("Can't find material " + id);
            return;
        }

        /*var html =
            '<tr data-id=' + id + '>\n' +
            '<td><span class="material-category">' + materials[id]['category'] + '</span></td>\n' +
            '<td><span class="material-name">' + materials[id]['name'] + '</td>\n' +
            '<td><button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button></td>\n' +
            '<tr>';*/

        var html =
            '<tr data-id=' + id + '>\n' +
            '<td><span class="material-category">' + material.category + '</span></td>\n' +
            '<td><span class="material-name">' + material.name + '</td>\n' +
            '<td><button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button></td>\n' +
            '<tr>';

        // Insert new row
        jQuery('#materials-list tr[data-option]').before(html);


        // Add delete listener
        jQuery('#materials-list tr[data-id=' + id + '] button.delete').on('click', function(){
            patient['materials'].splice(patient['materials'].indexOf(id), 1);
            jQuery(this).closest('tr[data-id]').remove();
            updateCategory();
        })
    }

// Material data initialization
    initMaterialData();
    patient['materials'].forEach(function(material){
        addMaterial(material);
    });

// Add material button
    jQuery('#materials-list tr[data-option] button.validate').on('click', function(){
        var id = parseInt(jQuery('#materials-list').find('tr[data-option] .material-name select').val());
        if (id !== -1 && patient['materials'].indexOf(id) === -1)
        {
            console.log('adding ' + id);
            addMaterial(id);
            patient['materials'].push(id);
            updateCategory();
        }
    });

//</editor-fold>

    //<editor-fold desc="Questions handling">

        function addAnswer(id)
        {
            if (questions[id] === undefined)
            {
                return false;
            }

            var html =
                '<tr data-id=' + id + '>\n' +
                '<td><span class="question-name">' + questions[id]['name'] + '</span></td>\n' +
                '<td><span class="question-question">' + questions[id]['question'] + '</span></td>\n' +
                '<td><input class="question-answer form-control" placeholder="' + questions[id]['answer'] + '"></td>\n' +
                '<td><button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button></td>\n' +
                '</tr>';

            // Insert new row
            jQuery('#questions-list tr[data-option]').before(html);


            // Add delete listener
            jQuery('#questions-list tr[data-id=' + id + '] button.delete').on('click', function(){
                var i = 0;
                patient['responses'].forEach(function(response){
                    if (response['id'] === id)
                    {
                        patient['responses'].splice(i, 1);
                        return;
                    }
                    ++i;
                });
                jQuery(this).closest('tr[data-id]').remove();
                showHideQuestions();
            })
        }


        function showHideQuestions()
        {
            var activeQuestions = [];
            var firstId = -1;

            // Get active questions to hide doubles
            patient['responses'].forEach(function(question){
                activeQuestions.push(question['id'])
            });

            // Hide and show options
            jQuery('#questions-list').find('tr[data-option] select.question-name option').each(function(){
                var id = parseInt(jQuery(this).val());

                if (id !== -1 && activeQuestions.indexOf(id) === -1)
                {
                    if (firstId === -1)
                    {
                        firstId = id;
                    }

                    jQuery(this).show();
                }
                else
                {
                    jQuery(this).hide();
                }
            });

            jQuery('#questions-list').find('tr[data-option] select.question-name').val(firstId);
            updateQuestionHelper();
        }


        function updateQuestionHelper()
        {
            var id = jQuery('#questions-list').find('tr[data-option] select.question-name').val();

            // If no question available
            if (id === -1 || questions[id] === undefined)
            {
                question = '';
                answer = '';
            }
            else
            {
                question = questions[id]['question'];
                answer = questions[id]['answer'];
            }

            jQuery('#questions-list').find('tr[data-option] span.question-question').html(question);
            jQuery('#questions-list').find('tr[data-option] span.question-answer').html(answer);
        }


        function initQuestionsData()
        {
            // Init dropdown values
            var htmlQuestionsDropdown = '';

            for (var question in questions)
            {
                htmlQuestionsDropdown += '<option value="' + questions[question]['id'] + '">' + questions[question]['name'] + '</option>';
            }

            htmlQuestionsDropdown += '<option value="-1">Pas de questions disponible</option>';


            jQuery('#questions-list').find('tr[data-option] select.question-name').html(htmlQuestionsDropdown);

            // Update availables materials when changing category
            jQuery('#questions-list').find('tr[data-option] select.question-name').on('change', function(){updateQuestionHelper()});
        }


    // Data init
        initQuestionsData();
        patient['responses'].forEach(function(question){
            addAnswer(question['id']);
            jQuery('#questions-list tr[data-id=' + question['id'] + '] input.question-answer').val(question['answer'])
        });
        showHideQuestions();

    // Add button interaction
        jQuery('#questions-list tr[data-option] button.validate').on('click', function(){
            var id = parseInt(jQuery('#questions-list').find('tr[data-option] select.question-name').val());

            if (id != undefined && id !== -1)
            {
                addAnswer(id);
                patient['responses'].push({'id': id, 'answer': ''});
                showHideQuestions();
            }
        });

    //</editor-fold>

    //<editor-fold desc="Surgeries handling">

        function showHideSurgeries()
        {
            var firstId = -1;

            // Hide and show options
            jQuery('#surgeries-list').find('tr[data-option] select.surgery-name option').each(function(){
                var id = parseInt(jQuery(this).val());

                if (id !== -1 && patient['surgeries'].indexOf(id) === -1)
                {
                    if (firstId === -1)
                    {
                        firstId = id;
                    }

                    jQuery(this).show();
                }
                else
                {
                    jQuery(this).hide();
                }
            });

            jQuery('#surgeries-list').find('tr[data-option] select.surgery-name').val(firstId);
        }

        function addSurgery(id)
        {
            var html =
                '<tr data-id=' + id + '>' +
                '<td><span class="surgery-name">' + surgeries[id]['name'] + '</span></td>' +
                '<td><button class="btn btn-sm btn-danger faa-parent animated-hover delete"><i class="fa fa-times faa-flash"></i></button></td>' +
                '<tr>';

            // Insert new row
            jQuery('#surgeries-list tr[data-option]').before(html);

            // Add delete listener
            jQuery('#surgeries-list tr[data-id=' + id + '] button.delete').on('click', function(){
                patient['surgeries'].splice(patient['surgeries'].indexOf(id), 1);
                jQuery(this).closest('tr[data-id]').remove();
                showHideSurgeries();
            });
        }

        function initSurgeriesData()
        {
            // Make index of array same as id for better handling
            var surgeriesWithIndex = [];

            // Init dropdown values
            var htmlSurgeriesDropdown = '';

            for (var surgeryId in surgeries)
            {
                htmlSurgeriesDropdown += '<option value="' + surgeries[surgeryId]['id'] + '">' + surgeries[surgeryId]['name'] + '</option>';
            }

            htmlSurgeriesDropdown += '<option value="-1">Pas de chirurgie disponible</option>';

            jQuery('#surgeries-list').find('tr[data-option] select.surgery-name').html(htmlSurgeriesDropdown);
        }


    // Data init
        initSurgeriesData();
        patient['surgeries'].forEach(function(patient){
            addSurgery(patient);
        });
        showHideSurgeries();
        jQuery('.patient-sex').val(patient['sex']);


    // Add button interaction
        jQuery('#surgeries-list tr[data-option] button.validate').on('click', function(){
            var id = parseInt(jQuery('#surgeries-list').find('tr[data-option] select.surgery-name').val());

            if (id != undefined && id !== -1)
            {
                addSurgery(id);
                patient['surgeries'].push(id);
                showHideSurgeries();
            }
        });

    //</editor-fold>

    jQuery('.patient-avatar').val(patient.avatar);
    jQuery('.patient-ta').val(patient.ta);
    jQuery('.patient-dentalCondition').val(patient.dentalCondition);

    jQuery('.hideable').each(function(){this.style.cursor = 'pointer'});
    jQuery('.hideable').on('click', function(){
        jQuery(this).closest('.panel').find('.panel-body').slideToggle()
    });

    //<editor-fold desc="Json parsing">

    function readJson() {
        // bool to allergies
        allergies = {};
        if ($('input.patient-allergies-antib:checked')[0] !== undefined)
            allergies.antibiotique = true;
        if ($('input.patient-allergies-latex:checked')[0] !== undefined)
            allergies.latex = true;

        var extra = $('input.patient-allergies-other').val().split(',');
        extra.forEach(function(element){
            let val = element.trim();
            if (val === '')
                return;
            allergies[val] = true;
        });

        // bool to examinations
        examinations = {};
        if ($('input.patient-examinations-groupe1:checked')[0] !== undefined)
            examinations['Groupe 1'] = true;
        if ($('input.patient-examinations-groupe2:checked')[0] !== undefined)
            examinations['Groupe 2'] = true;
        if ($('input.patient-examinations-phenotype:checked')[0] !== undefined)
            examinations['Phénotype'] = true;
        if ($('input.patient-examinations-rai:checked')[0] !== undefined)
            examinations['RAI'] = true;
        if ($('input.patient-examinations-cross-nf:checked')[0] !== undefined)
            examinations['Cross NF'] = true;
        if ($('input.patient-examinations-tp:checked')[0] !== undefined)
            examinations['TP'] = true;
        if ($('input.patient-examinations-tca:checked')[0] !== undefined)
            examinations['TCA'] = true;
        if ($('input.patient-examinations-iono:checked')[0] !== undefined)
            examinations['Iono'] = true;
        if ($('input.patient-examinations-radiothorax:checked')[0] !== undefined)
            examinations['Radiothorax'] = true;
        if ($('input.patient-examinations-ecg:checked')[0] !== undefined)
            examinations['ECG'] = true;

        extra = $('input.patient-examinations-other').val().split(',');
        extra.forEach(function(element){
            let val = element.trim();
            if (val === '')
                return;
            examinations[val] = true;
        });

        // texts to premedications
        patient.premedication.eve = $('textarea.patient-premedication-eve').val().split('\n');
        patient.premedication.morning = $('textarea.patient-premedication-morning').val().split('\n');
    }

    $('#button-test').on('click', function () {
        console.log('click');
        readJson();
    });

    function writeJson() {
        // allergies json to bool
        var extra = '';
        $.each(allergies, function(index, value) {
            if (index === 'antibiotique' && value === true) {
                $('.patient-allergies-antib').bootstrapToggle('on');
                return;
            }
            if (index === 'latex' && value === true) {
                $('.patient-allergies-latex').bootstrapToggle('on');
                return;
            }

            if (value === true)
                extra += index + ', ';
        });

        // examinations to bool
        if (extra !== '') {
            extra = extra.substring(0, extra.length - 2);
            $('.patient-allergies-other').val(extra);
        }

        extra = '';
        $.each(examinations, function(index, value) {
            if (index === 'Groupe 1' && value === true) {
                $('.patient-examinations-groupe1').bootstrapToggle('on');
                return;
            }
            if (index === 'Groupe 2' && value === true) {
                $('.patient-examinations-groupe2').bootstrapToggle('on');
                return;
            }
            if (index === 'Phénotype' && value === true) {
                $('.patient-examinations-phenotype').bootstrapToggle('on');
                return;
            }
            if (index === 'RAI' && value === true) {
                $('.patient-examinations-rai').bootstrapToggle('on');
                return;
            }
            if (index === 'Cross NF' && value === true) {
                $('.patient-examinations-cross-nf').bootstrapToggle('on');
                return;
            }
            if (index === 'TP' && value === true) {
                $('.patient-examinations-tp').bootstrapToggle('on');
                return;
            }
            if (index === 'TCA' && value === true) {
                $('.patient-examinations-tca').bootstrapToggle('on');
                return;
            }
            if (index === 'Iono' && value === true) {
                $('.patient-examinations-iono').bootstrapToggle('on');
                return;
            }
            if (index === 'Radiothorax' && value === true) {
                $('.patient-examinations-radiothorax').bootstrapToggle('on');
                return;
            }
            if (index === 'ECG' && value === true) {
                $('.patient-examinations-ecg').bootstrapToggle('on');
                return;
            }

            if (value === true)
                extra += index + ', ';
        });

        if (extra !== '') {
            extra = extra.substring(0, extra.length - 2);
            $('.patient-examinations-other').val(extra);
        }

        // premedications to texts
        if (!patient.premedication.eve)
            patient.premedication = JSON.parse(patient.premedication);

        var text = "";
        patient.premedication.eve.forEach(function(e){
            if (e !== '')
                text += e + "\n";
        });
        $('.patient-premedication-eve').val(text);

        text = "";
        patient.premedication.morning.forEach(function(e){
            if (e !== '')
                text += e + "\n";
        });
        $('.patient-premedication-morning').val(text);
    }

    writeJson();

    //</editor-fold>

    function save()
    {
        // Take updated answer values
        patient['responses'].forEach(function(element){
            element['answer'] = jQuery('#questions-list tr[data-id=' + element['id'] + '] .question-answer').val()
        });

        readJson();

        patient.firstname = jQuery('.patient-firstname').val();
        patient.lastname = jQuery('.patient-lastname').val();
        patient.sex = jQuery('.patient-sex').val();
        patient.age = jQuery('.patient-age').val();
        patient.height = jQuery('.patient-height').val();
        patient.weight = jQuery('.patient-weight').val();
        patient.story = jQuery('.patient-story').val();
        patient.avatar = jQuery('.patient-avatar').val();

        patient.story = jQuery('textarea.patient-story').val();
        patient.treatments = jQuery('textarea.patient-treatments').val();
        patient.allergies = JSON.stringify(allergies);
        patient.ta = jQuery('input.patient-ta').val();
        patient.fc = jQuery('input.patient-tc').val();
        patient.dentalCondition = jQuery('input.patient-dentalCondition').val();
        patient.dentalRiskNotice = jQuery('input.patient-dentalRiskNotice:checked').length === 1;
        patient.mallanpati = parseInt(jQuery('select.patient-mallanpati').val());
        patient.thyroidMentalDistance = jQuery('input.patient-thyroid-mental-distance:checked').length === 1 ? 64 : 66;
        patient.mouthOpening = jQuery('input.patient-mouth-opening:checked').length === 1 ? 34 : 36;
        patient.difficultIntubation = jQuery('input.patient-difficult-intubation:checked').length === 1;
        patient.difficultVentilation = jQuery('input.patient-difficult-ventilation:checked').length === 1;
        patient.asa = parseInt(jQuery('input.patient-asa').val());
        console.log(examinations);
        console.log(JSON.stringify(examinations));
        patient.preAnestheticExaminations = JSON.stringify(examinations);

        var mar = 0;
        mar += jQuery('input.patient-mar-ag:checked').length === 1 ? 1 : 0;
        mar += jQuery('input.patient-mar-bis:checked').length === 1 ? 2 : 0;
        patient.marProposition = mar;

        patient.expectedHospitalisation = parseInt(jQuery('select.patient-hospitalisation').val());
        patient.transfusionStrategy = jQuery('textarea.patient-transfusion-strategy').val();
        patient.preAnestheticVisit = jQuery('textarea.patient-pre-anesthetic-visit').val();
console.log(patient);
        // Prevent from click bashing
        jQuery('button.save').off();
        jQuery('button.save').addClass('disabled');
        jQuery('button.save i').removeClass('fa-floppy-o');
        jQuery('button.save i').addClass('fa-cog faa-spin animated');

        // Prepare data to send
        var sendData = {
            'id': patient['id'],
            'surgeries': patient['surgeries'],
            'materials': patient['materials'],
            'responses': patient['responses'],
            'firstname': patient['firstname'],
            'lastname': patient['lastname'],
            'sex': patient['sex'],
            'age': patient['age'],
            'height': patient['height'],
            'weight': patient['weight'],
            'avatar': patient['avatar'],
            'story': patient['story'],
            'patient': patient
        };

        jQuery.ajax({
            method: 'POST',
            url: '/include/ajax-api.php',
            data: {
                action: "saveData",
                type: "patient",
                data: sendData
            }
        })
            .done(function(data){
                jQuery('button.save').on('click', function(){
                    save();
                });
                jQuery('button.save').removeClass('disabled');
                jQuery('button.save i').removeClass('fa-cog faa-spin animated');
                jQuery('button.save i').addClass('fa-floppy-o');

                jQuery('h1.page-header').text(patient['firstname'] + ' ' + patient['lastname']);
                jQuery('ol.breadcrumb .active span').text(patient['firstname'] + ' ' + patient['lastname'])

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

    jQuery('button.save').on('click', function(){
        save();
    });

    jQuery(window).bind('keydown', function(event) {
        if ((event.ctrlKey || event.metaKey) && event.which === 83) {
            event.preventDefault();
            save();
        }
    });
});