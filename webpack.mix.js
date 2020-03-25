const mix = require('laravel-mix');

// PER IL WEBSITE
mix.styles(
    [
        'resources/assets/css/bootstrap.min.css',
        'resources/assets/css/bootstrap-dropdownhover.min.css',
        'resources/assets/css/bootstrap-datepicker.css',
        'resources/assets/font/css/font-awesome.min.css',
        'resources/assets/simple-line-icon/css/simple-line-icons.css',
        'resources/assets/css/animate.min.css',
        'resources/assets/css/style.css',
        'resources/assets/css/baguetteBox.css',
        'resources/assets/owl-carousel/owl.carousel.css',
        'resources/assets/owl-carousel/owl.theme.css',
        'resources/assets/css/mystyle.css',
        'resources/assets/css/magnific-popup.css',
    ],
    'public/assets/css/all.css'

);

//PER IL CMS (non toccare)
mix.sass('resources/cms_assets/font-awesome/scss/font-awesome.scss', 'public/cms_assets/font-awesome/css');
mix.styles(
    [
        'resources/cms_assets/css/bootstrap.css',
        'resources/cms_assets/css/animate.css',
        'resources/cms_assets/css/plugins/dataTables/datatables.min.css',
        'resources/cms_assets/css/plugins/summernote/summernote-bs4.css',
        'resources/cms_assets/css/plugins/dropzone/dropzone.css',
        'resources/cms_assets/css/plugins/blueimp/css/blueimp-gallery.min.css',
        'resources/cms_assets/css/plugins/sweetalert/sweetalert.css',
        'resources/cms_assets/css/plugins/chosen/bootstrap-chosen.css',
        'resources/cms_assets/css/plugins/datapicker/datepicker3.css',
        'resources/cms_assets/css/plugins/chosen/bootstrap-chosen.css',
        'resources/cms_assets/css/style.css',
        'resources/cms_assets/css/custom.css',
    ],
    'public/cms_assets/css/all.css'

);


