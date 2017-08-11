<!---load bootstrap css----->
<link rel='stylesheet' type='text/css' href='<?php echo plugins_url('/bootstrap/css/bootstrap.css', __FILE__); ?>' />
<link rel='stylesheet' type='text/css' href='<?php echo plugins_url('/bootstrap/css/bootstrap-responsive.css', __FILE__); ?>' />
<script src="<?php echo plugins_url('/bootstrap/js/bootstrap-tooltip.js', __FILE__); ?>" type="text/javascript"></script>
<script src="<?php echo plugins_url('/bootstrap/js/bootstrap-affix.js', __FILE__); ?>" type="text/javascript"></script>
<script src="<?php echo plugins_url('/bootstrap/js/application.js', __FILE__); ?>" type="text/javascript"></script>

<div class='span12' style='margin-top:20px;'>
<?php
global $wpdb;
if(isset($_POST['addsubject']))
{
	$subname = strip_tags($_POST['name']);
	$insert_query="insert into `eexamhall_subject`(`id`,`subject_name`) values('','$subname')";
	$wpdb->query($insert_query);
	echo "<div class='alert alert-success'>Subject Name Added Successfully</div>";
}
if(isset($_POST['update_name']))
{
	$up_su_n = strip_tags($_POST['up_su_n']);
	$up_su_id = strip_tags($_POST['up_id']);
	$update_query = "update `eexamhall_subject` set `subject_name`='$up_su_n' where `id`='$up_su_id'";
	$wpdb->query($update_query);
	echo "<div class='alert alert-success'>Subject Name Updated Successfully</div>";
}
if($_GET['action']=='delete')
{
	$iddelt = $_GET['id'];
	$delete_query = "delete from `eexamhall_subject` where `id`='$iddelt'";
	$wpdb->query($delete_query);
	echo "<div class='alert alert-success'>Subject Name Deleted Successfully</div>";
	echo "<script>setTimeout(location.href='".admin_url("admin.php?page=eExamhall-main")."',6000)</script>";
}
?>
<script type="text/javascript">
function show_confirm() {
    return confirm("Do You Really Want to delete the Entry ? ");
}
</script>
<?php
	$select_query = "select * from `eexamhall_subject`";
	$select_row =  $wpdb->get_results($select_query);
	//print_r($select_row);
?>
<span style="float:right;">
<a class="btn btn-success" id='add_subjct'>Add Subject</a>
</span>
<?php 

if($_GET['action']=='update')
{
	$idd = $_GET['id'];
	$selectd_query = "select * from `eexamhall_subject` where `id`='$idd'";
	$selectd_row =  $wpdb->get_results($selectd_query);
	$su_n = $selectd_row[0]->subject_name;
	?>
	<div class="alert alert-success" style="margin-top:40px;">
	<form action="<?php echo admin_url("admin.php?page=eExamhall-main") ?>" method="post">
	<input type="hidden" name="up_id" value="<?php echo $idd;?>">
	Name of the Subject : <input type="text" value="<?php echo $su_n;?>" name="up_su_n"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	<input class="btn" name="update_name" type="submit" value="Update">
	</form>
	</div>
	<?php
}
?>
<hr/>
<div class="alert alert-info"><center><strong>List of Subject Added By you</strong></center></div>
<table class="responsive display table table-bordered">
<tr>
<th>Sr No</th><th>Name of Subject</th><th>Action</th>
</tr>
<?php
if($select_row)
{
	$i = 1;
	foreach($select_row as $select_row)
	{
		echo "<tr><td>$i</td><td>".$select_row->subject_name."</td><td> &nbsp;&nbsp;&nbsp;&nbsp;<a href='".admin_url("admin.php?page=eExamhall-main&action=update&id=$select_row->id")."' rel='tooltip' title='update' class='update'><i class='icon-pencil'></i></a> &nbsp;&nbsp; <a href='".admin_url("admin.php?page=eExamhall-main&action=delete&id=$select_row->id")."' onclick='return show_confirm();' rel='tooltip' title='Delete' class='delete'><i class='icon-trash'></i></a></td></tr>";
		$i++;
	}
}
else
{
	echo "<tr><td colspan='3' class='alert alert-error'><center><strong>You have not added any subject yet</strong></center></td></tr>";
}
?>
</table>
</div>

<script tst="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" src="<?php echo plugins_url('/js/jquery.min.js', __FILE__); ?>" type="text/javascript"></script>
<script>
$(document).ready(function(){
	$('#add_subjct').click(function(){
	   $("#myModal1").show();
	});
	$("#modelclose").click(function(){
		$("#myModal1").hide();
	});
	$("#addsubject").click(function(){
		var sub = $("#subname").val();
		if(sub =='')
		{
			alert("Please Enter Subject Name");
			return false;
		}
	});
});
</script>

<div class="modal" id="myModal1" style="display:none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
			<h3>Add Subject</h3>
		</div>
		<div class="modal-body">
			<form action="" method="post">
			Enter the Name of the Subject You want to add<br/>
			<input type="text" autocomplete="off" class="span4 text" name="name" style="margin-top:12px;height:25px;" id="subname"><br/>
			<div class="alert alert-error" id="blankname" style="display:none;">Subject Name Cannot be blank</div>
			<div class="alert alert-error" id="alreadytaken" style="display:none;">This Name Already Taken. Please choose another</div>
			<button type="submit" class="btn btn-success" name="addsubject" id="addsubject">Add Subject</button>
			</form>
			<div id="client_exist" style="display:none;">
			</div>
		</div>
		<div class="modal-footer">
			<a href="" class="btn" id="modelclose">Close</a>
		</div>
	</div>