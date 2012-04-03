<fieldset>
	<legend>
		Verification Status
	</legend>
	
	<div class="control-group">
		<label class="control-label" for="verified_status">Status</label>
		<div class="controls">
			<input id="verified_status" name="verified_status" title="status" class="input-xlarge" type="text" value="<?php echo $project['verified_status']['status'] ?>" placeholder="Verification status">
			<p class="help-block">
				In addition to freeform text, any HTML5 text-based input appears like so.
			</p>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="remarks">Name</label>
		<div class="controls">
			<input id="remarks" name="remarks" title="remarks" class="input-xlarge" type="text" value="<?php echo $project['verified_status']['remarks']; ?>" placeholder="Verification remarks">
			<p class="help-block">
				In addition to freeform text, any HTML5 text-based input appears like so.
			</p>
		</div>
	</div>
</fieldset>