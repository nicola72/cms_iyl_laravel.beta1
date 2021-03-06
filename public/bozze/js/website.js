function cartUpdateQta(id_carrello, lang, id_prodotto) {
    var qta = $("input[name='qta'][data-idrow='" + id_carrello + "']").val();
    $.ajax({
        url: "/_ext/ajax/ajax_site.php",
        data: "action=cartUpdateQta&id_carrello=" + id_carrello + "&lang=" + lang + "&qta=" + qta + "&id_prodotto=" + id_prodotto,
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

function addToWishList(id_prodotto, lang) {
    $.ajax({
        url: "/_ext/ajax/ajax_site.php",
        data: "action=addToWishList&id_prodotto=" + id_prodotto + "&lang=" + lang,
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

function couponRedeem(lang) {
    var coupon = $("input#coupon").val();
    if (coupon == '') {
        return;
    }
    $.ajax({
        url: "/_ext/ajax/ajax_site.php",
        data: "action=couponRedeem&coupon=" + coupon + "&lang=" + lang,
        type: "get",
        dataType: "json",
        success: function (data) {
            $(".modal-title").html('COUPON');
            $("#ajax-test").html(data.msg);
            $('#myModal').fadeIn();
            return;
        }
    });
}
