<link rel='stylesheet' type='text/css' href='<?php echo plugins_url('/bootstrap/css/bootstrap.css', __FILE__); ?>' />
<h3>Settings</h3>
<form method="post" action="#">
<label><strong>Set Time for Quiz : </strong><input type="text" name="timer" value="<?php echo $timer; ?>" class="span2 text" required="required" disabled="disabled" /> Seconds </label>
<div class="alert alert-error">This feature is Available only in premium feature. Please Click here to upgrade</div>
</form>