


<footer class="footer">

    <!-- Widgets - Bootstrap Brain Component -->
    <section class="bg-light py-4 py-md-5 py-xl-8 border-top border-light">
        <div class="container overflow-hidden">
            <div class="row gy-4 gy-lg-0 justify-content-xl-between">
                <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <div class="widget">
                        <?= view('templates/logo', array()) ?>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 col-xl-3">
                    <div class="widget">
                        <h4 class="widget-title mb-4">
                            SBNOTÍCIAS<br>a sua cidade on-line!
                        </h4>
                        <address class="mb-4">Av. Monte Castelo 255, Centro
                            <br>Santa Bárbara d'Oeste, SP - Brasil
                            <br>
                            CEP: 13450-285
                        </address>
                        <p class="mb-1">
                            <a class="link-secondary text-decoration-none" href="tel:+551934635068">(19) 3463 5068</a>
                            |
                            <a class="link-secondary text-decoration-none" href="tel:+551934635255">(19) 3463 5255</a>
                        </p>
                        <p class="mb-0">
                            <a class="link-secondary text-decoration-none"
                                href="mailto:contato@sbnoticias.com.br">contato@sbnoticias.com.br</a>
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <div class="widget">
                        <h4 class="widget-title mb-4">Links</h4>

                        <?= view('templates/nav', array()) ?>

                    </div>
                </div>
                <div class="col-12 col-lg-3 col-xl-4">
                    <div class="widget">
                        <h4 class="widget-title mb-4">BrasilFM 81,9</h4>

                        <p class="mb-1">
                            <a class="link-secondary text-decoration-none"
                                href="mailto:radiobrasil@radiobrasilsbo.com.br">radiobrasil@radiobrasilsbo.com.br</a>
                        </p>

                        <p class="mb-0">
                            <a class="link-secondary text-decoration-none" href="tel:+551934635255">(19) 3463-5255</a>
                            <br>
                            <a class="link-secondary text-decoration-none" href="tel:+551934635068">(19) 3463-5068</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Copyright - Bootstrap Brain Component -->
    <div class="bg-light py-4 py-md-5 py-xl-8 border-top border-light-subtle">
        <div class="container overflow-hidden">
            <div class="row gy-4 gy-md-0">
                <div class="col-xs-12 col-md-7 order-1 order-md-0">
                    <div class="copyright text-center text-md-start">
                        &copy; <?= date('Y') ?>. SBNotícias. Todos os direitos reservados
                    </div>

                </div>

                <div class="col-xs-12 col-md-5 order-0 order-md-1">
                    <div class="nav justify-content-center justify-content-md-end">
                        <small class="credits text-secondary text-center text-md-start mt-2 fs-7">
                            Desenvolvido por <a href="https://allenati.com.br/"
                                class="link-secondary text-decoration-none">Allenati</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"
    integrity="sha512-Ixzuzfxv1EqafeQlTCufWfaC6ful6WFqIz4G+dWvK0beHw0NVJwvCKSgafpy5gwNqKmgUfIBraVwkKI+Cz0SEQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"
    integrity="sha512-frFP3ZxLshB4CErXkPVEXnd5ingvYYtYhE5qllGdZmcOlRKNEPbufyupfdSTNmoF5ICaQNO6SenXzOZvoGkiIA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?= base_url('public/js/main.js?' . date('YmdHi')) ?>" crossorigin="anonymous"></script>

<?php
if (@$js) {
    ?>
    <script src="<?= base_url('public/js/' . $js) ?>?v=<?=date('YmdHi')?>" crossorigin="anonymous"></script>
    <?php
}
?>

<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-11670040-2']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>




</html>