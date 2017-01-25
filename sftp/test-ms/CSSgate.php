<form action="https://secure.cssgate.com" method="post">
<label>sid</label> <input type="text" name="sid" value="yoursid">
<label>rcode</label> <input type="text" name="rcode" value="yourrcode">
<label>tid</label> <input type="text" name="tid" value="anyreference">
<label>firstname</label> <input type="text" id="firstname" name="firstname" value="Jack">
<label>lastname</label> <input type="text" id="lastname" name="lastname" value="Tester">
<label>email</label> <input type="text" id="email" name="email" value="jack@testing.com">
<label>phone</label> <input type="text" id="phone" name="phone" value="1234567">
<label>address</label> <input type="text" id="address" name="address" value="12 Test Lane">
<label>suburb_city</label> <input type="text" id="suburb_city" name="suburb_city" value="TestCity">
<label>state</label> <input type="text" id="state" name="state" value="ON">
<label>postcode</label> <input type="text" id="postcode" name="postcode" value="410101">
<label>country</label> <input type="text" id="country" name="country" value="CA">
<label>ship_firstname</label> <input type="text" id="ship_firstname" name="ship_firstname" value="Jack">
<label>ship_lastname</label> <input type="text" id="ship_lastname" name="ship_lastname" value="Tester">
<label>ship_address</label> <input type="text" id="ship_address" name="ship_address" value="12 Test Lane">
<label>ship_suburb_city</label> <input type="text" id="ship_suburb_city" name="ship_suburb_city" value="TestCity">
<label>ship_state</label> <input type="text" id="ship_state" name="ship_state" value="ON">
<label>ship_postcode</label> <input type="text" id="ship_postcode" name="ship_postcode" value="410101">
<label>ship_country</label> <input type="text" id="ship_country" name="ship_country" value="CA">
<label>card_name</label> <input type="text" id="card_name" name="card_name" value="Test Card">
<label>card_no</label> <input type="text" id="card_no" name="card_no" value="4111111111111111">
<label>card_ccv</label> <input type="text" id="card_ccv" name="card_ccv" value="123">
<label>card_exp_month</label> <input type="text" id="card_exp_month" name="card_exp_month" value="10">
<label>card_exp_year</label> <input type="text" id="card_exp_year" name="card_exp_year" value="2007">
<label>shipping</label> <input type="text" name="shipping" value="1"> 
<label>amount_shipping</label> <input type="text" name="amount_shipping" value="0.30">    
<label>ref1</label> <input type="text" name="ref1" value="ref1"> 
<label>ref2</label> <input type="text" name="ref2" value="ref2"> 
<label>ref3</label> <input type="text" name="ref3" value="ref3"> 
<label>ref4</label> <input type="text" name="ref4" value="ref4"> 
<label>addinfo</label> <input type="text" name="addinfo" value="addinfo"> 
	<table>
	  <tbody><tr>		    
	    <td>
			<label>item_quantity</label> <input type="text" name="item_quantity[]" value="2">
			<label>item_name</label> <input type="text" name="item_name[]" value="apple">
			<label>item_no</label> <input type="text" name="item_no[]" value="a234">
			<label>item_desc</label> <input type="text" name="item_desc[]" value="juicy green apple">
			<label>item_amount_unit</label> <input type="text" name="item_amount_unit[]" value="0.03">
	    </td>
	  </tr>
	  <tr>		    
	    <td>
			<label>item_quantity</label> <input type="text" name="item_quantity[]" value="1">
			<label>item_name</label> <input type="text" name="item_name[]" value="pear">
			<label>item_no</label> <input type="text" name="item_no[]" value="p567">
			<label>item_desc</label> <input type="text" name="item_desc[]" value="fresh green pear">
			<label>item_amount_unit</label> <input type="text" name="item_amount_unit[]" value="0.04">
	    </td>	    
	  </tr>
	</tbody></table>
<label>card_type</label><select name="card_type"><option value="visa">Visa</option><option value="mastercard">Mastercard</option><option value="amex">Amex</option><option value="jcb">Jcb</option><option value="union_pay">Union Pay</option></select>
<label>language</label><select name="lang">
		<option value="en">English</option>
		<option value="ch">Chinese</option>
		<option value="es">Spanish</option>
		<option value="nl">Dutch</option>
		<option value="de">German</option>
	</select>
<label>noshipping</label> <input type="checkbox" name="no_ship_address" value="1"> 
<label>nobank</label> <input type="checkbox" name="no_bank" value="1"> 
<label>thirdpartydetails</label> <input type="checkbox" name="thirdpartydetails" value="1"> 
<label>successurl</label> <input type="text" name="successurl" value=""> 
<label>failureurl</label> <input type="text" name="failureurl" value=""> 
  <input type="submit" value="Post To Hosted Sales">
</form>