<?php
/**
 * This file is  part of the tests for package Nonce.
 */
declare(strict_types=1);

namespace noncetest;

defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)));
require_once implode(
    DIRECTORY_SEPARATOR, array(__ROOT__, 'vendor', 'autoload.php')
);

use PHPUnit\Framework\TestCase;

/**
 * Generates test case for testing the class Nonce\NonceField which
 * generates form fields with nonce value.
 *
 * @author  Shehfinaz Kadavil <shehfinaz@gmail.com>
 * @package Nonce
 */
class NonceFieldTest extends TestCase
{
    /**
     * This method tests the creation of form fields with nonce value. Here the
     * parameters Wp_referrer is set to false and echo is set to false. Two types
     * of nonce objects one with no nonce name and one with given nonce name are
     * used for testing.
     * Wp_referrer indicates whether the referrer URL must be added or not.
     * Echo indicates whether the output should be printed or not.
     */
    public function testWithOutWPReferrer()
    {
        //Initialise test values for nonce
        $testNonceName = "remove-action";
        $testNonceAction = "remove";
        $testNonceValue = $this->retreiveTestNonceValue($testNonceAction);
       
        //Setting Wp_referrer and echo as false
        $testIsWpReferrer = false;
        $testIsEcho = false;
        
        //The nonce object with given name is used
        $nonceObjWithName = new \nonce\NonceField(
            $testNonceName,
            $testNonceAction,
            $testNonceValue
        );
        $nonceObjWithName->generateNonceField($testIsWpReferrer, $testIsEcho);
        $testNonceField1 = $nonceObjWithName->displayNonceField();
        
        $testNonceFieldSample = '<input type="hidden" id="'.$testNonceName.
            '" name="'.$testNonceName.'" value="' . $testNonceValue . '" />';
        $this->assertSame($testNonceField1, $testNonceFieldSample);
        
        //The nonce object with default name is used
        $nonceObjWithoutName = new \nonce\NonceField(
            null,
            $testNonceAction,
            $testNonceValue
        );
        $nonceObjWithoutName->generateNonceField($testIsWpReferrer, $testIsEcho);
        $testNonceField2 = $nonceObjWithoutName->displayNonceField();
        $testNonceFieldSample = '<input type="hidden" id="_wpnonce" name="_wpnon'
                . 'ce" value="' . $testNonceValue . '" />';
        $this->assertSame($testNonceField2, $testNonceFieldSample);
    }
    
    /**
     * This method tests the creation of form fields with nonce value. Here the
     * parameters Wp_referrer is set to true and echo is set to false. Two types
     * of nonce objects one with no nonce name and one with given nonce name are
     * used for testing.
     * Wp_referrer indicates whether the referrer URL must be added or not.
     * Echo indicates whether the output should be printed or not.
     */
    public function testWithWPReferrer()
    {
        //Initialise test values for nonce
        $testNonceName = "remove-action";
        $testNonceAction = "remove";
        $testNonceValue = $this->retreiveTestNonceValue($testNonceAction);
        
        //Setting Wp_referrer and echo
        $testIsWpReferrer = true;
        $testIsEcho = false;
        
        //The nonce object with given name is used
        $nonceObjWithName = new \nonce\NonceField($testNonceName, $testNonceAction, $testNonceValue);
        $nonceObjWithName->generateNonceField($testIsWpReferrer, $testIsEcho);
        $testNonceField1 = $nonceObjWithName->displayNonceField();
        $testNonceFieldSample = '<input type="hidden" id="'.$testNonceName.'" '
         . 'name="'.$testNonceName.'" value="' . $testNonceValue . '" />'.
         '<input type="hidden" name="_wp_http_referer" value="URL-needed" />';
        $this->assertSame($testNonceField1, $testNonceFieldSample);
        
        
        //The nonce object with default name is used
        $nonceObjWithoutName = new \nonce\NonceField(
            null,
            $testNonceAction,
            $testNonceValue
        );
        $nonceObjWithoutName->generateNonceField($testIsWpReferrer, $testIsEcho);
        $testNonceField2 = $nonceObjWithoutName->displayNonceField();
        $testNonceFieldSample = '<input type="hidden" id="_wpnonce" '
        . 'name="_wpnonce" value="' . $testNonceValue . '" />'.
        '<input type="hidden" name="_wp_http_referer" value="URL-needed" />';
        $this->assertSame($testNonceField2, $testNonceFieldSample);
    }
    
