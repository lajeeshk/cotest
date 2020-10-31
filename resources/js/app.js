require('./bootstrap');

$('#submit-product').on('click', function(event) {

event.preventDefault();
var formData = {
    'name'              : $('input[name=name]').val(),
    'price'             : $('input[name=price]').val(),
    'quantity'    : $('input[name=quantity]').val(),
    '_token'    : $('input[name=_token]').val()
};

$.ajax({
    type        : 'POST',
    url         : 'create',
    data        : formData,
})
.done(function(data) {

    console.log(data);

});

});


