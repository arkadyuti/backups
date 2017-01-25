 
<form action="https://secure.conceptpayments.com" method="post"><table>
<!--sid: --> <input type="hidden" name="sid" value="6724"> --> 
 <input type="hidden"  name="rid" value="8661"> 
<!--wid: --><input type="hidden" name="RCode" value="4d58c4"> 
<!--postback url: --><input type="hidden" name="postback_url" value="http://ms.softechinfo.net/CSSgate-postback.php"><BR>
<!--<tr><td>card type:</td><td>  <input type="hidden" name="card_type" value="visa"></td></tr>-->
<tr><td>firstname:</td><td>  <input type="text" name="firstname" value=""></td></tr>
<tr><td>lastname:</td><td>  <input type="text" name="lastname" value=""></td></tr>
<tr><td>email:</td><td>  <input type="text" name="email" value=""></td></tr>
<tr><td>phone:</td><td>  <input type="text" name="phone" value=""></td></tr>
<!--address: <input type="text" name="address" value="12 Test Lane"><BR>
suburb_city: <input type="text" name="suburb_city" value="TestCity"><BR>
state: <input type="text" name="state" value="CA-ON"><BR>
postcode: <input type="text" name="postcode" value="41010"><BR>
country: <input type="text" name="country" value="CA"><BR>
ship_firstname: <input type="text" name="ship_firstname" value="Julie"><BR>
ship_lastname: <input type="text" name="ship_lastname" value="Tester"><BR>
ship_address: <input type="text" name="ship_address" value="13 Test Lane"><BR>
ship_suburb_city: <input type="text" name="ship_suburb_city" value="TestCity"><BR>
ship_state: <input type="text" name="ship_state" value="CA-ON"><BR>
ship_postcode: <input type="text" name="ship_postcode" value="41010"><BR>
ship_country: <input type="text" name="ship_country" value="CA"><BR>
card_name: <input type="text" name="card_name" value="_test_"><BR>-->
<tr><td>card_no:</td><td>  <input type="text" name="card_no" placeholder="4111111111111111"></td></tr>
<tr><td>card_ccv:</td><td>  <input type="text" name="card_ccv" placeholder="123"></td></tr>
<tr><td>card_exp_month:</td><td>  <input type="text" name="card_exp_month" placeholder="10"></td></tr>
<tr><td>card_exp_year:</td><td>  <input type="text" name="card_exp_year" placeholder="2015"></td></tr>
<!--shipping: <input type="text" name="shipping" value="1"><BR>
amount_shipping: <input type="text" name="amount_shipping" value="0.30"><BR>-->


<input type="hidden" name="item_quantity[]" value="1">
<tr><td>item_name:</td><td>  <input type="text" name="item_name[]" placeholder="Product/Service Name "></td></tr>
<!--item_no: <input type="text" name="item_no[]" value="a234">-->
<tr><td>item_desc:</td><td>  <input type="text" name="item_desc[]" placeholder="Description "></td></tr>
<tr><td>amount:</td><td> <input type="text" name="item_amount_unit[]" value=""></td></tr>

<!--<tr>
<td>
item_quantity: <input type="text" name="item_quantity[]" value="1">
item_name: <input type="text" name="item_name[]" value="pear">
item_no: <input type="text" name="item_no[]" value="p567">
item_desc: <input type="text" name="item_desc[]" value="fresh green pear">
item_amount_unit: <input type="text" name="item_amount_unit[]" value="0.68">
</td>
</tr>-->
</table>
<input type="submit" value="Pay">
</form>