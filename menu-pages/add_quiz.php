<!---load bootstrap css----->
<link rel='stylesheet' type='text/css' href='<?php echo plugins_url('/bootstrap/css/bootstrap.css', __FILE__); ?>' />
<link rel='stylesheet' type='text/css' href='<?php echo plugins_url('/bootstrap/css/bootstrap-responsive.css', __FILE__); ?>' />
<script src="<?php echo plugins_url('/bootstrap/js/bootstrap-tooltip.js', __FILE__); ?>" type="text/javascript"></script>
<script src="<?php echo plugins_url('/bootstrap/js/bootstrap-affix.js', __FILE__); ?>" type="text/javascript"></script>
<script src="<?php echo plugins_url('/bootstrap/js/application.js', __FILE__); ?>" type="text/javascript"></script>
<script tst="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" src="<?php echo plugins_url('/js/jquery.min.js', __FILE__); ?>" type="text/javascript"></script>

<div class='span12' style='margin-top:20px;'>
<?php
global $wpdb;
$select_qury = "select * from `eexamhall_subject`";
$select_data = $wpdb->get_results($select_qury);

$select_quiz = "select * from `eexamhall_quiz`";
$select_data_quiz = $wpdb->get_results($select_quiz);
if(isset($_POST['add_quiz']))
{
	$quiz_n = $_POST['qz_n'];
	$sub_id = $_POST['sub_nm'];
	$insert_queryr = "insert into `eexamhall_quiz`(`id`,`sub_id`,`quiz_name`) values('','$sub_id','$quiz_n')";
	$wpdb->query($insert_queryr);
	echo "<div class='alert alert-success'>Quiz Name Added Successfully</div>";
}

if(isset($_POST['update_name']))
{
	$up_su_n = $_POST['up_su_n'];
	$up_su_id = $_POST['up_id'];
	$up_su_ss = $_POST['sub_nm'];
	$update_query = "update `eexamhall_quiz` set `quiz_name`='$up_su_n',`sub_id`='$up_su_ss' where `id`='$up_su_id'";
	$wpdb->query($update_query);
	echo "<div class='alert alert-success'>Subject Name Updated Successfully</div>";
}

if($_GET['action']=='delete')
{
	$iddelt = $_GET['id'];
	$delete_query = "delete from `eexamhall_quiz` where `id`='$iddelt'";
	$wpdb->query($delete_query);
	echo "<div class='alert alert-success'>Quiz Name Deleted Successfully</div>";
	echo "<script>setTimeout(location.href='".admin_url("admin.php?page=eExamhall-quiz")."',6000)</script>";
}
?>
<script type="text/javascript">
function show_confirm() {
    return confirm("Do You Really Want to delete the Entry ? ");
}
</script>

<?php 

if($_GET['action']=='update')
{
	$idd = $_GET['id'];
	$selectd_query = "select * from `eexamhall_quiz` where `id`='$idd'";
	$selectd_row =  $wpdb->get_results($selectd_query);
	$su_n = $selectd_row[0]->quiz_name;
	$sub_id = $selectd_row[0]->sub_id;
	?>
	<div class="alert alert-success" style="margin-top:40px;">
	<center><strong>Edit Your Quiz</strong></center>
	<form action="<?php echo admin_url("admin.php?page=eExamhall-quiz") ?>" method="post">
	<input type="hidden" name="up_id" value="<?php echo $idd;?>">
	Select Subject Name : <select name="sub_nm">
	<?php
	foreach($select_data as $select_data)
	{
		if($select_data->id == $sub_id)
			echo "<option value='$select_data->id' selected='selected'>$select_data->subject_name (id = $select_data->id)</option>";
		else
			echo "<option value='$select_data->id'>$select_data->subject_name (id = $select_data->id)</option>";
	}
	?>
	</select> &nbsp;&nbsp;&nbsp;&nbsp;
	Name of the Quiz : <input type="text" value="<?php echo $su_n;?>" name="up_su_n"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	<input class="btn" name="update_name" type="submit" value="Update Quiz">
	</form>
	</div>
	<?php
}
?>

<?php
if($select_data)
{
	?>
	<div class="alert alert-info" style="height:40px;">
	<form action="" method="post">
	Select Subject Name : <select name="sub_nm">
	<?php
	foreach($select_data as $select_data)
	{
		echo "<option value='$select_data->id'>$select_data->subject_name (id = $select_data->id)</option>";
	}
	?>
	</select> &nbsp;&nbsp;&nbsp;&nbsp;
	Quiz Name : <input type="text" name="qz_n"> &nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" class="btn" value="Add Quiz" name="add_quiz">
	<?php
}
else
{
	echo "<div class='alert alert-error'>You have not added any subject yet. First Add Subject </div>";
}
?>
</div>
<div class="alert alert-success"><center><strong>List of Quizes Added By you</strong></center></div>
<table class="responsive display table table-bordered">
<tr>
<th>Sr No</th><th>Subject Name</th><th>Name of Quiz</th><th>Shortcode</th><th>Action</th>
</tr>
<?php
if($select_data_quiz)
{
	$i = 1;
	foreach($select_data_quiz as $select_data_quiz)
	{
		$select_sub = "select * from `eexamhall_subject` where `id`='$select_data_quiz->sub_id'";
		$select_sub_quiz = $wpdb->get_results($select_sub);
		echo "<tr><td>$i</td><td>".$select_sub_quiz[0]->subject_name."</td><td>".$select_data_quiz->quiz_name."</td><td>[eExamHall id='".$select_data_quiz->id."']</td><td> &nbsp;&nbsp;&nbsp;&nbsp;<a href='".admin_url("admin.php?page=eExamhall-quiz&action=update&id=$select_data_quiz->id")."' rel='tooltip' title='update' class='update'><i class='icon-pencil'></i></a> &nbsp;&nbsp; <a href='".admin_url("admin.php?page=eExamhall-quiz&action=delete&id=$select_data_quiz->id")."' onclick='return show_confirm();' rel='tooltip' title='Delete' class='delete'><i class='icon-trash'></i></a></td></tr>";
		$i++;
	}
}
else
{
	echo "<tr><td colspan='4' class='alert alert-error'><center><strong>You have not added any Quiz yet</strong></center></td></tr>";
}
?>
</table>
</div>