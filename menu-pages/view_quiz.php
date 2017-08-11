   <?php
   global $wpdb;
       $a = shortcode_atts( array(
        'id' => 'something',
    ), $atts );

   $quiz_id ="{$a['id']}";
   ?>
   <link rel='stylesheet' type='text/css' href='<?php echo plugins_url('/bootstrap/css/bootstrap.css', __FILE__); ?>' />
<link rel='stylesheet' type='text/css' href='<?php echo plugins_url('/bootstrap/css/bootstrap-responsive.css', __FILE__); ?>' />
<script src="<?php echo plugins_url('/jquery.min.js', __FILE__);?>"></script>
<script src="<?php //echo plugins_url('/bootstrap/js/bootstrap-tooltip.js', __FILE__); ?>" type="text/javascript"></script>
<script src="<?php //echo plugins_url('/bootstrap/js/bootstrap-affix.js', __FILE__); ?>" type="text/javascript"></script>
<script src="<?php //echo plugins_url('/bootstrap/js/application.js', __FILE__); ?>" type="text/javascript"></script>
<style>
ul{list-style:none;}
</style>
<script>
jQuery(function(){

	var items = $('ul#part li');
	console.log(items);
	var answers = new Array();
	var correct = new Array();
	$("span#zero div span").addClass("checked");
	if(items.filter(':visible').length == 0)
	{
		items.first().show();
	}
	var i = 1;
	$('#next').click(function(e){
		var active = items.filter(':visible:last');
        active.hide();
		//Example2.Timer.pause();
		var op111 = "op1"+i;
		
		var correct_op = "#correct"+i;
		var c = $(correct_op).val();
		correct.push(c);
			//One item checked with that name
		if($("input:radio[name="+op111+"]:checked"))
		var val = $("input:radio[name="+op111+"]:checked").val();
		else
			var val = 0;
		i=i+1;
		
		console.log(val)
		answers.push(val)
        var next = active.next();
        if (next.length){
             next.show();
			// Example2.Timer.play();
			}
		else{
			//console.log(correct);
			//Example2.Timer.stop();
			$("#next").hide();
			$("#thanks").show();
			
		}
		
});
$("#getresult").click(function(){
		//alert('as');
		var user_id = $('#user_id').val();
		var quiz_id = $('#quiz_id').val();
		var user_email = $('#user_email').val();
		var ans_Array = answers;
		var cor_Array = correct;
		$("#loading").show();
		var data = "&ans="+ans_Array+"&cor="+cor_Array+"&user_id="+user_id+"&quiz_id="+quiz_id+"&user_email="+user_email;
		var url = "#";
		$.ajax({
			dataType : 'html',
			type: 'POST',
			url : url,
			cache: false,
			data : data,
			complete : function() {  },
			success: function(data) 
					{
						$("#loading").hide();
						var result = $(data).find('#teee');
						$("#thanks").hide();
						$("#heading_eexam").hide();
						$('#lks').html(result);
					}
		});
		
	});
});	
</script>

			<div class='alert alert-info' id="heading_eexam">
				<h2>
					<?php 
					$list_q = "select * from eexamhall_question where `quiz_id`='$quiz_id'";
					$list_q = $wpdb->get_results($list_q);
					?>
					<center> Take Quiz</center>
					</h2>                    
    		</div>
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

				<div class="row-fluid">
								
				<div class="span12" >

				<ul id="part">

				<?php 
										
				$i = 1; 
				if($list_q){
				foreach($list_q as $list_q)
				{
					echo "<li id='div$i' style='display:none;'>
					<p style='font-size:20px;'><strong>Question $i </strong>: $list_q->question </p>
					<br/><div style='margin-left:60px;font-size:14px;'>
					<input type='radio' name='op1$i' id='op1$i' value='1' >$list_q->op1<br/><br/>
					<input type='radio' name='op1$i' id='op2$i' value='2' >$list_q->op2<br/><br/>
					<input type='radio' name='op1$i' id='op3$i' value='3' >$list_q->op3<br/><br/>
					<input type='radio' name='op1$i' id='op4$i' value='4' >$list_q->op4<br/><br/>
					<input type='hidden' id='correct$i' value='$list_q->correct_ans' name='correct$i'>
					</li>";
					$i++;
				}
				}
				else
				{
					echo "<div class='alert alert-error'>Sorry !! No Question Added to the Quiz .... Ask Admin to add questions</div>";
				}
				?>
				</ul>
				
				<input type='hidden' name='quiz_id' id='quiz_id' value='<?php echo $quizid;?>'>

				<div class="span6">
				<button id="next" class="btn btn-info btn-large" style="float:right;">Next &rarr; </button>
				</div>
				</div>
				<div class="span12" id='timeover' style='display:none'>
				<div class="alert alert-error">
				<center> Time Over ..... </center>
				</div>
				</div>
				<div class="span12" id="thanks" style="display:none;">
				<div class="alert alert-info">
				<center>Thank you for taking Quiz. To get result, please click on the GET RESULT button below<br/>
				<br/>
				Enter Your name Here : <input type='text' name='user_id' id='user_id' value=''><br/>
				Enter Your Email Here : <input type='text' name='user_email' id='user_email' value=''><br/>
				<button class="btn btn-danger btn-large" id="getresult">GET RESULT</button></center>
				</div>
				<div class="span12" id="loading" style="display:none;">
				<center>
				Please Wait while we are generating your result ... <br/><br/>
				<img src="<?php echo plugins_url('/images/009.gif', __FILE__); ?>" alt=""></center>
				</div>


				</div>
				</div>
