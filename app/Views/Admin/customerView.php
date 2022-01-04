<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
    
    <!-- End Carousal -->
    <!-- JS -->
   
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="../public/assets/js/header.js"></script>
<script type="text/javascript" src="../public/assets/js/weather.js"></script>
<script type="text/javascript" src="../public/assets/js/lightslider.js"></script>
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <link type="text/css" rel="stylesheet" href="../public/assets/css/lightslider.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
        <div class="container cust-border bg-white">
            <a class="navbar-brand">
                <img src="../public/assets/images/logofah.png" alt="" width="100" height="85" class="d-inline-block align-text-top img-fluid">   
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link h4" href="index">Customers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link h4" href="vendor">Vendors</a>
                </li>
            </ul>
            <div class="pt-3 d-flex flex-column align-items-center">
                <button type="button" class="btn custbtn" style=""><a href="<?= base_url('FAH/Login/logout');?>" style="color:white;">Logout</a></button>
                <p>Admin Name</p>
            </div>
            
        </div>
</div>
</nav>

<div class="container mt-1">
  <div class="row">
    <div class=" col-lg-3 col-md-12 text-center bg-white cust-right-border p-3">
      <p class="size-s">Hi Cameron Boettcherf <br> Here's a look at</p>
<p>11818 | St<br>Omaha, NE 68137</p>
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMG1kJqJloPRmIoM5YaYjc2grrrw_PjkRTLQ&usqp=CAU" alt="" width="100" height="100" class="image-round">   
<div class="d-flex increased-width reduce-width size-s"><div>Cost:</div><div>$100,000</div></div>
<div class="d-flex increased-width reduce-width size-s"><div>Cost:</div><div>$100,000</div></div>
<div class="d-flex increased-width reduce-width size-s"><div>Cost:</div><div>$100,000</div></div>
<hr class="m-1">
<p class="size-s mb-1">Job Remaining Balance</p>
<h3>$250,000.00</h3><br>
<a href="#" class="btn btn-success float-none size-s text-decoration-none">Make A Payment</a>
    </div>



    <div class="col-lg-6 col-md-12 bg-white ml-2 cust-right-border text-center p-3">
        <img id="img-high" src="../public/assets/images/1.jpeg" alt="Image 1" class="img-fluid w-100 h-50">
        <div class="mt-2 container">
            
<!-- Start Carousal -->

<!--https://bootsnipp.com/snippets/zDQkr-->
<div class="mt-3 p-0">
<ul id="light-slider" class="image-fluid">
    <li>
    <img src="../public/assets/images/1.jpeg" alt="Image 1" class="img-not-high img-fluid" name="carousel-img" onclick="givehigh(0)">
    </li>
    <li>
    <img src="../public/assets/images/2.jpeg" alt="Image 1" class="img-not-high img-fluid" name="carousel-img" onclick="givehigh(1)">
    </li>
    <li>
    <img src="../public/assets/images/3.jpeg" alt="Image 1" class="img-not-high img-fluid" name="carousel-img" onclick="givehigh(2)">
    </li>
    <li>
    <img src="../public/assets/images/1.jpeg" alt="Image 1" class="img-not-high img-fluid" name="carousel-img" onclick="givehigh(3)">
    </li>
    <li>
    <img src="../public/assets/images/1.jpeg" alt="Image 1" class="img-not-high img-fluid" name="carousel-img" onclick="givehigh(4)">
    </li>
    <li>
    <img src="../public/assets/images/2.jpeg" alt="Image 1" class="img-not-high img-fluid" name="carousel-img" onclick="givehigh(5)">
    </li>
    <li>
    <img src="../public/assets/images/3.jpeg" alt="Image 1" class="img-not-high img-fluid" name="carousel-img" onclick="givehigh(6)">
    </li>
    <li>
    <img src="../public/assets/images/1.jpeg" alt="Image 1" class="img-not-high img-fluid" name="carousel-img" onclick="givehigh(7)">
    </li>
</ul>
</div>
    


