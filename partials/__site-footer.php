<?php

use App\Services\Helpers;

?>
<footer class="text-center text-lg-start bg-light">
  
  <section class="">
    <div class="container text-center text-md-start mt-5 pt-4">
     
      <div class="row mt-3">
        
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
       
          <h6 class="text-uppercase fw-bold mb-4 d-flex justify-content-center">
            <?= Helpers::APPLICATION_NAME ?>
          </h6>
          <p class="d-flex justify-content-center">
          Our Earn Daily platform gives you the opportunity to perform simple tasks while you earn from the comfort of your home.
          </p>
        </div>
     

        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          
          <h6 class="text-uppercase fw-bold mb-4 d-flex justify-content-center">
            Useful links
          </h6>
          <p class="d-flex justify-content-center">
            <a href="register" class="text-reset footer-link">Sign Up</a>
          </p>
          <p class="d-flex justify-content-center">
            <a href="login" class="text-reset footer-link">Sign In</a>
          </p>
          <p class="d-flex justify-content-center">
            <a href="how-to-make-payment" class="text-reset footer-link">How to Make Payment</a>
          </p>
          <p class="d-flex justify-content-center">
            <a href="privacy-policy" class="text-reset footer-link">Privacy Policy</a>
          </p>
        </div>


        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 ">
         
          <h6 class="text-uppercase fw-bold mb-4 d-flex justify-content-center">
            Contact our customer care
          </h6>
          <!-- company's email -->
          <p class="d-flex justify-content-center"><i class="bi bi-envelope"></i>  <?= Helpers::APPLICATION_MAIL?></p>
          <p class="d-flex justify-content-center"><i class="bi bi-telephone"></i> +234 909 616 7191</p>
          <p class="d-flex justify-content-center"><i class="bi bi-whatsapp"></i> +234 909 616 7191</p>
        </div>
       
      </div>
     
    </div>
  </section>
 

  <!-- Copyright -->
  <div class="text-center" style="background-color: rgba(0, 0, 0, 0.05);">
      <div class="text-center mt-5">&copy; <?= Date('Y') .' '.Helpers::APPLICATION_NAME ?>. All Rights Reserved.</div>
  </div>
  <!-- Copyright -->
</footer>