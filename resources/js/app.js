/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



/* section create preview button click event */
$('button.preview-section').on("click", function(){
    $('.section-preview').children().remove();
    $('.section-preview').append(editor1.getValue());
});

makeSelector();

function makeSelector(){
    $("select.mmy-model-selector").parent().hide();
    $("select.mmy-year-selector").parent().hide();

    $('select.mmy-make-selector').on('change', function(){
        var selectedVal = $('select.mmy-make-selector option:selected').val();
        var token = $("meta[name=api-token]");
        $("select.mmy-model-selector").children().remove();
        $.get('/api/make/' + selectedVal + '/models?api_token=' + token.attr('content'), function(data){
            
            data.map(model => {
                $("select.mmy-model-selector").append("<option value='"+ model.id +"'>"+ model.name +"</option>")
            });

            $("select.mmy-model-selector").parent().show();

            $('select.mmy-model-selector').on('change', function(){
                var selectedVal = $('select.mmy-model-selector option:selected').val();
                $.get('/api/model/' + selectedVal + '/years?api_token=' + token.attr('content'), function(data){
                    data.map(years => {
                        $("select.mmy-year-selector").append("<option value='"+ years.id +"'>"+ years.year +"</option>")
                    });

                    $("select.mmy-year-selector").parent().show();
                });
            });

        });
    });
}





