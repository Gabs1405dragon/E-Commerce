$(() => {
    $('a.btn').click((e) => {
        e.preventDefault();
        $.ajax({
            url:'http://localhost/E-commerce/views/pages/ajax/finalizarAjax.php'
        }).done(function (data) {
            console.log(data);
        var isOpenLightBox = PagSeguroLightbox({
            code: data
        }, {
            success: function (transactionCode) {
                console.log("Usuário foi até o final");
            },
            abort: function () {
                console.log('fechou a janela!');
            }
        })
        })
       
        return false;
    })
})