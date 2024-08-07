<?php include('constants/navbar.php'); ?>

<?php 

    //check whether id is passed or not
    if(isset($_GET['category_id']))
    {
        //category id is set and get the id
        $category_id = $_GET['category_id'];
        //get the category tittle based on category id
        $sql = "SELECT tittle FROM tbl_services WHERE id=$category_id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //get the value from database
        $row = mysqli_fetch_assoc($res);

        //get the title
        $category_tittle = $row['tittle'];

    }
    else
    {
        //category not passed
        //redirect to service page
        header('location:'.SITEURL.'services.php');
    }

?>

<!-- vehicle sEARCH Section Starts Here -->
    <section class="taxi-search text-center">
        <div class="container">
            
            
            <h2>Vehicles on <a href="#" class="text-white">"<?php echo $category_tittle; ?>"</a></h2>

        </div>

    </section>
    <!-- vehicle sEARCH Section Ends Here -->
    <br><br>



    <!-- vehicle MEnu Section Starts Here -->
    <section class="taxi-menu wrapper">
        <div class="container">
            <h2 class="text-center">Vehicles</h2>

            <?php 

               //create sql query to get vehicles based on selected category
               $sql2 = "SELECT * FROM tbl_car WHERE category_id=$category_id";

               //execute the query
               $res2 = mysqli_query($conn, $sql2);


               //count the rows
               $count2 = mysqli_num_rows($res2);

               //check whether vehicle is available or not
               if($count2>0)
               {
                //vehicle is available
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id = $row2['id'];
                    $tittle =$row2['tittle'];
                    $passengers =$row2['passengers'];
                    $details =$row2['details'];
                    $image_name =$row2['image_name'];

                    ?>

                       <div class="taxi-menu-box">
                            <div class="taxi-menu-img">
                                <?php 

                                  if($image_name=="")
                                  {
                                    //image not available
                                    echo "<div class='error'>Image Not Available.</div>";
                                  }
                                  else
                                  {
                                    //image available
                                    ?>

                                      <img src="<?php echo SITEURL; ?>images/cars/<?php echo $image_name; ?>" alt="Taxi Image" class="img-responsive img-curve">   

                                    <?php 
                                  }

                                ?>
                                
                            </div>

                            <div class="taxi-menu-desc">
                                <h4><?php echo $tittle; ?></h4>
                                <p class="taxi-passengers">Max. Passengers <?php echo $passengers; ?></p>
                                <p class="taxi-detail">
                                    <?php echo $details; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>book.php?vehicle_id=<?php echo $id; ?>" class="btn btn-primary">Book Now</a>
                            </div>
                        </div> 

                    <?php
                }
               }
               else
               {
                //vehicle is not available
                echo "<div class='error'>Vehicle Not Available.</div>";
               }


            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php include('constants/footer.php'); ?>
