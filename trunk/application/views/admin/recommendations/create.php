<div style="background: #F8F8F8; border: 1px solid #CCCCCC; padding: 10px; margin: 10px 0;">
	<div class="title" style="background: #F1F1F1; padding: 10px; cursor: pointer;" onclick="jQuery(this).next().slideToggle('slow');">
		Create new recommendation.
	</div>
	<div style="display:none;">
		<form method="post" id="form_new_recommendation">
			<div>
				<div style="display: inline-block; width: 300px; vertical-align: top;">
					<label>User</label>
					<div class="caption">
						Enter the name of the user. Select from the dropdown list.
					</div>
					<input type="text" id="user_name" name="user_name" class="ls_user_autocomplete" placeholder="alias, firstname, lastname" />
					<input type="hidden" name="user_id">
				</div>
				<div style="display: inline-block; width: 50px; padding-top:10px; vertical-align: bottom;">
					<div class="ls-profile-hover" ls-data-userid="">
						<!-- image placeholder -->
					</div>
				</div>
			</div>
			<div>
				<div style="display: inline-block; width: 300px; vertical-align: top;">
					<label>Target User</label>
					<div class="caption">
						Enter the name of the user. Select from the dropdown list.
					</div>
					<input type="text" id="target_user_name" name="target_user_name" class="ls_user_autocomplete" placeholder="alias, firstname, lastname" />
					<input type="hidden" name="target_user_id">
				</div>
				<div style="display: inline-block; width: 50px; padding-top:10px; vertical-align: bottom;">
					<div class="ls-profile-hover" ls-data-userid="">
						<!-- image placeholder -->
					</div>
				</div>
			</div>
			<div>
				<label>Reason</label>
				<input type="text" id="reason" name="reason" placeholder="Reason" />
			</div>
			<input type="submit" />
		</form>
	</div>
</div>