<?php

    /* 
     * Boutique Merchant Services API Example v1.2
     */

    $TESTING = TRUE;

    $parameters = rand( 1, 2 ) == 1 ? array(
        'public_key' => "wCGh0kIGd0OLOvkM",
        'timestamp'  => time(),
        'invoice_id' => time(),
        'nonce'      => md5( time() ),
        
        'username'   => "",
        'email'      => "",
        'country'    => "GBR",
        'amount'     => "",
        'currency'   => "USD",
        'note'       => "",
        
        'return_url' => "http://www.ms.softechinfo.net/return",
        
	) : array(
        'public_key'  => "wCGh0kIGd0OLOvkM",
        'timestamp'   => time(),
        'invoice_id'  => time(),
        'nonce'       => md5( time() ),
        
        'username'    => "",
        'email'       => "",
        'country'     => "USA",
		
		
		
        'amount'      => "",
        'currency'    => "USD",
        'note'        => "",
        
        'return_url'  => "http://www.ms.softechinfo.net/return",
        
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
        <form action="https://api.boutiquemerchantservices.com<?php // echo ( $TESTING ? '/testing' : '' );?>" method="post">
            <table>
			<tr><td>&nbsp; Country and currency </td><td>Provide Only code</td></tr>
                <?php
                foreach( $parameters as $k => $v )
                {
					if($k=='public_key' || $k=='timestamp' || $k=='invoice_id' || $k=='nonce' || $k=='return_url' ) $tp='hidden'; else $tp='text';
                    echo '<tr><td><label for="'.$k.'">'.$k.': </label></td><td><input id="'.$k.'" type="'.$tp.'" name="'.$k.'" value="'.$v.'" style="width:300px;" /></td></tr>';
                }
                ?>
                <tr><td><label for="hash">hash: </label></td><td><input id="hash" type="hidden" name="hash" value="<?php echo $hash; ?>" style="width:300px;" /></td></tr>
                <tr><td>&nbsp;</td><td><input type="submit" value="Proceed" /></td></tr>
            </table>
        </form>
    </body>
</html>