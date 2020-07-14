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
    $.ajax({
        type: "GET",
        url: url,
        dataType: "html",
        success: function (data)
        {
            $('#product_list').append(data);
        },
        error: function ()
        {
            alert("Si è verificato un errore! Riprova!");
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
                alert(data.msg);
                location.reload();
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
                alert(data.msg);
                location.reload();
            }
            else
            {
                alert(data.msg);
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
            $('#alert_modal').fadeIn();
            return;
        }
    });
}

function addAbbinamentoToWishList(id_abbinamento, lang) {
    $.ajax({
        url: "/_ext/ajax/ajax_site.php",
        data: "action=addAbbinamentoToWishList&id_abbinamento=" + id_abbinamento + "&lang=" + lang,
        dataType: "json",
        type: "get",
        success: function (data) {
            $(".modal-title").html('WISHLIST');
            $("#ajax-test").html(data.msg);
            $('#myModal').fadeIn();
            return;
        }
    });
}

/*



function addToNewsletter(lang) {
    var email = $("input[name='news_email']").val();
    $.ajax({
        url: "/_ext/ajax/ajax_site.php",
        data: "action=addToNewsletter&email=" + email + "&lang=" + lang,
        dataType: "json",
        type: "get",
        success: function (data) {
            if (data.msg != 'success') {
                $(".modal-title").html('');
                $("#ajax-test").html(data.msg);
                $('#myModal').fadeIn();
                return;
            } else {
                location.reload();
                return;
            }
        }
    });
}

function deleteItemFromCart(id_carrello, lang) {
    $.ajax({
        url: "/_ext/ajax/ajax_site.php",
        data: "action=deleteItemFromCart&id_carrello=" + id_carrello + "&lang=" + lang,
        dataType: "json",
        type: "get",
        success: function (data) {
            if (data.msg != 'success') {
                $(".modal-title").html('');
                $("#ajax-test").html(data.msg);
                $('#myModal').fadeIn();
                return;
            } else {
                location.reload();
                return;
            }
        }
    });
}



function deleteFromWishList(id_prodotto, lang) {
    $.ajax({
        url: "/_ext/ajax/ajax_site.php",
        data: "action=deleteFromWishList&id_prodotto=" + id_prodotto + "&lang=" + lang,
        dataType: "json",
        type: "get",
        success: function (data) {
            location.reload();
            return;
        }
    });
}

function addToCart(id_prodotto, lang, is_accessorio) {
    if (typeof (is_accessorio) === 'undefined') is_accessorio = 'false';
    $.ajax({
        url: "/_ext/ajax/ajax_site.php",
        data: "action=addToCart&id_prodotto=" + id_prodotto + "&is_accessorio=" + is_accessorio + "&lang=" + lang,
        dataType: "json",
        type: "get",
        success: function (data) {
            $(".modal-title").html('CART');
            $("#ajax-test").html(data.msg);
            if (typeof (data.tot) === 'undefined') {
                $('#myModal').fadeIn();
                return;
            }
            $('.carrello_nr').html(data.tot);
            $("#cart-menu").load(location.href + " #cart-menu>*", "");
            $('#myModal').fadeIn();
            return;
        }
    });
}

function addAbbinamentoToCart(id_abbinamento, lang, is_accessorio) {
    if (typeof (is_accessorio) === 'undefined') is_accessorio = 'false';
    var This = this;
    $.ajax({
        url: "/_ext/ajax/ajax_site.php",
        data: "action=addAbbinamentoToCart&id_abbinamento=" + id_abbinamento + "&is_accessorio=" + is_accessorio + "&lang=" + lang,
        dataType: "json",
        type: "get",
        success: function (data) {
            $(".modal-title").html('CART');
            $("#ajax-test").html(data.msg);
            if (typeof (data.tot) === 'undefined') {
                $('#myModal').fadeIn();
                return;
            }
            $('.carrello_nr').html(data.tot);
            $("#cart-menu").load(location.href + " #cart-menu>*", "");
            $('#myModal').fadeIn();
            return;
        }
    });
}
*/
