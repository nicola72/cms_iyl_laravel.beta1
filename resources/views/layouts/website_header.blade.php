<header>
    <!--  nav  -->
    <nav id="mainNav" class="navbar navbar-inverse navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= $site->getUrl('home') ?>">
                    <img src="/img/<?= $site->getLogo() ?>" alt="<?= $site->page->alt ?>"
                         width="180">
                </a>
            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" data-hover="dropdown"
                 data-animations="fadeIn fadeInLeft fadeInUp fadeInRight">
                <ul class="nav navbar-nav home2-nav header_new">

                    <?php foreach ($menu_pages as $item): ?>
                    <?php $class = ($item == $site->page->nome_interno) ? 'active' : ''; ?>
                    <?php if ($item != 'catalogo'): ?>
                    <li class="<?= $class ?>">
                        <a href="<?= $site->getUrl($item) ?>"><span><?= $site->getLabel($item) ?></span></a>
                    </li>
                    <?php else: ?>

                    <?php
                    $cat_camera = [2,21,22,23,17,24,25,26,57,27,28,16,18,29,30,31,32,33,34,35,36,37,9,38,39,40,41,58];
                    $cat_piumini = [2];
                    $cat_lenzuola = [27,18,57,28,17,25,26,34];
                    $cat_copripiumini = [58,22,21,24,23];
                    $cat_trapunte = [32,31,33,29,16,30];
                    $cat_accessori = [34,37,36,35,38,40];
                    $cat_living = [41,8,42,43,59,44,14];
                    $cat_cucina = [19,45,46,19];
                    $cat_bagno = [47,48,49,50,51,52];
                    $cat_tende = [15,53,54,55];
                    $cat_poltrone = [4,56];
                    ?>
                    <li class="dropdown">
                        <a href="<?= $site->getUrl('lista_categorie') ?>" class="dropdown-toggle"
                           data-toggle="dropdown" role="button" aria-expanded="false">
                            <span><?= _('Catalogo') ?></span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="row" style="padding-bottom: 20px;">

                                <div class="col-12 col-md-4">
                                    <div class="link-list-wrapper">
                                        <ul class="ul-mega">
                                            <li class="li-mega-header">
                                                <h4 class="no_toc">Piumini d'oca e Piumoni</h4>
                                            </li>
                                            <?php foreach ($categorie as $categoria): ?>
                                            <?php if(in_array($categoria->id,$cat_piumini)): ?>
                                            <?php if($categoria->url != ''):?>
                                            <li class="li-mega-item">
                                                <a href="<?= $categoria->url ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php else: ?>
                                            <li class="li-mega-item">
                                                <a href="<?= $site->getUrl('categoria') ?>?id=<?= Utils::encript($categoria->id) ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                            <li class="li-mega-header">
                                                <h4 class="no_toc">Copripiumini</h4>
                                            </li>
                                            <?php foreach ($categorie as $categoria): ?>
                                            <?php if(in_array($categoria->id,$cat_copripiumini)): ?>
                                            <?php if($categoria->url != ''):?>
                                            <li class="li-mega-item">
                                                <a href="<?= $categoria->url ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php else: ?>
                                            <li class="li-mega-item">
                                                <a href="<?= $site->getUrl('categoria') ?>?id=<?= Utils::encript($categoria->id) ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                            <li class="li-mega-header">
                                                <h4 class="no_toc">Lenzuola</h4>
                                            </li>
                                            <?php foreach ($categorie as $categoria): ?>
                                            <?php if(in_array($categoria->id,$cat_lenzuola)): ?>
                                            <?php if($categoria->url != ''):?>
                                            <li class="li-mega-item">
                                                <a href="<?= $categoria->url ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php else: ?>
                                            <li class="li-mega-item">
                                                <a href="<?= $site->getUrl('categoria') ?>?id=<?= Utils::encript($categoria->id) ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endforeach; ?>



                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="link-list-wrapper">
                                        <ul class="">
                                            <li class="li-mega-header">
                                                <h4 class="no_toc">Trapunte</h4>
                                            </li>
                                            <?php foreach ($categorie as $categoria): ?>
                                            <?php if(in_array($categoria->id,$cat_trapunte)): ?>
                                            <?php if($categoria->url != ''):?>
                                            <li class="li-mega-item">
                                                <a href="<?= $categoria->url ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php else: ?>
                                            <li class="li-mega-item">
                                                <a href="<?= $site->getUrl('categoria') ?>?id=<?= Utils::encript($categoria->id) ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                            <li class="li-mega-header">
                                                <h4 class="no_toc">Accessori letto</h4>
                                            </li>
                                            <?php foreach ($categorie as $categoria): ?>
                                            <?php if(in_array($categoria->id,$cat_accessori)): ?>
                                            <?php if($categoria->url != ''):?>
                                            <li class="li-mega-item">
                                                <a href="<?= $categoria->url ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php else: ?>
                                            <li class="li-mega-item">
                                                <a href="<?= $site->getUrl('categoria') ?>?id=<?= Utils::encript($categoria->id) ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endforeach; ?>


                                            <li class="li-mega-header">
                                                <h4 class="no_toc">Tende e tessuti per arredo</h4>
                                            </li>
                                            <?php foreach ($categorie as $categoria): ?>
                                            <?php if(in_array($categoria->id,$cat_tende)): ?>
                                            <?php if($categoria->url != ''):?>
                                            <li class="li-mega-item">
                                                <a href="<?= $categoria->url ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php else: ?>
                                            <li class="li-mega-item">
                                                <a href="<?= $site->getUrl('categoria') ?>?id=<?= Utils::encript($categoria->id) ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="link-list-wrapper">
                                        <ul class="">
                                            <li class="li-mega-header">
                                                <h4 class="no_toc">Bagno</h4>
                                            </li>
                                            <?php foreach ($categorie as $categoria): ?>
                                            <?php if(in_array($categoria->id,$cat_bagno)): ?>
                                            <?php if($categoria->url != ''):?>
                                            <li class="li-mega-item">
                                                <a href="<?= $categoria->url ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php else: ?>
                                            <li class="li-mega-item">
                                                <a href="<?= $site->getUrl('categoria') ?>?id=<?= Utils::encript($categoria->id) ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                            <li class="li-mega-header">
                                                <h4 class="no_toc">Living</h4>
                                            </li>
                                            <?php foreach ($categorie as $categoria): ?>
                                            <?php if(in_array($categoria->id,$cat_living)): ?>
                                            <?php if($categoria->url != ''):?>
                                            <li class="li-mega-item">
                                                <a href="<?= $categoria->url ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php else: ?>
                                            <li class="li-mega-item">
                                                <a href="<?= $site->getUrl('categoria') ?>?id=<?= Utils::encript($categoria->id) ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                            <li class="li-mega-header">
                                                <h4 class="no_toc">Cucina e Tavola</h4>
                                            </li>
                                            <?php foreach ($categorie as $categoria): ?>
                                            <?php if(in_array($categoria->id,$cat_cucina)): ?>
                                            <?php if($categoria->url != ''):?>
                                            <li class="li-mega-item">
                                                <a href="<?= $categoria->url ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php else: ?>
                                            <li class="li-mega-item">
                                                <a href="<?= $site->getUrl('categoria') ?>?id=<?= Utils::encript($categoria->id) ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                            <li class="li-mega-header">
                                                <h4 class="no_toc">Poltrone e arredamento casa</h4>
                                            </li>
                                            <?php foreach ($categorie as $categoria): ?>
                                            <?php if(in_array($categoria->id,$cat_poltrone)): ?>
                                            <?php if($categoria->url != ''):?>
                                            <li class="li-mega-item">
                                                <a href="<?= $categoria->url ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php else: ?>
                                            <li class="li-mega-item">
                                                <a href="<?= $site->getUrl('categoria') ?>?id=<?= Utils::encript($categoria->id) ?>">
                                                    <?= $categoria->nome ?>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endforeach; ?>

                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <li>
                        <a href="<?= $site->getUrl('contatti') ?>"><?= _('Contatti') ?></a>
                    </li>
                </ul>
                <!--  MENU A DESTRA -->
                <ul class="nav navbar-nav navbar-right">

                <?php if ($site->is_auth): ?>
                <!-- menu user loggato -->
                    <li>
                        <a href="<?= $site->getUrl('account') ?>">
                            <i class="fa fa-user"></i>
                            <span><?= $site->getLabel('account') ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" onclick="logout('<?= $site->lang ?>')">
                            <i class="fa fa-sign-out"></i>
                            <span><?= _('Logout') ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $site->getUrl('wishlist') ?>">
                            <i class="fa fa-heart-o"></i>
                            <span><?= $site->getLabel('wishlist') ?></span>
                        </a>
                    </li>
                    <!-- -->
                <?php else: ?>
                <!-- menu user non loggatto -->
                    <li>
                        <a href="<?= $site->getUrl('login') ?>">
                            <i class="fa fa-sign-in"></i>
                            <span><?= _('Login/Registrazione') ?></span>
                        </a>
                    </li>
                    <!-- -->
                <?php endif; ?>


                <!-- CARRELLO  -->
                <?php if ($site->page->nome_interno != 'carrello'): ?>

                <!-- pulsante mobile -->
                    <li class="hidden-md hidden-lg">
                        <a href="<?= $site->getUrl('carrello') ?>">
                            <i class="fa fa-shopping-bag"></i>
                            <span class="upper"><?= _('Carrello') ?></span>
                        </a>
                    </li>

                    <!-- pulsante desktop -->
                    <li class="dropdown hidden-xs hidden-sm">
                        <a href="<?= $site->getUrl('carrello') ?>" class="dropbtn">
                            <img src="<?= Config::SITE_FOLDER ?>assets/images/top-icon3.png"
                                 alt="<?= $site->page->alt ?>">
                            <span id="span-carrello upper"><?= _('Carrello') ?> (<?= $countCarrello ?>)</span>
                        </a>
                        <?php if (count($carrello_items) > 0): ?>
                        <div class="dropdown-content">

                            <!-- lista prodotti carrello -->
                            <?php $totale_carrello = 0; ?>

                            <?php foreach ($carrello_items as $item): ?>
                            <div class="cart-content">
                                <div class="col-sm-4 col-md-4">
                                    <?php if ($item->img): ?>
                                    <img src="<?= Utils::getThumb($item->img) ?>"
                                         alt="<?= $site->page->alt ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <div class="pro-text" style="margin-bottom:5px;">
                                        <?php $url_scheda = $site->getUrlScheda($item->id_disp, $item->nome) ?>
                                        <?php //$url_scheda = $site->getUrl('scheda_prodotto') . "?id=" . Utils::encript($item['id_elem']) ?>
                                        <a href="<?= $url_scheda ?>"><?= $item->nome ?>  </a>
                                        <?= _('qt.') ?> <?= $item->qta ?> x <strong
                                                style="color:#000"> <?= Utils::price($item->prezzo) ?></strong>
                                    </div>
                                </div>
                            </div>
                            <?php $totale_carrello = $totale_carrello + $item->prezzo_totale ?>
                            <?php endforeach; ?>
                            <div class="total">
                                <div class="col-sm-6 col-md-6 text-left">
                                    <br> <strong><?= _('Totale') ?>:</strong>
                                </div>
                                <div class="col-sm-6 col-md-6 text-right">
                                    <strong><br/><?= Utils::price($totale_carrello) ?></strong>
                                </div>
                            </div>

                            <!-- -->

                            <a href="<?= $site->getUrl('carrello') ?>"
                               class="cart-btn upper"><?= _('Carrello') ?></a>
                        </div>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
                <!-- FINE CARRELLO -->

                </ul>
                <!-- FINE MENU A DESTRA -->
            </div>
            <div class="row" style="padding-top:20px;padding-right:10px;">
                <div class="col-dm-12 text-right">
                    <?php $url_action = $site->getUrl('ricerca') ?>
                    <form id="form-ricerca" method="post" action="<?= $url_action ?>">
                        <input name="ricerca" class="form-control" style="max-width:200px;display:inline-block"
                               id="ricerca" type="text" placeholder="<?= _('Cerca') ?>..."/>
                        <button type="submit" class="btn" onclick="check_ricerca();return false;"><i
                                    class="fa fa-search" style="font-size:18px;"></i></button>
                    </form>
                </div>
            </div>
        </div>

    </nav>

</header>