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
 * This is the abstract class which implements the interface
 * NonceInterface. It contains definitions of getters and setters
 * for nonce name, action name and nonce value.
 *
 * @author  Shehfinaz Kadavil <shehfinaz@gmail.com>
 * @package Nonce
 */

abstract class NonceAbstract implements NonceInterface
{
    /**
    * The name of the nonce.
    *
    * @var string
    */
    private $nonceName;
    
    /**
    * The action name of the nonce.
    *
    * @var string
    */
    private $nonceAction;
    
    /**
    * The value of the nonce.
    *
    * @var string
    */
    private $nonceValue;
    
    /**
     * Class constructor.
     *
     * @param string $nonceName. Name of the nonce.
     * @param string $nonceAction. Action value of nonce.
     * @param string $nonceValue. Value of the nonce.
     */
    public function __NonceAbstract($nonceName, $nonceAction, $nonceValue)
    {
        $this->nonceName = $nonceName;
        $this->nonceAction = $nonceAction;
        $this->nonceValue = $nonceValue;
    }
    
    /**
    * The method returns the name of the nonce.
    * @return string
    */
    public function getNonceName()
    {
        return $this->nonceName;
    }
    
    /**
    * The method sets the name of the nonce.
    * @param string contains the name of the nonce.
    */
    public function setNonceName($nonceName)
    {
        $this->nonceName = $nonceName;
    }
    
    /**
    * The method gets the name of the nonce action.
    * @return string
    */
    public function getNonceAction()
    {
        return $this->nonceAction;
    }
    
    /**
    * The method sets the nonce action.
    * @param string contains the name of the action.
    */
    public function setNonceAction($nonceAction)
    {
        $this->nonceAction = $nonceAction;
    }
    
    /**
    * The method gets the value of the nonce.
    * @return string
    */
    public function getNonceValue()
    {
        return $this->nonceValue;
    }
    
    /**
    * The method sets the value of the nonce.
    * @param string contains the value of the nonce.
    */
    public function setNonceValue($nonceValue)
    {
        $this->nonceValue = $nonceValue;
    }
}
