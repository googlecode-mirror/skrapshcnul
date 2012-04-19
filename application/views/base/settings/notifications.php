<div class="container">
	
	<div class="row-fluid">
		<div class="span3">
			<?php $this -> load -> view('base/settings/includes/sidetab');?>
		</div>
		<div class="span9 hasLeftCol">
			<div class="content-area">
				
				<div class="hr">
					<h2 class="hr-text"><?php echo $tpl_page_title; ?></h2>
				</div>
				
				<form method="post" class="form-horizontal">
					<fieldset>
						
						<legend>System Notifications</legend>
						
						<table class="table table-striped">
							<thead>
								<tr>
									<td width="80%"></td>
									<td><i class="icon-envelope"></i></td>
									<td><i class="icon-comment"></i></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>When I receive system notifications</td>
									<td>
										<label class="checkbox">
											<input type="checkbox" name="email_system_notification" 
											<?php echo $settings['notification']['email']['system_notification'] ? 'checked="checked"' : ''; ?>>
										</label>
									</td>
									<td>
										<label class="checkbox">
											<input type="checkbox" name="phone_system_notification"
											<?php echo $settings['notification']['phone']['system_notification'] ? 'checked="checked"' : ''; ?>>
										</label>
									</td>
								</tr>
							</tbody>
						</table>
					</fieldset>
					
					<fieldset>
						
						<legend>Profile Notifications</legend>
						
						
						<table class="table table-striped">
							<thead>
								<tr>
									<td width="80%"></td>
									<td><i class="icon-envelope"></i></td>
									<td><i class="icon-comment"></i></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>When I receive lunch suggestion.</td>
									<td>
										<label class="checkbox">
											<input type="checkbox" name="email_lunch_suggestion" 
											<?php echo $settings['notification']['email']['lunch_suggestion'] ? 'checked="checked"' : ''; ?>>
										</label>
									</td>
									<td>
										<label class="checkbox">
											<input type="checkbox" name="phone_lunch_suggestion" 
											<?php echo $settings['notification']['phone']['lunch_suggestion'] ? 'checked="checked"' : ''; ?>>
										</label>
									</td>
								</tr>
								<tr>
									<td>When people add me to their lunch wishlist.</td>
									<td>
										<label class="checkbox">
											<input type="checkbox" name="email_lunch_wishlist" 
											<?php echo $settings['notification']['email']['lunch_wishlist'] ? 'checked="checked"' : ''; ?>>
										</label>
									</td>
									<td>
										<label class="checkbox">
											<input type="checkbox" name="phone_lunch_wishlist" 
											<?php echo $settings['notification']['phone']['lunch_wishlist'] ? 'checked="checked"' : ''; ?>>
										</label>
									</td>
								</tr>
							</tbody>
						</table>
						
					</fieldset>
					
					<fieldset>
						
						<legend>Projects Notifications</legend>
						
						
						<table class="table table-striped">
							<thead>
								<tr>
									<td width="80%"></td>
									<td><i class="icon-envelope"></i></td>
									<td><i class="icon-comment"></i></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>When people followed my projects.</td>
									<td>
										<label class="checkbox">
											<input type="checkbox" name="email_project_follow" 
											<?php echo $settings['notification']['email']['project_follow'] ? 'checked="checked"' : ''; ?>>
										</label>
									</td>
									<td>
										<label class="checkbox">
											<input type="checkbox" name="phone_project_follow" 
											<?php echo $settings['notification']['phone']['project_follow'] ? 'checked="checked"' : ''; ?>>
										</label>
									</td>
								</tr>
								<tr>
									<td>When people favourited my projects.</td>
									<td>
										<label class="checkbox">
											<input type="checkbox" name="email_project_favaourite" 
											<?php echo $settings['notification']['email']['project_favaourite'] ? 'checked="checked"' : ''; ?>>
										</label>
									</td>
									<td>
										<label class="checkbox">
											<input type="checkbox" name="phone_project_favaourite" 
											<?php echo $settings['notification']['phone']['project_favaourite'] ? 'checked="checked"' : ''; ?>>
										</label>
									</td>
								</tr>
							</tbody>
						</table>
						
					</fieldset>
					
					<div class="form-actions">
						<button type="submit" class="btn btn-primary btn-large">
							Save changes
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	
</div>

<script>

</script>