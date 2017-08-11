<?php
global $wpdb;
?>
<!---load bootstrap css----->
<link rel='stylesheet' type='text/css' href='<?php echo plugins_url('/bootstrap/css/bootstrap.css', __FILE__); ?>' />
<link rel='stylesheet' type='text/css' href='<?php echo plugins_url('/bootstrap/css/bootstrap-responsive.css', __FILE__); ?>' />
<script src="<?php echo plugins_url('/bootstrap/js/bootstrap-tooltip.js', __FILE__); ?>" type="text/javascript"></script>
<script src="<?php echo plugins_url('/bootstrap/js/bootstrap-affix.js', __FILE__); ?>" type="text/javascript"></script>
<script src="<?php echo plugins_url('/bootstrap/js/application.js', __FILE__); ?>" type="text/javascript"></script>
<script type="text/javascript">
function show_confirm() {
    return confirm("Do You Really Want to delete the Entry ? ");
}
function getfunction(){
			var ServiceId = jQuery("select#classlist").val();
			if(ServiceId > 0)
			{
				jQuery('#sheduling_wait').show();
				var FirstData = "ServiceId=" + ServiceId;
				var currenturl = jQuery(location).attr('href');
				var url = currenturl;
				jQuery.ajax({
					dataType : 'html',
					type: 'GET',
					url : url,
					data : FirstData,
					complete : function() { },
					success: function(data) 
						{
							
							data=jQuery(data).find('div#stfflistdiv');
							jQuery('#staff').show();
							jQuery('#staff').html(data);
							jQuery('#sheduling_wait').hide();
						}
				});
			}
		}	

</script>

</script>
<?php
if(isset($_POST['submit_up']))
{
	$iss = $_POST['up_id'];
	$quiz_id = $_POST['quiz_ed'];
	$question = $_POST['wp_question'];
	$op111 = $_POST['op1'];
	$op222 = $_POST['op2'];
	$op333 = $_POST['op3'];
	$op444 = $_POST['op4'];
	$corrr = $_POST['corr_op'];
	$update_qq = "update `eexamhall_question` set `quiz_id`='$quiz_id', `question`='$question', `op1`='$op111',`op2`='$op222',`op3`='$op333',`op4`='$op444',`correct_ans`='$corrr' where `id`='$iss'";
	$wpdb->query($update_qq);
	//echo $wpdb->show_errors();
	echo "<div class='alert alert-success'>Question Update Successfully</div>";
	
}
if($_GET['action']=='delete')
{
	$iddelt = $_GET['id'];
	$delete_query = "delete from `eexamhall_question` where `id`='$iddelt'";
	$wpdb->query($delete_query);
	echo "<div class='alert alert-success'>Question Deleted Successfully</div>";
	echo "<script>setTimeout(location.href='".admin_url("admin.php?page=eExamhall-question-view")."',6000)</script>";
}

if($_GET['action']=='update')
{
		$idedit = $_GET['id'];
		$upd_q = "select * from `eexamhall_question` where `id`='$idedit'";
		$upd_q = $wpdb->get_results($upd_q);
		
		$quiz = $upd_q[0]->quiz_id;
		$question = $upd_q[0]->question;
		$op11 = $upd_q[0]->op1;
		$op2 = $upd_q[0]->op2;
		$op3 = $upd_q[0]->op3;
		$op4 = $upd_q[0]->op4;
		$corr = $upd_q[0]->correct_ans;
		?>
		<div class="alert alert-success" style='margin-top:15px;'>
		<center><strong>Edit Your Questions</strong></center></div>
		<form action="<?php echo admin_url("admin.php?page=eExamhall-question-view") ?>" method="post">
		<input type="hidden" name="up_id" value="<?php echo $idedit;?>">
		<table class="table">
		<?php
		$select_quizs = "select * from `eexamhall_quiz`";
		$select_data_quizs = $wpdb->get_results($select_quizs);
		echo "<tr><td>";
		echo "Select Quiz Name : <select name='quiz_ed'>";
		foreach($select_data_quizs as $select_data_quizs)
		{
			if($select_data_quizs->id == $quiz)
			{
				//echo $select_data_quizs->id;
				echo "<option value = '$select_data_quizs->id' selected='selected'>$select_data_quizs->quiz_name</option>";
			}
			else
			{
				//echo $select_data_quizs->id;
				echo "<option value = '$select_data_quizs->id'>$select_data_quizs->quiz_name</option>";
			}
		}
		echo "</select></td><td>";
		echo "Edit Question : <textarea name='wp_question'>$question</textarea></td></tr><tr><td>";
		echo "Option 1 : <input type='text' name='op1' value='$op11'></td><td>Option 2 :<input type='text' name='op2' value='$op2'></td></tr><tr><td>";
		echo "Option 3 : <input type='text' name='op3' value='$op3'></td><td>Option 4 :<input type='text' name='op4' value='$op4'></td></tr><tr><td>";
		echo "Correct Option : <select name='corr_op'>";
		for ($j=1;$j<=4;$j++)
		{
			if($j==$corr)
				echo "<option value='$j' selected='selected'>Option $j</option>";
			else
				echo "<option value='$j'>Option $j</option>";
		}
		echo "</select></td><td><input type='submit' class='btn btn-success' name='submit_up' value='Update'></td></tr>";
		?>
	    </table>
		<?php
}
?>
<div style='margin-top:20px;'>
<div class="alert alert-info"><center><strong>List of Questions Added By you</strong></center></div>
<div class='alert alert-success'>
<center>Select Questions via Quiz and Subject</center>
<br/>
<form method='post' action='#'>
<?php 
$allsubs = "SELECT * FROM `eexamhall_subject`";
$allsubslist = $wpdb->get_results($allsubs);
?>
Choose Subject :
<select name="classlist" id="classlist" onChange="return getfunction()">
<option value="0">Select Subject</option>
<?php
foreach($allsubslist as $allsubslist)
	echo "<option value='$allsubslist->id'>$allsubslist->subject_name</option>";
