@extends('layouts.website')
@section('content')
    <div class="col-md-12" style="background-color:#e4e0dc;">
        <div class="row">
            <div class="col-md-2 hidden-xs hidden-sm" style="background-color:#e4e0dc; padding:20px 0;">
                <!-- MENU' DESKTOP -->
                @include('layouts.website_menu_desktop')
                <!-- FINE MENU' DESKTOP -->
                    <!-- box facebook -->
                @include('layouts.website_box_facebook')
                <!-- -->
                    <!-- box spedizione -->
                @if(app()->getLocale() == 'it')
                    @include('layouts.website_box_spedizione')
                @endif
                <!-- -->
            </div>
            <div class="col-md-10" style="background-color: #fff;">
                <!-- TITOLO PAGINA -->
                <div class="row header-page">
                    <div class="col-xs-6">
                        <div class="page-title">
                            <h2 class="fjalla">@lang('msg.informativa')</h2>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <ol class="breadcrumb pull-right">
                            <li><a href="/">Home</a></li>
                            <li><a href="#" id="name_category">@lang('msg.informativa')</a></li>
                        </ol>
                    </div>
                </div>
                <!-- FINE TITOLO PAGINA -->

                <div class="row">
                    <div class="col-md-12" style="background-color: #fff;">
                        <div class="page-catalogo-content">
                            @if(app()->getLocale() == 'it')
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                    <!--DWLayoutTable-->
                                    <tr>
                                        <td width="490" height="425" valign="top">
                                            <p align="center" class="Stile4">INFORMATIVA AI SENSI DELL&rsquo;ART. 13 DEL D. LGS. 30 GIUGNO 2003 N. 196</p>
                                            <p class="stile_informativa"><strong>Titolare del trattamento dei dati personali</strong>.
                                                <strong>Marsili's Company</strong> via Borgo S. Jacopo 23/r <br/>50125 Firenze (FI)  &egrave; titolare del trattamento dei dati personali.</p>
                                            <p><span class="Stile4">Finalit&agrave; del trattamento. </span><span class="stile_informativa">I dati personali forniti sono trattati nell&rsquo;ambito della normale attivit&agrave; di Marsili's Company, secondo le seguenti finalit&agrave;: </span>
                                            <ul>
                                                <li class="stile_informativa" style="margin-left:40px;">per dare esecuzione alla richiesta che l&rsquo;utente sta compiendo;</li>
                                                <li class="stile_informativa" style="margin-left:40px;">per esigenze di tipo operativo e gestionale;</li>
                                                <li class="stile_informativa" style="margin-left:40px;">per effettuare analisi statistiche;</li>
                                                <li class="stile_informativa" style="margin-left:40px;">per ottemperare agli obblighi di legge;</li>
                                            </ul>
                                            <p class="stile_informativa">I trattamenti saranno effettuati con l&rsquo;ausilio di mezzi elettronici o comunque automatizzati e comprendono, nel rispetto dei limiti e delle condizioni poste dall&rsquo;art. 11 del D. Lgs. 196/2003, tutte le operazioni o complesso di operazioni previste dallo stesso decreto con il termine &ldquo;trattamento&rdquo;.</p>
                                            <p class="stile_informativa"><strong>Natura del trattamento.</strong> Il conferimento dei dati personali ha natura facoltativa. Tuttavia il mancato conferimento, anche parziale, dei dati richiesti nei campi contrassegnati da un asterisco determiner&agrave; l&rsquo;impossibilit&agrave; di inoltrare la richiesta e di procedere all&rsquo;erogazione dei servizi offerti.</p>
                                            <p class="stile_informativa"><strong>Comunicazione e diffusione dei dati.</strong> I dati raccolti non saranno oggetto di diffusione o comunicazione a terzi se non nei casi previsti dall&rsquo;informativa e/o dalla legge e comunque con le modalit&agrave; da questa consentite. </p>
                                            <p class="stile_informativa"><strong>Diritti dell&rsquo;interessato</strong>. Ai sensi dell&rsquo;art. 7 del D. Lgs. N. 196/03 l&rsquo;interessato ha diritto ad ottenere l&rsquo;indicazione: della conferma dell&rsquo;esistenza o meno di dati personali che lo riguardano e della loro comunicazione in forma intelligibile, dell&rsquo;origine dei dati personali, delle finalit&agrave; e delle modalit&agrave; del trattamento, della logica applicata in caso di trattamento effettuato con l&rsquo;ausilio di strumenti elettronici, degli estremi identificativi del titolare, dei soggetti ai quali i dati possono essere comunicati. L&rsquo;interessato ha diritto di ottenere: l&rsquo;aggiornamento, la rettificazione ovvero, quando vi ha interesse, l&rsquo;integrazione dei dati, la cancellazione, la trasformazione in forma anonima o il blocco dei dati trattati in violazione di legge, compresi quelli di cui non &egrave; necessaria la conservazione in relazione agli scopi per i quali sono stati raccolti o successivamente trattati; l&rsquo;interessato ha diritto di opporsi per motivi legittimi al trattamento dei dati personali che lo riguardano anche ai fini dell&rsquo;invio di materiale pubblicitario, di vendita diretta o per ricerche di mercato o di comunicazione commerciale.</p>
                                            <p class="stile_informativa">Per esercitare i suddetti diritti l'interessato pu&ograve; scrivere a <a href="mailto:info@chess-store.it?subject=Richiesta inviata da www.chess-store.it" style="text-decoration:none; color:#660000;"><strong>info@chess-store.it</strong></a> o telefonare al numero  +39 055 2645488.</p>
                                        </td>
                                    </tr>
                                </table>
                            @else
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                    <!--DWLayoutTable-->
                                    <tr>
                                        <td width="100%" height="425" valign="top" class="stile_informativa"><p><strong>DISCLOSURE PURSUANT TO ART. 13 OF D. LGS. 30 JUNE 2003 N. 196 AND OF GDPR European Regulations 2016/679</strong></p>
                                            <p><strong>Handling of personal data</strong>. Marsili's Company  via Borgo S. Jacopo 23/r <br/>50125 Firenze (FI), shall handle the personal data supplied. </p>
                                            <p><strong>Purpose for handling personal data</strong>. The personal data supplied shall be used for the normal activities pertaining to Marsili's Company as follows:</p>
                                            <ul>
                                                <li style="margin-left:40px;">to carry out the request completed by the user;</li>
                                                <li style="margin-left:40px;">to carry out normal operative and management procedures;</li>
                                                <li style="margin-left:40px;">to carry out statistical analyses; </li>
                                                <li style="margin-left:40px;">to satisfy legal obligations.</li>
                                            </ul>
                                            <p>Handling of data will be carried out using electronic or automated means and includes, in agreement with the limits and conditions imposed by Art. 11 of Leg. Decree 196/2003, all operations or complex of operations as outlined by said decree under the term &ldquo;handling&rdquo;.<br>
                                                <br>
                                                <strong>Nature of data handling</strong>. Transmission of personal data is optional. However, if data is not supplied, or is incomplete, in data fields indicated by an asterisk, it will be impossible to forward the request and carry out the procedures necessary for delivery of services.</p>
                                            <p><strong>Communication and diffusion of data</strong>. The data collected shall not be supplied or communicated to third parties, except in the cases provided for by law, and however according to the permitted modalities. </p>
                                            <p><strong>Rights of the interested party</strong>. According to Art. 7 of Legislative Decree no. 196/03, the interested party has the right to obtain: confirmation of the existence or not of their personal data and communication thereof in an intelligible form; information regarding the origin of their personal data; information regarding the aims for and modalities of handling; information regarding the applied logic in cases of handling carried out by electronic means; identification details regarding the proprietor; information regarding the recipients of the data. The interested party has the right to obtain: up-dates; correction or integration of data; cancellation; transformation in anonymous form or block of data handled in violation of the law, including those for whom conservation of the data is not appropriate for the aims of its collection or subsequent handling. The interested party has the right to oppose, for legitimate reasons, the handling of personal data for the delivery of publicity materials, solicitation of direct sales, for market research or commercial communications.</p>
                                            <p>In order to exercise the above-mentioned rights, please write to <a href="mailto:info@chess-store.it?subject=Richiesta inviata da www.chess-store.it" title="Chess store">info@chess-store.it</a> or phone +39 055 2645488.</p>
                                            <br>
                                            The contents will be treated exclusively for purposes related to the company activity up to an explicit request of cancellation by the interested party according to article 13 paragraph 2 letter A.
                                        </td>
                                    </tr>
                                </table>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js_script')
@stop
