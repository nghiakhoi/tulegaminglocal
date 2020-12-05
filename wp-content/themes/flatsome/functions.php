<?php
/**
 * Flatsome functions and definitions
 *
 * @package
 */



require get_template_directory() . '/inc/init.php';

/**
 * Note: It's not recommended to add any custom code here. Please use a child theme so that your customizations aren't lost during updates.
 * Learn more here: http://codex.wordpress.org/Child_Themes
 */

add_action('init', 'myStartSession', 1);
function myStartSession() {
 
    if(!session_id()) {
 
        session_start();
 
    }
 
}
if(!isset($_SESSION["sanphambuildpc"])){
    $_SESSION["sanphambuildpc"] = array();
}

// if (count($_SESSION["sanphambuildpc"])>=0) {
//     session_start();
//     //session_destroy();
//     $_SESSION["sanphambuildpc"] = array();
//     //session_unset($_SESSION["sanphambuildpc"]);
  
//  }



add_action( 'wp_ajax_loadpost', 'loadpost_init' );
add_action( 'wp_ajax_nopriv_loadpost', 'loadpost_init' );
function loadpost_init() {
 
    $category_id = isset($_POST['category_id']) ? (int)$_POST['category_id'] : 0;
    $query = new WP_Query( array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'tax_query'      => array( array(
            'taxonomy'   => 'product_cat',
            'field'      => 'term_id',
            'terms'      => $category_id,
        ) )
    ) );
    

    ?>

<script>
    jQuery(".icon-menu-filter-mobile").click(function(){
        jQuery(".build-pc .popup-select .popup-main .popup-main_filter").toggle();
    });

    // var SEARCH_URL = "https://nghiakhoi.ddns.net:8888/wp-admin/custom-ajax.php";
    var SEARCH_URL = "<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>";

    function loadAjaxContent(holder_id, url){
        objBuildPCVisual.showProductFilter(url);
    }

    function searchKeyword(query,category_id) {
        if(query.length < 2) return ;
        objBuildPCVisual.searchProductFilter(SEARCH_URL, encodeURIComponent(query),category_id);
    }

    jQuery("#buildpc-search-keyword").keypress(function(e) {
        var category_id = jQuery("#buildpc-search-keyword").data("category-id");
        if(e.which == 13) {
            e.preventDefault();
            searchKeyword(this.value,category_id);
        }
    });

    jQuery("#js-buildpc-search-btn").on("click", function(){
        searchKeyword(jQuery("#buildpc-search-keyword").val());
    });
</script>

<div id="js-modal-popup"><div class="mask-popup active">
    <div class="close-pop-biuldpc" onclick="closePopup()" style="width: 100%;float: left;height: 100%;position: fixed;z-index: 1;"></div>
    <div class="popup-select" style="z-index: 99;">
        <div class="header">
            <h4>Chọn linh kiện</h4>
            <form action="">
                <input type="text" value="" data-category-id="<?php echo $category_id;?>" id="buildpc-search-keyword" class="input-search" placeholder="Bạn cần tìm linh kiện gì?">
                <span class="btn-search"><i class="far fa-search" id="js-buildpc-search-btn"></i></span>
                <div class="icon-menu-filter-mobile"><i class="fal fa-filter"></i> Lọc</div>
            </form>

            <span class="close-popup" onclick="closePopup()"><i class="fal fa-times"></i></span>
        </div>
        <div class="popup-main">
            
            <div class="popup-main_content w-100 float_r">
                <div class="sort-paging clear">
                    <div class="sort-block float_l">
                        <span>Sắp xếp: </span>
                        <select style="position: relative;    top: -40px;    left: 70px;" onchange="if(this.value != '') { objBuildPCVisual.showProductFilter(this.value) }">
                            <option value="">Tùy chọn</option>
                            
                            <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=new">Mới nhất</option>
                            
                            <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=price-asc">Giá tăng dần</option>
                            
                            <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=price-desc">Giá giảm dần</option>
                            
                            <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=view">Lượt xem</option>
                            
                            <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=rating">Đánh giá</option>
                            
                            <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=name">Tên A-&gt;Z</option>
                            
                        </select>
                    </div>

                    
                    
                </div>

                <div class="list-product-select">

                    <?php
                    while ( $query->have_posts() ) : $query->the_post();
                    ?>
                    <div class="p-item">
                        <a href="<?php echo get_permalink(); ?>" class="p-img">
                            
                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                            
                        </a>
                        <div class="info">
                            <a href="<?php echo get_permalink(); ?>" class="p-name"><?php echo get_the_title(); ?></a>

                            <table>
                                <tbody><tr>
                                    <td width="80">Mã SP:</td>
                                    <td>RAAV178</td>
                                </tr>
                                <tr>
                                    <td>Bảo hành:</td>
                                    <td>36 tháng</td>
                                </tr>
                                <tr>
                                    <td valign="top">Kho hàng:</td>
                                    <td>
                                        
                                        <span class="dongbotonkho">
                                        <span class="detail" style="background: #278c56; color: #fff; padding: 2px 10px; white-space: pre-line;"><i class="far fa-check"></i> Còn hàng</span>
                                      </span>
                                        
                                    </td>
                                </tr>
                            </tbody></table>
                            <span class="p-price"><?php $product = wc_get_product( get_the_ID() ); echo number_format( $product->get_price() , 0, '', '.'); ?> đ</span>
                        </div>

                        
                        <span class="btn-buy js-select-product" data-id="<?php echo get_the_ID(); ?>"></span>
                        
                    </div>
                    <?php
                        endwhile;
                    ?>
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
    <?php
    wp_reset_postdata();
