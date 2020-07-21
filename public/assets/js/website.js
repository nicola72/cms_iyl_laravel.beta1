function show_others(url)
{
    $('#product_list').fadeOut();
    $.ajax({
        type: "GET",
        url: url,
        dataType: "html",
        success: function (data)
        {
            $('#product_list').html(data);
            window.scrollTo(0, 0);
            $('#product_list').fadeIn();

        },
        error: function ()
        {
            alert("Si è verificato un errore! Riprova!");
        }
    });
}

function show_others_for_scroll(url)
{
    $('#preloader_nic').css('display','block');
    $.ajax({
        type: "GET",
        url: url,
        dataType: "html",
        success: function (data)
        {
            $('#product_list').append(data);
            $('#preloader_nic').css('display','none');
        },
        error: function ()
        {
            alert("Si è verificato un errore! Riprova!");
            $('#preloader_nic').css('display','none');
        }
    });
}

function ordina(value)
{
    $('#order').val(value);
    $('#form_ordinamento').submit();
}

function filtra(value)
{
    $('#filter').val(value);
    $('#form_filtro').submit();
}

function addToCart(url) {

    $.ajax({
        url: url,
        dataType: "json",
        type: "get",
        success: function (data)
        {
            if(data.result === 1)
            {
                $(".modal-alert-title").html(data.title);
                $("#modal-alert-msg").html(data.msg);
                $('#alert_modal').modal();

                $('#alert_modal').on('hidden.bs.modal', function (e) {
                    location.reload();
                });

            }
            else
            {
                alert(data.msg);
            }
        }
    });
}

function cartUpdateQta(url,id_carrello) {
    var qta = $("input[name='qta'][data-idrow='" + id_carrello + "']").val();

    $.ajax({
        url: url,
        data: {'id': id_carrello,'qta':qta },
        dataType: "json",
        type: "get",
        success: function (data)
        {
            if(data.result === 1)
            {
                location.reload();
            }
            else
            {
                alert(data.msg);
            }
        }
    });
}

function dropProvincia() {
    var nazione = $("#nazione").val();
    if (nazione != '101') {
        $("#prov-camp").fadeOut();
        $("#prov").val('00');
    } else {
        $("#prov-camp").css({"display": "block"});
    }
    return;
}


function couponRedeem(url) {
    var coupon = $("input#coupon").val();
    if (coupon == '') {
        return;
    }
    $.ajax({
        url: url,
        type: "get",
        data: {'coupon': coupon },
        dataType: "json",
        success: function (data)
        {
            if(data.result === 1)
            {
                $(".modal-alert-title").html('COUPON');
                $("#modal-alert-msg").html(data.msg);
                $('#alert_modal').modal();

                $('#alert_modal').on('hidden.bs.modal', function (e) {
                    location.reload();
                })
            }
            else
            {
                $(".modal-alert-title").html('COUPON');
                $("#modal-alert-msg").html(data.msg);
                $('#alert_modal').modal();
            }
        }
    });
}

function addToWishList(url) {
    $.ajax({
        url: url,
        dataType: "json",
        type: "get",
        success: function (data) {
            $(".modal-alert-title").html('WISHLIST');
            $("#modal-alert-msg").html(data.msg);
            $('#alert_modal').modal();
            return;
        }
    });
}

function deleteFromWishList(url) {

    $.ajax({
        url: url,
        dataType: "json",
        type: "get",
        success: function (data) {
            $(".modal-alert-title").html('WISHLIST');
            $("#modal-alert-msg").html(data.msg);
            $('#alert_modal').modal();
            location.reload();
            return;
        }
    });

}
