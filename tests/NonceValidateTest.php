<?php
/**
 * This file is  part of the tests for package Nonce.
 *
 */
namespace noncetest;

defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)));
require_once implode(
    DIRECTORY_SEPARATOR, array(__ROOT__, 'vendor', 'autoload.php')
);
use PHPUnit\Framework\TestCase;

/**
 * Generates test case for testing the class Nonce\NonceVAlidate which
 * validates nonce value.
 * @author  Shehfinaz Kadavil <shehfinaz@gmail.com>
 * @package Nonce
 */
class NonceValidateTest extends TestCase
{
    /**
    * This method generates nonce value from test nonce name and action. Compares
    * the generated value with correct sample value. It also compares the
    * generated value with incorrect sample value to test valid and invalid cases.
    */
    public function testValidateNonce()
    {
        // Initialise nonce name, action and correct nonce value for valid case.
        $testNonceName = "post-action";
        $testNonceAction = "post";
        $testNonceValue = $this->retriveTestNonceValue($testNonceAction);
        
        //Check if generated nonce value is equal to sample nonce value.
        $nonceObj = new \nonce\NonceValidate(
            $testNonceName,
            $testNonceAction,
            $testNonceValue
        );
        $nonceObj->checkIfValid();
        $generatedNonceState = $nonceObj->displayIsValid();
        $this->assertTrue($generatedNonceState);
        
        //Test nonce value against incorrect sample nonce value.
        $testNonceValue = "987kjhs";
        $nonceObj = new \nonce\NonceValidate(
            $testNonceName,
            $testNonceAction,
            $testNonceValue
        );
        $nonceObj->checkIfValid();
        $generatedNonceState = $nonceObj->displayIsValid();
        $this->assertFalse($generatedNonceState);
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
        $nonceObj = new \nonce\NonceValidate(
            $testNonceName,
            $testNonceAction,
            null
        );
        $nonceObj->checkIfValid();
    }
        
    /**
    * This method is used to generate nonce value using
    * nonce action.
    * @param string $nonceAction contains Nonce action
    * @return nonce value
    */
    public function retriveTestNonceValue($nonceAction)
    {
        return substr(md5($nonceAction), -12, 10);
    }
}
