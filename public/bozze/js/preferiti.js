<script type="text/javascript">
<!--
function Preferiti()
{
    var title = document.title;
    var url = document.location.href;
    if (window.sidebar) // Mozilla Firefox
    {
        window.sidebar.addPanel(title, url, "");
    }
    else if (window.external) // Internet Explorer
    {
        window.external.AddFavorite(url, title);
    }
    else if (window.opera && window.print) // Opera
    {
        var elem = document.createElement('a');
        elem.setAttribute('href', url);
        elem.setAttribute('title', title);
        elem.setAttribute('rel', 'sidebar');
        elem.click();
    }
}
//-->
</script>

