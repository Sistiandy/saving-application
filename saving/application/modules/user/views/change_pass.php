<div class="col-sm-9 col-md-10 main">
	<?php echo form_open(current_url()); ?>
	<?php echo validation_errors(); ?>
	<div class="form-group">
		<?php if($this->uri->segment(3) == 'cpw' ) { ?>
		<label ><?php echo $this->lang->line('current_pass')?> *</label>
		<input type="password" name="user_current_password" class="form-control" placeholder="<?php echo $this->lang->line('current_pass')?>">
		<?php } ?>
	</div>
	<div class="form-group">
		<label ><?php echo $this->lang->line('new_pass')?>*</label>
		<input type="password" name="user_password" class="form-control" placeholder="<?php echo $this->lang->line('new_pass')?>">
		<?php if($this->uri->segment(3) == 'cpw' ) { ?>
		<input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id'); ?>" >
		<?php } else{ ?>
		<input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>" >
		<?php } ?>
	</div>
	<div class="form-group">
		<label ><?php echo $this->lang->line('confirm_new_password')?>*</label>
		<input type="password" name="passconf" class="form-control" placeholder="<?php echo $this->lang->line('confirm_new_password')?>" >
	</div>
    <button type="submit" class="btn btn-success"><i class="ion-checkmark"></i> <?php echo $this->lang->line('save')?></button>
    <a href="<?php echo site_url('manage/user'); ?>" class="btn btn-info"><i class="ion-arrow-left-a"></i> <?php echo $this->lang->line('cancel')?></button></a>
	<?php form_close() ?>
</div>