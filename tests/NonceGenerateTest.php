<?php
/**
 * This file is  part of the tests for package Nonce.
 *
 */
declare(strict_types=1);

namespace noncetest;

defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)));
require_once implode(DIRECTORY_SEPARATOR, array(__ROOT__, 'vendor', 'autoload.php'));

use PHPUnit\Framework\TestCase;

/**
 * Generates test case for testing the class Nonce\NonceGenerate which
 * generates nonce value for action.
 * @author  Shehfinaz Kadavil <shehfinaz@gmail.com>
 * @package Nonce
 */
class NonceGenerateTest extends TestCase
{
    /**
    * This method tests generation of nonce value when only nonce action name is
    * given. Nonce name is not provided and hence defualt name is taken.
    */
    public function testGenerateWithActionOnly()
    {
        //Initialise nonce name and action.
        $testNonceName = null;
        $testNonceAction = "post";
        
        //Generate test nonce value from nonce action with default name.
        $testNonceValue = $this->retreiveTestNonceValue($testNonceAction);
        $nonceObj = new \nonce\NonceGenerate($testNonceName, $testNonceAction, null);
        $nonceObj->generateNonce();
        
        //Checks if test values and generated values are same.
        $this->assertEquals($testNonceValue, $nonceObj->getNonceValue());
        $this->assertEquals($nonceObj->getNonceName(), '_wpnonce');
    }
   
    /**
    * This method tests generation of nonce value when nonce action and name is
    * given.
    */
    public function testGenerateWithActionAndName()
    {
        //Initialise nonce name and action
        $testNonceName = "post-action";
        $testNonceAction = "post";
        
        //Generate test nonce value from nonce action.
        $testNonceValue = $this->retreiveTestNonceValue($testNonceAction);
        $nonceObj = new \nonce\NonceGenerate($testNonceName, $testNonceAction, null);
        $nonceObj->generateNonce();
        
        //checks if test values and generated values are same.
        $this->assertEquals($testNonceValue, $nonceObj->getNonceValue());
        $this->assertEquals($nonceObj->getNonceName(), $testNonceName);
    }
   
    /**
    * This method is used to test if exception is thrown when nonce action
    * is null
    */
    public function testExceptionNonceAction()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Action is null');
        
        //Initialise test values, setting nonce action as null
        $testNonceName = "post-action";
        $testNonceAction = null;
        
        $nonceObj = new \nonce\NonceGenerate($testNonceName, $testNonceAction, null);
        $nonceObj->generateNonce();
    }
   
    /**
    * This method is used to generate nonce value using
    * nonce action.
    * @param string $nonceAction contains Nonce action
    * @return nonce value
    */
    public function retreiveTestNonceValue($nonceAction)
    {
        return substr(md5($nonceAction), -12, 10);
    }
}
