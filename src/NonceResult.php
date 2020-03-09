<?php
/* Page to test the program with UI- for personal use.*/
namespace nonce;

defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)));
require_once implode(
    DIRECTORY_SEPARATOR, array(__ROOT__, 'vendor', 'autoload.php')
);

if (isset($_POST['action_name'])) {

    $nonce_obj = new NonceGenerate(null, $_POST['action_name'], null);
    $nonce_obj->generateNonce();
    echo $nonce_obj->getNonceValue();
}
if (isset($_POST['nonce_value'])) {
    $nonce_obj = new NonceValidate(null, $_POST['nonce_action_check'], $_POST['nonce_value']);
    $nonce_obj->checkIfValid();
    $is_valid = $nonce_obj->displayIsValid();
    if ($is_valid == false)
        echo "Not valid";
    else
        echo "valid";
}
if (isset($_POST['nonce_action'])) {
    $nonce_obj = new NonceUrl(null, $_POST['nonce_action'], null);
    $nonce_obj->generateNonceUrl($_POST['nonce_url']);
    echo $nonce_obj->displayNonceUrl();
}

if (isset($_POST['nonce_name1'])) {
    $nonce_obj = new NonceField($_POST['nonce_name1'], $_POST['nonce_action1'], null);
    $nonce_obj->generateNonceField($_POST['referrer_url'], $_POST['echo']);
    var_dump($nonce_obj->displayNonceField());
}
?>