die();//bắt buộc phải có khi kết thúc

}


add_action( 'wp_ajax_getdanhmuc', 'getdanhmuc_init' );
add_action( 'wp_ajax_nopriv_getdanhmuc', 'getdanhmuc_init' );
function getdanhmuc_init() {
    $cat_id = isset($_POST['cat_id']) ? (int)$_POST['cat_id'] : 0;
    echo '<ul>';

    $args = array(
        'post_type'             => 'product',
        'post_status'           => 'publish',
        'ignore_sticky_posts'   => 1,
        'posts_per_page'        => '12',
        'tax_query'             => array(
            array(
                'taxonomy'      => 'product_cat',
                'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                'terms'         => $cat_id,
                'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
            ),
            array(
                'taxonomy'      => 'product_visibility',
                'field'         => 'slug',
                'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                'operator'      => 'NOT IN'
            )
        )
    );
       $getposts = new WP_query($args); 
       //$getposts->query('post_status=publish&showposts=-1&terms='.$cat_id);
       global $wp_query; $wp_query->in_the_loop = true;
       while ($getposts->have_posts()) : $getposts->the_post();
          echo '<li>';
          echo '<a href="'.get_the_permalink().'">'.get_the_title().'</a>';
          echo '</li>';
       endwhile; wp_reset_postdata();
    echo '</ul>';
    die(); 

    ?>


    <?php
    //die();//bắt buộc phải có khi kết thúc

    }


add_action( 'wp_ajax_deleteitem', 'deleteitem' );
add_action( 'wp_ajax_nopriv_deleteitem', 'deleteitem' );
function deleteitem() {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $cat_id = isset($_POST['cat_id']) ? (int)$_POST['cat_id'] : 0;

    for($i=0;$i<count($_SESSION['sanphambuildpc']);$i++){
        if($_SESSION['sanphambuildpc'][$i]['cat_id']==$cat_id){
            unset($_SESSION['sanphambuildpc'][$i]);
        }
    }
    $_SESSION['sanphambuildpc'] = array_values($_SESSION['sanphambuildpc']);

    echo 'ok';
    die(); 

    ?>


    <?php
    //die();//bắt buộc phải có khi kết thúc

    }

add_action( 'wp_ajax_updateitem', 'updateitem' );
add_action( 'wp_ajax_nopriv_updateitem', 'updateitem' );
function updateitem() {
    //$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $cat_id = isset($_POST['cat_id']) ? (int)$_POST['cat_id'] : 0;
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;

    for($i=0;$i<count($_SESSION['sanphambuildpc']);$i++){
        if($_SESSION['sanphambuildpc'][$i]['cat_id']==$cat_id){
            //unset($_SESSION['sanphambuildpc'][$i]);
            $_SESSION['sanphambuildpc'][$i]['sl']=$quantity;
        }
    }
    $_SESSION['sanphambuildpc'] = array_values($_SESSION['sanphambuildpc']);

    echo 'ok';
    die(); 

    ?>


    <?php
    //die();//bắt buộc phải có khi kết thúc

    }

    

