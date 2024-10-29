

<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
	header('location:index.php');
}
else{ 
	// code for cancel
	if(isset($_REQUEST['bkid']))
	{
		$bid=intval($_GET['bkid']);
		$status=2;
		$cancelby='a';
		$sql = "UPDATE hoadon SET trangthai=:status,huy=:cancelby WHERE  id_hoadon=:bid";
		$query = $dbh->prepare($sql);
		$query -> bindParam(':status',$status, PDO::PARAM_STR);
		$query -> bindParam(':cancelby',$cancelby , PDO::PARAM_STR);
		$query-> bindParam(':bid',$bid, PDO::PARAM_STR);
		$query -> execute();

		$msg=" Hủy đơn thành công";
	}


	if(isset($_REQUEST['bckid']))
	{
		$bcid=intval($_GET['bckid']);
		$status=1;
		$cancelby='a';
		$sql = "UPDATE hoadon SET trangthai=:status WHERE id_hoadon=:bcid";
		$query = $dbh->prepare($sql);
		$query -> bindParam(':status',$status, PDO::PARAM_STR);
		$query-> bindParam(':bcid',$bcid, PDO::PARAM_STR);
		$query -> execute();
		$msg=" Đã xác nhận";
	}
	?>
	<!DOCTYPE HTML>
	<html>
	<head>
		<title>Khách sạn</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="css/morris.css" type="text/css"/>
		<link href="css/font-awesome.css" rel="stylesheet"> 
		<script src="js/jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/table-style.css" />
		<link rel="stylesheet" type="text/css" href="css/basictable.css" />
		<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
		<!--=========================database======================== -->
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script src="http://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.20/js/dataTables.semanticui.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css">
		<script src="https://cdn.datatables.net/1.10.20/js/dataTables.semanticui.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
     // $('#table').basictable();

     var dt= $('#table').DataTable({
     	"dom": '<"pull-right"f>t<"row mt-1" <"col-sm-3" l><"col-sm-6" <"pull-right" p>>>',
     	"language": {
     		"lengthMenu": "Hiển thị _MENU_ trên 1 trang",
     		"zeroRecords": "Không tìm thấy nội dung cần tìm",
     		"infoEmpty": "Chưa có nội dung",
     		"infoFiltered": "(filtered from _MAX_ total records)",
     		"sSearch":"Tìm kiếm",
     		"oPaginate": {
                    "sFirst": "Đầu", // This is the link to the first page
                    "sPrevious": "Trước", // This is the link to the previous page
                    "sNext": "Tiếp", // This is the link to the next page
                    "sLast": "Cuối" // This is the link to the last page
                }
            }
        });

     $('#table-breakpoint').basictable({
     	breakpoint: 768
     });

     $('#table-swap-axis').basictable({
     	swapAxis: true
     });

     $('#table-force-off').basictable({
     	forceResponsive: false
     });

     $('#table-no-resize').basictable({
     	noResize: true
     });

     $('#table-two-axis').basictable();

     $('#table-max-height').basictable({
     	tableWrapper: true
     });
 });
</script>
<style>
	.errorWrap {
		padding: 10px;
		margin: 0 0 20px 0;
		background: #fff;
		border-left: 4px solid #dd3d36;
		-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
	}
	.succWrap{
		padding: 10px;
		margin: 0 0 20px 0;
		background: #fff;
		border-left: 4px solid #5cb85c;
		-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
	}
	.col-sm-6 {
		width: 73%;
	}
	.alert-success {
		margin-left: 45px;
		margin-top: 35px;
	}
	.logo-w3-agile{
		background-color: #1B93E1 !important;
	}
	.btn-primary {
    background-color: #1B93E1 !important;
     }
	 table th{
		background-color: #1B93E1;
	 }
</style>
<!-- ============================================end database=================================== -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />

<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />

