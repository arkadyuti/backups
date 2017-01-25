<?php

session_start();
ini_set("display_errors", 1);

class expresscheckout {


    private $apikey; 
    private $apiUrl = "https://www.paytabs.com/express/";
    private $merchant_id = "anirbanhabra@gmail.com";
    private $password = "softech2014";
    private $url;
    private $language;


    function api_authentication($url_redirect, $language, $amount = '', $currency = '', $discount = '', $order_id = 0, $subdomain = '') {
        $this->url = $url_redirect;
        $_SESSION['url_redirect'] = $url_redirect;
        $_SESSION['language'] = $language;
        $_SESSION['order_id'] = $order_id;
        $_SESSION['subdomain'] = $subdomain;
        $url_request = 'authentication';
        $post_data = "merchant_id=" . base64_encode($this->merchant_id) . "&password=" . base64_encode($this->password) . "&amount=" . $amount . "&cu_code=" . $currency . "&discount=" . $discount;
        return $this->fetch_response($url_request, $post_data, TRUE);
    }

    function check_dcc() {
        
    }

    function get_checkout_form($api_key) {
        $_SESSION['api_key'] = $api_key;
        $url_request = 'get_api_view';
        $post_data = "amount=" . $_REQUEST['amount'] . "&currency=" . $_REQUEST['currency'] . "&discount=" . $_REQUEST['discount'];
        return $this->fetch_response($url_request, $post_data, FALSE);
    }

    function checkout($api_key) {
        $url_request = 'prepare_transaction';
        $post_data = "amount=" . $_REQUEST['amount'] . "&currency=" . $_REQUEST['currency'] . "&discount=" . $_REQUEST['discount'] . "&title=" . $_REQUEST['title'] . "&firstname=" . $_REQUEST['firstname'] . "&lastname=" . $_REQUEST['lastname'] . "&card_number=" . $_REQUEST['card_number'] . "&expiry=" . $_REQUEST['expiry'] . "&cvv=" . $_REQUEST['cvv'] . "&original_assignee_code=" . $_REQUEST['original_assignee_code'] . "&email=" . $_REQUEST['email'] . "&billing_address=" . $_REQUEST['billing_address'] . "&city=" . $_REQUEST['city'] . "&state=" . $_REQUEST['state'] . "&postal_code=" . $_REQUEST['postal_code'] . "&country=" . $_REQUEST['country'] . "&address_shipping=" . $_REQUEST['address_shipping'] . "&city_shipping=" . $_REQUEST['city_shipping'] . "&state_shipping=" . $_REQUEST['state_shipping'] . "&postal_code_shipping=" . $_REQUEST['postal_code_shipping'] . "&country_shipping=" . $_REQUEST['country_shipping'];
        return $this->fetch_response($url_request, $post_data, FALSE);
    }

    function amex_ksa_pin_verify($api_key) {
        $url_request = 'prepare_transaction_amex';
        $post_data = "amex_ksa_pin_id=" . $_REQUEST['amex_ksa_pin_id'] . "&enter_pin=" . $_REQUEST['enter_pin'];
        return $this->fetch_response($url_request, $post_data, FALSE);
    }

    function get_error($type = '', $currency = '') {
        $url_request = 'get_auth_error';
        $post_data = "language=" . $_SESSION['language'] . "&type=" . $type . "&currency=" . $currency;
        return $this->fetch_response($url_request, $post_data, FALSE);
    }

    function redirect_payer_auth($result) {
        $obj = json_decode($result);
        $acsURL = $obj->payerAuthEnrollReply->acsURL;
        $paReq = $obj->payerAuthEnrollReply->paReq;
        $xid = $obj->payerAuthEnrollReply->xid;
        $transaction_id = $obj->local_transaction_id;
        $merchant_id = $obj->merchant_id;
        $post_data = "acsURL=" . base64_encode($acsURL) . "&paReq=" . base64_encode($paReq) . "&xid=" . $xid . "&transaction_id=" . $transaction_id . "&merchant_id=" . $merchant_id;
        $url_request = 'redirect_payer_authentication';
        return $this->fetch_response($url_request, $post_data, FALSE);
    }

