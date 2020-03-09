<!DOCTYPE html>
<!--PAge to test program easily through UI - for personal use -->
<html>
    <head>
    <h2>Word press nonce implemented in Object Oriented Programming</h2>
    </head>

<body>
    <h3>1. Generate Nonce</h3>
    <form action="/src/NonceResult.php" method='post'>
        <input type="text" name="action_name" value=""/>
        <input type="submit" value="Submit">
    </form>


    <h3>2. Validate a nonce </h3>
    <form action="/src/NonceResult.php" method='post'>
        Nonce Action to validate: <input type='text' name='nonce_action_check' value=''/>
        Nonce Value: <input type="text" name="nonce_value" value=""/>
        <input type="submit" value="Submit">
    </form>

    <h3>3. Generate Nonce URL </h3>
    <form action="/src/NonceResult.php" method='post'>

        Nonce action: <input type="text" name="nonce_action" value=""/>
        URL to change: <input type="text" name="nonce_url" value=""/>
        <input type="submit" value="Submit">
    </form>

    <h3>4.Generate Nonce Form field </h3>
    <form action="/src/NonceResult.php" method='post'>
        Nonce name: <input type="text" name="nonce_name1" value=""/>
        Nonce action: <input type="text" name="nonce_action1" value=""/>
        Referral URL needed: <input type="text" name="referrer_url" value=""/>
        Echo needed: <input type="text" name="echo" value=""/>
        <input type="submit" value="Submit">
    </form>

</body>
</html>