<!-- caricamento altri prodotti AJAX on scroll -->
<script>
    var no=1;
    var page=2;
    var lastpage = parseInt('{{$paginator->lastPage()}}');
    $(window).scroll(function () {
        if(no==1)
        {
            if(page <= (lastpage + 1))
            {
                if ($(window).scrollTop() >= ($(document).height() - $(window).height())*0.7){
                    no=2;
                    show_others_for_scroll('?page='+page);
                    page = page + 1;

                    setTimeout(function(){ no=1; }, 3000);
                }
            }

        }
    });
</script>
<!-- -->