    function check_trans() {
        $url_request = 'check_transaction';
        $post_data = "transaction_id=" . $_REQUEST['transaction_id'] . "&merchant_id=" . $_REQUEST['merchant_id'];
        return $this->fetch_response($url_request, $post_data, FALSE);
    }


    private function api_url($u) {
        return $this->apiUrl . $u . "/" . $this->apikey . ".json";
    }


    private function fetch_response($url, $postdata, $json) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata . "&return_url=" . rawurlencode($_SESSION['url_redirect']) . '&language=' . $_SESSION['language'] . '&order_id=' . $_SESSION['order_id'] . "&subdomain=" . $_SESSION['subdomain'] . "&api_key=" . $this->get_api_key());
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        $obj = json_decode($result);
        if ($json == FALSE) {
            if (is_object($obj)) {
                if ($obj->decision == 'REJECT' && $obj->payerAuthEnrollReply->acsURL != '') {
                    $result_payer_auth = $this->redirect_payer_auth($result);
                    exit();
                }
            }
            echo $result;
        } else
            return $obj;
    }

    function get_api_key() {
        if (isset($_SESSION['api_key']))
            return $_SESSION['api_key'];
        else
            return 0;
    }

}

?>



<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Softech INFO</title>
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
<?php include './A/h.php';  ?>
</head>
<body>

<div id="fixed01" >
<a href="./?View=Web&amp;Page=Plan"><span style="color:white;font-family:'Arial Black';font-size:24px;"><strong>Plans And Pricing </strong></span></a></div>



<div id="Layer1" style="position:relative;text-align:left; top:0px;width:100%;height:85px;z-index:13;" >
<div style="width:950px; margin-left:auto;margin-right:auto;">
<img src="images/img0001.png" style="float:right; margin-top:20px;"><div style="color:#006600;font-family:Lobster;  font-size: 48px;  text-shadow: 4px 4px 4px #aaa; ">Softech</div><i>Innovative solution for better tommorrow </i> </div>

</div>


<div id="container">
<div id="Layer2" style="position:absolute;text-align:left;left:8px;top:358px;width:957px;height:152px;z-index:11;" >

<!--<div id="wb_Image5" style="position:absolute;left:288px;top:28px;width:260px;height:84px;z-index:0;">
<img src="images/images%20%282%29.jpg" id="Image5"style="width:260px;height:84px;"></div> -->
<div id="SlideShow1" style="position:absolute;left:288px;  width:267px;height:120px;z-index:46;">
<img class="image" style="width:267px;height:120px;" src="images/01%20%281%29.jpg">
<img class="image" style="width:267px;height:120px;display:none;" src="images/01%20%282%29.jpg">
<img class="image" style="width:267px;height:120px;display:none;" src="images/01%20%283%29.jpg">
<img class="image" style="width:267px;height:120px;display:none;" src="images/01%20%284%29.jpg">
<img class="image" style="width:267px;height:120px;display:none;" src="images/01%20%285%29.jpg">
<img class="image" style="width:267px;height:120px;display:none;" src="images/01%20%286%29.jpg">
<img class="image" style="width:180px;height:120px;display:none;" src="images/01%20%287%29.jpg">
<img class="image" style="width:267px;height:120px;display:none;" src="images/01%20%288%29.jpg">
<img class="image" style="width:267px;height:120px;display:none;" src="images/01%20%289%29.jpg">
<img class="image" style="width:267px;height:120px;display:none;" src="images/01%20%2810%29.jpg">
<img class="image" style="width:267px;height:120px;display:none;" src="images/01%20%2811%29.jpg">
<img class="image" style="width:267px;height:120px;display:none;" src="images/01%20%2812%29.jpg">
<img class="image" style="width:267px;height:120px;display:none;" src="images/01%20%2813%29.jpg">
<img class="image" style="width:267px;height:120px;display:none;" src="images/01%20%2814%29.jpg">
<img class="image" style="width:267px;height:120px;display:none;" src="images/01%20%2815%29.jpg">
<img class="image" style="width:267px;height:120px;display:none;" src="images/01%20%2816%29.jpg">
<img class="image" style="width:267px;height:120px;display:none;" src="images/01%20%2817%29.jpg">
</div>



