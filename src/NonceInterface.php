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
 * This is the interface for nonce implementation
 *
 * @author  Shehfinaz Kadavil <shehfinaz@gmail.com>
 * @package Nonce
 */
interface NonceInterface
{
    /**
    * The method returns the name of the nonce.
    * @return string
    */
    public function getNonceName();
    
    /**
    * The method sets the name of the nonce.
    * @param string contains the name of the nonce.
    */
    public function setNonceName($nonceName);
    
    /**
    * The method returns the name of the nonce action.
    * @return string
    */
    public function getNonceAction();
    
    /**
    * The method sets the name of the nonce action.
    * @param string contains the name of the nonce action.
    */
    public function setNonceAction($nonceAction);
    
    /**
    * The method returns the value of the nonce.
    * @return string
    */
    public function getNonceValue();
    
    /**
    * The method sets the value of the nonce.
    * @param string contains the value of the nonce.
    */
    public function setNonceValue($nonceName);
}
