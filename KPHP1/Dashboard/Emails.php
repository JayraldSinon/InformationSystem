<?php
require('top.inc.php');
isAdmin();
if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from email where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}	



$sql="select * from emails";
$res=mysqli_query($con,$sql);
?>

<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Emails </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table">
						 <thead>
							<tr>
							   <th width="2%">ID</th>
							   <th width="20%">NAME</th>
							   <th width="20%">EMAIL</th>
							   <th width="10%">SUBJECT</th>
							   <th width="20%">MESSAGE</th>
							   <th width="20%">OPTION</th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td><?php echo $row['ID']?></td>
							   <td><?php echo $row['Name']?></td>
							   <td><?php echo $row['Email']?></td>
							   <td><?php echo $row['Subject']?></td>
							   <td><?php echo $row['Message']?></td>
							  
							   <td>

								<?php
								echo "<span class='badge badge-edit'><a href=Semail.php?&id=".$row['ID'].">Reply</a></span>&nbsp;";
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['ID']."'>Delete</a></span>";		
								?>
							   </td>
							</tr>
							<?php } ?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.inc.php');
?>