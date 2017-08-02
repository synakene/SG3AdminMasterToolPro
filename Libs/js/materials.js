// List the categories
var categories = [];
var i = 1;
$('#category-slider a').each(function(){

    console.log(jQuery.inArray(this.text, categories) === false);
    console.log(i !== 1);
    console.log(i !== 1);
    console.log(jQuery('#category-slider a').length());
    if (jQuery.inArray(this.text, categories) === false && i !== 1 && i !== jQuery('#category-slider a').length())
    {
        categories.push(this.text);
    }
    ++i;
});
console.log(categories);

// Add slider interactivity
jQuery('#category-slider-main').on('click', function(){jQuery('#category-slider').slideToggle('fast')})

// Add a new category
jQuery('#category-slider button').on('click', function(){
    var name = $('#category-slider input').val()
    jQuery('#category-slider > div').before('<a href="#" class="list-group-item">' + name + '</a>')

});