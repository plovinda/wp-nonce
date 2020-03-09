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
 * This class generates form fields containing nonce value. Two fields in the form
 * are generated based on the value of Wp_Referrer and echo variables.
 * @author  Shehfinaz Kadavil <shehfinaz@gmail.com>
 * @package Nonce
 */
class NonceField extends NonceGenerate
{
    /**
     * The default name of the nonce.
     * @var string
     */
    private $nonceNameDefault = '_wpnonce';

    /**
     * The string that contains the input types for form.
     * @var string
     */
    private $nonceField;

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
     * The method returns the nonce form fields.
     * @return string containing the form fields generated.
     */
    public function displayNonceField(): string
    {
        return $this->nonce_field;
    }

    /**
    * The method sets the nonce form fields.
    * @param String $nonceField. The value of the nonce field.
    */
    public function changeNonceField($nonceField)
    {
        $this->nonce_field = $nonceField;
    }

    /**
    * The method generates the form field values containing nonce.
    * It mimics the wp_nonce_field() function and returns a field to be
    * added to a form with nonce value.
    * @param boolean $wpReferer decides whether referrer should be included as
    * hidden field.
    * @param boolean $wpEcho decides whether the output should be printed.
    */
    public function generateNonceField($wpReferer, $wpEcho)
    {
        //check if parameters are valid
        if ($this->checkIfParamsAreValid($wpReferer, $wpEcho)===false) {
            throw new \InvalidArgumentException('Parameters are not boolean');
        }
        
        // Generate Nonce value for the action
        $nonceObj = new NonceGenerate(null, $this->getNonceAction(), null);
        $nonceObj->generateNonce();
        $nonceName = $this->getNonceName();
        $nonceValue = $nonceObj->getNonceValue();
        $nonceField = '<input type="hidden" id="' . $nonceName . '" name="'.
                        $nonceName . '" value="' . $nonceValue . '" />';
        if ($wpReferer) {
            $nonceField .= '<input type="hidden" name="_wp_http_referer" '
            . 'value="URL-needed" />';
        }
        if ($wpEcho) {
            echo $nonceField;
        }
        $this->changeNonceField($nonceField);
    }
    
    /**
    * This method checks if the parameters given are boolean values
    * @param boolean $wpReferer decides whether referrer should be included.
    * @param boolean $wpEcho decides whether fields should be printed.
    * @return boolean returns true if parameters are boolean else returns false.
    */
    private function checkIfParamsAreValid($wpReferer, $wpEcho)
    {
        return (!($wpReferer===null && $wpEcho===null) ?
        ($this->isAttributeBoolean($wpReferer) &&
         $this->isAttributeBoolean($wpEcho)) : false);
    }
    
    /**
    * This method checks the value passed against an array of elements and returns
    * true if the parameter is present else returns false.
    * @param boolean $value contains the parameter to check.
    * @return boolean returns true or false.
    */
    private function isAttributeBoolean($value)
    {
        return in_array($value,
            array(
            "TRUE",
            "FALSE",
            "true",
            "false",
            "1",
            "0",
            "yes",
            "no",
            true,
            false, ),
            true
        );
    }
}
