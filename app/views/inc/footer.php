<?php if ($data['settings']['site']->show_footer) : ?>
    <footer id="footer" class="footer-area bg-battern text-light wow bounceInUp">
        <div class="container">
                <p class="py-3 ">
                    جميع الحقوق محفوظة ل<?php echo $data['settings']['site']->title; ?>
                    <i class="icofont-copyright"></i>
                </p>
        </div>
    </footer>
<?php endif; ?>
<!-- JS assets -->
<script src="<?php echo URLROOT; ?>/templates/nexencare/js/jquery.min.js"></script>
<script src="<?php echo URLROOT; ?>/templates/nexencare/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo URLROOT; ?>/templates/nexencare/js/jquery.inputmask.min.js"></script>
<script src="<?php echo URLROOT; ?>/templates/nexencare/js/main.js"></script>
<?php echo $data['settings']['site']->footer_code; ?>
</body>

</html>