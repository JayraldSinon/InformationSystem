<?php
require('top.inc.php');
isAdmin();
$username='';
$password='';
$email='';
$mobile='';
$role='';

$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from admin_users where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$username=$row['username'];
		$email=$row['email'];
		$mobile=$row['mobile'];
		$password=$row['password'];
	}else{
		header('location:Admin.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$username=get_safe_value($con,$_POST['username']);
	$email=get_safe_value($con,$_POST['email']);
	$mobile=get_safe_value($con,$_POST['mobile']);
	$password=get_safe_value($con,$_POST['password']);
	$role=get_safe_value($con,$_POST['Role']);
	
	$res=mysqli_query($con,"select * from admin_users where username='$username'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Username already exist";
			}
		}else{
			$msg="Username already exist";
		}
	}
	
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$update_sql="update admin_users set username='$username',password='$password',email='$email',mobile='$mobile' where id='$id'";
			mysqli_query($con,$update_sql);
		}else{
			mysqli_query($con,"insert into admin_users(username,password,email,mobile,role,status) values('$username','$password','$email','$mobile','$role',1)");
		}
		echo '<script language="javascript">';
    	echo 'window.location.replace("Admin.php");';	
    	echo '</script>';
		
	}
}
?>
<div class="content pb-0">
		<a href="Admin.php" class="btn btn-secondary">
      		<i class="fa fa-arrow-left"></i> Back to Admin Page
   		</a>
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>ADMIN MANAGEMENT FORM</strong><small> </small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   
								
								<div class="form-group">
									<label for="username" class=" form-control-label">Username</label>
									<input type="text" name="username" placeholder="Enter username" class="form-control" required value="<?php echo $username?>">
								</div>
								
								<div class="form-group">
									<label for="password" class=" form-control-label">Password</label>
									<input type="text" name="password" placeholder="Enter password" class="form-control" required value="<?php echo $password?>">
								</div>
								
									<div class="form-group">
									<label for="password" class=" form-control-label">Role</label>
									<select class='form-control' name='Role'>
									<option value="1">Admin</option>
									<option value="2">Officer</option>
									<option value="3">Sub-Admin</option>
									
									
									</select>
								</div>
								
								<div class="form-group">
									<label for="password" class=" form-control-label">Email</label>
									<input type="email" name="email" placeholder="Enter email" class="form-control" required value="<?php echo $email?>">
								</div>
								<div class="form-group">
									<label for="mobile" class=" form-control-label">Mobile</label>
									
								<input name="somename"
									oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
									type = "number"
									maxlength = "11"
									class="form-control"
								/>
								</div>
								
								
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">SUBMIT</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
		 
		 
         <script>        
           function phoneno(){          
            $('#phone').keypress(function(e) {
                var a = [];
                var k = e.which;

                for (i = 48; i < 58; i++)
                    a.push(i);

                if (!(a.indexOf(k)>=0))
                    e.preventDefault();
            });
        }
       </script>
<?php
require('footer.inc.php');
?>