<div id="wb_Image7" style="position:absolute;left:693px;top:21px;width:256px;height:120px;z-index:1;">
<img src="images/images%20%285%29.jpg" id="Image7"style="width:256px;height:120px;"></div>
<div id="wb_Image6" style="position:absolute;left:575px;top:15px;width:103px;height:100px;z-index:2;">
<img src="images/images%20%287%29.jpg" id="Image6"style="width:103px;height:100px;"></div>
<div id="wb_Image4" style="position:absolute;left:31px;top:11px;width:239px;height:122px;z-index:3;">
<img src="images/images%20%283%29.jpg" id="Image4"style="width:239px;height:122px;"></div>
<div style="z-index:4">

</div>

</div>



<div id="wb_Text1" style="position:absolute;left:20px;top:121px;width:414px;height:137px;z-index:13;text-align:left;">
<span style="color:#808080;font-family:Georgia;font-size:29px;"><strong>Instant</strong></span><span style="color:#000000;font-family:Arial;font-size:29px;"><strong> </strong></span><span style="color:#87CEEB;font-family:Arial;font-size:29px;"><strong>Tech Support<br></strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"> </span><span style="color:#000000;font-family:Arial;font-size:20px;">&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; </span><span style="color:#00BFFF;font-family:Arial;font-size:20px;">A </span><span style="color:#EE82EE;font-family:Arial;font-size:20px;">Click</span><span style="color:#00BFFF;font-family:Arial;font-size:20px;"> Away....<br></span>   <span style="color:#00BFFF;font-family:Arial;font-size:35px;">Call Toll Free&nbsp; </span><span style="color:#EE82EE;font-family:Arial;font-size:30px;"><BR>1-888-850-0229</span><span style="color:#696969;font-family:Arial;font-size:20px;"> <br>Mail:support@softechinfo.net<!-- UK +44 2071939674 --><br> <!--US +1 3604649932--></span> </span></div>   
<div id="wb_Image3" style="position:absolute;left:389px;top:122px;width:580px;height:214px;z-index:14;">
<img src="images/img0002.jpg" id="Image3"style="width:580px;height:214px;"></div>


<div id="wb_Image11" style="position:absolute;left:48px;top:500px;width:871px;height:10px;z-index:20;">
<img src="images/sh1.jpg" id="Image11"style="width:871px;height:10px;"></div>



