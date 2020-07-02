
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="/plugins/jquery-ui/jquery-ui.js"></script>

<script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/plugins/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="/plugins/rs-plugin/js/jquery.themepunch.revolution.js"></script>
<script src="/plugins/owl-carousel/owl.carousel.js"></script>
<script src="/plugins/selectbox/jquery.selectbox-0.1.3.min.js"></script>
<script src="/plugins/countdown/jquery.syotimer.js"></script>
<script src="/js/jquery.magnific-popup.min.js"></script>
<script src="/js/lightbox.js"></script>
<script src="/_ext/js/jquery.validate.js"></script>
<script src="/_ext/js/additional-methods.js"></script>
<script src="/js/custom.js"></script>
<script src="/js/website.js"></script>
<script>
    $(document).ready(function () {
        $('.galleria-item2').magnificPopup(
                {
                    type: 'image',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                    },
                });
    });
</script>
<?php if ($this->lang == 'ita'): ?>
    <script src="/js/il18n-datepicker-it.js"></script>
<?php endif; ?>

<?php if ($this->lang == 'ita'): ?>
    <script>
    $(document).ready(function () {
        var d = new Date();
        var final_dp_date = d.getFullYear();
        $('.datepicker').datepicker({
            dateFormat: "dd/mm/yy",
            yearRange: "1920:" + final_dp_date + "",
            changeYear: true,

            regional: "it"
        });
    });

    </script>	
<?php else: ?>
    <script>
        $(document).ready(function () {
            var d = new Date();
            var final_dp_date = d.getFullYear();
            $('.datepicker').datepicker({
                dateFormat: "dd/mm/yy",
                yearRange: "1920:" + final_dp_date + "",
                changeYear: true,

            });
        });

    </script>
<?php endif; ?>
<script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', ' https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-32581493-43', 'auto');
    ga('send', 'pageview');
    ga('set', 'anonymizeIp', true);
<!-- Global site tag (gtag.js) - Google Ads: 1071317029 -->

        
    $(document).ready(function () {
        // mailto: function
        $('a[href^="mailto:"]').click(function () {
             ga("send", "event", "email", "submit");

        });

        // tel: function
        $('a[href^="tel:"]').click(function () {
             ga("send", "event", "telefono", "submit");
        });
    });
    </script>
