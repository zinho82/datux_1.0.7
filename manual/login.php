<link rel="stylesheet" type="text/css" media="all" href="../includes/index.css">


<?php
include_once("../includes/class/class_mysql_inc.php");
$connect = new DB_mysql ;
$connect->conectar();


$campaigns = $connect->consulta("SELECT * FROM vicidial_campaigns where active = 'Y' and voicemail_ext = 'general'");


?>

<br><br><br><br><br>
<table  width="120" align="center">
<tr><td>
	<fieldset class="swiftfieldset">
		
				
				<table class="tborder" border="0" cellpadding="0" cellspacing="0" width="100">
				
									<!-- BEGIN LOGIN BOX -->
					  <tbody>
            <tr class="tcat">
						<td align="left" width="1"><img src="../images/space.gif" height="21" width="1"></td>
						<td align="left" width="1"><img src="../images/blockarrow.gif" height="8" width="8"></td>
						<td align="left" valign="middle">&nbsp;<span class="smalltext"><strong><font color="#ffffff">Login</font></strong></span></td>
						<td align="right" width="130"><span class="smalltext">&nbsp;</span></td>
					  </tr>

					  <tr>
						<td colspan="4" bgcolor="#f5f5f5">
						<form name="loginform" action="autentificar.php" method="post"><table border="0" cellpadding="2" cellspacing="1" width="100%">
						  <tbody><tr>
							<td class="smalltext" width="46%">Usuario:</td>
							<td width="54%"><input name="username" class="logintext" value="" type="text"></td>
						  </tr>
						  <tr>
							<td class="smalltext">Password:</td>
							<td><input name="password" class="loginpassword" value="" type="password"></td>
							</tr>
							<tr>
							<td class="smalltext">Campa�a:</td>
							<td>
						
							<?php	
							echo "<select name='campaign_id'>";
							while($row = mysql_fetch_array($campaigns))
								{
									
									echo "<option value='$row[campaign_id]'>".$row["campaign_id"]." ".$row['campaign_name']."</option>";
								}
							echo "</select>";
							?>
							</td></tr>
							 <tr>
							<td class="smalltext">&nbsp;</td>
							<td><input name="Submit2" value="Login" class="yellowbutton" type="submit">                          </td>
						  </tr>
						</tbody></table>
						<input name="_m" value="core" type="hidden"><input name="_a" value="login" type="hidden"><input name="querystring" value="_m=knowledgebase&amp;_a=viewarticle&amp;kbarticleid=32" type="hidden">
						</form>
			</td></tr>
			</table>		