?>
</select><div id="sheduling_wait" style="display:none;"><?php _e('Loading Quiz, Please wait...', 'classbooking'); ?>
<img src="<?php echo plugins_url('images/009.gif', __FILE__); ?>" /></div><span id="staff"></span>
<?php
if(isset($_GET['ServiceId']) && !isset($_GET['classname']))
{
?>
	<div id="stfflistdiv">
	 <?php 
		global $wpdb;
		$serviceid = $_GET['ServiceId'];
		$allclassess = "SELECT * FROM `eexamhall_quiz` where `sub_id`= $serviceid";
		$allclassess = $wpdb->get_results($allclassess);
	 ?>
	 Select Quiz : 	 <select name="stafflist" id="stafflist">
	 <?php
		foreach($allclassess as $allclassess)
		{
			echo "<option value='$allclassess->id'>$allclassess->quiz_name</option>";
		}
	 ?>
	 </select>
	 <input type='submit' name='show_result' class='btn btn-danger' value='Show Result' />
<?php
}
?>
</form>
</div>
<table class="responsive display table table-bordered">
<tr>
<th>Sr No</th><th>Quiz Name</th><th>Question</th><th>Op 1</th><th>Op 2</th><th>Op 3</th><th>Op 4</th><th>Correct Op</th><th>Action</th>
</tr>
<?php
$i =1;
if(isset($_POST['show_result']))
{
	$post_q = $_POST['stafflist'];
	$select_query = "select * from `eexamhall_question` where `quiz_id` = '$post_q'";
	$select_query = $wpdb->get_results($select_query);
}
else
{
	$select_query = "select * from `eexamhall_question` order by `quiz_id`";
	$select_query = $wpdb->get_results($select_query);
}
if($select_query){
foreach($select_query as $select_query)
{
	$select_sub = "select * from `eexamhall_quiz` where `id`='$select_query->quiz_id'";
	$select_sub_quiz = $wpdb->get_results($select_sub);
	//print_r($select_sub_quiz);die;
	echo "<tr><td>$i</td><td>".$select_sub_quiz[0]->quiz_name."</td><td>$select_query->question</td><td>$select_query->op1</td><td>$select_query->op2</td><td>$select_query->op3</td><td>$select_query->op4</td><td>$select_query->correct_ans</td><td> &nbsp;&nbsp;&nbsp;&nbsp;<a href='".admin_url("admin.php?page=eExamhall-question-view&action=update&id=$select_query->id")."' rel='tooltip' title='update' class='update'><i class='icon-pencil'></i></a> &nbsp;&nbsp; <a href='".admin_url("admin.php?page=eExamhall-question-view&action=delete&id=$select_query->id")."' onclick='return show_confirm();' rel='tooltip' title='Delete' class='delete'><i class='icon-trash'></i></a></td></tr>";
	$i++;
}
}
else
{
	echo "<tr><td colspan='9' class='alert alert-danger'><center>You have not added any Question with the quiz yet</center> </td></tr>";
}
?>
</table>
</div>