</head> 
<body>
	<div class="page-container">
		<div class="left-content">
			<div class="mother-grid-inner">
				<?php include('includes/header.php');?>
				<div class="clearfix"> </div>	
			</div>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a><i class="fa fa-angle-right"></i>Quản lý hóa đơn</li>
			</ol>
			<div class="agile-grids"  style=" margin-top: -40px; margin-left: -35px;">	
				<?php if($error){?><div class="errorWrap"><strong>Lỗi</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong style="margin-left: 35px;">Hoàn thành</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
				<div class="agile-tables" style="margin: -3em 0; width: 105%;">
					<div class="w3l-table-info">
						<h2 style="margin-left: 20px;">Quản lý đơn</h2>

						<div class="col-xs-12 col-sm-2 col-md-2 dashboard-nav">
							<ul style="width: 500px;margin-top: 30px; list-style: none;">
								<li style="margin-top: -19px;"><a href="manage-bookings.php"><span><i class="glyphicon glyphicon-road" style="color:      #1b93e1;"></i></span> Tour</a></li>
								
								<li class="active"  style="margin-top: -19px;margin-left: 80px;"><a href="manage-bookings-hotel.php"><span><i class="fas fa-hotel"></i></span> Khách sạn</a></li>
								
							</ul>
						</div>
						
						<table id="table">
							<thead>
								<tr>
									<th>Mã</th>
									<th>Tên</th>
									<th>sđt</th>
									<th>Email</th>
									<th>Khách sạn</th>
									<th style="text-align: center;">Tổng tiền <br> (VNĐ)</th>
									<th>Ngày vào/ra</th>
									<th>Số phòng</th>
									<th>Ngày đặt</th>
									<th>Ghi chú </th>
									<th>Trạng thái </th>
									<th>Hoạt động </th>
								</tr>
							</thead>
							<tbody>
								<?php $sql = "SELECT hoadon.id_hoadon as bookid,nguoidung.hoten as fname,nguoidung.sdt_nd as mnumber,nguoidung.id_email as email,khachsan.tenks as pckname,khachsan.gia as gia,hoadon.sophong as sphong,hoadon.id_ks as pid,khachsan.ngayvao as xphat,khachsan.ngayra as ve,hoadon.ghichu as comment,hoadon.ngaydat as ngaydat,hoadon.trangthai as status,hoadon.huy as cancelby,hoadon.huy as upddate from nguoidung join  hoadon on  hoadon.email_nguoidung=nguoidung.id_email join khachsan on khachsan.id_ks=hoadon.id_ks";
								$query = $dbh -> prepare($sql);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);
								$cnt=1;
								if($query->rowCount() > 0)
								{
									foreach($results as $result)
										{				?>	
											<tr>
												<td>MS-<?php echo htmlentities($result->bookid);?></td>
												<td><?php echo htmlentities($result->fname);?></td>
												<td><?php echo htmlentities($result->mnumber);?></td>
												<td><?php echo htmlentities($result->email);?></td>
												
												<td><a href="update-hotel.php?pid=<?php echo htmlentities($result->pid);?>"><?php echo htmlentities($result->pckname);?></a></td>

												<td  style="width: 90px;"><a href="update-hotel.php?pid=<?php echo htmlentities($result->pid);?>"><?php echo number_format($result->gia * $result->sphong);?></a></td>
												<td style="width: 100px;"><?php echo date("d-m-Y", strtotime($result->xphat));?></br> Đến </br><?php echo date("d-m-Y", strtotime($result->ve));?></td>
												<td><?php echo htmlentities($result->sphong);?></td>
												<td style="width: 90px;"><?php echo date("d-m-Y", strtotime($result->ngaydat)); ?></td>
												
												<td><?php echo htmlentities($result->comment);?></td>
												<td><?php if($result->status==0)
												{
													echo "Đang chờ xử lý";
												}
												if($result->status==1)
												{
													echo "Đã xác nhận";
												}
												if($result->status==2 and  $result->cancelby=='a')
												{
													echo "Bạn đã hủy " .$result->upddate;
												} 
												if($result->status==2 and $result->cancelby=='u')
												{
													echo "Đã bị hủy bởi người dùng tại " .$result->upddate;

												}
												?></td>

												<?php if($result->status==2)
												{
													?><td>Đã hủy<br>
														<a href="delete-bookings-hotel.php?bkid=<?php echo htmlentities($result->bookid);?>" onclick="return confirm('Bạn có chắc chắn xóa')" >Xóa</a>
													</td>
												<?php } else {?>
													<td><a href="manage-bookings-hotel.php?bkid=<?php echo htmlentities($result->bookid);?>" onclick="return confirm('Bạn có chắc chắn hủy')" >Hủy</a> / <a href="manage-bookings-hotel.php?bckid=<?php echo htmlentities($result->bookid);?>" onclick="return confirm('Bạn có chắc chắn xác nhận')" >Xác nhận</a></td>
												<?php }?>

											</tr>
											<?php $cnt=$cnt+1;} }?>
										</tbody>
									</table>
								</div>
							</table>
						</div>
						<script>
							$(document).ready(function() {
								var navoffeset=$(".header-main").offset().top;
								$(window).scroll(function(){
									var scrollpos=$(window).scrollTop(); 
									if(scrollpos >=navoffeset){
										$(".header-main").addClass("fixed");
									}else{
										$(".header-main").removeClass("fixed");
									}
								});

							});
						</script>
						<div class="inner-block">

						</div>
						<?php include('includes/footer.php');?>
					</div>
				</div>
				<?php include('includes/sidebarmenu.php');?>
				<div class="clearfix"></div>		
			</div>
			<script>
				var toggle = true;

				$(".sidebar-icon").click(function() {                
					if (toggle)
					{
						$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
						$("#menu span").css({"position":"absolute"});
					}
					else
					{
						$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
						setTimeout(function() {
							$("#menu span").css({"position":"relative"});
						}, 400);
					}

					toggle = !toggle;
				});
			</script>
			<script src="js/jquery.nicescroll.js"></script>
			<script src="js/scripts.js"></script>
			<script src="js/bootstrap.min.js"></script>  

		</body>
		</html>
	<?php } 	