</div>
<div class="span12" style="">
<div id="lks">
</div>
</div>
<?php 
if(isset($_POST['ans']))
{
		$correct_ans = $_POST['cor'];
		$give_ans = $_POST['ans'];
		
		$user_id = $_POST['user_id'];
		$useremail = $_POST['user_email'];
		$quiz_id = $_POST['quiz_id'];
		$correct_ans = explode(",",$correct_ans);
		$give_ans = explode(",",$give_ans);
		$count = count($give_ans);
		$countt = count($correct_ans);
		$new = array();
		for($i=0;$i<count($give_ans);$i++)
		{
			if($give_ans[$i] == '')
				$new[$i] = '0';
			else
				$new[$i] = $give_ans[$i];
		}
		//print_r($new);
		$new1 = $new;
		$result_ans = array();
		$count = count($new);
		for ($i = 0; $i < $count; $i++) {
			if ($new[$i] == 0) {
				$zero_ans[$i] = $new[$i];
				unset($new[$i]);
			} else if ($new[$i] == $correct_ans[$i]) {
				$result_ans[$i] = $new[$i];
				unset($new[$i]);
			}
		}
    if(isset($zero_ans))
	{
		$no_ans = count($zero_ans);
	}
	else
		$no_ans = 0;
	if(isset($result_ans))
		$correct_ansq = count($result_ans);
	else
		$correct_ansq = 0;
		?>
		<div id="teee">
			<div class="alert alert-success" >
		<center><h3>Question wise Summery of the test</h3></center>
		</div>
		<table class="responsive table table-striped table-bordered table-condensed" style="border-top:1px solid gray">
		<tr>
		<th>Question No</th>
		<?php 
		$i = 1; 
		for($i=1;$i<=$count;$i++)
		{
			echo "<td>$i</td>";
		}
		?>
		</tr>
		<tr>
		<th>Given ANS</th>
		<?php 
		foreach($give_ans as $give_ans)
		{
			if($give_ans == '')
				$give_ans = "0";
			echo "<td>$give_ans</td>";
		}
		?>
		</tr>
		</tr>
		<tr>
		<th>Correct ANS</th>
		<?php 
		foreach($correct_ans as $correct_ans)
		{
			if($correct_ans == '')
				$correct_ans = 0;
			echo "<td>$correct_ans</td>";
		}
		?>
		</tr>
		</table>
		<?php 	
		$wrong = $countt-($no_ans + $correct_ansq); 
		$result = $correct_ansq*100/$countt;
		$result = round($result,2);
		?>
		<div class="alert alert-success">
		<center><h3>Marksheet for the Quiz</h3></center>
		</div>
		<table class="responsive table table-striped table-bordered table-condensed" style="border-top:1px solid gray">
		<tr>
		<th>Name of Candidate</th><td><?php echo $user_id;?></td><th>Email id </th><td><?php echo $useremail;?></td></tr>
		<tr><td colspan="4" class="alert alert-info"><center><strong>Result</strong><center></td></tr>
		<tr><th>Total Question</th><td colspan="3"><?php echo $countt; ?></td></tr>
		<tr><th>Correct Ans</th><td colspan="3"><?php echo $correct_ansq; ?></td></tr>
		<tr><th>Answers Not Given</th><td colspan="3"><?php echo $no_ans; ?></td></tr>
		<tr><th>Wrong Ans</th><td colspan="3"><?php echo $wrong; ?></td></tr>
		<tr><th>Percentage </th><td colspan="3"><?php echo $result." %"; ?></td></tr>
		<tr><th>Result</th>
		<?php if($result < 40)
		{
		?>
		<td class="alert alert-error" colspan="3"> Fail</td>
		<?php
		}else
		{
		?>
		<td class="alert alert-success" colspan="3">Pass</td>
		<?php
		}
		?>
		</tr>
		</table>
		</div>
		<?php
		$insert_Query_re = "insert into `eexamhall_result`(`id`,`quiz_id`,`name`,`correct`,`wrong`,`zero`,`percentage`) values('','quiz_id','$user_id','$correct_ansq','$wrong','$no_ans','$result')";
		$wpdb->query($insert_Query_re);
}
?>