<div id="wb_Image15" style="position:absolute;left:22px;top:760px;width:198px;height:188px;z-index:29;">
<img src="images/download%20%281%29.jpg" id="Image15"style="width:198px;height:188px;"></div>
<div id="wb_Text10" style="position:absolute;left:71px;top:513px;width:173px;height:34px;z-index:30;text-align:left;">
<span style="color:#00BFFF;font-family:Impact;font-size:27px;">Disclaimer</span></div>
<div id="wb_Text11" style="position:absolute;left:29px;top:546px;width:192px;height:160px;text-align:justify;z-index:31;">
<span style="color:#000000;font-family:Arial;font-size:13px;">&nbsp; Softech is an independent online computer support provider, provides support for computer software and accessories. Our expertise lies in identifying and troubleshooting a multitude of third-party products from companies that are, in no way, associated with us.  </span></div>
<hr id="Line1" style="margin:0;padding:0;position:absolute;left:48px;top:952px;width:188px;height:2px;z-index:32;">
<div id="wb_Text12" style="position:absolute;left:32px;top:977px;width:185px;height:34px;z-index:33;text-align:left;">
<span style="color:#00BFFF;font-family:Impact;font-size:27px;">Secure Payment</span></div>
<div id="wb_Image16" style="position:absolute;left:181px;top:1041px;width:35px;height:29px;z-index:34;">
<img src="images/american-express.jpg" id="Image16"style="width:35px;height:29px;"></div>
<div id="wb_Image17" style="position:absolute;left:78px;top:1040px;width:47px;height:31px;z-index:35;">
<img src="images/discover.jpg" id="Image17"style="width:47px;height:31px;"></div>
<div id="wb_ImageMap1" style="position:absolute;left:29px;top:1040px;width:46px;height:29px;z-index:36;">
<img src="images/mastercard.jpg" id="ImageMap1"usemap="#ImageMap1_map" border="0" style="width:46px;height:29px;">
</div>
<div id="wb_Image18" style="position:absolute;left:129px;top:1040px;width:46px;height:29px;z-index:37;">
<img src="images/visa.jpg" id="Image18"style="width:46px;height:29px;"></div>
<div id="wb_Image19" style="position:absolute;left:68px;top:1006px;width:97px;height:33px;z-index:38;">
<img src="images/paypal.gif" id="Image19"style="width:97px;height:33px;"></div>
<div id="Layer4" style="position:absolute;text-align:left;left:233px;top:537px;width:4px;height:753px;z-index:39;" >
</div>

<div id="wb_Text14" style="position:absolute;left:32px;top:1120px;width:181px;height:16px;z-index:41;text-align:left;">

</div>



<div id="wb_Text15" style="position:absolute;left:65px;top:722px;width:140px;height:34px;z-index:42;text-align:left;">
<span style="color:#00BFFF;font-family:Impact;font-size:27px;">1 Time Fix</span></div>
<div id="wb_Text16" style="position:absolute;left:44px;top:1150px;width:185px;height:34px;z-index:43;text-align:left;">
<a href="./?View=Web&Page=Plan"> <span style="color:#00BFFF;font-family:Impact;font-size:27px;">Plan & Pricing</span> </a></div>

<hr id="Line4" style="margin:0;padding:0;position:absolute;left:47px;top:1080px;width:188px;height:2px;z-index:45;">
<hr id="Line4" style="margin:0;padding:0;position:absolute;left:47px;top:1900px;width:188px;height:2px;z-index:45;">





<div id="page" style="position:absolute;left:250px;top:520px;width:720px;height:870px;z-index:2000;  ">

<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if (  isset($_GET['View'])) {
		if ( $_GET['View']=='Web')  // PAGE VIEW
	{
	if (  isset($_GET['Page']))   { 
		include './A/Pages/'.$_GET['Page'].'.php';
		}
	
	}
}  else include './A/Pages/home.php';
}
?>
</div> </div> 

