<?php

namespace IdnoPlugins\Recaptcha3\Pages;

/**
 * Default class to serve IPFS settings in administration
 */
class Admin extends \Idno\Common\Page {

    function getContent() {
        $this->adminGatekeeper(); // Admins only
        $t = \Idno\Core\site()->template();
        $body = $t->draw('admin/recaptcha3');
        $t->__(array('title' => 'Recaptcha 3 Config', 'body' => $body))->drawPage();
    }

    function postContent() {
        $this->adminGatekeeper(); // Admins only

        $siteKey = $this->getInput('siteKey');
        $privateKey = $this->getInput('privateKey');

        $config = \IdnoPlugins\Recaptcha3\Main::getConfig();
        $config['siteKey'] = $siteKey;
        $config['privateKey'] = $privateKey;

        \Idno\Core\site()->config->config['recaptcha3'] = $config;

        \Idno\Core\site()->config()->save();
        \Idno\Core\site()->session()->addMessage(\Idno\Core\Idno::site()->language()->_('Your Recaptcha 3 settings were saved.'));

        $this->forward(\Idno\Core\site()->config()->getDisplayURL() . 'admin/recaptcha3/');
    }

}
