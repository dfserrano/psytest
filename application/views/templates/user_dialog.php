<div id="dialog-form" title="<?php echo $this->lang->line('label_user_data');?>">
<p class="validateTips"><?php echo $this->lang->line('label_all_required');?>.</p>
	<form>
		<fieldset>
			<label for="firstname"><?php echo $this->lang->line('label_name');?></label> <input type="text"
				name="firstname" id="firstname"
				class="text ui-widget-content ui-corner-all" /> <label
				for="lastname"><?php echo $this->lang->line('label_lastname');?></label> <input type="text" name="lastname"
				id="lastname" class="text ui-widget-content ui-corner-all" />
			<!-- <label for="email">Email</label>
			<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />-->
			<label for="age"><?php echo $this->lang->line('label_age');?></label> <input type="text" name="age" id="age"
				value="" class="text ui-widget-content ui-corner-all" /> <label
				for="age"><?php echo $this->lang->line('label_id_doc');?></label> <input type="text" name="docid"
				id="docid" value="" class="text ui-widget-content ui-corner-all" />
		</fieldset>
	</form>
</div>