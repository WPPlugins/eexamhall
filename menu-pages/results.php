   <link rel='stylesheet' type='text/css' href='<?php echo plugins_url('/bootstrap/css/bootstrap.css', __FILE__); ?>' />
<link rel='stylesheet' type='text/css' href='<?php echo plugins_url('/bootstrap/css/bootstrap-responsive.css', __FILE__); ?>' />
<div class=" span12 alert alert-info" style="margin-top:20px;">
<h3>Results</h3>
<hr/>
<?php
global $wpdb;
$select_query = "select * from `eexamhall_result`";
$select_result = $wpdb->get_results($select_query);
?>
<table class="display table table-bordered alert alert-error">
<tr>
<th>Sr No</th>
<th>Name</th>
<th>Correct Ans</th>
<th>No Answer</th>
<th>Wrong Ans</th>
<th>Percentage</th>
</tr>
<?php
$i=1;
foreach($select_result as $select_result)
{
	echo "<tr><td>$i</td><td>$select_result->name</td><td>$select_result->correct</td><td>$select_result->zero</td><td>$select_result->wrong</td><td>$select_result->percentage</td></tr>";
	$i++;
}
?>
</table>
</div>