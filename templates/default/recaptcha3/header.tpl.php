<?php
$config = \IdnoPlugins\Recaptcha3\Main::getConfig();

if (!empty($config['siteKey'])) {
?>
<script src="https://www.google.com/recaptcha/api.js?render=<?= $config['siteKey'] ?>"></script>
<?php } ?>