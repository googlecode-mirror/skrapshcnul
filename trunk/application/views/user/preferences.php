<div class="m-content">
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('user/includes/sidetab');?>
	</div>
	<div class="m-content-2-col-right">
		<form>
			<h2>Preferences</h2>
			<div class="hr">
				<h2 class="hr-text">What you looking for</h2>
			</div>
			<div>
				<label>Networking: </label><br />
				<textarea style="width: 100%; height: 100px;"></textarea>
			</div>
			<div>
				<label>Career: </label><br />
				<textarea style="width: 100%; height: 100px;"></textarea>
			</div>
			
			<div class="hr">
				<h2 class="hr-text">What you can offer</h2>
			</div>
			<div>
				<label>Career: </label><br />
				<textarea style="width: 100%; height: 100px;"></textarea>
			</div>
			<div class="clearfix"></div>
		</form>
		<br />
		
		<div class="button-set">
			<input type="submit" id="add_pick_button" value="Save">
		</div>
		<br />
	</div>
</div>