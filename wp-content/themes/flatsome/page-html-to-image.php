<?php
/*
Template Name: Page Html to Image
Template Post Type: post, page, event
*/
if(is_page('buildpctoimage')){
	
	echo ('<script type="text/javascript" src="/wp-includes/js/jquery/jquery.js"> </script>'); 
	echo ('<script type="text/javascript" src="'. get_stylesheet_directory_uri() . '/assets/js/html2canvas.js"> </script>'); 

 }

?>



<style>
    	body{margin:0; padding:0; font-family:Arial; font-size:14px; line-height:1.5; background:url('/wp-content/themes/flatsome/assets/img/bg_logo.png') center center no-repeat fixed #ffffff;}
      	table{padding:5px;}
    </style>

<body  id="html-content-holder">

<div   style="width:800px; margin:auto;">
	<img src="/wp-content/themes/flatsome/assets/img/bg_header_print_config.jpg" alt="header" style="width:100%; height:auto; display:block;">
	<table style="width:100%;">
	  
	  
	  
	  <tbody>
		  <?php //TIẾP TỤC Ở ĐÂY
		 	if(count($_SESSION['sanphambuildpc'])>0){
				//$array_product="";
				$cate = wp_get_nav_menu_items('BuildPC');
				$array_product=array();
				for($i=0;$i<count($cate);$i++){
	
					for($j=0;$j<count($_SESSION['sanphambuildpc']);$j++){
						if($_SESSION['sanphambuildpc'][$j]['cat_id']==$cate[$i]->object_id){
							$product_info = wc_get_product($_SESSION['sanphambuildpc'][$j]['id']);
							$image_id  = $product_info->get_image_id();
							$image_url = wp_get_attachment_image_url( $image_id, 'full' );
							$product_item['info']=array (
								'id' => $cate[$i]->object_id,
								'name' => $cate[$i]->title,
							);
							$product_item['items']=[
									array (
									  'id' => $product_info->get_id(),
									  'name' => $product_info->get_name(),
									  'sku' => $product_info->get_sku(),
									  'image' => $image_url,
									  'price' => $product_info->get_price(),
									  'url' => $product_info->get_permalink(),
									  'stock' => '1',
									  'quantity' => $_SESSION['sanphambuildpc'][$j]['sl'],
									  'price_sum' =>  number_format( $product_info->get_price() , 0, '', '.'),
									  'warranty' => '30 Tháng',
									  'note' => '',
									),
								];
							
								
							   
							;
							//$array_product[$cate[$i]->object_id]=$product_item;
							//array_push($array_product,$product_item);
	
							
						}
						
	
						}
					}
				//print_r( $cate);
				//$json = $array_product;
				//echo $array_product;
				//$out = array_values($array_product);
				//$someArray = json_encode($out, true);
				//print_r($someArray); 
				//echo json_encode($array_product);
				}
			
		  ?>
	<tr>
		<td><a href="https://www.hanoicomputer.vn/mainboard-asus-prime-h410i-plus"><img src="https://hanoicomputercdn.com/media/product/120_56675_mainboard_asus_prime_h410i_plus_001.jpg" alt=""></a></td>
		<td>
		  <a href="https://www.hanoicomputer.vn/mainboard-asus-prime-h410i-plus" style="text-decoration:none; color:#333; font-weight:bold; font-size:16px;">Mainboard&nbsp;ASUS PRIME H410I-PLUS (Intel H410, Socket 1200, Mini-ITX, 2 khe Ram DDR4)</a><br>
		  Mã SP: MBAS612 <br>
		  Bảo hành: 36 Tháng<br>
		  <b>1.999.000 x 1</b>
		</td>
		<td width="180">
		   
		  <!--1999000-->
		  <b style="color:#e00; font-size:16px;">= 1.999.000 đ</b>
		</td>
	  </tr>
			<?php ?>
	  
	  
	  <tr>
		<td><a href="https://www.hanoicomputer.vn/cpu-intel-core-i3-10100f"><img src="https://hanoicomputercdn.com/media/product/120_55894_cpu_intel_core_i3_10100f.jpg" alt=""></a></td>
		<td>
		  <a href="https://www.hanoicomputer.vn/cpu-intel-core-i3-10100f" style="text-decoration:none; color:#333; font-weight:bold; font-size:16px;">CPU Intel Core i3-10100F (3.6GHz turbo up to 4.3Ghz, 4 nhân 8 luồng, 6MB Cache, 65W) - Socket Intel LGA 1200</a><br>
		  Mã SP: CPUI407 <br>
		  Bảo hành: 36 Tháng<br>
		  <b>2.199.000 x 1</b>
		</td>
		<td width="180">
		   
		  <!--4198000-->
		  <b style="color:#e00; font-size:16px;">= 2.199.000 đ</b>
		</td>
	  </tr>
	  
	  
	  
	  <tr>
		<td><a href="https://www.hanoicomputer.vn/ram-desktop-corsair-vengeance-pro-rgb-white-cmw16gx4m2e3200c16w"><img src="https://hanoicomputercdn.com/media/product/120_56688_ram_desktop_corsair_vengeance_pro_rgb_white_cmw16gx4m2e3200c16w.jpg" alt=""></a></td>
		<td>
		  <a href="https://www.hanoicomputer.vn/ram-desktop-corsair-vengeance-pro-rgb-white-cmw16gx4m2e3200c16w" style="text-decoration:none; color:#333; font-weight:bold; font-size:16px;">Ram Desktop Corsair Vengeance PRO RGB White (CMW16GX4M2E3200C16W) 16GB (2x8GB) DDR4 3200MHz</a><br>
		  Mã SP: RACO334 <br>
		  Bảo hành: 60 Tháng<br>
		  <b>2.399.000 x 1</b>
		</td>
		<td width="180">
		   
		  <!--6597000-->
		  <b style="color:#e00; font-size:16px;">= 2.399.000 đ</b>
		</td>
	  </tr>
	  
	  
	</tbody></table>
  
  
  
  
  <p style="font-size:21px; color:#e00; font-weight:bold; text-align:center;">Tổng chi phí: 6.597.000</p>
  <p style="font-size:21px; color:#e00; font-weight:bold; text-align:center;">Tổng tiền thanh toán sau Km giảm tiền mặt: 6.597.000</p>
  
  <table style="text-align:center; width:100%;">
	<tbody><tr><td colspan="8" style="font-size:21px;">CHÂN THÀNH CẢM ƠN !</td></tr>
	<tr><td colspan="8">Để biết thêm chi tiết, vui lòng liên hệ</td></tr>
	<tr><td colspan="8"><b>Hotline:</b> 1900 1903 (8h - 21h30 hàng ngày)</td></tr>
	<tr><td colspan="8"><a href="http://hanoicomputer.vn">https://www.hanoicomputer.vn</a></td></tr>
  </tbody></table>
</div>
<script>


jQuery(document).ready(function($) {
	var element = jQuery("#html-content-holder"); // global variable
	var getCanvas; // global variable
	html2canvas(element, {
         onrendered: function (canvas) {
                $("#previewImage").append(canvas);
                getCanvas = canvas;
             }
		 })
		 .then(function(){
			var imgageData = getCanvas.toDataURL("image/png");
			// Now browser starts downloading it instead of just showing it
			var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
			jQuery("#btn-Convert-Html2Image").attr("download", "your_pic_name.png").attr("href", newData);
			var tmpLink = document.createElement( 'a' );  
			tmpLink.download = 'image.png'; // set the name of the download file 
			tmpLink.href = imgageData; 
			document.body.appendChild( tmpLink );  
			tmpLink.click();  
			document.body.removeChild( tmpLink );
		 });

});


</script>


</body>



	<?php ?>