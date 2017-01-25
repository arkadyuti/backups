<?php
if(isset($usearch))
{
	$search = urldecode($usearch);
}
if($usearch=='')
	$search = 'Our';
if($search=='Clothing & Accessories')
{
echo '
	<div style="background:white;min-height:2354px;padding: 0 25px 0 14px;margin-bottom:50px;border:2px solid #d0dde2;border: 2px solid #d0dde2;box-shadow: 0 2px 6px 2px rgba(131, 131, 131, 0.27);">
	';
}
else
echo '
	<div style="background:white;min-height:1800px;padding: 0 25px 0 14px;margin-bottom:50px;border:2px solid #d0dde2;border: 2px solid #d0dde2;box-shadow: 0 2px 6px 2px rgba(131, 131, 131, 0.27);">
';
?>
	<div class="allstore_body allstore_body2" style="margin-left:0px;">
		<div class="top_merchants">
			<div class="merchants_header" align="left"><?php echo $search; ?></div>
			<div class="merchants_500" align="left"></div>
		</div>
		<div class="merchants_body_alls"  style="margin-bottom:30px;">
		<?php
		if($session==null)
		{
			$session='anonymous';
		}
		$search = urldecode($usearch);
			$q="SELECT * FROM allstore WHERE Category LIKE '%".$search."%' AND active='1' GROUP BY cname";
			$result = mysql_query($q) or die("query");
			
			
			$count = 0;
			WHILE($rows = mysql_fetch_array($result))
			{
				
				$count++;
				$temp = explode('.',$rows['cname']);
				$cname = $temp[0];
				$cname = strtolower($cname);
				//$cname = strtolower($cname);
				$id = $rows['id'];
				$rate = $rows['rate'];
				$description = $rows['desc'];
				$url=$rows['url'];
				echo '
				<style>
				#dealimg'.$id.' {background:url("/img/store/'.$cname.'.png") 49% 100% no-repeat;background-size: 186px 104px;}
				</style>
				<a href="/stores/'.$cname.'"><div class="merchants_details_alls"><div id="dealimg'.$id.'" style="height: 97px;width:191px;"></div><div class="m_desertion">'.$description.'</div><div class="merchants_text">'.$rate.'</div></div></a>
				';
			}
			if($count<25)
			{
				echo '
				<div style="float:left;">
				<hr style="margin-top:100px;">
					<div class="merchants_header" align="center" style="padding:20px 0 20px;">Our other stores</div>
				';	
					$aff_date = date("YmdHis");
					$q2="SELECT * FROM allstore where active='1' order by rand() limit 10";
					$result2 = mysql_query($q2) or die("query");
					WHILE($rows2 = mysql_fetch_array($result2))
						{
							$cname2 = $rows2['cname'];
							$cname2 = strtolower($cname2);
							$id2 = $rows2['id'];
							$rate2 = $rows2['rate'];
							$description2 = $rows2['desc'];
							$url2=$rows2['url'];
							echo '
							<style>
							#dealimg'.$id2.' {background:url("/img/store/'.$cname2.'.png") 49% 100% no-repeat;background-size: 186px 104px;}
							</style>
							<a href="/stores/'.$cname2.'"><div class="merchants_details_alls"><div id="dealimg'.$id2.'" style="height: 97px;width:191px;"></div><div class="m_desertion">'.$description2.'</div><div class="merchants_text">'.$rate2.'</div></div></a>				
							';
						}
			echo '
				</div>
				';
			}
		?>
		</div>
	</div>
</div>