<!-- End Carousal -->

        
        </div>
    </div>




    <div class="col-lg-3 col-md-12 bg-white ml-2 p-3">
      <p>What's Happening</p>
      <div class="d-flex justify-content-between size-s cust-bottom-border"><div>To-do's:</div><div class="bg-danger text-white third-col-items">1</div></div>
      <div class="d-flex justify-content-between size-s cust-bottom-border"><div>Unread Documents:</div><div class="bg-danger text-white third-col-items">7</div></div>
      <div class="d-flex justify-content-between size-s cust-bottom-border"><div>Messages:</div><div class="bg-danger text-white third-col-items">1</div></div>
      <div class="d-flex justify-content-between size-s cust-bottom-border"><div>Pending Change Orders:</div><div class="bg-danger text-white third-col-items">1</div></div>
      <div class="d-flex justify-content-between size-s cust-bottom-border"><div>Upcoming Selections:</div><div class="bg-danger text-white third-col-items">1</div></div>
      <div class="d-flex justify-content-between size-s cust-bottom-border"><div>Warranty items:</div><div class="bg-danger text-white third-col-items">1</div></div>
      <div class="d-flex justify-content-between size-s cust-bottom-border"><div>Surveys:</div><div class="bg-danger text-white third-col-items">1</div></div>
      <div class="d-flex justify-content-between size-s cust-bottom-border"><div>Invoices:</div><div class="bg-danger text-white third-col-items">1</div></div>
      <div class="d-flex justify-content-between size-s cust-bottom-border"><div>Recent Daily Logs:</div><div class="bg-danger text-white third-col-items">1</div></div>
      
      <p class="mt-2">Weather</p>
      <div class="justify-content-between d-flex size-s">
        <div>Omaha, NE 68137</div>
        <div>
        <!-- <span><#?= $currentdate ?></span> -->
    </div>
    </div>
    <table class="table size-s mt-2">
        <thead class="table-dark">
            <tr>
                <th scope="col" colspan="2">
                <span class="d-inline size-m">Current Condition : </span>
                <!-- <span><#?=$cweather?></span> -->
                </th>
            </tr>
        </thead>
        <tbody style="background-color : #cbd0d38f;">
            <tr>
                <td>
                <div class="align-middle"><img name="wicon" src="<#?=$atum[0]?>" alt="icon"/><h3 class="d-inline">
                    <!-- <span><#?= $currenttemp ?></span> -->
                    <sup>o</sup>C</h3></div>
                </td>
                <td>
                <p class="text-end">
                Feels like: <sup>o</sup>C<br>
                <!-- <span><#?=$feeltemp?></span> -->
                Winds:  kmh
                <!-- <span><#?=$wind?></span> -->
                </p>
                </td>
            <tr>  
        </tbody>  
    </table>
    
    <table class="table table-bordered size-s mt-2">
        <thead>
            <tr>
                <th scope="col" colspan="2">
                <span class="d-inline size-m">Your Extended Forecast</span>
                </th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php $i=1; for($k=0;$k<2;$k++){ ?>
            <tr>
                <?php for($l=0;$l<2;$l++){ ?>
                <td>
                    <div class="size-s text-center">
                        <!-- <span><#?=$date[$i]?></span> -->
                </div>
                    <div class="d-flex justify-content-center"><div class="d-flex align-items-center"><img name="wicon" src="<#?=$atum[$i]?>" alt="icon"/></div><div class="d-flex flex-column"><h4 class="d-inline">
                        <!-- <span><#?=$maxtemp[$i]?></span> -->
                        <sup>o</sup></h4>
                    <h4 class="fw-lighter">
                        <!-- <span><#?=$mintemp[$i]?></span> -->
                        <sup>o</sup></h4></div>
                    </div>
                </td>
                <?php $i++; } ?>
            </tr>
            <?php } $i=0; ?>
        </tbody>  
    </table>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $("#light-slider").lightSlider({
            item: 4,
            autoWidth: false,
            slideMove: 1, // slidemove will be 1 if loop is true
            slideMargin: 10,

            addClass: '',
            mode: "slide",
            useCSS: true,
            cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
            easing: 'linear', //'for jquery animation',////

            speed: 400, //ms'
            auto: false,
            pauseOnHover: false,
            loop: false,
            slideEndAnimation: true,
            pause: 2000,

            keyPress: false,
            controls: true,
            prevHtml: '',
            nextHtml: '',

            rtl:false,
            adaptiveHeight:false,

            vertical:false,
            verticalHeight:500,
            vThumbWidth:100,

            thumbItem:10,
            pager: true,
            gallery: false,
            galleryMargin: 5,
            thumbMargin: 5,
            currentPagerPosition: 'middle',

            enableTouch:true,
            enableDrag:true,
            freeMove:true,
            swipeThreshold: 40,

            responsive : [],

            onBeforeStart: function (el) {},
            onSliderLoad: function (el) {},
            onBeforeSlide: function (el) {},
            onAfterSlide: function (el) {},
            onBeforeNextSlide: function (el) {},
            onBeforePrevSlide: function (el) {}
        });
    });

</script>

<div class="container mt-3">
  <div class="row">
    <!-- <div class=" col-lg-3 col-md-12 p-2 text-center bg-white cust-right-border p-3">
      
    </div> -->

    <div class="col-lg-8 col-md-12 bg-white ml-2 cust-right-border text-center p-3">
        
    </div>

<div class="col-lg-4 col-md-12 bg-white ml-2 p-3">

<div class="row bootstrap snippets bootdeys">
    <div class="comment-wrapper">
        <div class="card">
            <div class="card-header">
                Comment panel
            </div>

            <?php if(session()->getTempdata('errorcomment')): ?>
            <div class="alert alert-danger"> <?= session()->getTempdata('errorcomment'); ?> </div>
            <?php endif; ?>

            <?php if(session()->getTempdata('successcomment')): ?>
            <div class="alert alert-success"> <?= session()->getTempdata('successcomment'); ?> </div>
            <?php endif; ?>
            
            <div class="card-body">
                <form action="Comment" method="post">
                    <input type="text" name="userid" class="d-none" value="<?=$userid?>"/>
                <textarea name="comment" class="form-control" placeholder="write a comment..." rows="3"></textarea>
                <br>
                <button type="submit" id="btn" class="btn btn-outline-primary float-end">Post</button>
                <div class="clearfix"></div>
                
                <hr>
                <ul class="list-unstyled commentbody">
                    <?php if( $comment != NULL) { for($i=0;$i<count($comment);$i++){ ?>
                    <li class="card">
                        <div class="card-body">
                            <span class="text-muted float-end">
                                <small class="text-muted"><?=$time[$i]?></small>
                            </span>
                            <strong class="text-success"><?=$name[$i]?></strong>
                            <p>
                                <?=$comment[$i]?>
                            </p>
                        </div>
                    </li>
                    <?php } } else {?>
                        
                    <?php } ?>
                </ul>
                </form>
            </div>
        </div>
    </div>

</div>
</div>



</div>
</body>
</html>