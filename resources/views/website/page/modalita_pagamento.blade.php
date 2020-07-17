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
                            <h2 class="fjalla">@lang('msg.modalita_pagamento')</h2>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <ol class="breadcrumb pull-right">
                            <li><a href="/">Home</a></li>
                            <li><a href="#" id="name_category">@lang('msg.modalita_pagamento')</a></li>
                        </ol>
                    </div>
                </div>
                <!-- FINE TITOLO PAGINA -->

                <div class="row">
                    <div class="col-md-12" style="background-color: #fff;">
                        <div class="page-catalogo-content">
                            @if(app()->getLocale() == 'it')
                                <b>Tutti i prodotti</b> acquistabili sul sito www.chess-store.it sono venduti direttamente da Marsili's Company s.n.c, con sede legale e amministrativa V.Borgo S.Iacopo 23/r, 50125 Firenze(Italy).<br>
                                Le immagini mostrate sul sito www.chess-store.it sono del tutto indicative e potrebbero differire anche in modo significativo dal prodotto effettivamente disponibile in quanto di produzione artigianale.<br><br>

                                <b>Disponibilità prodotti</b> Nel dettaglio di ogni prodotto sarà aggiornata la disponibilità in termini di tempo. <span style="text-decoration:underline;">In considerazione della particolare rapidità di cambiamento del mercato on-line, è tuttavia possibile che alcune offerte o articoli, siano nel frattempo esauriti. Ci riserviamo in tal caso di contattarti nel più breve tempo possibile per annullare l'ordine</span> (senza penali per entrambe le parti).<br><br>

                                <b>I prezzi</b> visualizzati nel sito www.chess-store.it sono <span style="text-decoration:underline;">IVA inclusa</span>.
                                L'IVA sulle vendite con destinazione USA/Canada, Asia, Africa, Oceania, America del Sud, Medio Oriente e Paesi non UE, verrà dedotta al momento dell'indicazione del luogo di spedizione della merce acquistata. Tali acquisti godono della detrazione Iva art. 8 DPR 633.<br>
                                L'IVA sulle vendite a soggetti commerciali UE in possesso di regolare partita iva comunitaria (che richiede emissione di
                                fattura Iva con regime di non applicazione Iva ai sensi art. 41 D.L. 331/93) verrà dedotta qualora l'acquisto venga effettuato per uso aziendale/professionale e non personale.<br><br>

                                <b>Le spese di trasporto</b> non sono incluse nei prezzi visualizzati e saranno applicate nella fase di pagamento, saranno dipendenti dal peso/volumetrico della merce acquistata e dal paese dove sarà spedita.<br><br>

                                <b>Tasse Doganali su vendite Extra Unione Europea</b>: gli acquisti effettuati non sono comprensivi delle imposte doganali di importazione per paesi come USA, Canada, Giappone e tutti i paesi extra UE.<br><br>

                                <b>Fatturazione</b>: Per ogni ordine Marsili's Company s.n.c. emetterà la relativa fattura di acquisto.<br><br>
                                <b>Servizio Clienti</b>: il Servizio Clienti <a href="mailto:customerservice@chess-store.it">customerservice@chess-store.it</a> di Marsili's Company è a disposizione per fornire assistenza necessaria in tutte le fasi d'acquisto e per tutte le informazioni commerciali.<br><br>

                                <h3 style="text-decoration:underline;font-size:16px;">Come Acquistare:</h3>
                                Entrare sul sito www.chess-store.it, registrarsi(x usare la lista dei desideri e visualizzare gli ordini effettuati), consultare sulla sinistra i prodotti raggruppati per Categorie.<br><br>
                                Ogni immagine è osservabile nei particolari cliccando sulla foto, cliccando sulla banda rossa alla base della foto si aprono i dettagli dell'oggetto.<br><br>
                                Usate la funzione "Lista dei desideri" per memorizzare i prodotti da valutare.<br><br>

                                <b><span style="text-decoration:underline;">FASE 1</span> (SHOPPING)</b> Una volta individuato l'articolo che si vuole acquistare, cliccare sul tasto Aggiungi al Carrello si aprirà una schermata dove si può scegliere “continua lo shopping” oppure “procedi con il check-out”, cliccando “procedi con il check-out” si apre una schermata con il riepilogo della merce in carrello a quel punto è sufficiente cliccare “procedi alla cassa” per accedere alla fase successiva.<br><br>

                                <b><span style="text-decoration:underline;">FASE 2</span> (AUTENTICAZIONE)</b> Inserisci username e password ed entra nel tuo account, se non hai un account registrati e crealo.<br><br>

                                <b><span style="text-decoration:underline;">FASE 3</span> (PAGAMENTO)</b> Scegli la modalità di pagamento e procedi all'acquisto.<br><br>

                                <h3 style="text-decoration:underline;font-size:16px;">Qualità, Garanzia, Resi:</h3>
                                Per ogni richiesta specifica di Uso e Manutenzione si prega scrivere a: <a href="mailto:customerservice@chess-store.it">customerservice@chess-store.it</a><br>
                                Nel caso il Cliente gradisca effettuare un reso del prodotto acquistato, Marsili's Company informa i propri clienti di tutelare i
                                diritti e gli interessi del consumatore mediante il rispetto delle disposizioni di legge in tema di:
                                <ul class="page_list">
                                    <li>trasparenza delle condizioni di acquisto</li>
                                    <li>diritto di recesso</li>
                                </ul>
                                Gli acquisti effettuati sul sito Marsili's Company s.n.c sono soggetti alla normativa di cui ai D.L. 50/1992 114/98 e 185/99 e successive leggi vigenti in materia di esercizio del diritto di recesso a favore del consumatore.<br>
                                Il Cliente che intenda esercitare il diritto di recesso deve: inviare entro 10 (dieci) giorni dalla ricezione del prodotto una raccomandata con avviso di ricevimento oppure una mail in PEC oppure un fax, contenente: la manifestazione di volontà di avvalersi dei benefici concessi dai D.L. 50/1992 114/98 e 185/99 e leggi seguenti e la copia del nostro scontrino fiscale e/o della nostra fattura.<br>
                                Le comunicazioni di cui ai punti precedenti devono essere spedite a Marsili's Company, sede legale e amministrativa Via
                                Borgo S.Iacopo 23/r, 50125 Firenze Italia, devono contenere l'indicazione del prodotto relativo,il motivo del reso, il numero progressivo d'ordine rilasciato al momento dell'acquisto/ordinazione ed essere comunicate dallo stesso soggetto che ha effettuato l'acquisto.<br><br>

                                <b>Nel caso di reso per non gradimento</b> il cliente entro lo stesso termine di 10 (dieci) giorni dalla ricezione della merce dovrà rispedire a Marsili's Company a mezzo posta o corriere o altro mezzo da lui scelto il prodotto relativamente al quale intende esercitare il diritto di recesso, tutte le spese di spedizione saranno a carico del cliente.<br>

                                Condizione necessaria per l'esercizio del diritto di recesso è la sostanziale integrità del prodotto e della confezione
                                (restituzione in normale stato di conservazione in quanto sia stata custodita ed eventualmente adoperata con l'uso della
                                normale diligenza).<br>
                                Per comodità del Cliente il prodotto dovrà essere corredato esclusivamente dalla fattura allegata al prodotto al momento
                                della consegna.<br>
                                Entro 30 (trenta) giorni dalla ricezione della comunicazione nella quale il consumatore esprime la volontà di esercitare il diritto di recesso, ed una volta avuto restituito il prodotto il cui acquisto risulta oggetto di recesso, Marsili's Company provvederà al rimborso mediante bonifico bancario del valore della merce acquistata escluso il costo di spedizione.<br><br>
                                <b>Nel caso di reso per difetto del prodotto</b> un corriere inviato da Marsili's Company provvederà al ritiro della merce presso il cliente e le spese di spedizione saranno poste a carico di Marsili's Company.<br>
                                Marsili's Company si impegna a rispedire entro 10 giorni dalla ricezione del reso un prodotto uguale a quello acquistato<br><br>
                                <h3 style="text-decoration:underline;font-size:16px;">Privacy:</h3>
                                Chess-store di <b>Marsili's Company</b>, con sede legale e amministrativa in Via borgo S.Iacopo 23/r, 50125 Firenze Italia, Tel/Fax + 39 055 2645488, applica e si impegna al rispetto delle norme in tema di privacy del D.Lgs 196/2003 e normative collegate vigenti.<br>
                                <span style="text-decoration:underline;">Norme sulla privacy e condizioni di comunicazione:</span><br>
                                - Informativa sul trattamento dei dati personali ai sensi del Dlgs 196/2003 -<br>
                                I dati riportati sono provenienti: dagli interessati con qualunque mezzo informatico o tramite via telefonica. Sono comunque riservati ai soggetti interessati tutti i diritti come da leggi e regolamenti vigenti, ad esempio: rettifica, integrazione, cancellazione etc.<br>
                                Marsili' Company si riserva comunque la facoltà della cancellazione dei dati. Con la registrazione darete il vostro consenso informato a Marsili's Company - titolare del trattamento dati - ed entrerete nei nostri database con possibilità di consultazione ed acquisto. Potrete inoltre ricevere gratuitamente le nostre newsletters informative.<br>
                                I dati forniti potranno essere trattati, oltre che per ottemperare agli obblighi previsti dalla legge, da un regolamento o dalla normativa comunitaria ed in particolare per dare integrale esecuzione a tutti gli obblighi contrattuali, anche per le seguenti finalità: invio di newsletter periodica contenente informazioni e notizie su nuovi prodotti in vendita e/o eventuali promozioni. I suddetti trattamenti potranno essere eseguiti usando supporti cartacei o informatici e/o telematici anche ad opera di terzi per i quali la conoscenza dei Vostri dati personali risulti necessaria o comunque funzionale allo svolgimento dell'attività di Marsili's Company; in ogni caso il trattamento avverrà con modalità idonee a garantirne la sicurezza e la riservatezza.<br>
                                In relazione al trattamento dei Vostri dati, potrete esercitare i diritti previsti dal Decreto Legislativo 30 giugno 2003, n. 196 "Codice in materia di protezione dei dati personali" pubblicato nella Gazzetta Ufficiale n. 174 del 29 luglio 2003, Supplemento Ordinario n. 123. Per esercitare i diritti previsti all'art. 7 del Codice in materia di protezione dei dati personali, sopra elencati, va rivolta una semplice richiesta email, senza particolari formalità, a Marsili's Company.<br><br>
                                <h3 style="text-decoration:underline;font-size:16px;">Controversie:</h3>
                                In caso di controversia è esclusivamente competente l'Autorità Giudiziaria di Firenze.<br><br><br>
                            @else
                                <b>All products</b> purchased on the web site www.chess-store.it are sold directly by Marsili's Company snc, established legal and administrative V.Borgo S.Iacopo 23 / r, 50125 Firenze (Italy).<br>
                                The images displayed on the web site www.chess-store.it may differ significantly from the actual product available as handicraft production<br><br>

                                <b>Product availability</b> In the detail of each product will be updated the availability in terms of time. Given the particular rate of change of the online market, it is possible that some offers or articles, have since sold out. We reserve the right in this case to contact you as soon as possible to cancel the order (no charge for both sides).<br><br>

                                <b>The prices</b> displayed on the site www.chess-store.it <span style="text-decoration:underline;">include taxes</span>.<br>
                                VAT on sales to US destinations / Canada, Asia, Africa, Oceania, South America, the Middle East and countries outside the EU will be deducted at the time of indication of the place of delivery of the goods purchased .These purchases benefit of the deduction of VAT Art.8 DPR 633.<br>
                                The VAT on sales to EU business entities in possession of a valid EU VAT number (which requires an invoice with VAT regime of non-application of VAT pursuant to Art. 41 D.L. 331/93) will be deducted if the purchase is made for business use and not personal.<br><br>

                                <b>Shipping charges</b> are not included in the prices shown and will be applied in the payment phase will be dependent on the weight / volume of goods purchased and the country where it will be shipped.<br><br>

                                <b>Customs Tax on sales outside the European Union</b>: purchases do not include the customs duties for imports of countries like USA, Canada, Japan and all countries outside the EU.<br><br>

                                <b>Billing</b>: For every order Marsili's Company snc will make the invoice of the purchase.<br><br>

                                <b>Customer Service</b>: Customer Service <a href="mailto:customerservice@chess-store.it">customerservice@chess-store.it</a> of Marsili's Company is available to provide necessary assistance at all stages of purchase and for all business information.<br><br>

                                <h3 style="text-decoration:underline;font-size:16px;">How to buy:</h3>
                                Enter in the web site www.chess-store.it, sign (x use the wish list and view your orders), look at the Products grouped by categories on the left.<br><br>
                                Each image can be observed in detail by clicking on the photo, click on the red band at the bottom of the picture to open the item details.<br><br>
                                Use the "Wish List" to store the products.<br><br>

                                <b><span style="text-decoration:underline;">STEP 1</span> (SHOPPING)</b> Once you find the item you want to buy, click on the Add to Cart button will open a screen where you can choose continue shopping" or "proceed to checkout", clicking "proceed to check-Out "opens a screen with the list of goods in shopping cart then simply click" proceed to checkout "to go to the next step.<br><br>

                                <b><span style="text-decoration:underline;">STEP 2</span> (AUTHENTICATION))</b> Insert your username and password and login to your account, if you do not have an account register and create it..<br><br>

                                <b><span style="text-decoration:underline;">STEP 3</span> (FREE)</b> Choose the mode of payment, and purchase.<br><br>

                                <h3 style="text-decoration:underline;font-size:16px;">Quality, Warranty, Returns:</h3>
                                For any specific request for Operation and Maintenance, please write to: <a href="mailto:customerservice@chess-store.it">customerservice@chess-store.it</a><br>
                                If the customer likes to return a product purchased, Marsili's Company informs its customers to protect the rights and interests of consumers through compliance with the provisions of the law on the subject of:
                                <ul class="page_list">
                                    <li>Transparency of the conditions of purchase</li>
                                    <li>Right of withdrawal</li>
                                </ul>
                                Purchases made on site Marsili's Company snc are subject to the rules set out in D.L.50/1992 114/98 and 185/99 and subsequent laws on the exercise of the right of withdrawal for the consumer.<br>
                                The customer who wishes to exercise the right of withdrawal must submit <b>within ten (10) days</b> of receipt of the product a letter with acknowledgment of receipt or an email PEC or a fax, expressing his wish to avail oneself of the benefits granted by Legislative Decree 50/1992 114/98 and 185/99 and following laws and a copy of our receipt and / or our invoice.<br>The notifications referred to in the preceding paragraphs should be sent to Marsili's Company, registered office and administrative Via Borgo S.Iacopo 23 / r, 50125 Florence Italy, must contain the information on the product, the reason for the return, the sequence number of order issued at the time of purchase / order and be communicated by the same person who made the purchase.<br><br>

                                <b>In case of return for not liking</b> the customer within the same period of ten (10) days of receipt of the goods shall return to Marsili's Company by post or courier or other means he chose the item for which he intends to exercise the right of withdrawal ,all shipping charges will be borne by the customer.<br>

                                A necessary condition for the exercise of the right of withdrawal is the integrity of the product and the packaging (return to normal condition as it has been preserved and possibly used with the use of reasonable diligence).<br>
                                For the convenience of the customer, the product must be accompanied only by the invoice attached to the product at the time of delivery.<br>
                                Within thirty (30) days of receipt of notice in which the consumer expresses the intention to exercise the right of withdrawal, and once had returned the product whose purchase is subject to withdrawal, Marsili's Company will reimburse the bank transfer of the value of goods purchased excluding shipping costs.<br>
                                <b>In case of return for product defected</b> a courier sent by Marsili's Company will collect the goods at the customer and the shipping charges will be borne by Marsili's Company. Marsili's Company agrees to return within 10 days of receipt of the returned product equal to that purchased<br><br>
                                <h3 style="text-decoration:underline;font-size:16px;">Privacy:</h3>
                                Chess-store of Marsili's Company, with headquarters and administrative office in Via Borgo S.Iacopo 23 / r, Florence 50125 Italy Tel / Fax + 39 055 2645488, applies and is committed to compliance with the rules on privacy of Legislative Decree 196/2003 and related regulations in force.<br>
                                <span style="text-decoration:underline;">Terms of Privacy and communications:</span><br>
                                - Information on the processing of personal data pursuant to Legislative Decree 196/2003 -<br>
                                The data shown are from: from interested parties by computer or telephone. Are reserved to parties all the rights as per the applicable laws and regulations, for example, correction, integration, cancellation, etc.<br>
                                Marsili 'Company reserves the right to deletion of data. By registering you will give your informed consent to Marsili's Company and you will enter in our database with full browse and purchase. You will also receive free informational newsletters.<br>
                                The data provided will be treated in order to comply with the obligations provided for by law, regulations or Community legislation and in particular to give full effect to all contractual obligations, including for the following purposes: sending a periodic newsletter containing information and news about new products, sales and / or any promotions. The above can be performed using paper or computer and / or remote even by third parties for whom the knowledge of your personal information is necessary or useful to carry out the activity of Marsili's Company; in any case the treatment will take place with appropriate procedures to ensure the security and confidentiality.<br>
                                In regard to the processing of your data, you may exercise the rights provided for by Legislative Decree 30 June 2003, n. 196 "Code concerning the protection of personal data" published in the Official Gazette no. 174 of 29 July 2003, Ordinary Supplement no. 123. In order to exercise the rights under Art. 7 of the Code regarding the protection of personal data listed above, should be given a simple email request, in any form, in Marsili's Company.<br><br>
                                <h3 style="text-decoration:underline;font-size:16px;">Disputes:</h3>
                                In the case of the exclusive competence of the judicial authorities of Florence.<br><br><br>
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