    /**
     * This method tests the creation of form fields with nonce value. Here the
     * parameters Wp_referrer is set to false and echo is set to true. Nonce
     * object with nonce name is used.
     * Wp_referrer indicates whether the referrer URL must be added or not.
     * Echo indicates whether the output should be printed or not.
     */
    public function testEchoWithName()
    {
        //Initialise test values for nonce
        $testNonceName = "remove-action";
        $testNonceAction = "remove";
        $testNonceValue = $this->retreiveTestNonceValue($testNonceAction);
        
        //Setting Wp_referrer and echo
        $testIsWpReferrer = false;
        $testIsEcho = true;
        
        //creating nonce object with given name
        $nonceObjWithName = new \nonce\NonceField(
            $testNonceName,
            $testNonceAction,
            $testNonceValue
        );
        $nonceObjWithName->generateNonceField($testIsWpReferrer, $testIsEcho);
        $testNonceField1 = $nonceObjWithName->displayNonceField();
        $testNonceFieldSample = '<input type="hidden" id="'.$testNonceName.'" '
        . 'name="'.$testNonceName.'" value="' . $testNonceValue . '" />';
        $this->expectOutputString($testNonceFieldSample);
        $this->assertSame($testNonceField1, $testNonceFieldSample);
    }
    
    /**
     * This method tests the creation of form fields with nonce value. Here the
     * parameters Wp_referrer is set to false and echo is set to true. Nonce object
     * with default name is used.
     * Wp_referrer indicates whether the referrer URL must be added or not.
     * Echo indicates whether the output should be printed or not.
     */
    public function testEchoWithoutName()
    {
        //Initialise test values for nonce
        $testNonceAction = "remove";
        $testNonceValue = $this->retreiveTestNonceValue($testNonceAction);
        
        //Setting Wp_referrer and echo
        $testIsWpReferrer = false;
        $testIsEcho = true;
        
        //creating nonce object with default name
        $nonceObjWithoutName = new \nonce\NonceField(null, $testNonceAction, $testNonceValue);
        $nonceObjWithoutName->generateNonceField($testIsWpReferrer, $testIsEcho);
        $testNonceField2 = $nonceObjWithoutName->displayNonceField();
        $testNonceFieldSample = '<input type="hidden" id="_wpnonce" '
        . 'name="_wpnonce" value="' . $testNonceValue . '" />';
        $this->expectOutputString($testNonceFieldSample);
        $this->assertSame($testNonceField2, $testNonceFieldSample);
    }
    
      /**
       * This method is used to test if exception is thrown when referrer and echo
       * parameters are set to null
       */

    public function testExceptionNonceFieldWithNull()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Parameters are not boolean');
       
        //Initialise test values
        $testNonceAction = "remove";
        $testNonceValue = $this->retreiveTestNonceValue($testNonceAction);
        
        //Setting both parameters to null
        $testIsWpReferrer = null;
        $testIsEcho = null;
        
        $nonceObj = new \nonce\NonceField(null, $testNonceAction, $testNonceValue);
        $nonceObj->generateNonceField($testIsWpReferrer, $testIsEcho);
    }
    
    /**
     * This method is used to test if exception is thrown when referrer and echo
     * parameters are set to non boolean values.
     */

    public function testExceptionNonceField()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Parameters are not boolean');
       
        //Initialise test values
        $testNonceAction = "remove";
        $testNonceValue = $this->retreiveTestNonceValue($testNonceAction);
        
        //Setting both parameters to null
        $testIsWpReferrer = "abcd";
        $testIsEcho = 123;
        
        $nonceObj = new \nonce\NonceField(null, $testNonceAction, $testNonceValue);
        $nonceObj->generateNonceField($testIsWpReferrer, $testIsEcho);
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
        $testNonceValue = $this->retreiveTestNonceValue($testNonceAction);
        $testIsWpReferrer = true;
        $testIsEcho = false;
        
        $nonceObj = new \nonce\NonceField(
            null,
            $testNonceAction,
            $testNonceValue
        );
        $nonceObj->generateNonceField($testIsWpReferrer, $testIsEcho);
    }
   
    /**
     * This method is used to generate nonce value using
     * nonce action.
     *
     * @param  string $nonceAction contains Nonce action
     * @return nonce value
     */
    public function retreiveTestNonceValue($nonceAction)
    {
        $nonceObj = new \nonce\NonceGenerate(null, $nonceAction, null);
        $nonceObj->generateNonce();
        return $nonceObj->getNonceValue();
    }
}
