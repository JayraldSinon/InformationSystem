<?php
require('top.inc.php');
isAdmin();

$roleMap = array(
    '1' => 'Admin',
    '2' => 'Officer',
	'3' => 'Sub-Admin'
	
	
);

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update admin_users set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from admin_users where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}	

$sql="select * from admin_users where role>=1 order by id desc";
$res=mysqli_query($con,$sql);
?>

<style type="text/css">
		..button-wrapper {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin-bottom: 10px;
}

.button-wrapper a {
    flex-grow: 1;
    text-align: center;
    white-space: nowrap;
}

hr.thin {
    margin: 5px 0;
    height: 1px;
    background-color: #ffff;
    border: none;
}

	</style>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">ADMIN MANAGEMENT </h4>
				   
        <button type="button" class="btn btn-success" style="float: right;"><i class="fa-solid fa-user-plus"></i><a style="text-decoration: none; color: white" href="AdminCTRL.php">&nbspADD ACCOUNT</a></button>

				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">Role</th>
							   <th width="20%">Username</th>
							   <th width="20%">Password</th>
							   <th width="20%">Email</th>
							   <th width="10%">Mobile</th>
							   <th width="20%"></th>
							</tr>
						 </thead>	
						 <tbody>
							<?php 
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
								<td class="serial"><?php echo $roleMap[$row['role']] ?></td>
							    <td><?php echo $row['username']?></td>
							    <td><?php echo $row['password']?></td>
							    <td><?php echo $row['email']?></td>
							    <td><?php echo $row['mobile']?></td>
							 
							   <td>
							   	<center>
								<?php
								echo "<span class='badge badge-edit'><a href='AdminCTRL.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a href='?type=delete&id=" . $row['id'] . "'>Delete</a></span>&nbsp;";
								
								?>
								</center>
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