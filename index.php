<?php
  require_once './app/Services/Helpers.php';
  use App\Services\Helpers;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="icon" href="/images/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <title>Home - Royal Network</title>
</head>
<body>

    <div class="container-fluod">

        <marquee width="100%" scrollamount="5" class="bg-info">
            Do you want us to influence or advertise your brand, business or promote your contents? Contact our Customer Care Rep: +234 703 349 9876
        </marquee>

        <a href="https://wa.me/2347033499876?text=Hi, my name is..." class="float" target="_blank">
          <i class="bi bi-whatsapp my-float"></i>
        </a>

          <nav class="navbar">
            <div class="container">
              <a class="navbar-brand" href="/">
                <img src="images/logo.png" alt="RoyalNet Logo" width="100" height="50">
              </a> 
              <ul class="nav justify-content-end">
                  <li class="nav-item">
                    <a class="nav-link" href="register">Sign Up</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="login">Sign In</a>
                  </li>
              </ul>
            </div>
          </nav>

            <div class="hero">
                <div class="hero-text">
                    <h1>Earn from performing online task</h1>
                    <p>Our Earn Daily platform gives you the opportunity to perform simple tasks while you earn from the comfort of your home.</p>
                    <a href="register"><button type="button" class="btn get-started">Get started</button></a>
                </div>
            </div>

        
        <div class="container">
          <div class="row ">
              <div class="col-lg-6 col-sm-12 col-md-12 pt-4">
                <div class="about ">
                  <span class="sub-head">About</span> <span class="line"></span>  

                <div class="about-heading">What is Royal Network?</div>
                <div class="about-details">Royal Network  is an online Networking, Advert and Affiliate Marketing Center where various individuals earn on a daily basis by performing simple task.
                  We also pay a 50% commission on every referral completed successfully.
                </div>

                <div class="about-heading pt-3">What is it for?</div>
                <div class="about-details">Royal Network is for people(ranging from young and old) who want to scale up their income, people looking for other legitimate sources of income online by simply making money through networking and through affiliate marketingy.
                </div>

                <div class="about-heading pt-3">How Does It Work? </div>
                <div class="about-details">Royal Network is  made up of: Two Platforms and both Platforms solely depend on what the registrant chooses to participate in on our website.
                </div>

                <div class="about-heading pt-3">How To Earn Daily</div>
                <div class="about-details">Royal Network gives you the opportunity to earn daily but first you must choose a package and mode of payment. The package are as follows:
                </div>
                </div>
              </div>

              <div class="col-lg-6 pt-5 d-none d-lg-block">
                <img src="images/about-us.jpg" alt="" class="about-us-image img-fluid" height="100px">
              </div>
          </div>


          <!-- Packages -->
        <div class="pt-5">
          <span class="sub-head">Packages</span> <span class="line"></span>
        </div>

        <div class="row mt-4">

          <div class="col-lg-4 col-sm-12 col-md-6">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3  bg-success">
              <h4 class="my-0 fw-normal text-light">Member</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title"> N3000</h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li><i class="bi bi-check2-circle text-success"></i> Earn N140 every day</li>
                <li><i class="bi bi-check2-circle text-success"></i> Get 50% referral commission</li>
              </ul>
            </div>
          </div>
          </div>

          <div class="col-lg-4 col-sm-12 col-md-6">
            <div class="card mb-4 rounded-3 shadow-sm">
              <div class="card-header py-3 bg-success">
                <h4 class="my-0 fw-normal text-light">Agent</h4>
              </div>
              <div class="card-body">
                <h1 class="card-title pricing-card-title"> N5000</h1>
                <ul class="list-unstyled mt-3 mb-4">
                  <li><i class="bi bi-check2-circle text-success"></i> Earn N240 every day</li>
                  <li><i class="bi bi-check2-circle text-success"></i> Get 50% referral commission</li>
                </ul>
              </div>
            </div>
            </div>

            <div class="col-lg-4 col-sm-12 col-md-6">
              <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3 bg-success">
                  <h4 class="my-0 fw-normal text-light">VIP 1</h4>
                </div>
                <div class="card-body">
                  <h1 class="card-title pricing-card-title"> N10,000</h1>
                  <ul class="list-unstyled mt-3 mb-4">
                    <li><i class="bi bi-check2-circle text-success"></i> Earn N420 every day</li>
                    <li><i class="bi bi-check2-circle text-success"></i> Get 50% referral commission</li>
                  </ul>
                </div>
              </div>
              </div>

              <div class="col-lg-4 col-sm-12 col-md-6">
                <div class="card mb-4 rounded-3 shadow-sm">
                  <div class="card-header py-3  bg-success">
                    <h4 class="my-0 fw-normal text-light">VIP 2</h4>
                  </div>
                  <div class="card-body">
                    <h1 class="card-title pricing-card-title"> N25,000</h1>
                    <ul class="list-unstyled mt-3 mb-4">
                      <li><i class="bi bi-check2-circle text-success"></i> Earn N930 every day</li>
                      <li><i class="bi bi-check2-circle text-success"></i> Get 50% referral commission</li>
                    </ul>
                  </div>
                </div>
                </div>
      
                <div class="col-lg-4 col-sm-12 col-md-6">
                  <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3 bg-success">
                      <h4 class="my-0 fw-normal text-light">VIP 3</h4>
                    </div>
                    <div class="card-body">
                      <h1 class="card-title pricing-card-title"> N60,000</h1>
                      <ul class="list-unstyled mt-3 mb-4">
                        <li><i class="bi bi-check2-circle text-success"></i> Earn N2300 every day</li>
                        <li><i class="bi bi-check2-circle text-success"></i> Get 50% referral commission</li>
                      </ul>
                    </div>
                  </div>
                  </div>
      
                  <div class="col-lg-4 col-sm-12 col-md-6">
                    <div class="card mb-4 rounded-3 shadow-sm">
                      <div class="card-header py-3 bg-success">
                        <h4 class="my-0 fw-normal text-light">Deputy Manager</h4>
                      </div>
                      <div class="card-body">
                        <h1 class="card-title pricing-card-title"> N150,000</h1>
                        <ul class="list-unstyled mt-3 mb-4">
                          <li><i class="bi bi-check2-circle text-success"></i> Earn N5800 every day</li>
                          <li><i class="bi bi-check2-circle text-success"></i> Get 50% referral commission</li>
                        </ul>
                      </div>
                    </div>
                    </div>

                    <div class="col-lg-4 col-sm-12 col-md-6">
                      <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3 bg-success">
                          <h4 class="my-0 fw-normal text-light">Manager </h4>
                        </div>
                        <div class="card-body">
                          <h1 class="card-title pricing-card-title"> N250,000</h1>
                          <ul class="list-unstyled mt-3 mb-4">
                            <li><i class="bi bi-check2-circle text-success"></i> Earn N9600 every day</li>
                            <li><i class="bi bi-check2-circle text-success"></i> Get 50% referral commission</li>
                          </ul>
                        </div>
                      </div>
                      </div>
          
                      <div class="col-lg-4 col-sm-12 col-md-6">
                        <div class="card mb-4 rounded-3 shadow-sm">
                          <div class="card-header py-3 bg-success">
                            <h4 class="my-0 fw-normal text-light">Assistant Director</h4>
                          </div>
                          <div class="card-body">
                            <h1 class="card-title pricing-card-title"> N500,000</h1>
                            <ul class="list-unstyled mt-3 mb-4">
                              <li><i class="bi bi-check2-circle text-success"></i> Earn N20000 every day</li>
                              <li><i class="bi bi-check2-circle text-success"></i> Get 50% referral commission</li>
                            </ul>
                          </div>
                        </div>
                        </div>
                      
                        <div class="col-lg-4 col-sm-12 col-md-6">
                          <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-header py-3 bg-success">
                              <h4 class="my-0 fw-normal text-light">Director  </h4>
                            </div>
                            <div class="card-body">
                              <h1 class="card-title pricing-card-title"> N1,000,000</h1>
                              <ul class="list-unstyled mt-3 mb-4">
                                <li><i class="bi bi-check2-circle text-success"></i> Earn N40,500 every day</li>
                                <li><i class="bi bi-check2-circle text-success"></i> Get 50% referral commission</li>
                              </ul>
                            </div>
                          </div>
                          </div>

                            <div class="col-lg-4 col-sm-12 col-md-6">
                              <div class="card mb-4 rounded-3 shadow-sm">
                                <div class="card-header py-3 bg-success">
                                  <h4 class="my-0 fw-normal text-light">Shareholder  </h4>
                                </div>
                                <div class="card-body">
                                  <h1 class="card-title pricing-card-title"> N2,000,000</h1>
                                  <ul class="list-unstyled mt-3 mb-4">
                                    <li><i class="bi bi-check2-circle text-success"></i> Earn N83000 every day</li>
                                    <li><i class="bi bi-check2-circle text-success"></i> Get 50% referral commission</li>
                                  </ul>
                                </div>
                              </div>
                              </div>
                  

      </div>

    </div>
  
        


        <!-- Footer -->
<footer class="text-center text-lg-start bg-light">
  
  <section class="">
    <div class="container text-center text-md-start mt-5 pt-4">
     
      <div class="row mt-3">
        
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
       
          <h6 class="text-uppercase fw-bold mb-4 d-flex justify-content-center">
            Royal Network
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
        </div>


        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 ">
         
          <h6 class="text-uppercase fw-bold mb-4 d-flex justify-content-center">
            Contact out customer care
          </h6>
          <!-- company's email -->
          <p class="d-flex justify-content-center"><i class="bi bi-envelope"></i>  <?= Helpers::APPLICATION_MAIL?></p>
          <p class="d-flex justify-content-center"><i class="bi bi-telephone"></i> +234 703 349 9876</p>
          <p class="d-flex justify-content-center"><i class="bi bi-whatsapp"></i> +234 703 349 9876</p>
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

   </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>