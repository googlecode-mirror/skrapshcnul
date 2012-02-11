<html>
	<body>
		<table width="500px" style="border: 2px solid #DDDDDD; background: #FFFFFF; margin: auto;">
			<tr>
				<td colspan="3" style="background: #EFEFEF; border-bottom: 1px solid #CCCCCC;"><img src="<?php echo base_url() ?>skin/images/300/ls_logo.png" /></td>
			</tr>
			<tr>
				<td width="10px"></td>
				<td>&nbsp;</td>
				<td width="10px"></td>
			</tr>
			<tr>
				<td width="10px"></td>
				<td><h1>Dear <?php echo !empty($invitee_email) ? $invitee_email : '';?>,</h1></td>
				<td width="10px"></td>
			</tr>
			<tr>
				<td width="10px"></td>
				<td>&nbsp;</td>
				<td width="10px"></td>
			</tr>
			<tr>
				<td width="10px"></td>
				<td>
				<p>
					<strong>Join the Lunchsparks private Alpha!</strong>
				</p>
				<p>
					We are happy to present the first private alpha version of <?php echo anchor('', 'Lunchsparks.me') ?>, a platform connecting professionals with each other.
				</p>
				<p>
					<span> Your invitation code is <strong><?php echo !empty($invitation_code) ? $invitation_code : '' ?><strong></span>
				</p>
				<p style="text-align: center;">
					<?php echo !empty($invitation_code) ? 
						anchor('auth/signup?invitation_key=' . $invitation_code, 'Sign up Now', 
						array('style' => 'display:inline-block;padding:8px 12px;background-color:#95c033;color:#fff;font-size:20px;font-weight:bold;text-decoration:none;cursor:pointer;border:1px solid #8bae42;border-radius:5px;box-shadow:0 1px 0 #b7db81 inset, 0 -1px 0 #b7db81 inset;text-shadow:0 1px 0 #6b8e4a')) : 
						'';?>
				</p>
				<p>&nbsp;</p>
				<p>
					
				</p>
				</td>
				<td width="10px"></td>
			</tr>
			<tr>
				<td width="10px"></td>
				<td>
					<p>This invitation was send to you by <?php echo !empty($sender_email) ? $sender_email: '';?></p>
				</td>
				<td width="10px"></td>
			</tr>
			<tr>
				<td width="10px"></td>
				<td>
				<p>&nbsp;</p>
				<p>
					Best Regards,
					<br />
					Lunchsparks Team
				</p></td>
				<td width="10px"></td>
			</tr>
			<tr>
				<td width="10px"></td>
				<td><p><br /></p></td>
				<td width="10px"></td>
			</tr>			
			<tr>
				<td width="10px"></td>
				<td>
					<p>Follow us on: <a href="http://twitter.com/#!/lunchsparks">Twitter</a> | <a href="https://www.facebook.com/pages/Lunchsparks/148121848608310">Facebook</a> | <a href="http://blog.lunchsparks.me/">Blog</a> <br /><br /><br /></p>
				</td>
				<td width="10px"></td>
			</tr>
		</table>
	</body>
</html>