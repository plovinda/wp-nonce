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
 * Validates the nonce value for different scenarios.
 *
 * @author  Shehfinaz Kadavil <shehfinaz@gmail.com>
 * @package Nonce
 */

class NonceValidate extends NonceGenerate
{
    /**
    * Default value for name of the nonce if no name is given.
    *
    * @var string
    */
    private $nonceNameDefault = '_wpnonce';
    
    /**
    * The bool value indicating if nonce is valid or not.
    * @var string
    */
    private $isValid;
    
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
    * This method returns the status of validity.
    * @return boolean true if nonce is valid else false.
    */
    public function displayIsValid(): bool
    {
        return $this->is_valid;
    }

    /**
    * This method sets the status of validity.
    * @param boolean true indicates nonce is valid else not valid.
    */
    public function changeIsValid($isValid)
    {
        $this->is_valid = $isValid;
    }

    /**
    * This method checks the validity of nonce by generating a nonce value using
    * action name and compares it with given nonce value.It is similar to the
    * wp_verify_nonce() function in wordpress.
    */
    public function checkIfValid()
    {
        $nonceValueToCheck = $this->getNonceValue();
        $nonceObj = new NonceGenerate(null, $this->getNonceAction(), null);
        $nonceObj->generateNonce();
        $nonceVariable = $nonceObj->getNonceValue();
        return $this->changeIsValid($nonceVariable === $nonceValueToCheck);
    }
}
