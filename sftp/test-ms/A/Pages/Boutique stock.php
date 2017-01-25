<?php

    /* 
     * Boutique Merchant Services API Example v1.2
     */

    $TESTING = TRUE;

    $parameters = rand( 1, 2 ) == 1 ? array(
        'public_key' => "wCGh0kIGd0OLOvkM",
        'timestamp'  => time(),
        'invoice_id' => "some reference",
        'nonce'      => md5( time() ),
        
        'username'   => "gcsbpo@yahoo.co.in",
        'email'      => "gcsbpo@yahoo.co.in",
        'country'    => "GBR",
        'amount'     => "34.77",
        'currency'   => "USD",
        'note'       => "This is a note",
        
        'return_url' => "http://www.ms.softechinfo.net/return",
        'notify_url' => "http://www.ms.softechinfo.net/notify",
	) : array(
        'public_key'  => "wCGh0kIGd0OLOvkM",
        'timestamp'   => time(),
        'invoice_id'  => "some reference",
        'nonce'       => md5( time() ),
        
        'username'    => "gcsbpo@yahoo.co.in",
        'email'       => "gcsbpo@yahoo.co.in",
        'country'     => "USA",
        'address'     => "37 Green street",
        'city'        => "Blue Town",
        'state'       => "AZ",
        'postal_code' => "82410",
        'amount'      => "34.77",
        'currency'    => "USD",
        'note'        => "This is a note",
        
        'return_url'  => "http://www.ms.softechinfo.net/return",
        'notify_url'  => "http://www.ms.softechinfo.net/notify",
    );

    $hash = "";

    foreach( $parameters as $p )
    {
        $p = trim( $p );
        $hash .= strlen( $p ) . $p;
    }

    $hash = hash_hmac( "sha256", $hash, "my_private_key" );

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Payment  </title>
    </head>
    <body>
        <form action="https://api.boutiquemerchantservices.com<?php echo ( $TESTING ? '/testing' : '' );?>" method="post">
            <table>
                <?php
                foreach( $parameters as $k => $v )
                {
                    echo '<tr><td><label for="'.$k.'">'.$k.': </label></td><td><input id="'.$k.'" type="text" name="'.$k.'" value="'.$v.'" style="width:300px;" /></td></tr>';
                }
                ?>
                <tr><td><label for="hash">hash: </label></td><td><input id="hash" type="text" name="hash" value="<?php echo $hash; ?>" style="width:300px;" /></td></tr>
                <tr><td>&nbsp;</td><td><input type="submit" value="Proceed" /></td></tr>
            </table>
        </form>
    </body>
</html>