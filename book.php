<?php 

include('constants/navbar.php');
include('constants/login-check.php');
 
 ?>

 <?php 

    //check whether vehicle id is set or not
    if(isset($_GET['vehicle_id']))
    {
        //get the vehicle id and details of the selected vehicle
        $vehicle_id = $_GET['vehicle_id'];

        //get the details of the Selected vehicle
        $sql = "SELECT * FROM tbl_car WHERE id=$vehicle_id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //count the rows
        $count = mysqli_num_rows($res);

        //check whether the data is available or not
        if($count==1)
        {
            //we have data
            //get the data from databse
            $row = mysqli_fetch_assoc($res);

            //get all the details
            $tittle = $row['tittle'];
            $details = $row['details'];
            $image_name = $row['image_name'];

        }
        else
        {
            //we do not have data
            //redirect to service page
            header('location:'.SITEURL.'services.php');
        }
    }
    else
    {
        //redirect to services page
        header('location:'.SITEURL.'services.php');
    }


 ?>

<!-- Book Section Starts Here -->
    <section class="book-search wrapper">
    	<div class="wrapper">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your booking.</h2>

            <form action="" method="POST" class="booking">
                <fieldset>
                    <legend>Selected Car</legend>

                    <div class="taxi-menu-img">
                        <?php 

                            //check whether image is available or not
                            if($image_name=="")
                            {
                                //image not available
                                echo "<div class='error'>Image Not Available.</div>";
                            }
                            else
                            {
                                //image available
                                ?>

                                   <img src="<?php echo SITEURL; ?>images/cars/<?php echo $image_name; ?>" alt="taxi" class="img-responsive img-curve"> 

                                <?php
                            }


                        ?>
                        
                    </div>
    
                    <div class="taxi-menu-desc">
                        <h3><?php echo $tittle; ?></h3>
                            <input type="hidden" name="car" value="<?php echo $tittle; ?>">

                        <p class="taxi-detail"><?php echo $details; ?></p>

                        <div class="taxi-label">Passengers</div>
                        <input type="number" name="passengers" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Your Details</legend>
                    <div class="taxi-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Jane Doe" class="input-responsive" required>

                    <div class="taxi-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. +254712345678" class="input-responsive" required>

                    <div class="taxi-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@gme.gmail.com" class="input-responsive" required>

                    <div class="taxi-label">Pick up</div>
                    <input type="text" name="pickup" placeholder="E.g. Langas / JKIA" class="input-responsive" required>

                    <div class="taxi-label">Destination</div>
                    <input type="text" name="destination" placeholder="E.g. Kimumu" class="input-responsive" required>

                    <br><br>
                    <input type="submit" name="submit" value="Confirm Booking" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 

                //check whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //get all the details
                    $car = $_POST['car'];
                    $customer_name = $_POST['full-name'];
                    $contact = $_POST['contact'];
                    $email = $_POST['email'];
                    $passengers = $_POST['passengers'];
                    $pickup = $_POST['pickup'];
                    $destination = $_POST['destination'];
                    $book_date = date("Y-m-d h:i:sa"); //booking date
                    $total = $passengers * 15; //total = passengers * constant amount of 5o
                    $status = "Booked"; //Booked, Travelling, T.Completed, Cancelled

                    
                    
                    
                    
                    


                    //save the booking in database
                    //create sql to save the data
                    $sql2 = "INSERT INTO tbl_book SET 
                      car = '$car',
                      customer_name = '$customer_name',
                      contact = '$contact',
                      email = '$email',
                      passengers = $passengers,
                      pickup = '$pickup',
                      destination ='$destination',
                      book_date = '$book_date',
                      total = '$total',
                      status = '$status'
                      
                      

                    ";

                    //echo $sql2; die();

                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //check whether query is executed successfully or not
                    if($res2=true)
                    {
                        //Query Executed and Booking saved in database
                        $_SESSION['book'] = "<div class='success text-center'>Booking Completed Successfully. Please Wait for 3 Minutes as we Connect you with our Driver. Thank You, and enjoy your ride!!</div>";
                        header('location:'.SITEURL.'services.php');
                    }
                    else
                    {
                        //failed to save booking
                        $_SESSION['book'] = "<div class='error text-center'>Failed to Complete Booking. Try Again!!</div>";
                        header('location:'.SITEURL.'services.php');
                    }

                }

            ?>



        </div>
        </div>
    </section>
    <!-- book Section Ends Here -->


<?php include('constants/footer.php'); ?>