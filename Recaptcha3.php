<?php

namespace IdnoPlugins\Recaptcha3;

class Recaptcha3 {
    
    private $siteKey;
    private $privateKey;
    
    /**
     * Create a new recaptcha object
     * @param type $siteKey Public site key
     * @param type $privateKey Private site key
     */
    public function __construct($siteKey, $privateKey) {
        $this->siteKey = $siteKey;
        $this->privateKey = $privateKey;
    }

    /**
     * Check captcha
     * @global string $error
     * @return boolean
     * @param $action The action you're protecting
     * @throws \RuntimeException
     */
    public function gatekeeper($action) {
        
        // Not a process, don't continue
        if (!$action)
            return true;
        
        // Normalise action
        $action = trim($action, ' /');

        $token = \Idno\Core\Idno::site()->currentPage()->getInput('recaptcha-token');

        // Check that we've actually got a recaptcha token
        if ($token)
            throw new \RuntimeException(\Idno\Core\Idno::site()->language()->_('Capture token could not be found'));

        // Verify recaptcha response
        $response = $this->challenge($action, $token);
        if (empty($response))
            throw new \RuntimeException(\Idno\Core\Idno::site()->language()->_('Captcha could not be verified as no response was retrieved from recaptcha servers'));

        // Did we get a successful response, or an error? 
        if (!$response['success'])
            throw new \RuntimeException(\Idno\Core\Idno::site()->language()->_('There was a problem processing the captcha: %s', [implode(',', $response['error-codes'])]));

        // Test threshold value
        if ($response['score'] < $threshold)
            throw new \RuntimeException(\Idno\Core\Idno::site()->language()->_("Captcha failed, score of %s is below the minimum threshold of %s for %s", [$response['score'], $threshold, $action]));
        
        return true;
    }
    
    /**
     * Obtain a threshold for the action, or returning the default value if an entry isn't found
     * @param type $action
     * @return float
     */
    protected function getThreshold($action) {
        $config = Main::getConfig();
        
        if (!empty($config['thresholds'][$action]))
            return $config['thresholds'][$action];
        
        return $config['defaultThreshold'];
            
    }
    
    /**
     * Check a token and receive challenge respinse
     * @param type $action
     * @param type $token
     * @return type
     */
    protected function challenge($action, $token) {
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = $this->privateKey;
        $recaptcha_response = $token;

        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);

        return json_decode($recaptcha, true);
    }

}
