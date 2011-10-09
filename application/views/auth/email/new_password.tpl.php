<html>
	<body>
		<table width="500px" style="border: 2px solid #DDDDDD; background: #FFFFFF;">
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
				<td><h1>Dear <?php echo !empty($identity) ? $identity : '';?>,</h1></td>
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
						You recently asked us to reset your password. Your password has been reset to:
					</p>
					<p style="text-align: center;">
						<span style="display:inline-block;padding:8px 12px;background-color:#95c033;color:#fff;font-size:20px;font-weight:bold;text-decoration:none;box-shadow:0 1px 0 #b7db81 inset, 0 -1px 0 #b7db81 inset;text-shadow:0 1px 0 #6b8e4a">
							<?php echo $new_password;?>
						</span>
					</p>
					<p>&nbsp;</p>
				</td>
				<td width="10px"></td>
			</tr>
			<tr>
				<td width="10px"></td>
				<td>
					<p>If you have not asked for your password to be reset, please <?php echo mailto('support@lunchsparks.me', 'Contact Us');?>. </p>
				</td>
				<td width="10px"></td>
			</tr>
			<tr>
				<td width="10px"></td>
				<td>
					<p>&nbsp;</p>
					<p>
						Cheers,
						<br />
						Lunchsparks Support
					</p>
				</td>
				<td width="10px"></td>
			</tr>
			<tr>
				<td width="10px"></td>
				<td><p>&nbsp;</p></td>
				<td width="10px"></td>
			</tr>			
			<tr>
				<td width="10px"></td>
				<td>
					<p>Follow us on: Twitter | Facebook | Blog</p>
				</td>
				<td width="10px"></td>
			</tr>
		</table>
	</body>
</html>
