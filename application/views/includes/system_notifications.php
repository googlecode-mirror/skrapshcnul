<?php if($this->session->flashdata('system_message')) : 
?>
<div id="system_notifications">
	<?php echo $this -> session -> flashdata('system_message');?>
</div>
<?php endif?>