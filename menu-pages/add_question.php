<!---load bootstrap css----->
<link rel='stylesheet' type='text/css' href='<?php echo plugins_url('/bootstrap/css/bootstrap.css', __FILE__); ?>' />
<link rel='stylesheet' type='text/css' href='<?php echo plugins_url('/bootstrap/css/bootstrap-responsive.css', __FILE__); ?>' />
<script src="<?php echo plugins_url('/bootstrap/js/bootstrap-tooltip.js', __FILE__); ?>" type="text/javascript"></script>
<script src="<?php echo plugins_url('/bootstrap/js/bootstrap-affix.js', __FILE__); ?>" type="text/javascript"></script>
<script src="<?php echo plugins_url('/bootstrap/js/application.js', __FILE__); ?>" type="text/javascript"></script>

<div class='span12' style='margin-top:20px;'>
<div class="alert alert-info"><center>Add Question</center></div>
<?php
global $wpdb;

if(isset($_POST['add_question']))
{
	$quiz_id = strip_tags($_POST['quiz_n']);
	$quest = strip_tags($_POST['question']);
	$op1 = strip_tags($_POST['op1']);
	$op2 = strip_tags($_POST['op2']);
	$op3 = strip_tags($_POST['op3']);
	$op4 = $_POST['op4'];
	$correct = $_POST['correct_op'];
	//$wpdb->show_errors();
	$insert_query = "insert into `eexamhall_question`(`id`,`quiz_id`,`question`,`op1`,`op2`,`op3`,`op4`,`correct_ans`) values ('','$quiz_id','$quest','$op1','$op2','$op3','$op4','$correct')";
	$wpdb->query($insert_query);
	echo "<div class='alert alert-success'>Question Added Successfully</div>";
}
$select_quiz = "select * from `eexamhall_quiz`";
$select_data_quiz = $wpdb->get_results($select_quiz);
if($select_data_quiz)
{
	?>
	<form action="" method="post">
	<table class="table">
	<tr><td>
	Select Quiz :
	</td><td>
	<select name="quiz_n">
	
	<?php
	foreach($select_data_quiz as $select_data_quiz)
	{
		echo "<option value = '$select_data_quiz->id'>$select_data_quiz->quiz_name</option>";
	}
	?>
	</select>
	</td></tr>
	<tr><td>Question : </td>
	<td><textarea name="question"></textarea></td></tr>
	<tr><td> Option 1 : </td>
	<td> <input type="text" name="op1"></td></tr>
	<tr><td> Option 2 : </td>
	<td> <input type="text" name="op2"></td></tr>
	<tr><td> Option 3 : </td>
	<td> <input type="text" name="op3"></td></tr>
	<tr><td> Option 4 : </td>
	<td> <input type="text" name="op4"></td></tr>
	<tr>
	<td>Correct Answer</td>
	<td>
	<select name="correct_op">
	<option value='1'>Option 1</option>
	<option value='2'>Option 2</option>
	<option value='3'>Option 3</option>
	<option value='4'>Option 4</option>
	</select>
	</td>
	</tr>
	<tr>
	<td colspan="2">
	<input type="submit" class="btn btn-primary" name="add_question" value="Add Question">
	</td>
	</tr>
	</table>
	</form>
	<?php
}
else
{
	echo "<div class='alert alert-error'>You have not added any quiz yet. First add Quiz</div>";
}
?>
</div>