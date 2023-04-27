<?php
  $page_title = 'Register for demo';
  require_once('includes/load.php');
  require_once('includes/functions.php');
  $all_slots = find_all('slots');
  $seats_left=null;
  $msg="";
  $fail="";
  
?>
<?php
 if(isset($_POST['register'])){ //register
   $req_fields = array('student_id','first_name','last_name','email_id', 'project_title','slot_id','phone_no' );
   validate_fields($req_fields);

  
   if(empty($errors)){
    $p_student_id  = remove_junk($db->escape($_POST['student_id']));
     $p_first_name  = remove_junk($db->escape($_POST['first_name']));
     $p_last_name  = remove_junk($db->escape($_POST['last_name']));
     $p_email_id   = remove_junk($db->escape($_POST['email_id']));
     $p_project_title   = remove_junk($db->escape($_POST['project_title']));
     $p_slot_id   = remove_junk($db->escape($_POST['slot_id']));
     $p_phone_no  = remove_junk($db->escape($_POST['phone_no']));
    
     $errors=verifyUserDetails($p_student_id,$p_first_name,$p_email_id,$p_phone_no);
     if(count($errors)===0){
      if(find_slot_by_id($p_slot_id)<=0){
        $fail="Please select an available slot";
      }

      else{

      
    
     $query  = "INSERT INTO students (";
     $query .=" id,first_name,last_name,email,project_title,phone_number";
     $query .=") VALUES (";
     $query .=" '{$p_student_id}','{$p_first_name}', '{$p_last_name}', '{$p_email_id}', '{$p_project_title}', '{$p_phone_no}'";
     $query .=");";
   
     update_all_tables($p_student_id,$p_email_id,$p_first_name,$p_last_name,$p_phone_no,$p_project_title,$p_slot_id);
     
     if($db->query($query)){
      $msg= "Registered successfully ";
      // sleep(10);
      // redirect('register.php', false);
     } else {
      $fail='Failed to register';
      //  redirect('register.php', false);
     }

   } 
  }
   else{
    $fail="Please check entered data to be in proper format";
   }

  }
}

     
 

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12 text-success">
    <?php echo $msg; ?>
  </div>
  <div class="col-md-12 text-danger">
    <?php echo $fail; ?>
  </div>
</div>
  
  <div class="col" style="margin-top:100px;">
    
      <div class="panel panel-default">
      <div class="pull-right" style="margin-right:60px;">
           <a href="index.php" class="btn btn-primary">Home</a>
      </div>
        <div class="panel-heading" >
          <strong>
            <span class="text-primary">Book a slot</span>
         </strong>
        </div>
    
        
    
        <div class="panel-body">
         <div class="col-lg-12">
          <form method="post" action="register.php" class="clearfix">
              <div class="form-group">
               
              <div class="input-group">
                  <span class="input-group-addon">
                  </span>
                  <input style="width:40%;" type="number" class="form-control" name="student_id" placeholder="student_id">
              </div>
              <div class="col-md-12 text-danger" style="margin-bottom:10px">
                        <?php if (isset($errors['std_id'])) { ?>
                       <p><?php echo $errors['std_id']; ?></p>
                        <?php } ?>
              </div>
              
                  <div class="col-md-4 pushright">
                    <div class="input-group">
                      <span class="input-group-addon">
                      </span>
                      <input type="text" class="form-control" name="first_name" placeholder="first_name">
                      <span class="input-group-addon"></span>
                      <?php if (isset($errors['name'])) { ?>
                       <p><?php echo $errors['name']; ?></p>
                        <?php } ?>
                   </div>
                   <div class="col-md-12 text-danger" style="margin-bottom:10px">
                        
              </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        
                      </span>
                      <input type="text" class="form-control" name="last_name" placeholder="last_name">
                      
                   </div>
              </div>

              
              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                    
                     </span>
                     <input type="number" class="form-control" name="phone_no" placeholder="Phone number">
                     <?php if (isset($errors['phone'])) { ?>
                       <p><?php echo $errors['phone']; ?></p>
                        <?php } ?>
                  </div>
                 </div>
                 <div class="col-md-12 text-danger" style="margin-bottom:10px">
                        
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4 leftpush">
                    <select class="form-control" name="slot_id">
                      <option value="">Select an available slot</option>
                    <?php  foreach ($all_slots as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php $seats_left=$cat['available_seats'] ?>
                        <?php echo $cat['date'] .' '. $cat['start_time'] . ' - ' . $cat['end_time']  . ' available seats :'.$cat['available_seats']?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       
                      </span>
                      <input type="email" class="form-control" name="email_id" placeholder="Email Id"> 
                      <?php if (isset($errors['email'])) { ?>
                       <p><?php echo $errors['email']; ?></p>
                        <?php } ?>
                   </div>
                 </div>
                 <div class="col-md-12 text-danger" style="margin-bottom:10px">
                        
              </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                       
                      </span>
                      <input type="text" class="form-control" name="project_title" placeholder="Project Title">
                      <span class="input-group-addon"></span>
                   </div>
                  </div>
               </div>

               

              </div>

              
              <button type="submit" name="register" class="btn btn-primary">Register</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
