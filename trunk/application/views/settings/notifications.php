<div class="m-content">
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('settings/includes/sidetab');?>
	</div>
	<div class="m-content-2-col-right">
		<div class="hr">
			<h2 class="hr-text"><?php echo $tpl_page_title; ?></h2>
		</div>

		<div id="settings-system-notification">
			<h3>System Notifications</h3>
			<div class="row-item">
				<div class="content-table-2-col-left">
					When I receive system announcement
				</div>
				<div class="content-table-2-col-right">
					<div class="buttonset">
						<input type="checkbox" id="check_sys_ann_email" /><label for="check_sys_ann_email">Email</label>
						<input type="checkbox" id="check_sys_ann_phone" /><label for="check_sys_ann_phone">Phone</label>
					</div>
				</div>
			</div>
			<div class="row-item">
				<div class="content-table-2-col-left">
					When I receive system notifications
				</div>
				<div class="content-table-2-col-right">
					<div class="buttonset">
						<input type="checkbox" id="check_sys_notif_email" /><label for="check_sys_notif_email">Email</label>
						<input type="checkbox" id="check_sys_notif_phone" /><label for="check_sys_notif_phone">Phone</label>
					</div>
				</div>
			</div>
		</div>
		
		<div id="settings-system-notification">
			<h3>Profile Notifications</h3>
			<div class="row-item">
				<div class="content-table-2-col-left">
					When I receive event notifications.
				</div>
				<div class="content-table-2-col-right">
					<div class="buttonset">
						<input type="checkbox" id="check_sys_event_email" /><label for="check_sys_event_email">Email</label>
						<input type="checkbox" id="check_sys_event_phone" /><label for="check_sys_event_phone">Phone</label>
					</div>
				</div>
			</div>
			<div class="row-item">
				<div class="content-table-2-col-left">
					When people add me to their lunch wishlist.
				</div>
				<div class="content-table-2-col-right">
					<div class="buttonset">
						<input type="checkbox" id="check_sys_lunch_wishlist_email" /><label for="check_sys_lunch_wishlist_email">Email</label>
						<input type="checkbox" id="check_sys_lunch_wishlist_phone" /><label for="check_sys_lunch_wishlist_phone">Phone</label>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<div class="clearfix"></div>
</div>

<script>jQuery(".buttonset").buttonset();</script>
