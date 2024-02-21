<?php
require('top.inc.php');
isAdmin();

$id=$_GET['id'];

$sql="select Email from emails where id=$id";
$res=mysqli_query($con,$sql);
?>

<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Send Email</h4>
				</div>
				<div class="col-xl-12">
				<div class="col-xl-12">
					<?php
					if($id == '0') {?>
						<form method="get" action="Email/send.php">
			            Email To :<br>
			            <input type="text" name="email" placeholder="Email" class="form-control" required>
			            Subject :<br>
			            <input type="text" name="subject" class="form-control" placeholder="Subject" required>
			            Body :<br>
			            <textarea name="body" class="form-control" placeholder="Message" required></textarea><br>
			            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info ">
						Send
						</button>     
			         </form>
			         <?php
					}else{
					while($row=mysqli_fetch_assoc($res)){?>
					<form method="get" action="Email/send.php">
			            Email To :<br>
			            <input type="text" name="email" value="<?php echo strtolower($row['Email'])?>" class="form-control">
			            Subject :<br>
			            <input type="text" name="subject" class="form-control">
			            Body :<br>
			            <textarea name="body" class="form-control"></textarea><br>
			      
			            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info ">
						Send
						</button>     
			         </form>
			         <?php }} ?>
			         </div>
			        <div class="row" style="padding: 10px">
			        	
			        </div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.inc.php');
?>