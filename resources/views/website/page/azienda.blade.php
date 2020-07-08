@extends('layouts.website')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="background-color:#e4e0dc;">
                <div class="row">
                    <div class="col-md-2 hidden-xs hidden-sm" style="background-color:#e4e0dc; padding-top:20px;padding-bottom: 20px;">
                        <!-- MENU' DESKTOP -->
                        @include('layouts.website_menu_desktop')
                        <!-- FINE MENU' DESKTOP -->
                    </div>
                    <div class="col-md-10" style="">
                        <div class="row">
                            <div class="col-md-12" style="padding-right: 0px;">
                                <img src="/img/negozio_scacchi_online_2a.jpg" alt="{{$seo->alt ?? ''}}" class="img-responsive" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-content" style="padding:60px 0;">
                    @if(app()->getLocale() == 'it')
                        <strong>MARSILI'S COMPANY</strong> apre nel marzo 2002 in Borgo San Iacopo, nel cuore di Firenze a soli 100mt da Ponte Vecchio.<br /><br /> <strong>MARSILI'S COMPANY</strong> &egrave; un punto vendita esclusivo specializzato in SCACCHI e SCACCHIERE di ogni genere e dimensione adatti al piccolo e al grande regalo:
                        <ul>
                            <li><strong>Scacchi in Ottone</strong> torniti in svariate linee classiche e moderne.</li>
                            <li><strong>Scacchi in Resina</strong> completamente dipinti a mano, raffiguranti personaggi storici o fantastici</li>
                            <li><strong>Scacchi in Bronzo</strong> prodotti con stampi a cera persa e rifiniti con vero oro e argento, riproducenti gloriose armature e battaglie del passato.</li>
                            <li><strong>Scacchiere, tavoli da gioco e set gioco da viaggio</strong> realizzati in tanti materiali e finiture : alabastro, radica di olmo, noce, palissandro ecc..</li>
                        </ul>
                        <br />
                        La maggior parte dei SET SCACCHI in vendita sono prodotti artigianalmente nella propria fabbrica <strong>ITALFAMA</strong> unica nel mondo per il suo genere.<br /><br> <strong>MARSILI'S COMPANY</strong> inoltre vende articoli da regalo di altissima qualit&agrave;:
                        <ul>
                            <li><strong>Statue in Resina Bronzata</strong> rappresentanti opere d&rsquo;arte dei grandi maestri: Leonardo da Vinci,Michelangelo,Canova ecc.., personaggi storici: Musicisti, Filosofi, Guerrieri Romani, Guerrieri Spartani ecc..,arte moderna e molte atre categorie</li>
                            <li><strong>Sculture in Peltro</strong> raffiguranti cavalieri,guerrieri e armature del passato</li>
                            <li><strong>Mappamondi e Clessidre</strong> di altissima finitura e qualit&agrave;</li>
                        </ul>
                    @else
                        <strong>MARSILI'S COMPANY</strong> opened in March 2002 in Borgo San Jacopo, in the heart of Florence, just 100 meters far from the Old Bridge.<br>
                        <strong>MARSILI'S COMPANY</strong> is an exclusive store specializing in CHESS-MEN and CHESS-BOARDS of all types and sizes suitable for the small and the great gift:<br>
                        <ul class="page_list">
                            <li><b>Brass Turned Chess</b> in many different classical and modern lines.</li>
                            <li><b>Resin Chess</b> completely hand painted representing famous historical or fantastic characters.</li>
                            <li><b>Bronze Chess</b> lost wax casting moulds products and finished with real gold and silver reproducing armour and glorious battles of the past</li>
                            <li><b>Chessboards, game tables and travel games sets</b> made in many materials and finishes: alabaster, elm briar wood, walnut, rosewood ecc..</li>
                        </ul>
                        Most chess set sold are hand made in our own factory ITALFAMA unique in the world.<br>
                        <strong>MARSILI'S COMPANY</strong> also sells gift items of high quality:<br>
                        <ul class="page_list">
                            <li><b>Bronzed Resin Statues</b> representing art of the great masters: Leonardo da Vinci,Michelangelo,Canova etc..,Historical Characthers: Musicians,Philosophers,Romans Warriors, Spartan Warriors etc..,Modern Art and so many other categories</li>
                            <li><b>Pewter Sculptures</b> representing Knights,soldiers, armours of the past</li>
                            <li><b>Globes and Hourglasses</b> in high quality and finishing</li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>

    </div>

@endsection
@section('js_script')

@stop
