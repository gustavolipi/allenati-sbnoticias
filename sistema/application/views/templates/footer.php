<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        <?php echo titulo_footer ?>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url() ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="<?php echo base_url() ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url() ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
    type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="<?php echo base_url() ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/select2/select2.js" charset="utf-8">
</script>

<script src="<?php echo base_url() ?>assets/admin/pages/scripts/jquery.maskedinput.js" type="text/javascript"></script>

<script>
var base_url = 'https://sistema.sbnoticias.com.br/';
var base_site = 'https://sbnoticias.com.br';
var url_tikers = '<?= url_tikers ?>';
</script>

<script src="<?php echo base_url() ?>assets/admin/sys/js/select.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/admin/sys/js/jquery.Jcrop.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/admin/sys/js/main.js" type="text/javascript"></script>

<?php echo @$js ?>

<script>
jQuery(document).ready(function() {
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features
});
</script>
<!-- END JAVASCRIPTS -->

<!-- Modal -->
<div class="modal fade" id="modalCrop" role="dialog">
    <div class="modal-dialog  modal-xl" style="width:90%; height: 90%;">

        <!-- Modal content-->
        <div class="modal-content" style="height: 100%;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editar Imagem</h4>
            </div>
            <div class="modal-body"
                style="max-height: calc(100% - 120px) !important; height: 100%; display: flex; align-items: center; justify-content: center;">

                <div>
                    <img src="" style="width: 100%; height: 100%;" id="cropbox" class="img" /><br />
                </div>

            </div>
            <div class="modal-footer" id="btn">
                <button type="button" class="btn btn-default" id="crop" value='CROP'>Salvar</button>
            </div>
        </div>

    </div>
</div>

<script>
$(document).ready(function() {
    $(".cropImage").click(function() { // Click to only happen on announce links
        $("#cropbox").attr('src', $(this).attr('data-image'));
        $('#modalCrop').modal('show');

        var size;
        $('#cropbox').Jcrop({
            aspectRatio: 800 / 600,
            onSelect: function(c) {
                size = {
                    x: c.x,
                    y: c.y,
                    w: c.w,
                    h: c.h
                };
                $("#crop").css("visibility", "visible");
            }
        });

        $("#crop").click(function() {
            var img = $("#cropbox").attr('src');

            $.ajax({
                type: "GET",
                url: base_url + 'imageCrop',
                data: {
                    x: size.x,
                    y: size.y,
                    w: size.w,
                    h: size.h,
                    img: img
                }
            }).done(function(o) {
                $('#modalCrop').modal('hide');
                window.location.reload()
            });


            // $("#cropped_img").show();
            // $("#cropped_img").attr('src', base_url + 'imageCrop?x=' + size.x + '&y=' +
            //     size.y +
            //     '&w=' + size.w + '&h=' + size.h + '&img=' + img);
        });
    });
});
</script>

</body>
<!-- END BODY -->

</html>