add_action( 'wp_ajax_example_ajax_request', 'example_ajax_request' );
add_action( 'wp_ajax_nopriv_example_ajax_request', 'example_ajax_request' );
function example_ajax_request() {
    if ( isset($_GET) ) {
       if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
        
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $cat_id = isset($_GET['cat_id']) ? (int)$_GET['cat_id'] : 0;
        $product_info = wc_get_product( $id );

        //$_SESSION['sanphambuildpc'][] = $id;
        $replaced_idsp = false;
        for($i=0;$i<count($_SESSION['sanphambuildpc']);$i++){
            if($_SESSION['sanphambuildpc'][$i]['cat_id']==$cat_id){
                $_SESSION['sanphambuildpc'][$i]['id']=$id;
                $_SESSION['sanphambuildpc'][$i]['sl']=1;
                $replaced_idsp=true;
            }
        }
    
        if($replaced_idsp==false){
            $_SESSION['sanphambuildpc'][] = array('cat_id'=>$cat_id,
                                                'id'=>$product_info->get_id(),
                                                 'sl'=>1                       
                                                    );
        }
            

           //$fruit = $_GET['id'];
           //echo $fruit;
           //echo $product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_info->get_the_ID() ), 'single-post-thumbnail' );
           $image_id  = $product_info->get_image_id();
            $image_url = wp_get_attachment_image_url( $image_id, 'full' );
           echo '{
            "id": "'.$_GET['id'].'",
            "productId": "'.$_GET['id'].'",
            "isOn": "1",
            "productPath": [
                {
                    "path": [
                        {
                            "id": "6",
                            "url": "\/linh-kien-may-tinh",
                            "name": "Linh Ki\u1ec7n M\u00e1y T\u00ednh"
                        },
                        {
                            "id": "31",
                            "url": "\/cpu-bo-vi-xu-ly",
                            "name": "CPU - B\u1ed9 vi x\u1eed l\u00fd"
                        },
                        {
                            "id": "617",
                            "url": "\/cpu-intel",
                            "name": "CPU Intel"
                        },
                        {
                            "id": "836",
                            "url": "\/cpu-intel-core-i3",
                            "name": "CPU Intel Core i3"
                        }
                    ],
                    "path_url": "<a href=\"\/linh-kien-may-tinh\">Linh Ki\u1ec7n M\u00e1y T\u00ednh<\/a>  &gt;&gt; <a href=\"\/cpu-bo-vi-xu-ly\">CPU - B\u1ed9 vi x\u1eed l\u00fd<\/a>  &gt;&gt; <a href=\"\/cpu-intel\">CPU Intel<\/a>  &gt;&gt; <a href=\"\/cpu-intel-core-i3\">CPU Intel Core i3<\/a> "
                }
            ],
            "productModel": "'.$product_info->get_sku().'",
            "productSKU": "'.$product_info->get_sku().'",
            "productUrl": "'.$product_info->get_permalink().'",
            "productName": "'.$product_info->get_name().'",
            "productImage": {
                "thum": "'.$image_url.'",
                "small": "'.$image_url.'",
                "medium": "'.$image_url.'",
                "large": "'.$image_url.'",
                "original": "'.$image_url.'"
            },
            "price": "'.$product_info->get_price().'",
            "currency": "vnd",
            "promotion_price": "0",
            "priceUnit": "chi\u1ebfc",
            "marketPrice": "0",
            "brand": {
                "id": "21",
                "brand_index": "intel",
                "name": "INTEL",
                "summary": "",
                "image": "https:\/\/hanoicomputercdn.com\/media\/brand\/intel.jpg",
                "product": "0",
                "status": "1",
                "is_featured": "0",
                "ordering": "0",
                "letter": "I",
                "lastUpdate": "2020-04-11 15:28:54",
                "brand_page_view": "0",
                "meta_title": "INTEL, Th\u00f4ng Tin V\u00e0 S\u1ea3n Ph\u1ea9m C\u1ee7a H\u00e3ng INTEL - HANOICOMPUTER",
                "meta_keywords": "",
                "meta_description": "INTEL | Linh ki\u1ec7n, Mainboard, CPU, M\u00e1y t\u00ednh v\u0103n ph\u00f2ng mini v.v. Gi\u00e1 r\u1ebb \u2713 Ch\u1ea5t l\u01b0\u1ee3ng \u2713 Ch\u00ednh h\u00e3ng \u2713 \u01afu \u0111\u00e3i h\u1ea5p d\u1eabn \u2713 Ch\u00ednh s\u00e1ch chu \u0111\u00e1o t\u1ea1i HANOICOMPUTER",
                "sellerId": "0",
                "description": ""
            },
            "productSummary": "D\u00f2ng Core i3 th\u1ebf h\u1ec7 th\u1ee9 10 d\u00e0nh cho m\u00e1y b\u00e0n c\u1ee7a Intel\r\n4 nh\u00e2n & 8 lu\u1ed3ng\r\nXung nh\u1ecbp: 3.6GHz (C\u01a1 b\u1ea3n) \/ 4.3GHz (Boost)\r\nSocket: LGA1200\r\n\u0110\u00e3 k\u00e8m s\u1eb5n t\u1ea3n nhi\u1ec7t t\u1eeb h\u00e3ng\r\nKh\u00f4ng k\u00e8m s\u1eb5n iGPU, c\u1ea7n s\u1eed d\u1ee5ng c\u00f9ng VGA r\u1eddi",
            "package_accessory": "0",
            "productImageGallery": [
                {
                    "folder": "standard",
                    "size": {
                        "thum": "'.$image_url.'",
                        "small": "'.$image_url.'",
                        "medium": "'.$image_url.'",
                        "large": "'.$image_url.'",
                        "original": "'.$image_url.'"
                    },
                    "alt": "'.$product_info->get_name().'"
                },
                {
                    "folder": "standard",
                    "size": {
                        "thum": "https:\/\/hanoicomputercdn.com\/media\/product\/50_55894_cpu_intel_core_i3_10100f_22.jpg",
                        "small": "https:\/\/hanoicomputercdn.com\/media\/product\/75_55894_cpu_intel_core_i3_10100f_22.jpg",
                        "medium": "https:\/\/hanoicomputercdn.com\/media\/product\/120_55894_cpu_intel_core_i3_10100f_22.jpg",
                        "large": "https:\/\/hanoicomputercdn.com\/media\/product\/250_55894_cpu_intel_core_i3_10100f_22.jpg",
                        "original": "https:\/\/hanoicomputercdn.com\/media\/product\/55894_cpu_intel_core_i3_10100f_22.jpg"
                    },
                    "alt": "'.$product_info->get_name().'"
                },
                {
                    "folder": "standard",
                    "size": {
                        "thum": "https:\/\/hanoicomputercdn.com\/media\/product\/50_55894_cpu_intel_core_i3_10100f_33.jpg",
                        "small": "https:\/\/hanoicomputercdn.com\/media\/product\/75_55894_cpu_intel_core_i3_10100f_33.jpg",
                        "medium": "https:\/\/hanoicomputercdn.com\/media\/product\/120_55894_cpu_intel_core_i3_10100f_33.jpg",
                        "large": "https:\/\/hanoicomputercdn.com\/media\/product\/250_55894_cpu_intel_core_i3_10100f_33.jpg",
                        "original": "https:\/\/hanoicomputercdn.com\/media\/product\/55894_cpu_intel_core_i3_10100f_33.jpg"
                    },
                    "alt": "'.$product_info->get_name().'"
                },
                {
                    "folder": "standard",
                    "size": {
                        "thum": "https:\/\/hanoicomputercdn.com\/media\/product\/50_55894_cpu_intel_core_i3_10100f.jpg",
                        "small": "'.$image_url.'",
                        "medium": "https:\/\/hanoicomputercdn.com\/media\/product\/120_55894_cpu_intel_core_i3_10100f.jpg",
                        "large": "https:\/\/hanoicomputercdn.com\/media\/product\/250_55894_cpu_intel_core_i3_10100f.jpg",
                        "original": "https:\/\/hanoicomputercdn.com\/media\/product\/55894_cpu_intel_core_i3_10100f.jpg"
                    },
                    "alt": "'.$product_info->get_name().'"
                }
            ],
            "productImageCount": "4",
            "warranty": "36 Th\u00e1ng",
            "specialOffer": {
                "all": []
            },
            "specialOfferGroup": [],
            "shipping": "0",
            "quantity": "23",
            "visit": "4046",
            "status": "1",
            "configCount": "0",
            "configList": "",
            "comboCount": "0",
            "buy_count": "0",
            "has_video": "0",
            "manual_url": "",
            "hasVAT": "1",
            "productType": {
                "isNew": 0,
                "isHot": 0,
                "isBestSale": 0,
                "isSaleOff": 0,
                "online-only": 0
            },
            "condition": "",
            "config_count": "0",
            "extend": {
                "product_name_h1": "",
                "more_price_1": "0",
                "more_price_2": "0",
                "more_price_3": "0"
            },
            "meta_title": "CPU Intel Core i3-10100F (3.6GHz turbo up to 4.3Ghz, 4 nh\u00e2n 8 lu\u1ed3ng, 6MB Cache, 65W) - Socket Intel LGA 1200",
            "meta_keyword": "",
            "meta_description": "Mua CPU Intel Core i3-10100F ch\u00ednh h\u00e3ng t\u1ea1i HANOICOMPUTER! Build PC gi\u00e1 t\u1ed1t, khuy\u1ebfn m\u00e3i h\u1ea5p d\u1eabn t\u1ea1i HANOICOMPUTER! D\u1ecbch v\u1ee5 uy t\u00edn. Ph\u1ee5c v\u1ee5 t\u1eadn t\u00e2m. Mua ngay!",
            "last_update": "2020-10-14T08:14:06+0700",
            "supplier": false,
            "bulk_price": [],
            "thum_poster": "0",
            "thum_poster_type": "",
            "sale_rules": {
                "price": "2399000",
                "normal_price": "2399000",
                "min_purchase": 1,
                "max_purchase": "23",
                "remain_quantity": "23",
                "from_time": 0,
                "to_time": 0,
                "type": ""
            },
            "deal_list": [],
            "related": {
                "product": [],
                "article-article": []
            },
            "categoryInfo": [
                {
                    "id": "836",
                    "name": "CPU Intel Core i3",
                    "summary": "<p>C&aacute;c con chip Core I5, I7 hay th\u1eadm ch&iacute; l&agrave; Core I9 hi\u1ec7n nay \u0111\u01b0\u1ee3c coi l&agrave; c\u1ea5u h&igrave;nh ti&ecirc;u chu\u1ea9n cho c&aacute;c b\u1ed9 m&aacute;y t\u1ea7m trung tr\u1edf n&ecirc;n. Nh\u01b0ng v\u1edbi s\u1ef1 ph&aacute;t tri\u1ec3n c\u1ee7a m&igrave;nh, CPU Intel Core I3 th\u1ebf h\u1ec7 th\u1ee9 10 c\u0169ng c&oacute; s\u1ee9c m\u1ea1nh kh&ocirc;ng k&eacute;m g&igrave; nh\u1eefng con chip I7 \u0111\u1eddi c\u0169. B\u1edfi v\u1eady, ch\u1eb3ng c&oacute; l\u1ebd g&igrave; b\u1ea1n kh&ocirc;ng mua m\u1ed9t con chip I3 \u0111\u1ec3 s\u1eed d\u1ee5ng k",
                    "is_featured": "0",
                    "isParent": "0",
                    "url": "\/cpu-intel-core-i3",
                    "parentId": "617",
                    "thumnail": ""
                }
            ],
            "tag_list": [],
            "addon": []
        }';
           wp_die();
       }
       die();
    }
   }


   add_action( 'wp_ajax_getinfosaved', 'getinfosaved_init' );
   add_action( 'wp_ajax_nopriv_getinfosaved', 'getinfosaved_init' );
   function getinfosaved_init() {
       if ( isset($_POST) ) {
          if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
            
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
                        $array_product[$cate[$i]->object_id]=$product_item;
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
            echo json_encode($array_product);
            }else{
                echo "[]";
            }
               

        }

        wp_die();
          }
          
        }
        
        function title_filter( $where, &$wp_query )
        {
            global $wpdb;
            if ( $search_term = $wp_query->get( 'search_prod_title' ) ) {
                $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\'';
            }
            return $where;
        }
  

  // ĐÂY LÀ CHỖ CHO AJAX SEARCH
  add_action( 'wp_ajax_timkiem', 'timkiem' );
