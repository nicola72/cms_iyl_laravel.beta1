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
                            <h2 class="fjalla">Cookies Policy</h2>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <ol class="breadcrumb pull-right">
                            <li><a href="/">Home</a></li>
                            <li><a href="#" id="name_category">Cookies Policy</a></li>
                        </ol>
                    </div>
                </div>
                <!-- FINE TITOLO PAGINA -->

                <div class="row">
                    <div class="col-md-12" style="background-color: #fff;">
                        <div class="page-catalogo-content">
                            @if(app()->getLocale() == 'it')
                                <div id="policy" style="padding-top:30px">
                                    <h3>Cookies Policy</h3>
                                    <br>
                                    <br> Il nostro sito Web fa uso di cookie allo scopo di migliorare
                                    l'esperienza online di tutti i nostri utenti. <br>
                                    <br> All'interno della nostra Policy sui Cookie descriviamo cosa sono i
                                    cookie e in che modo vengono usati sul nostro sito internet. Ti
                                    invitiamo a consultare la nostra Privacy Policy per ulteriori
                                    informazioni su come vengono usati i dati personali degli utenti che si
                                    collegano ai nostri siti internet e sull'importanza con cui
                                    consideriamo la protezione della tua privacy. <br>
                                    <br> Il nostro sito web e i servizi in esso contenuti non possono
                                    essere usati senza la presenza di Cookie e pertanto nell'utilizzare la
                                    nostra piattaforma Web, acconsenti all'uso di Cookie in conformità con
                                    i termini di detta politica. <br>
                                    <br>
                                    <br> <strong>Cosa sono i Cookie?</strong> <br>
                                    <br> I Cookie sono file di testo che contengono stringhe di testo di
                                    piccola dimensione inviate da un server Web ad un client (di solito un
                                    browser) e poi rimandati indietro dal client al server (senza subire
                                    modifiche) ogni volta che il client accede alla stessa porzione dello
                                    stesso dominio Web. I Cookie non contengono alcuna informazione in
                                    grado di identificare direttamente un utente, tuttavia, le informazioni
                                    personali conservate nel nostro sito possono essere collegate, da parte
                                    nostra, alle informazioni memorizzate nei Cookie e ottenute dai Cookie.
                                    <br>
                                    <br>
                                    <br> <strong>Uso dei Cookie</strong> <br>
                                    <br> Le informazioni che otteniamo in seguito all'uso dei nostri Cookie
                                    sono utilizzate per i seguenti scopi:
                                    <ul>
                                        <li>Per riconoscere il computer dell'utente quando visita il nostro
                                            sito Web</li>
                                        <li>Per migliorare l'usabilità del sito Web</li>
                                        <li>Per analizzare l'utilizzo del sito Web</li>
                                        <li>Per amministrare questo sito Web</li>
                                        <li>Per prevenire le frodi e migliorare la sicurezza del sito Web</li>
                                        <li>Per personalizzare il nostro sito Web (con messaggi mirati che
                                            possono essere di interesse per l'utente)</li>
                                        <li>Per tenere traccia della navigazione dell'utente durante la sua
                                            visita</li>
                                    </ul>
                                    <br>
                                    <br> <strong>L'abilitazione dei Cookie è sicura?</strong><br> <br> Sì.
                                    I Cookie contengono solo piccole porzioni di dati e non possono
                                    eseguire alcuna operazione in maniera autonoma. Ti raccomandiamo di
                                    configurare il browser Web in modo tale da accettare Cookie provenienti
                                    dal nostro sito. <br>
                                    <br>
                                    <br> <strong>Come puoi modificare le impostazioni per i Cookie?</strong><br>
                                    <br> Per modificare le impostazioni riguardo ai Cookie, devi variare le
                                    impostazioni del browser che utilizzi. Dato che i browser vengono
                                    aggiornati di frequente e le piattaforme che li supportano sono sempre
                                    più numerose, non è possibile fornire un'unica guida idonea a tutte le
                                    versioni di browser e dispositivi. Tuttavia i seguenti collegamenti
                                    rimandano ad una ricerca Google con le opportune parole chiave relative
                                    alla modifica dei Cookie per ogni principale browser. Personalizza la
                                    ricerca inserendo la versione del browser e la piattaforma che utilizzi
                                    (PC, MAC, iPhone, Android, BlackBerry eccetera).
                                    <ul>
                                        <li>Internet Explorer</li>
                                        <li>Mozilla Firefox</li>
                                        <li>Chrome</li>
                                        <li>Safari</li>
                                    </ul>
                                    <br>
                                    <br> <strong>Quanti tipi di Cookie esistono?</strong> <br>
                                    <br> Sul nostro sito Web vengono utilizzati tre tipi diversi di Cookie:

                                    <ul>
                                        <li><strong>Cookie di sessione</strong>: file temporanei che vengono
                                            memorizzati solo per la durata della sessione di navigazione sul sito
                                            Web. Il browser Web normalmente li elimina alla chiusura.</li>
                                        <li><strong>Cookie persistenti</strong>: la durata di questi file
                                            supera la sessione del browser (ad esempio, se si esegue l'accesso a
                                            un sito Web, questo riconosce l'utente alla sua visita successiva). I
                                            Cookie persistenti consentono funzionalità come avvisi di benvenuto,
                                            mantenimento degli oggetti nel carrello (in caso di acquisti online),
                                            riconoscimento delle preferenze come lingue, colori eccetera.</li>
                                        <li><strong>Cookie di terze parti</strong>: durante la navigazione del
                                            nostro sito Web, l'utente potrebbe trasmettere Cookie a terze parti
                                            non legate alla nostra azienda. Se si accede a una pagina Web con
                                            contenuti incorporati, ad esempio YouTube, potrebbero essere
                                            trasmessi dei Cookie da e verso tale sito. Non abbiamo il controllo
                                            di questi Cookie, pertanto ti consigliamo di consultare i siti Web di
                                            terze parti per maggiori informazioni riguardanti i Cookie di cui
                                            fanno uso e come gestirli.</li>
                                    </ul>

                                    <br>
                                    <br> <strong>Cookie presenti sul nostro sito internet</strong><br>
                                    <br> Di seguito viene riportato un elenco dei Cookie utilizzati dal
                                    nostro sito, con una spiegazione del singolo utilizzo:
                                    <ul>
                                        <li>Proprietario Tipo di Cookie Utilizzo</li>
                                        <li>Questo sito Temporaneo Sessione</li>
                                        <li>Google Persistente Statistiche utilizzo</li>
                                        <li>Facebook Persistente Login</li>
                                        <li>Twitter Persistente Login</li>
                                        <li>Blocco dei Cookie.</li>
                                    </ul>
                                    <br> Tutti i browser consentono di rifiutare i Cookie. Dato che i
                                    browser vengono aggiornati di frequente e le piattaforme che li
                                    supportano sono sempre più numerose, non è possibile fornire un'unica
                                    guida idonea a tutte le versioni di browser e dispositivi. <br> Il
                                    blocco dei Cookie, tuttavia, può avere un impatto negativo
                                    sull'usabilità di molti siti Web. <br>
                                    <br>
                                    <br> <strong>Eliminazione dei Cookie</strong><br>
                                    <br> È possibile eliminare i Cookie già memorizzati sul proprio
                                    computer. Dato che i browser vengono aggiornati di frequente e le
                                    piattaforme che li supportano sono sempre più numerose, non è possibile
                                    fornire un'unica guida idonea a tutte le versioni di browser e
                                    dispositivi. <br> Questa azione può avere conseguenze negative riguardo
                                    l'usabilità di molti siti Web. <br>
                                    <br>
                                    <br> <strong>Altre tecnologie presenti sul nostro sito</strong><br>
                                    <br> <em>Google Analytics</em> <br> Google Analytics è uno strumento di
                                    analisi di Google che aiuta i proprietari di siti web e app a capire
                                    come i visitatori interagiscono con i contenuti di loro proprietà. Si
                                    può utilizzare un set di cookie per raccogliere informazioni e generare
                                    statistiche di utilizzo del sito web senza identificazione personale
                                    dei singoli visitatori da parte di Google.<br>
                                    <br> <em>Google Maps</em><br> Google Maps è un servizio di
                                    visualizzazione di mappe gestito da Google Inc. che migliora
                                    notevolmente l'esperienza degli utenti sul nostro sito web. Google
                                    Maps, infatti, fornisce informazioni dettagliate sulla localizzazione
                                    di uno specifico esercizio commerciale o attività ricettiva presente
                                    sul territorio.<br>
                                    <br>


                                </div>
                            @else
                                <div id="policy" style="padding-top:30px">
                                    <br /> <br /> Our websites use cookies to improve the online experience
                                    for all our users. <br> Within our Cookie Policy we describe what
                                    cookies are and how they are used in our website. Please see our
                                    Privacy Policy for more information on how we use the personal data of
                                    users who connect to our websites and on the importance with which we
                                    consider the protection of your privacy. <br> Our web site and services
                                    contained in it cannot be used without the presence of cookies and
                                    therefore to use our Web platform, you consent to the use of cookies in
                                    accordance with the terms of that policy. <br>
                                    <br>
                                    <br> <strong>What are cookies?</strong> <br>
                                    <br> Cookies are text files that contain text strings of small size
                                    sent from a Web server to a client (usually a browser) and then sent
                                    back by the client to the server (without changes) each time the client
                                    accesses the same portion the of the same web domain. Cookies do not
                                    contain any information that can directly identify a user, however, the
                                    personal information stored on our site can be linked, on our part, to
                                    the information stored in the cookie and obtained by the cookie. <br>
                                    <br>
                                    <br> <strong>Cookie Usage</strong> <br>
                                    <br> The information we obtain through use of our Cookies are used for
                                    the following purposes:
                                    <ul>
                                        <li>To recognize your computer when you visit our website</li>
                                        <li>To improve the usability of the Web site</li>
                                        <li>To analyze the use of the Web site</li>
                                        <li>To administer this website</li>
                                        <li>To personalize our website (with targeted messages that may be of
                                            interest to the user)<!--<li-->To keep track of the user's navigation
                                            during his visit.
                                        </li>
                                    </ul>
                                    <br>
                                    <br> <strong>Is the enabling of cookies safe?</strong> <br>
                                    <br> Yes. Cookies contain only small amounts of data and cannot work
                                    independently. We recommend that you configure your Web browser in
                                    order to accept cookies from our website. <br>
                                    <br>
                                    <br> <strong>How can you change the settings for cookies?</strong> <br>
                                    <br> To change the settings regarding cookies, you must change the
                                    settings of the browser you use. Since browsers are updated frequently
                                    and the platforms that support them more and more, it is not possible
                                    to provide a single guide suitable for all versions of browsers and
                                    devices. However the following links refer to a Google search with the
                                    appropriate keywords related to the modification of the Cookie for each
                                    major browser. Customize your search by entering the browser version
                                    and the platform you use (PC, MAC, iPhone, Android, BlackBerry, etc.).
                                    <ul>
                                        <li>Internet Explorer</li>
                                        <li>Mozilla Firefox</li>
                                        <li>Chrome</li>
                                        <li>Safari</li>
                                    </ul>
                                    <br>
                                    <br> <strong>How many types of cookies are there?</strong> <br>
                                    <br> On our website three different types of Cookies are used:
                                    <ul>
                                        <li>Session Cookies: Temporary files that are stored only for the
                                            duration of the browsing session on the website. The web browser
                                            normally deletes them at closing.</li>

                                        <li>Persistent Cookies: The duration of these files exceeds the
                                            browser session (for example, if you log on to a Web site, it
                                            acknowledges the user on his subsequent visit). The Persistent
                                            cookies enable features such as welcomes, maintenance of the items in
                                            your cart (in the case of online purchases), recognition of
                                            preferences such as languages, colours and so on.</li>

                                        <li>Third-party Cookies: while browsing our Web site, the user may
                                            transmit Cookies to third parties not related to our company. If you
                                            access a Web page with embedded content, such as YouTube, Cookies can
                                            be transmitted to and from that site. We have no control over these
                                            cookies, we encourage you to consult the Web sites of third parties
                                            for further information regarding the cookies they use and how to
                                            handle them.</li>
                                    </ul>
                                    <br>
                                    <br> <strong>Cookies on our website</strong> <br>
                                    <br> The following is a list of cookies used by our website, with an
                                    explanation of the individual use:
                                    <ul>
                                        <li>Owner type cookie use</li>
                                        <li>This website temporary session</li>
                                        <li>Persistent use Google Statistics</li>
                                        <li>Persistent Facebook Login</li>
                                        <li>Persistent Twitter Login</li>
                                        <li>Cookie block</li>
                                    </ul>
                                    <br> All browsers allow you to decline cookies. Since browsers are
                                    updated frequently and the platforms that support them more and more,
                                    it is not possible to provide a single guide suitable for all versions
                                    of browsers and devices. <br> Blocking of Cookies, however, can have a
                                    negative impact on the usability of many websites. <br>
                                    <br>
                                    <br> <strong>Deleting Cookies</strong> <br>
                                    <br> You can delete cookies already stored on your computer. Since
                                    browsers are updated frequently and the platforms that support them
                                    more and more, it is not possible to provide a single guide suitable
                                    for all versions of browsers and devices. This action can have negative
                                    consequences regarding the usability of many websites. <br>
                                    <br>
                                    <br> <strong>Other technologies on our website</strong> <br>
                                    <br> <em>- Google Analytics</em> <br> Google Analytics is a Google
                                    analysis tool which helps website and app owners to understand how
                                    visitors interact with the content they own. You can use a set of
                                    cookies to collect information and generate usage statistics of the
                                    website without personal identification of individual visitors by
                                    Google. <br>
                                    <br> <em>- Google Maps</em><br> Google Maps is a service of visualizing
                                    maps powered by Google Inc. which greatly improves the user experience
                                    on our website. Google Maps, in fact, provides detailed information on
                                    the location of a specific commercial establishment or accommodation
                                    business in the area. <br>
                                    <br>
                                </div>
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
