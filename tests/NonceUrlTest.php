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
 * Generates test case for testing the class Nonce\NonceUrl which
 * generates URL with nonce value.
 * @author  Shehfinaz Kadavil <shehfinaz@gmail.com>
 * @package Nonce
 */
class NonceUrlTest extends TestCase
{
    
    /**
    * This method tests generation of nonce URL with nonce value and compares it
    * with given sample URL. The URL does not have www.
    */
    public function testGenerateNonceUrlWithoutWWW()
    {
        //Initialise nonce action and nonce value
        $testNonceAction = "delete";
        $testNonceValue = $this->retreiveTestNonceValue($testNonceAction);
        
        //generate nonce URL
        $nonceObj = new \nonce\NonceUrl(null, $testNonceAction, null);
        $paramActionUrl = "http://example.com/wp-admin/users.php?user=7&"
        . "action=delete";
        $expectedUrl = "http://example.com/wp-admin/users.php?user=7&action="
        . "delete&_wpnonce=".$testNonceValue."";
        $nonceObj->generateNonceUrl($paramActionUrl);
        $generatedUrl = $nonceObj->displayNonceUrl();
        
        //checks if the generated URL is same as sample URL
        $this->assertSame($generatedUrl, $expectedUrl);
    }
    
    /**
    * This method tests generation of nonce URL with nonce value and compares it
    * with given sample URL. The URL has www in it.
    */
    public function testGenerateNonceUrlWithWWWW()
    {
        //Initialise nonce action and nonce value
        $testNonceAction = "delete";
        $testNonceValue = $this->retreiveTestNonceValue($testNonceAction);
        
        //generate nonce URL
        $nonceObj = new \nonce\NonceUrl(null, $testNonceAction, null);
        $paramActionUrl = "http://www.example.com/wp-admin/users.php?user=7&"
        . "action=delete";
        $expectedUrl = "http://www.example.com/wp-admin/users.php?user=7&"
        . "action=delete&_wpnonce=".$testNonceValue."";
        $nonceObj->generateNonceUrl($paramActionUrl);
        $generatedUrl = $nonceObj->displayNonceUrl();
        
        //checks if the generated URL is same as sample URL
        $this->assertSame($generatedUrl, $expectedUrl);
    }
    
      /**
    * This method is used to test if exception is thrown when URL is null.
    */

    public function testExceptionNonceURLWithNull()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid URL');
        
        //Initialise test value and setting URL to null
        $testNonceAction = "delete";
        $paramActionUrl = null;
        
        $nonceObj = new \nonce\NonceUrl(null, $testNonceAction, null);
        $nonceObj->generateNonceUrl($paramActionUrl);
    }
    
      /**
    * This method is used to test if exception is thrown when incorrect URL is
    * provided.
    */

    public function testExceptionNonceURL()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid URL');
        
        //Initialise test value and setting URL to random string
        $testNonceAction = "delete";
        $paramActionUrl = "sample-random-word";
        
        $nonceObj = new \nonce\NonceUrl(null, $testNonceAction, null);
        $nonceObj->generateNonceUrl($paramActionUrl);
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
        $testNonceAction = null;
        $paramActionUrl = $paramActionUrl = "http://www.example.com/wp-admin"
        . "/users.php?user=7&action=delete";
        
        $nonceObj = new \nonce\NonceUrl(null, $testNonceAction, null);
        $nonceObj->generateNonceUrl($paramActionUrl);
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