add_action( 'wp_ajax_nopriv_timkiem', 'timkiem' );
function timkiem() {
    $search_string = isset($_POST['searchstring']) ? $_POST['searchstring'] : "";
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : "";
    // global $wpdb; // Biến toàn cục lớp $wpdb được sử dụng trong khi tương tác với databse wordpress
    //  $table = $wpdb->prefix . 'posts'; // Khai báo bảng cần lấy
    //  $sql = "SELECT * FROM {$table} 
    //     INNER JOIN $wpdb->term_relationships ON wp_term_relationships.object_id = wp_posts.ID
        
    //     WHERE `post_type` = 'product' and wp_term_relationships.term_taxonomy_id = '".$category_id."' and (`post_title` LIKE '%".$search_string."%' OR `post_title` LIKE '".$search_string."%')
    //  ";
    //  $data = $wpdb->get_results( $wpdb->prepare($sql, $limit, $offset), ARRAY_A); // thực thi câu query, trả về dữ liệu trong biến $data
    
    
    // $args = array(
    //     'post_type'     => 'product',
    //     'post_status'   => 'publish',
    //     'posts_per_page' => -1,

    //     'tax_query'      => array( array(
    //         'taxonomy'   => 'product_cat',
    //         'field'      => 'term_id',
    //         'terms'      => $category_id,
    //     ) ),

    //     'search_prod_title' => $search_string,
    // );

    // $query = new WP_Query($args);
    // $posts = $query->posts;


    $args = array(
        'post_type' => 'product',
        'post_status'   => 'publish',
        'search_prod_title' => $search_term,
        'post_status' => 'publish',
        'orderby'     => 'title', 
        'order'       => 'ASC'
    );
    
    add_filter( 'posts_where', 'title_filter', 10, 2 );
    $wp_query = new WP_Query($args);
    remove_filter( 'posts_where', 'title_filter', 10, 2 );
    $posts = $wp_query->posts; ///cần convert to aarayy
    // return $wp_query;



       print_r( $wp_query); 
      
    ?>

<script>
    jQuery(".icon-menu-filter-mobile").click(function(){
        jQuery(".build-pc .popup-select .popup-main .popup-main_filter").toggle();
    });

    // var SEARCH_URL = "https://nghiakhoi.ddns.net:8888/wp-admin/custom-ajax.php";
    var SEARCH_URL = "<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>";

    function loadAjaxContent(holder_id, url){
        objBuildPCVisual.showProductFilter(url);
    }

    function searchKeyword(query,category_id) {
        if(query.length < 2) return ;
        objBuildPCVisual.searchProductFilter(SEARCH_URL, encodeURIComponent(query),category_id);
    }

    jQuery("#buildpc-search-keyword").keypress(function(e) {
        var category_id = jQuery("#buildpc-search-keyword").data("category-id");
        if(e.which == 13) {
            e.preventDefault();
            searchKeyword(this.value,category_id);
        }
    });

    jQuery("#js-buildpc-search-btn").on("click", function(){
        searchKeyword(jQuery("#buildpc-search-keyword").val());
    });
</script>

<div id="js-modal-popup"><div class="mask-popup active">
    <div class="close-pop-biuldpc" onclick="closePopup()" style="width: 100%;float: left;height: 100%;position: fixed;z-index: 1;"></div>
    <div class="popup-select" style="z-index: 99;">
        <div class="header">
            <h4>Chọn linh kiện</h4>
            <form action="">
                <input type="text" value="" data-category-id="<?php echo $category_id;?>" id="buildpc-search-keyword" class="input-search" placeholder="Bạn cần tìm linh kiện gì?">
                <span class="btn-search"><i class="far fa-search" id="js-buildpc-search-btn"></i></span>
                <div class="icon-menu-filter-mobile"><i class="fal fa-filter"></i> Lọc</div>
            </form>

            <span class="close-popup" onclick="closePopup()"><i class="fal fa-times"></i></span>
        </div>
        <div class="popup-main">
            
            <div class="popup-main_content w-100 float_r">
                <div class="sort-paging clear">
                    <div class="sort-block float_l">
                        <span>Sắp xếp: </span>
                        <select style="position: relative;    top: -40px;    left: 70px;"  onchange="if(this.value != '') { objBuildPCVisual.showProductFilter(this.value) }">
                            <option value="">Tùy chọn</option>
                            
                            <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=new">Mới nhất</option>
                            
                            <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=price-asc">Giá tăng dần</option>
                            
                            <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=price-desc">Giá giảm dần</option>
                            
                            <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=view">Lượt xem</option>
                            
                            <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=rating">Đánh giá</option>
                            
                            <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=name">Tên A-&gt;Z</option>
                            
                        </select>
                    </div>

                    
                    <div class="paging-block float_r paging-ajax">
                        <table cellpadding="0" cellspacing="0"><tbody><tr><td class="pagingIntact"><a>Xem</a></td><td class="pagingSpace"></td><td class="pagingViewed">1</td><td class="pagingSpace"></td><td class="pagingIntact"><a href="javascript:;" onclick="loadAjaxContent('', '/ajax/get_json.php?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;storeId=&amp;&amp;page=2')">2</a></td><td class="pagingSpace"></td><td class="pagingIntact"><a href="javascript:;" onclick="loadAjaxContent('', '/ajax/get_json.php?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;storeId=&amp;&amp;page=3')">3</a></td><td class="pagingSpace"></td><td class="pagingIntact"><a href="javascript:;" onclick="loadAjaxContent('', '/ajax/get_json.php?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;storeId=&amp;&amp;page=4')">4</a></td><td class="pagingSpace"></td><td class="pagingIntact"><a href="javascript:;" onclick="loadAjaxContent('', '/ajax/get_json.php?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;storeId=&amp;&amp;page=5')">5</a></td><td class="pagingSpace"></td><td class="pagingIntact"><a href="javascript:;" onclick="loadAjaxContent('', '/ajax/get_json.php?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;storeId=&amp;&amp;page=6')">6</a></td><td class="pagingSpace"></td><td class="pagingIntact"><a href="javascript:;" onclick="loadAjaxContent('', '/ajax/get_json.php?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;storeId=&amp;&amp;page=7')">7</a></td><td class="pagingSpace"></td><td class="pagingFarSide" align="center">...</td><td class="pagingIntact"><a href="javascript:;" onclick="loadAjaxContent('', '/ajax/get_json.php?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;storeId=&amp;&amp;page=2')">&gt;&gt;</a></td></tr></tbody></table>
                    </div>
                </div>

                <div class="list-product-select">

                    <?php
                    foreach($data as $value){

                    
                    ?>
                    <div class="p-item">
                        <a href="<?php echo get_site_url(null,'/product/'.$value['post_name'],null); ?>" class="p-img">
                            
                            <img src="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $value['ID'] ), 'single-post-thumbnail' ); echo $image[0]; ?>" alt="<?php echo get_the_title(); ?>">
                            
                        </a>
                        <div class="info">
                            <a href="<?php echo get_site_url(null,'/product/'.$value['post_name'],null); ?>" class="p-name"><?php echo $value['post_title']; ?></a>

                            <table>
                                <tbody><tr>
                                    <td width="80">Mã SP:</td>
                                    <td>RAAV178</td>
                                </tr>
                                <tr>
                                    <td>Bảo hành:</td>
                                    <td>36 tháng</td>
                                </tr>
                                <tr>
                                    <td valign="top">Kho hàng:</td>
                                    <td>
                                        
                                        <span class="dongbotonkho">
                                        <span class="detail" style="background: #278c56; color: #fff; padding: 2px 10px; white-space: pre-line;"><i class="far fa-check"></i> Còn hàng</span>
                                      </span>
                                        
                                    </td>
                                </tr>
                            </tbody></table>
                            <span class="p-price"><?php $product = wc_get_product( $value['ID'] ); echo number_format( $product->get_price() , 0, '', '.'); ?> đ</span>
                        </div>

                        
                        <span class="btn-buy js-select-product" data-id="<?php echo $value['ID']; ?>"></span>
                        
                    </div>
                    <?php
                        }
                    ?>
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
   
die();//bắt buộc phải có khi kết thúc

}


 // ĐÂY LÀ CHỖ CHO AJAX SEARCH BY ATTRIBUTES
 add_action( 'wp_ajax_timkiembyattribute', 'timkiembyattribute' );
 add_action( 'wp_ajax_nopriv_timkiembyattribute', 'timkiembyattribute' );
 function timkiembyattribute() {
     $search_string = isset($_GET['searchstring']) ? $_GET['searchstring'] : "";
     $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : "";
     $sortproduct = isset($_GET['sort']) ? $_GET['sort'] : "";
     
    if($sortproduct=="price-asc"){
        $query = new WP_Query( array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'tax_query'      => array( array(
                'taxonomy'   => 'product_cat',
                'field'      => 'term_id',
                'terms'      => $category_id,
            ) ),
            'orderby' => 'meta_value_num',
            'meta_key' => '_price',
            'order' => 'asc'
        ) );
        echo "sort here";
    }
    if($sortproduct=="price-desc"){
        $query = new WP_Query( array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'tax_query'      => array( array(
                'taxonomy'   => 'product_cat',
                'field'      => 'term_id',
                'terms'      => $category_id,
            ) ),
            'orderby' => 'meta_value_num',
            'meta_key' => '_price',
            'order' => 'desc'
        ) );
    }
    if($sortproduct=="name"){
        $query = new WP_Query( array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'tax_query'      => array( array(
                'taxonomy'   => 'product_cat',
                'field'      => 'term_id',
                'terms'      => $category_id,
            ) ),
            'orderby' => 'title',
            'order' => 'asc'
        ) );
    }
     
     
     ?>

 <script>
     jQuery(".icon-menu-filter-mobile").click(function(){
         jQuery(".build-pc .popup-select .popup-main .popup-main_filter").toggle();
     });
 
     // var SEARCH_URL = "https://nghiakhoi.ddns.net:8888/wp-admin/custom-ajax.php";
     var SEARCH_URL = "<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>";
 
     function loadAjaxContent(holder_id, url){
         objBuildPCVisual.showProductFilter(url);
     }
 
     function searchKeyword(query,category_id) {
         if(query.length < 2) return ;
         objBuildPCVisual.searchProductFilter(SEARCH_URL, encodeURIComponent(query),category_id);
     }
 
     jQuery("#buildpc-search-keyword").keypress(function(e) {
         var category_id = jQuery("#buildpc-search-keyword").data("category-id");
         if(e.which == 13) {
             e.preventDefault();
             searchKeyword(this.value,category_id);
         }
     });
 
     jQuery("#js-buildpc-search-btn").on("click", function(){
         searchKeyword(jQuery("#buildpc-search-keyword").val());
     });
 </script>
 
 <div id="js-modal-popup"><div class="mask-popup active">
     <div class="close-pop-biuldpc" onclick="closePopup()" style="width: 100%;float: left;height: 100%;position: fixed;z-index: 1;"></div>
     <div class="popup-select" style="z-index: 99;">
         <div class="header">
             <h4>Chọn linh kiện</h4>
             <form action="">
                 <input type="text" value="" data-category-id="<?php echo $category_id;?>" id="buildpc-search-keyword" class="input-search" placeholder="Bạn cần tìm linh kiện gì?">
                 <span class="btn-search"><i class="far fa-search" id="js-buildpc-search-btn"></i></span>
                 <div class="icon-menu-filter-mobile"><i class="fal fa-filter"></i> Lọc</div>
             </form>
 
             <span class="close-popup" onclick="closePopup()"><i class="fal fa-times"></i></span>
         </div>
         <div class="popup-main">
             <!-- temp filter main hereeeeeeeee -->
             <div class="popup-main_content w-100 float_r">
                 <div class="sort-paging clear">
                     <div class="sort-block float_l">
                         <span>Sắp xếp: </span>
                         <select style="position: relative;    top: -40px;    left: 70px;"  onchange="if(this.value != '') { objBuildPCVisual.showProductFilter(this.value) }">
                             <option value="">Tùy chọn</option>
                             
                             <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=new">Mới nhất</option>
                             
                             <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=price-asc">Giá tăng dần</option>
                             
                             <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=price-desc">Giá giảm dần</option>
                             
                             <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=view">Lượt xem</option>
                             
                             <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=rating">Đánh giá</option>
                             
                             <option value="<?php echo get_site_url(null,'wp-admin/custom-ajax.php',null); ?>?action=timkiembyattribute&amp;action_type=get-product-category&amp;category_id=<?php echo $category_id; ?>&amp;pc_part_id=55008-30%2C54098-31&amp;sort=name">Tên A-&gt;Z</option>
                             
                         </select>
                     </div>
 
                     
                 </div>
 
                 <div class="list-product-select">
 
                 <?php echo "aaaaaa";
                    while ( $query->have_posts() ) : $query->the_post();
                    ?>
                    <div class="p-item">
                        <a href="<?php echo get_permalink(); ?>" class="p-img">
                            
                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                            
                        </a>
                        <div class="info">
                            <a href="<?php echo get_permalink(); ?>" class="p-name"><?php echo get_the_title(); ?></a>

                            <table>
                                <tbody><tr>
                                    <td width="80">Mã SP:</td>
                                    <td>RAAV178</td>
                                </tr>
                                <tr>
                                    <td>Bảo hành:</td>
                                    <td>36 tháng</td>
                                </tr>
                                <tr>
                                    <td valign="top">Kho hàng:</td>
                                    <td>
                                        
                                        <span class="dongbotonkho">
                                        <span class="detail" style="background: #278c56; color: #fff; padding: 2px 10px; white-space: pre-line;"><i class="far fa-check"></i> Còn hàng</span>
                                      </span>
                                        
                                    </td>
                                </tr>
                            </tbody></table>
                            <span class="p-price"><?php $product = wc_get_product( get_the_ID() ); echo number_format( $product->get_price() , 0, '', '.'); ?> đ</span>
                        </div>

                        
                        <span class="btn-buy js-select-product" data-id="<?php echo get_the_ID(); ?>"></span>
                        
                    </div>
                    <?php
                        endwhile;
                    ?>
                     
                     
                     
                     
                 </div>
             </div>
         </div>
     </div>
 </div>
 
     <?php
    
 die();//bắt buộc phải có khi kết thúc
 
 }


 add_action( 'wp_ajax_getsaveconfig', 'getsaveconfig_init' );
