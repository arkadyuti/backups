<?php
if($session==null)
{
	$session= 'anonymous'; 
}
$aff_date = date("YmdHis");

$q="SELECT * FROM allstore WHERE active='1'";
$result = mysql_query($q) or die("query");
WHILE($rows = mysql_fetch_array($result))
	{
		$cname = $rows['cname'];
		$cname = strtolower($cname);
		$id = $rows['id'];
		echo '
		<style>
		#dealimg'.$id.' {background:url("/img/store/'.$cname.'.png") 49% 100% no-repeat;background-size: 186px 104px;}
		</style>
		';
	}
?>
<style>
	#dealimgsorry {background:url("/img/store/sorry.jpg") 49% 100% no-repeat;background-size: 189px 114px;}
</style>
<div style="background:white;min-height:1678px;margin-bottom:50px;border:2px solid #d0dde2;border: 2px solid #d0dde2;box-shadow: 0 2px 6px 2px rgba(131, 131, 131, 0.27);">

	<div class="allstore_body allstore_body2" style="margin-left:0px;margin-right: 8px;">
		<div class="top_merchants">
			<div class="merchants_header" align="left">All Stores</div>
			<div class="merchants_500" align="left">Cashback from over 500+ best online stores</div>
		</div>
		<div class="abcd_container">
			<a href="/allstore/0/" class="abcd_ancar">0-9</a>
			<a href="/allstore/A/" class="abcd_ancar">A</a>
			<a href="/allstore/B/" class="abcd_ancar">B</a>
			<a href="/allstore/C/" class="abcd_ancar">C</a>
			<a href="/allstore/D/" class="abcd_ancar">D</a>
			<a href="/allstore/E/" class="abcd_ancar">E</a>
			<a href="/allstore/F/" class="abcd_ancar">F</a>
			<a href="/allstore/G/" class="abcd_ancar">G</a>
			<a href="/allstore/H/" class="abcd_ancar">H</a>
			<a href="/allstore/I/" class="abcd_ancar">I</a>
			<a href="/allstore/J/" class="abcd_ancar">J</a>
			<a href="/allstore/K/" class="abcd_ancar">K</a>
			<a href="/allstore/L/" class="abcd_ancar">L</a>
			<a href="/allstore/M/" class="abcd_ancar">M</a>
			<a href="/allstore/N/" class="abcd_ancar">N</a>
			<a href="/allstore/O/" class="abcd_ancar">O</a>
			<a href="/allstore/P/" class="abcd_ancar">P</a>
			<a href="/allstore/Q/" class="abcd_ancar">Q</a>
			<a href="/allstore/R/" class="abcd_ancar">R</a>
			<a href="/allstore/S/" class="abcd_ancar">S</a>
			<a href="/allstore/T/" class="abcd_ancar">T</a>
			<a href="/allstore/U/" class="abcd_ancar">U</a>
			<a href="/allstore/V/" class="abcd_ancar">V</a>
			<a href="/allstore/W/" class="abcd_ancar">W</a>
			<a href="/allstore/X/" class="abcd_ancar">X</a>
			<a href="/allstore/Y/" class="abcd_ancar">Y</a>
			<a href="/allstore/Z/" class="abcd_ancar">Z</a>
		</div>
		<div class="merchants_body_alls"  style="margin-bottom:30px;">
		<?php
		
		if($alpha=='')
		{
			$q2="SELECT * FROM allstore WHERE active='1' LIMIT 30";
			$result = mysql_query($q2) or die("query");
			WHILE($rows = mysql_fetch_array($result))
			{
				$cname = $rows['cname'];
				$cname = strtolower($cname);
				$id = $rows['id'];
				$rate = $rows['rate'];
				$description = $rows['desc'];
				$url=$rows['url'];
				echo '
				<a href="/stores/'.$cname.'"><div class="merchants_details_alls"><div id="dealimg'.$id.'" style="height: 97px;width:191px;"></div><div class="m_desertion">'.$description.'</div><div class="merchants_text">'.$rate.'</div></div></a>
				';
			}
			
		}
		else
		{
			
			$q="SELECT * FROM allstore WHERE cname LIKE '".$alpha."%'  AND active='1' group by cname LIMIT 30";
			$result = mysql_query($q) or die("query");
			if(!$result || (mysql_numrows($result) < 1))
			{
				echo '
					<a href="#"><div style="margin-left:360px;" class="merchants_details_alls"><div id="dealimgsorry" style="height: 113px;width:191px;"></div><div class="m_desertion"></div><div class="merchants_text" style="color:red;">Sorry! We did not find anything</div></div></a>
				';
			}
			WHILE($rows = mysql_fetch_array($result))
			{
				$cname = $rows['cname'];
				$cname = strtolower($cname);
				$id = $rows['id'];
				$rate = $rows['rate'];
				$description = $rows['desc'];
				$url=$rows['url'];
				echo '
				<a href="/stores/'.$cname.'"><div class="merchants_details_alls"><div id="dealimg'.$id.'" style="height: 97px;width:191px;"></div><div class="m_desertion">'.$description.'</div><div class="merchants_text">'.$rate.'</div></div></a>
				';
			}
			/*
			if(($alpha == 'F') || ($alpha == 'f'))
			{
				echo '<a href="/stores/'.$cname.'"><div class="merchants_details_alls"><div id="dealimg'.$id.'" style="height: 97px;width:191px;"></div><div class="m_desertion">'.$description.'</div><div class="merchants_text">'.$rate.'</div></div></a>
				';
			}*/
			echo '
			<div style="float:left;">
			<hr style="margin-top:100px;">
				<div class="merchants_header" align="center" style="padding:20px 0 20px;">Our other stores</div>
			';	
				$q2="SELECT * FROM allstore WHERE active='1' order by rand() limit 10";
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