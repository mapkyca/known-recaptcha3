<?php
$config = \IdnoPlugins\Recaptcha3\Main::getConfig();

if (!empty($config['privateKey'])) {
?>
<script src="https://www.google.com/recaptcha/api.js?render=<?= $config['privateKey'] ?>"></script>
<?php } ?>