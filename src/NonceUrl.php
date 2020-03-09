<?php
/**
 * This file is  part of the package Nonce.
 *
 */
declare(strict_types=1);

namespace nonce;

defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)));
require_once implode(
    DIRECTORY_SEPARATOR, array(__ROOT__, 'vendor', 'autoload.php')
);

/**
 * This class generates the nonce URL.
 *
 * @author  Shehfinaz Kadavil <shehfinaz@gmail.com>
 * @package Nonce
 */

class NonceUrl extends NonceGenerate
{
    /**
    * Default value for name of the nonce if no name is given.
    *
    * @var string
    */
    private $nonceNameDefault = '_wpnonce';
    
    /**
    * The nonce URL generated
    *
    * @var string
    */
    private $nonceUrl;
    
    /**
     * Class constructor.
     *
     * @param string $nonceName Optional. Name of the nonce. Default '_wpnonce'.
     * @param string $nonceAction. Action value of nonce.
     * @param string $nonceValue. Value of the nonce.
     */
    public function __construct($nonceName, $nonceAction, $nonceValue)
    {
        parent::__NonceAbstract($nonceName, $nonceAction, $nonceValue);
        if ($this->getNonceName() === null) {
            parent::setNonceName($this->nonceNameDefault);
        }
    }
    
    /**
    * This method will append the existing URL with nonce value. It mimics the
    * wordpress function wp_nonce_url().
    * @param string wp_action_url contains the URL to which the nonce value
    * is appended.
    */
    public function generateNonceUrl($wpActionUrl)
    {
        if (!$this->checkIfUrlIsValid($wpActionUrl)) {
            throw new \InvalidArgumentException('Invalid URL');
        }
        $nonceObj = new NonceGenerate(null, $this->getNonceAction(), null);
        $nonceObj->generateNonce();
        $nonceValue = $nonceObj->getNonceValue();
        $actionUrl = str_replace('&amp;', '&', $wpActionUrl);
        $url = $this->buildUrl($this->getNonceName(), $nonceValue, $actionUrl);
        $this->changeNonceUrl($url);
    }
    /**
    * This method builds the value of the nonce URL by appending the parameters.
    * @return string.
    */
    private function buildUrl($nonceName, $nonceValue, $actionUrl): string
    {
        return $actionUrl . '&' . $nonceName . '=' . $nonceValue;
    }
    
    /**
    * This method returns the value of the nonce URL.
    * @return string.
    */
    public function displayNonceUrl(): string
    {
        return $this->nonceUrl;
    }
    
    /**
    * This method sets the value of the nonce URL.
    * @param string $nonceUrl contains the URL string.
    */
    public function changeNonceUrl($nonceUrl)
    {
        $this->nonceUrl = $nonceUrl;
    }
    
    /**
    * This method checks if the URL given is valid
    * @param string $wpActionUrl contains the URL string.
    */
    private function checkIfUrlIsValid($wpActionUrl): bool
    {
        return filter_var($wpActionUrl, FILTER_VALIDATE_URL) == false ? false : true;
    }
}
