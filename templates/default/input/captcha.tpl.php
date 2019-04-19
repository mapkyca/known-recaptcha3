<?php
$config = \IdnoPlugins\Recaptcha3\Main::getConfig();

?>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('<?php echo $config['siteKey']; ?>', { action: '<?= str_replace(['.', '/'], '_', strtolower($vars['action'])); ?>' }).then(function (token) {
            $('#recaptcha-token').val(token);
        });
    });
</script>
<input type="hidden" name="recaptcha-token" value="" id="recaptcha-token" />