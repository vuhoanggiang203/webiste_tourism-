<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<html lang="en">
<head>
    <title>Tour Listing Left Sidebar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900,900i%7CMerriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" id="cpswitch" href="css/green.css">
    <link rel="stylesheet" href="css/responsive.css">
    
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>


<body>

    <!--====== LOADER =====-->
    <div class="loader"></div>
    
    
    <!--======== SEARCH-OVERLAY =========-->       
    <div class="overlay">
        <a href="javascript:void(0)" id="close-button" class="closebtn">&times;</a>
        <div class="overlay-content">
            <div class="form-center">
                <form action="search.php" method="get">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="hidden" class="form-control" placeholder="Nơi xuất phát" name="search" id="search">
                            <input type="hidden" class="form-control" placeholder="Điểm đến" name="search1" >
                            <input type="hidden" class="form-control dpd1" placeholder="Ngày đi" name="search2">
                            <input type="hidden" class="form-control dpd2" placeholder="Ngày về" name="search3">
                            <input type="text" class="form-control dpd1" placeholder="Nhập tên tour..." name="search4">
                            <span class="input-group-btn"><button name="submit" type="submit" class="btn"><span><i class="fa fa-search"></i></span></button></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    
    <!--============= TOP-BAR ===========-->
    <?php include('includes/header.php') ?>
    
    <!--================== PAGE-COVER =================-->
    <section class="page-cover" id="cover-tour-grid-list">
        <div class="container" style="margin-left: 160px;">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="page-title">Tour Khuyến Mãi</h1>
                    <ul class="breadcrumb">
                        <li><h4><a href="#">Trang Chủ</a></h4></li>
                        <li class="active">Khuyến Mãi</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <!--===== INNERPAGE-WRAPPER ====-->
    <section class="innerpage-wrapper">
        <div id="tour-listing" class="innerpage-section-padding">
            <div class="container">
                <div class="row">           



                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 content-side">
                     <?php $sql = "SELECT * from goidulich where khuyenmai= '1' order by ngayxuatphat";
                     $query = $dbh->prepare($sql);
                     $query->execute();
                     $results=$query->fetchAll(PDO::FETCH_OBJ);

                     if($query->rowCount() >0)
                     {
                        foreach($results as $result)
                            {   ?>
                                <div class="list-block main-block t-list-block">
                                    <div class="list-content">
                                        <div class="main-img list-img t-list-img">
                                            <a href="tour-detail.php?pkgid=<?php echo htmlentities($result->id_goi);?>">
                                                <img src="images/tour/<?php echo htmlentities($result->hinhanh);?>" class="img-responsive" alt="tour-img" />
                                            </a>
                                            <div class="main-mask">
                                                <ul class="list-unstyled list-inline offer-price-1">
                                                <li style="background-color:pink"> Giá Gốc:5,000,000 VND <li>
                                                    <li class="price"><?php echo number_format($result->giagoi);?> VND<span class="pkg"></span></li>
                                                    <li class="rating">
                                                        <span><i class="fa fa-star orange"></i></span>
                                                        <span><i class="fa fa-star orange"></i></span>
                                                        <span><i class="fa fa-star orange"></i></span>
                                                        <span><i class="fa fa-star orange"></i></span>
                                                        <span><i class="fa fa-star lightgrey"></i></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="list-info t-list-info">
                                            <h3 class="block-title"><a href="tour-detail.php?pkgid=<?php echo htmlentities($result->id_goi);?>"><?php echo htmlentities($result->tengoi);?></a></h3>
                                            <br>
                                            <div style="float: left;">
                                                <p><i class="fas fa-plane-departure"></i> Khởi hành: <?php echo date("d-m-Y", strtotime($result->ngayxuatphat)); ?></p>
                                                <p><i class="fas fa-plane-arrival"></i> Kết thúc:<?php echo date("d-m-Y", strtotime($result->ngayve)); ?></p>
                                            </div>
                                            <div style="float: right;">
                                              <p><i class="fas fa-map-marked-alt"></i> Điểm đến: <?php echo htmlentities($result->vitri);?></p>
                                              <p style="width: 222px;"> <i class="fas fa-map-marker-alt"></i> Điểm xuất phát: <?php echo htmlentities($result->noixuatphat);?></p>

                                          </div>
                                          <a style="margin-top: 30px;margin-bottom: -10px;" href="tour-detail.php?pkgid=<?php echo htmlentities($result->id_goi);?>" class="btn btn-orange btn-lg">Xem thêm</a>
                                      </div>
                                  </div>
                              </div>
                          <?php }} ?>
                          <div class="pages">
                            <ol class="pagination">
                                <li><a href="#" aria-label="Previous"><span aria-hidden="true"><i class="fa fa-angle-left"></i></span></a></li>
                                <li class="active"><a href="#">1</a></li>

                                <li><a href="#" aria-label="Next"><span aria-hidden="true"><i class="fa fa-angle-right"></i></span></a></li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!--======================= FOOTER =====================-->
    <?php include('includes/footer.php') ?>
    <script>
        $(document).ready(function(){
            $('.online-support').hide();
            $('.support-icon-right h3').click(function(e){
                e.stopPropagation();
                $('.online-support').slideToggle();
            });
            $('.online-support').click(function(e){
                e.stopPropagation();
            });
            $(document).click(function(){
                $('.online-support').slideUp();
            });
        });
    </script>

    <span style="font-size: 14px; color: rgb(87, 87, 87); font-family: ProximaNovaSemiBold, 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 30px;"></span>



    <style>
        .support-icon-right {
            background: #F0F3EF;
            position: fixed;
            right: 0;
            bottom: 0;
            z-index: 9;
            overflow: hidden;
            width: 250px;
            color: #fff!important;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }

        .support-icon-right h3 {
            text-transform: uppercase;
            font-weight: bold;
            font-size: 13px!important;
            font-family: Arial;
            color: #fff!important;
            margin: 0!important;
            background-color: #5CB85C;
            cursor: pointer;
        }

        .support-icon-right i {
            background-color: #D9534F;
            padding: 15px 15px 12px 15px;
            margin-right: 15px;
        }
        .online-support {
            display: none;
        }
        a.btn:link, a.btn:visited
        {
            color:white;
            text-decoration:none;
        }

        a.btn:hover
        {
            color:white;
            font-weight:bold;
            background: #9999ff !important;
        }

        a.btn:active
        {
            background:yellow;
        }
        @media (min-width: 992px)
        .col-md-6 {
        </style>

        <?php include('includes/signup.php');?>         

        <?php include('includes/signin.php');?>         
        
        <?php include('includes/write-us.php');?>           
        
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-ui.min.js"></script> 
        <script src="js/bootstrap.min.js"></script>
        <script src="js/custom-navigation.js"></script>
        <script src="js/custom-price-slider.js"></script>

    </body>
    </html>