add_action( 'wp_ajax_nopriv_getsaveconfig', 'getsaveconfig_init' );
function getsaveconfig_init() {
    $cat_id = isset($_POST['cat_id']) ? (int)$_POST['cat_id'] : 0;
    echo '<ul>';

    $args = array(
        'post_type'             => 'product',
        'post_status'           => 'publish',
        'ignore_sticky_posts'   => 1,
        'posts_per_page'        => '12',
        'tax_query'             => array(
            array(
                'taxonomy'      => 'product_cat',
                'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                'terms'         => $cat_id,
                'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
            ),
            array(
                'taxonomy'      => 'product_visibility',
                'field'         => 'slug',
                'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                'operator'      => 'NOT IN'
            )
        )
    );
       $getposts = new WP_query($args); 
       //$getposts->query('post_status=publish&showposts=-1&terms='.$cat_id);
       global $wp_query; $wp_query->in_the_loop = true;
       while ($getposts->have_posts()) : $getposts->the_post();
          echo '<li>';
          echo '<a href="'.get_the_permalink().'">'.get_the_title().'</a>';
          echo '</li>';
       endwhile; wp_reset_postdata();
    echo '</ul>';
    die(); 

    ?>


    <?php
    //die();//bắt buộc phải có khi kết thúc

    }