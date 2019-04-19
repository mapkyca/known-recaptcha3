<?php
$config = \IdnoPlugins\Recaptcha3\Main::getConfig();

?>
<script src="https://www.google.com/recaptcha/api.js?render=<?= $config['siteKey'] ?>"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('<?php echo $config['siteKey']; ?>', { action: '<?= str_replace(['.', '/'], '_', strtolower(trim($vars['action'], ' /'))); ?>' }).then(function (token) {
            $('#recaptcha-token').val(token);
        });
    });
</script>
<input type="hidden" name="recaptcha-token" value="" id="recaptcha-token" />
<input type="hidden" name="recaptcha-action" value="<?= $vars['action']; ?>" />