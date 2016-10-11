<!DOCTYPE html>
<html>
<head>
	<title>Product-list</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<style type="text/css">
		.hisella-messages { position: fixed; bottom: 0; right: 0; z-index: 999999; }
.hisella-messages-outer { position: relative; }
#hisella-minimize { background: #3b5998; font-size: 14px; color: #fff; padding: 3px 10px; position: absolute; top: -34px; left: -1px; border: 1px solid #E9EAED; cursor: pointer; }
@media screen and (max-width:768px){ #hisella-facebook { opacity:0; } .hisella-messages { bottom: -300px; right: -135px; } }
	</style>

</head>
<body>
<?php
require_once('functions/db_function.php');
	 $db=new db_functions();
?>
<div id="product_list">
		<?php require_once('navbar.php'); ?>
		<div class="menu_contact">
			<img src="img/hotline.png" alt="hotline" id="hotline">
			<div class="sub_partner">
				<img src="img/banner1.jpg" alt="partner" class="img-circle banner">
				<div class="info_partner">
					<p class="person_name">Mr.Huy Hạnh</p>
					<p class="phone">0123.344.644</p>
				</div>
			</div><!--end sub_partner-->
			<div class="sub_partner">
				<img src="img/banner1.jpg" alt="partner" class="img-circle banner">
				<div class="info_partner">
					<p class="person_name">Mr.Huy Hạnh</p>
					<p class="phone">0123.344.644</p>
				</div>
			</div><!--end sub_partner-->
		</div><!--end menu_contact-->
			<div class="container">
		<?php require_once('menu.php'); ?>



		<div class="list-product" style=" margin-left:23%;">
			<?php 
			$total_record=$db->numrow("SELECT *FROM sanpham WHERE id_danhmuc='$row[id_danhmuc]'");
			$limit=8;
			if($total_record>8)
				$total_pages=ceil($total_record/$limit);
			else
				$total_pages=1;
			if(isset($_GET['idDanhMuc'])){
			$getDanhMuc=$_GET['idDanhMuc'];

			$start=(isset($_GET['start'])&& (int)$_GET['start'])?$_GET['start']:0;

		$result=$db->select_all("SELECT * FROM danhmuc WHERE danhmuc.id_danhmuc='$getDanhMuc'");
		foreach ($result as $row){
			if($row['ten_danhmuc']!=""){
			?>
				<h3 class="product_title" style="margin-bottom:0px;text-align: center;"><?php echo $row['ten_danhmuc'];?></h3>
			<div class="product_sub" style="height:auto; text-align:center;">
			<?php
				$result1=$db->select_all("SELECT * FROM sanpham WHERE sanpham.id_danhmuc='$row[id_danhmuc]' LIMIT $start,8");
				foreach ($result1 as $row1) {
					if($row1['ten_sanpham']!=""){					
	?>	
			
			<div class="product"  style="width:23%;">
				<a href="product-detail.php?idChiTiet=<?php echo $row1['id_sanpham']; ?>" class="link_sub_img"><img src=<?php echo $row1['link_sanpham']; ?> alt="clother" class="small_main_img"></a>
				<p class="name_product"><?php echo $row1['ten_sanpham']; ?></p>
			</div>
			<?php } }
			if($db->numrow("SELECT * FROM sanpham WHERE sanpham.id_danhmuc='$row[id_danhmuc]'")==0)
				echo "<p style='margin-top:20px'>Chưa có sản phẩm trong mục này</p>";
		}
	}
}else{
	echo "<p>Không tồn tại trang mà bạn tìm kiếm.</p>";
	echo "Nhấn vào <a href='index.php'>link này</a> để trở về trang chủ.";
}
			?>
				
			
		</div>	<!--row product_sub-->
		</div><!--end list-product-->

		<div id="pages">
			 <ul class="pagination" style="float:right">
			 <?php  
			 	if($total_pages>1){
			 		$next=$start+$limit;
					$prev=$start-$limit;
					$current=($start+$limit)-1;
					if($current !=1){
						echo "<li><a href='product_list?idDanhMuc=$row[id_danhmuc]?&start=$prev'>Previous</a></li>";
					}
					for($i=0;$i<$total_pages;$i++){
					if($current != $i)
						{
							echo "<li><a href='product_list.php?idDanhMuc=$row[id_danhmuc]?&start=".($limit*($i-1))."'> $i </a> </li>";
							
						}
					else
						{
							echo "<li class='current'> $i </li>";
							
							
						}
					}
					if($current !=$total_pages){
						echo "<li><a href='product_list?idDanhMuc=$row[id_danhmuc]?&start=$next'>Next</a></li>";
					}

			 	}
			 ?>
			 
 			 </ul>		
		</div>
</div><!--end product-list-->
<?php require('footer.php'); ?>
<div id='fb-root'></div>
<script>
(function($) { $(document).ready(function(){ $( '#hisella-minimize' ).click( function() { if( $( '#hisella-facebook' ).css( 'opacity' ) == 0 ) { $( '#hisella-facebook' ).css( 'opacity', 1 ); $( '.hisella-messages' ).animate( { right: '0' } ).animate( { bottom: '0' } ); } else { $( '.hisella-messages' ).animate( { bottom: '-300px' } ).animate( { right: '-135px' }, 400, function(){ $( '#hisella-facebook' ).css( 'opacity', 0 ) } ); } } ) }); })(jQuery);
(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div class="hisella-messages"><div class="hisella-messages-outer"><div id="hisella-minimize">Facebook chat</div><div id="hisella-facebook" class='fb-page' data-adapt-container-width='true' data-height='300' data-hide-cover='false' data-href='https://www.facebook.com/Xưởng-May-Đồng-phục-Bảo-hộ-lao-động-Sòng-Sơn-442319485927565/' data-show-facepile='true' data-show-posts='false' data-small-header='false' data-tabs='messages' data-width='250'></div></div></div>
<script type="text/javascript">
			$(document).ready(function(){
			 $("div.sub_partner").hide();	
    $("#hotline").click(function(){
        $("div.sub_partner").slideToggle( "slow" );
    });
});
</script>
<script type="text/javascript">
			$(document).ready(function(){	
        $("#dLabel:hover").slideToggle( "slow" );
});
</script>

</body>
</html>