<div id="container">
<div id="wb_Text3" style="position:absolute;left:71px;top:1434px;width:177px;height:216px;z-index:21;text-align:left;">
<div style="line-height:20px;"><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Brand Support:</strong></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Acer" class="style1">Support for Acer</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Apple" class="style1">Support for Apple</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Dell" class="style1">Support for Dell</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=HP" class="style1">Support for HP</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Toshiba" class="style1">Support for Toshiba</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><br></span></div>
<div style="line-height:20px;"><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Email Client Support:</strong></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Outlook" class="style1">Support for MS Outlook</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Mail" class="style1">Support for Windows Mail</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=AOL" class="style1">Support for AOL</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Hotmail" class="style1">Support for Hotmail</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=MSN" class="style1">Support for MSN</a></span></div>
</div>
<div id="wb_Text4" style="position:absolute;left:303px;top:1436px;width:177px;height:200px;z-index:22;text-align:left;">
<div style="line-height:20px;"><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Antivirus Support:</strong></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Avast" class="style1">Support for Avast</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=AVG" class="style1">Support for AVG</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=McAfee" class="style1">Support for McAfee</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Norton" class="style1">Support for Norton</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><br></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><br></span></div>
<div style="line-height:20px;"><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Router Support:</strong></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Netgear" class="style1">Support for Netgear</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Belkin" class="style1">Support for Belkin</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Linksys" class="style1">Support for Linksys</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=D-Link" class="style1">Support for D-Link</a></span></div>
</div>
<div id="wb_Text5" style="position:absolute;left:528px;top:1434px;width:177px;height:200px;z-index:23;text-align:left;">
<div style="line-height:20px;"><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Windows Support:</strong></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=XP" class="style1">Support for Windows XP</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Vista" class="style1">Support for Windows Vista</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=7" class="style1">Support for Windows 7</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=8" class="style1">Support for Windows 8</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><br></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><br></span></div>
<div style="line-height:20px;"><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Browser Support:</strong></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Explorer" class="style1">Support for Internet Explorer</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Fiefox" class="style1">Support for Mozilla Fiefox</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Chrome" class="style1">Support for Google Chrome</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Safari" class="style1">Support for Apple Safari</a></span></div>
</div>
<div id="wb_Text6" style="position:absolute;left:756px;top:1434px;width:177px;height:216px;z-index:24;text-align:left;">
<div style="line-height:20px;"><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>General Support:</a></strong></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Repair" class="style1">Computer Repair</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=slow" class="style1">Fix slow Computer</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Virus" class="style1">Virus Removal</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Antivirus" class="style1">Antivirus Support</a></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><br></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><br></span></div>
<div style="line-height:20px;"><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Others:</strong></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Affi" class="style1">Affiliate<a/></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=About" class="style1">About Us<a/></span></div>
<div><span style="color:#000000;font-family:Arial;font-size:13px;"> <a href="./?View=Web&Page=Contact"> Contact <a/> </span></div>
</div>
<div id="wb_Image12" style="position:absolute;left:55px;top:1690px;width:871px;height:10px;z-index:25;">
<img src="images/sh1.jpg" id="Image12"style="width:871px;height:10px;"></div>
<div id="wb_Image13" style="position:absolute;left:61px;top:1412px;width:870px;height:11px;z-index:26;">
<img src="images/shu.jpg" id="Image13"style="width:870px;height:11px;"></div>
<div id="Layer3" style="position:absolute;text-align:left;left:48px;top:1710px;width:874px;height:75px;z-index:27;" >
<div id="wb_Text7" style="position:absolute;left:35px;top:48px;width:347px;height:16px;z-index:7;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">&#0169; 2008-2014 Softechinfo.net All rights reserved.</span></div>
<div id="wb_Text9" style="position:absolute;left:626px;top:47px;width:283px;height:16px;z-index:8;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./?View=Web&Page=Terms" class="style1">Terms and Condition</a> &#0124; <a href="./?View=Web&Page=Policy" class="style1">Policy </a>&#0124; <a href="./?View=Web&Page=Contact" class="style1">Contact</a></span></div>
<div id="wb_Image8" style="position:absolute;left:358px;top:7px;width:61px;height:61px;z-index:9;">
<a href="./TeamViewer_Setup_en-dcl_2.exe"><img src="images/555.jpg" id="Image8"style="width:61px;height:61px;"></a></div>
<div id="wb_Text17" style="position:absolute;left:441px;top:25px;width:180px;height:23px;z-index:10;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:20px;"><a href="TeamViewer_Setup_en-dcl_2.exe">Windows Client</a></span></div>
</div>



<!---   <div style="z-index:47">
<script type="text/javascript">
var disabled_message = "";
document.oncontextmenu = function() 
{ 
   return false; 
}
document.onmousedown = function md(e) 
{ 
  try 
  { 
     if (event.button==2||event.button==3) 
     {
        if (disabled_message != '')
           alert(disabled_message);
        return false; 
     }
  }  
  catch (e) 
  { 
     if (e.which == 3) return false; 
  } 
}
</script>
</div>  -->
</div>

</body>
</html>
     }
  }  
  catch (e) 
  { 
     if (e.which == 3) return false; 
  } 
}
</script>
</div>  -->
</div>

</body>
</html>