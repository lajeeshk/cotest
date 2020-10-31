require('./bootstrap');


$('.edit-product').on('click', function() {
    var thisElemet = $(this);
    var row = thisElemet.closest('tr');

    var name = row.find("td:nth-child(1)").text();
    var quantity = row.find("td:nth-child(2)").text();
    var price = row.find("td:nth-child(3)").text();

    $('input[name=product_id]').val(row.index());
    $('input[name=name1]').val(name);
    $('input[name=quantity1]').val(quantity);
    $('input[name=price1]').val(price);

    $('#update-product').modal('show');
});

$('#create-product').on('submit', function(event) {

    event.preventDefault();

    var formData = {
        'name' : $('input[name=name]').val(),
        'price' : $('input[name=price]').val(),
        'quantity' : $('input[name=quantity]').val(),
        '_token' : $('input[name=_token]').val()
    };

    $.ajax({
        type : 'POST',
        url  : 'create',
        data : formData,
    })
    .done(function(data) {

        var product = JSON.parse(data);
        $('#product-list tr:last').after(`<tr><td>${product.name}</td><td>${product.quantity}</td><td>${product.price}</td><td>${product.total}</td><td>${product.dateSubmitted}</td><td><a href="Javascript:void(0)" class="edit-product">Edit</a></td></tr>`);

    });
});

$('#update-product').on('submit', function(event) {

    event.preventDefault();

    var productId = $('input[name=product_id]').val();

    var formData = {
        'name' : $('input[name=name1]').val(),
        'price' : $('input[name=price1]').val(),
        'quantity' : $('input[name=quantity1]').val(),
        '_token' : $('input[name=_token]').val()
    };

    $.ajax({
        type : 'POST',
        url  : 'update/'+productId,
        data : formData,
    })
    .done(function(data) {
        $('#update-product').modal('hide');
        var product = JSON.parse(data);
        
       var row = $('#product-list tr').eq(productId+1);
       row.find("td:nth-child(1)").text(product.name);
       row.find("td:nth-child(2)").text(product.quantity);
       row.find("td:nth-child(3)").text(product.price);


    });
});


