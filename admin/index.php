<?php include('constants/navbar.php'); ?>
    <!--Content section starts here-->
    <div class="content">
    	<div class="wrapper">
    		<h2>DASHBOARD</h2>

            <br><br>
            <?php 

               if (isset($_SESSION['login1'])) 
               {
                  echo $_SESSION['login1'];
                  unset($_SESSION['login1']);  
               }


            ?>

            <br><br>


            <div class="col-4 text-center">
               <?php 
                  //sql query
                  $sql = "SELECT * FROM tbl_services";
                  //Execute query
                  $res = mysqli_query($conn, $sql);
                  //count rows
                  $count = mysqli_num_rows($res);

               ?>
            	<h2><?php echo $count; ?></h2>
            	<br>
            	Services
            	
            </div>


             <div class="col-4 text-center">

               <?php 
                  //sql query
                  $sql2 = "SELECT * FROM tbl_car";
                  //Execute query
                  $res2 = mysqli_query($conn, $sql2);
                  //count rows
                  $count2 = mysqli_num_rows($res2);

               ?>

            	<h2><?php echo $count2; ?></h2>
            	<br>
            	Vehicles
            	
            </div>


             <div class="col-4 text-center">
               <?php 
                  //sql query
                  $sql3 = "SELECT * FROM tbl_book";
                  //Execute query
                  $res3 = mysqli_query($conn, $sql3);
                  //count rows
                  $count3 = mysqli_num_rows($res3);

               ?>
            	<h2><?php echo $count3 ?></h2>
            	<br>
            	Total Bookings
            	
            </div>


             <div class="col-4 text-center">
               <?php 

                  //create sql query
                  //Aggregate Function in sql
                  $sql4 = "SELECT SUM(total) AS Total FROM tbl_book WHERE status='Alighted'";

                  //Execute the query
                  $res4 = mysqli_query($conn, $sql4);
                  //get the value
                  $row4 = mysqli_fetch_assoc($res4);

                  //get the total earnings
                  $total_earning = $row4['Total'];

               ?>
            	<h2>KSH <?php echo $total_earning; ?></h2>
            	<br>
            	Total Earnings
            	
            </div>

            <div class="clearfix"></div>

    	</div>
    	
    </div>


    <!--Content section ends here-->

    <?php include('constants/footer.php'); ?>
