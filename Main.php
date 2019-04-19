<?php

namespace IdnoPlugins\Recaptcha3;

class Main extends \Idno\Common\Plugin {
    
    function registerPages()
    {
	// Register admin settings
	\Idno\Core\site()->addPageHandler('admin/recaptcha3', '\IdnoPlugins\Recaptcha3\Pages\Admin');
	
	// Add menu items to account & administration screens
	\Idno\Core\site()->template()->extendTemplate('admin/menu/items', 'admin/recaptcha3/menu');
	
	// Extend header
	//\Idno\Core\site()->template()->extendTemplate('shell/head', 'recaptcha3/header');
    }

    function registerTranslations() {
        \Idno\Core\Idno::site()->language()->register(
                new \Idno\Core\GetTextTranslation(
                        'recaptcha3', dirname(__FILE__) . '/languages/'
                )
        );
    }
    
    function pageInterceptEvent(\Idno\Core\Event $event) {
        
        $config = self::getConfig();
        
        $captcha = new Recaptcha3($config['siteKey'], $config['privateKey']);
        
        $captcha->gatekeeper(\Idno\Core\Idno::site()->currentPage()->getInput('recaptcha-action'));
    }
    
    function registerEventHooks() {
        
        // Load configuration
        $config = self::getConfig();
        
        if (!empty($config['siteKey']) && !empty($config['privateKey'])) {
            
            // Override page hooks
            
            //\Idno\Core\Idno::site()->addEventHook('page/get', [$this, 'pageInterceptEvent']);
            \Idno\Core\Idno::site()->addEventHook('page/post', [$this, 'pageInterceptEvent']);
            
        }
        
    }

    public static function getConfig() {
	    $config = \Idno\Core\Idno::site()->config();
	    if (empty($config->recaptcha3)) {
		$config->recaptcha3 = [
                    'siteKey' => '',
                    'privateKey' => '',
                    
                    'thresholds' => [
                        'annotation/post' => 0.5,
                        'session/login' => 0.5,
                        'account/password' => 0.5,
                        'account/register' => 0.5
                    ],
                    
                    'defaultThreshold' => 0.5
		];
	    }
	    
	    return $config->recaptcha3;
	}
}
