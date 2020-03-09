<?php
/**
 * This file is  part of the package Nonce.
 *
 */
declare(strict_types=1);

namespace nonce;

defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)));
require_once implode(DIRECTORY_SEPARATOR, array(__ROOT__, 'vendor', 'autoload.php'));

/**
 * Generates the nonce value for the action given.
 *
 * @author  Shehfinaz Kadavil <shehfinaz@gmail.com>
 * @package Nonce
 */

class NonceGenerate extends NonceAbstract
{
    /**
    * Default value for name of the nonce if no name is given.
    * @var string
    */
    private $nonceNameDefault = '_wpnonce';
    
    /**
     * Class constructor.
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
    * This method is used to generate nonce value using
    * nonce action. It mimics wp_create_nonce()
    * function. Here blog id is not available so we are
    * using value of action string to produce hashed value
    * for nonce.
    */
    public function generateNonce()
    {
        if (empty($this->getNonceAction())) {
            throw new \InvalidArgumentException("Action is null");
        }
        $nonceVariable = substr(md5($this->getNonceAction()), -12, 10); //replicates wp_nonce_create()
        $this->setNonceValue($nonceVariable);
    }
}
