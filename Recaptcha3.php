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
     * @param $theshold Minimal threshold value between 0 and 1
     * @throws \RuntimeException
     */
    public function gatekeeper($action, $threshold) {

        // Not a process, don't continue
        if (!$action)
            return true;

        $token = \Idno\Core\Idno::site()->currentPage()->getInput('recaptcha-token');

        // Check that we've actually got a recaptcha token
        if ($token)
            throw new \RuntimeException('Capture token could not be found');

        // Not a protected process, don't continue
        if (!$this->isProtected($action))
            return true;

        // Verify recaptcha response
        $response = $this->challenge($action, $token);
        if (empty($response))
            throw new \RuntimeException('Captcha could not be verified as no response was retrieved from recaptcha servers');

        // Did we get a successful response, or an error? 
        if (!$response['success'])
            throw new \RuntimeException('There was a problem processing the captcha: ' . implode(',', $response['error-codes']));

        // Test threshold value
        if ($response['score'] < $threshold)
            throw new \RuntimeException("Captcha failed, score of {$response['score']} is below the minimum threshold of {$threshold} for {$action}");
        
        return true;
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
