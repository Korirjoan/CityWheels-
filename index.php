
<?php include('constants/navbar.php'); ?>


        

               <?php 

               if (isset($_SESSION['login'])) 
               {
                  echo $_SESSION['login'];
                  unset($_SESSION['login']);  
               }


                ?>


   	<!--About section starts--->

   	<div class="about2 wrapper">
          <!--<div class="wrapper"><--->
        <div class ="about2w">
            <!-- <h2 class="text-center">CityWheels</h2> --->
             <!--  <p class="about-subtittle  text-center"> --->
             <h1 class="m-size-30 text-center size-50"><span style="display: initial; color:black; text-shadow: rgb(200, 151, 43) 0px 0px 1.9px;" class="m-font-size-30 font-size-50" m-font-size-set="true">Dependable &amp; Budget-friendly taxi services.</span></h1>
                <h1 class ="m-size-30 text-center size-50"><span style="display: initial; color:blue;text-shadow: rgb(100, 51, 40) 0px 0px 1.9px; font-style:sans-serif;" class="m-font-size-20 font-size-30" m-font-size-set="true">Call us now</span></h1>
                  <h2 class ="m-size-30 text-center size-50"><span style="display: initial; color: rgb(255, 255, 255);text-shadow: rgb(200, 151, 43) 0px 0px 1.9px;" class="m-font-size-20 font-size-30" m-font-size-set="true">+254 705 060 300</span></h2>
            <!--</div><--->
        </div>
    </div>

   <div class="clearfix"></div>
   	 
      <h2 class="text-center">Our Services</h2>
      <a href="services.php">
        <div class="col-3 about-box">
            <img src="images/airport.jpg" alt="Car hire" class="img-responsive">
            <div class2="about2-tittle">Airport Pickup</div>
       </div>
      </a>



      <a href="services.php">
       <div class="col-3 about-box">
            <img src="images/salas-camp.jpg" alt="Safari services" class="img-responsive">
            <div class="about2-tittle">Tour services</div>
       </div>
      </a>

      <a href="services.php">
       <div class="col-3 about-box">
            <img src="images/river.jpg" alt="Taxi services" class="img-responsive">
            <div class="about2-tittle">Taxi services</div>
       </div>
      </a>
  </div>
</div>
       
      <div class="clearfix"></div>

   	
            

    <div class="clearfix"></div>
    

    <!--mission and aim section ends-->

   
<?php include('constants/footer.php'); ?>