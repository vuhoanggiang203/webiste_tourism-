<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{	
	header('location:index.php');
}
else{ 
	// code for cancel
	if(isset($_REQUEST['bkid']))
	{
		$bid=intval($_GET['bkid']);
		$status=2;
		$cancelby='u';
		$sql = "UPDATE hoadon SET trangthai=:status,huy=:cancelby WHERE  id_hoadon=:bid";
		$query = $dbh->prepare($sql);
		$query -> bindParam(':status',$status, PDO::PARAM_STR);
		$query -> bindParam(':cancelby',$cancelby , PDO::PARAM_STR);
		$query-> bindParam(':bid',$bid, PDO::PARAM_STR);
		$query -> execute();

		$msg=" Hủy đơn thành công";
	}
	?>
	<html lang="en">
	<head>
		<title>Bookings</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="icon" href="images/favicon.png" type="image/x-icon">

		<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900,900i%7CMerriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

		<link rel="stylesheet" href="css/bootstrap.min.css">

		<link rel="stylesheet" href="css/font-awesome.min.css">

		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" id="cpswitch" href="css/green.css">
		<link rel="stylesheet" href="css/responsive.css">
		<!---->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	<body id="booking">
		<?php include('includes/header.php') ?>
		<!--========= PAGE-COVER ==========-->
		<section class="page-cover dashboard">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h1 class="page-title">Tour đã đặt</h1>
						<ul class="breadcrumb">
							<li><a href="index.php">Home</a></li>
							<li class="active">Tour đã đặt</li>
						</ul>
					</div>
				</div>
			</div>
		</section>


		<!--===== INNERPAGE-WRAPPER ====-->
		<section class="innerpage-wrapper">
			<div id="dashboard" class="innerpage-section-padding">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="dashboard-heading">
								<h2>Thông tin<span> người dùng</span></h2>
								<p>Xin chào <?php echo htmlentities($result->hoten);?></p>
								<p>Tất cả các chuyến đi của bạn được đặt với chúng tôi sẽ xuất hiện ở đây</p>
							</div>

							<div class="dashboard-wrapper">
								<div class="row">

									<div class="col-xs-12 col-sm-2 col-md-2 dashboard-nav">
										<ul class="nav nav-tabs nav-stacked text-center">
											<li><a href="issuetickets.php"><span><i class="fa fa-question-circle"></i></span>Trợ giúp</a></li>
											<li><a href="profile.php"><span><i class="fa fa-user"></i></span>Hồ sơ</a></li>
											<li  class="active"><a href="#"><span><i class="fa fa-briefcase"></i></span>Đặt tour</a></li>
											<li><a href="password.php"><span><i class="fa fa-lock"></i></span>Mật khẩu</a></li>
											<li><a href="cards.html"><span><i class="fa fa-credit-card"></i></span>My Cards</a></li>
										</ul>
									</div>

									<div class="col-xs-12 col-sm-10 col-md-10 dashboard-content booking-trips">
										<h2 class="dash-content-title">Chuyến đi đã đặt</h2>
										<?php if($error){?><div class="errorWrap"><strong>Lỗi</strong>:<?php echo htmlentities($error); ?> </div><?php } 
										else if($msg){?><div class="succWrap"><strong>Hoàn thành</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
										<div class="dashboard-listing booking-listing">
											
											<div class="dash-listing-heading">
												<div class="custom-radio">
													
													<ul style="width: 500px;margin-top: 17px; margin-left: -160px; list-style: none;">
														<li style="margin-top: -19px; margin-left: 125px;" ><a href="booking.php"><span><i class="far fa-circle"></i></span> Tour du lịch</a></li>

														<li class="active" style="margin-top: -22px;margin-left: 260px;"><a href="#"><span><i class="	glyphicon glyphicon-record	"></i></span> Khách sạn</a></li>

													</ul>
												</div>

											</div>
											<?php 
											$uemail=$_SESSION['login'];;
											$sql = "SELECT hoadon.id_hoadon as bookid,hoadon.id_ks as pkgid,khachsan.tenks as packagename,khachsan.ngayvao as ngdi,khachsan.ngayra as sngay,khachsan.nguoilon as nguoilon,khachsan.treem as treem,khachsan.gia as gia,hoadon.ghichu as comment,hoadon.sophong as sophong,hoadon.trangthai as status,hoadon.ngaydat as regdate,hoadon.huy as cancelby,hoadon.ngaycapnhat as upddate from hoadon join khachsan on khachsan.id_ks=hoadon.id_ks where email_nguoidung=:uemail";
											$query = $dbh->prepare($sql);
											$query -> bindParam(':uemail', $uemail, PDO::PARAM_STR);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											$cnt=1;
											if($query->rowCount() > 0)
											{
												foreach($results as $result)
													{	?>
														<div class="table-responsive">
															<table class="table table-hover">
																<tbody>
																	<tr>
																		<td class="dash-list-icon booking-list-date"><div class="b-date" style="width: 75px;"><h3><?php echo htmlentities($cnt);?></h3><p>Mã: <?php echo htmlentities($result->bookid);?></p></div></td>
																		<td class="dash-list-text booking-list-detail">
																			<a href="tour-detail.php?pkgid=<?php echo htmlentities($result->pkgid);?>"> <h3 style="color: #7e4fa9"><?php echo htmlentities($result->packagename);?></h3></a>
																			<ul class="list-unstyled booking-info">
																				<li><span>Ngày vào: </span><?php echo date("d-m-Y", strtotime($result->ngdi)); ?> | <span>Ngày ra: </span><?php echo date("d-m-Y", strtotime($result->sngay)); ?></li>

																				<li><span>Bao gồm: </span><?php echo ($result->nguoilon);?> Người lớn | <?php echo ($result->treem);?> Trẻ em</li>

																				<li><span>Đã đặt: </span><?php echo htmlentities($result->sophong);?> Phòng</li>

																				<li><span>Tổng tiền: </span><?php echo number_format($result->gia * $result->sophong);?></li>

																				<li><span>Ghi chú: </span><?php echo htmlentities($result->comment);?></li>

																				<li><span>Ngày đặt: </span><?php echo date("d-m-Y", strtotime($result->regdate)); ?></li>

																			</ul>
																			<td><?php if($result->status==0)
																			{
																				echo "Đang chờ xử lý";
																			}
																			if($result->status==1)
																			{
																				echo "Đã xác nhận";
																			}
																			if($result->status==2 and  $result->cancelby=='u')
																			{
																				echo "Bạn đã hủy lúc " .$result->upddate;
																			} 
																			if($result->status==2 and $result->cancelby=='a')
																			{
																				echo "Quản trị viên đã hủy lúc  " .$result->upddate;
																			}
																			?>
																		</p>
																		</td>
																		<?php if($result->status==2)
												{
													?>
													</td>
												<?php } else {?>
													<td><a  class="btn btn-orange" href="booking-hotel.php?bkid=<?php echo htmlentities($result->bookid);?>" onclick="return confirm('Bạn có chắc chắn hủy')" >Hủy</a></td>
												<?php }?>
																	</tr>
																	<?php $cnt=$cnt+1; }} ?>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>

						<?php include('includes/footer.php');?>

						<?php include('includes/signup.php');?>			

						<?php include('includes/signin.php');?>			

						<?php include('includes/write-us.php');?>			

						<script src="js/jquery.min.js"></script>
						<script src="js/bootstrap.min.js"></script>
						<script src="js/custom-navigation.js"></script>

					</body>
					</html>
				<?php } ?>

				<style type="text/css">
					.dashboard-nav .nav-tabs li.active a:link, .dashboard-nav .nav-tabs li.active a:visited
					{
						color:white;
						text-decoration:none;
					}

					.dashboard-nav .nav-tabs li.active a:hover
					{
						color:white;
						font-weight:bold;
						background: #faa61a;
					}

					.dashboard-nav .nav-tabs li.active a:active
					{
						background:#faa61a;
					}
					p, ul, a, .btn, span, input, select, textarea, label, table, .meta h2, blockquote, small, .newsletter h2, .cruise-offer-text h3, .package h2, .welcome-message h2, #hot-tour h3, #hot-tour h2, #message-banner h2, .member-name h3, #error-text h2, .company-name, #coming-soon-text h2, .booking-form-block .selected-price, #dashboard h2, #dashboard h3, #dashboard h4, #web-name, .tvl-insurance-info .innerpage-heading h1, .big-heading h2, .traveler-info h3, .list-group-heading { font-family: initial;
					}
				</style>