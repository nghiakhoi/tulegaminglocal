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
		  $total=0;
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
				?>
							
							<tr>
		<td><a href="<?php echo $product_info->get_permalink(); ?>"><img style="width:150px;height:auto;" src="<?php echo $image_url; ?>" alt=""></a></td>
		<td>
		  <a href="<?php echo $product_info->get_permalink(); ?>" style="text-decoration:none; color:#333; font-weight:bold; font-size:16px;"><?php echo $product_info->get_name(); ?></a><br>
		  Mã SP: <?php echo $product_info->get_sku(); ?> <br>
		  Bảo hành: <?php echo $product_info->get_attribute('pa_bao-hanh'); ?><br>
		  <b><?php echo number_format( $product_info->get_price() , 0, '', '.') ?> x <?php echo $_SESSION['sanphambuildpc'][$j]['sl']; ?></b>
		</td>
		<td width="180">
		   
		  <!--1999000-->
		  <b style="color:#e00; font-size:16px;">= <?php $total+=($product_info->get_price() * $_SESSION['sanphambuildpc'][$j]['sl']); echo number_format( $product_info->get_price() * $_SESSION['sanphambuildpc'][$j]['sl'], 0, '', '.'); ?> đ</b>
		</td>
	  </tr>
	
							
					<?php	}
						
	
						}
					}
				}
			
		  ?>
	
			<?php ?>
	  
	  
	 
	  
	  
	</tbody></table>
  
  
  
  
  <p style="font-size:21px; color:#e00; font-weight:bold; text-align:center;">Tổng chi phí: <?php echo number_format( $total, 0, '', '.'); ?> đ</p>
  
  
  <table style="text-align:center; width:100%;">
	<tbody><tr><td colspan="8" style="font-size:21px;">CHÂN THÀNH CẢM ƠN !</td></tr>
	<tr><td colspan="8">Để biết thêm chi tiết, vui lòng liên hệ</td></tr>
	<tr><td colspan="8"><b>Hotline:</b> 1900 1903 (8h - 21h30 hàng ngày)</td></tr>
	<tr><td colspan="8"><a href="http://tulegaming.com">tulegaming.com</a></td></tr>
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