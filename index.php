<?php
  $page_title = 'Student Demo Registration';
  require_once('includes/load.php');
  
  $regStudents = join_slots_table();
  // $msg='Hii'
  
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12" style="margin-top:100px;">
       <!-- <?php echo display_msg($msg); ?> -->
     </div>
     
     <div>
         <h1 class="text-center text-primary">Student Demo Registration</h1>
     
     </div>
    <div class="col-md-12">
      <div>
      
      </div>
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <div>
                <h3 class="listOfStudents text-info text-center">Regestered Students list</h3>
            </div>
         <div class="pull-right">
           <a href="register.php" class="btn btn-primary">Book a Slot</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th  style="width: 10%;"> Index </th>
                <th  style="width: 10%;"> Student ID </th>
                <th  style="width: 10%;"> First Name </th>
                <th  style="width: 10%;"> Last Name </th>
                <th  style="width: 20%;"> Emai ID </th>
                <th  style="width: 10%;"> Project Title</th>
                <th  style="width: 10%;"> Phone no. </th>
                <th  style="width: 10%;"> Slot date </th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($regStudents as $regStudent):
                ?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td class="text-center"> <?php echo remove_junk($regStudent['id']); ?></td>
                <td class="text-center"> <?php echo remove_junk($regStudent['first_name']); ?></td>
                <td class="text-center" > <?php echo remove_junk($regStudent['last_name']);?></td>
                <td class="text-center"> <?php echo remove_junk($regStudent['email']); ?></td>
                <td class="text-center"> <?php echo remove_junk($regStudent['project_title']); ?></td>
                <td class="text-center"> <?php echo remove_junk($regStudent['phone_number']); ?></td>
                <td class="text-center"> <?php echo remove_junk($regStudent['date']) . ' ' . $regStudent['start_time'] . ' - ' . $regStudent['end_time'] ;
                ; ?></td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
