<html>
    <head>
        <title>Best CashBack and Best Deals/Coupons at CropmyBill</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                
                    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                        var article = "<?php echo $_GET['wa_s'];?>";
                        var weburl = "<?php echo $_GET['wa_url'];?>";
                        var whats_app_message = encodeURIComponent(article)+" - "+encodeURIComponent(weburl);
                        var whatsapp_url = "whatsapp://send?text="+whats_app_message;
                        window.location.href= whatsapp_url;
                    }else{
                        alert('Sorry!!! You are not using Mobile Device');
						window.close();
                    }
                
				
            });
        </script>
    </head>
<body>
	
</body>
</html>