<?php
require_once("/var/www/html/soulShape/wp/soulshape.earth/wp-load.php");
require_once( ABSPATH . 'wp-admin/includes/image.php' );
require_once( ABSPATH . 'wp-admin/includes/file.php' );
require_once( ABSPATH . 'wp-admin/includes/media.php' );

/* Sketchfab upload */
$fileType = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
$uploadOk = 0;
$allowed_files_type = ['stl', 'STL', 'obj', 'OBJ'];

// Check if file type is allowed
for($x = 0; $x < count($allowed_files_type); $x++)
{
    $var = $allowed_files_type[$x];

    if($fileType == $var)
        $uploadOk = 1;
}

if($uploadOk == 0)
    echo "<script type='text/javascript'>alert('Sorry, this files type are not allowed.')</script>";

// Check file size (50M)
if ($_FILES["fileToUpload"]["size"] > 50000000)
{
    echo '<script type="text/javascript">alert("Sorry, your file is too large.")</script>';
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk != 0)
{
    //Add extension
    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $_FILES['fileToUpload']['tmp_name'].'.'.$fileType);

    $params = array(
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'modelFile' => new CurlFile($_FILES['fileToUpload']['tmp_name'].'.'.$fileType),
        'token' => 'f0e7f420491b43d59d8799ae555838ff',
        'private' => 0,
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_URL, 'https://api.sketchfab.com/v2/models');

    $result = curl_exec($ch);

    if(is_null($result)) {
        echo "<script>alert('Something gone wrong during upload, retry');</script>";
        exit(100);
    }
}
/* Sketchfab upload */

/* Woocommerce product insert */
$name = $_POST['name'];
$uid = preg_split('/"/', $result)[3];
//$short_desc = $_POST['short_desc'];
$short_desc = '';
$long_desc = $_POST['long_desc'];
$population = $_POST['population'];
$length = $_POST['length'];
$width = $_POST['width'];
$height = $_POST['height'];
$age = $_POST['age'];
$country = $_POST['country'];
$material = $_POST['material'];
$price = 5;

$post = array(
    'post_author' => $user_id,
    'post_excerpt' => $short_desc,
    'post_content' => $long_desc,
    'post_status' => "publish",
    'post_title' => $name,
    'post_parent' => '',
    'post_type' => "product",
);

//Create post
$post_id = wp_insert_post($post, $wp_error);

if($post_id) {
    $image = media_handle_upload('image');
    add_post_meta($post_id, '_thumbnail_id', $image);

    wp_set_object_terms($post_id, '3D Model', 'product_cat');
    wp_set_object_terms($post_id, 'simple', 'product_type');

    update_post_meta($post_id, '_visibility', 'visible');
    update_post_meta($post_id, '_stock_status', 'instock');
    update_post_meta($post_id, 'total_sales', '0');
    update_post_meta($post_id, '_downloadable', 'yes');
    update_post_meta($post_id, '_virtual', 'yes');
    update_post_meta($post_id, '_regular_price', $price);
    update_post_meta($post_id, '_purchase_note', "");
    update_post_meta($post_id, '_featured', "no");
    update_post_meta($post_id, '_length', $length);
    update_post_meta($post_id, '_width', $width);
    update_post_meta($post_id, '_height', $height);
    update_post_meta($post_id, '_sku', "");

    $data = Array('pa_population'=>Array(
        'name'=>'pa_population',
        'value'=>'',
        'is_visible'=>'1',
        'is_variation'=>'1',
        'is_taxonomy'=>'1'
    ), 'pa_age'=>Array(
        'name'=>'pa_age',
        'value'=>'',
        'is_visible'=>'1',
        'is_variation'=>'1',
        'is_taxonomy'=>'1'
    ), 'pa_country'=>Array(
        'name'=>'pa_country',
        'value'=>'',
        'is_visible'=>'1',
        'is_variation'=>'1',
        'is_taxonomy'=>'1'
    ), 'pa_material'=>Array(
        'name'=>'pa_material',
        'value'=>'',
        'is_visible'=>'1',
        'is_variation'=>'1',
        'is_taxonomy'=>'1'
    ));

    update_post_meta($post_id, '_product_attributes', $data);
    wp_set_object_terms($post_id, $population, "pa_population", $true);
    wp_set_object_terms($post_id, $age, "pa_age", $true);
    wp_set_object_terms($post_id, $country, "pa_country", $true);
    wp_set_object_terms($post_id, $material, "pa_material", $true);

    update_post_meta($post_id, '_sale_price_dates_from', "");
    update_post_meta($post_id, '_sale_price_dates_to', "");
    update_post_meta($post_id, '_price', $price);
    update_post_meta($post_id, '_sold_individually', "");
    update_post_meta($post_id, '_manage_stock', "no");
    update_post_meta($post_id, '_backorders', "no");
    update_post_meta($post_id, '_stock', "");
    update_post_meta($post_id, 'post_iframe', '<iframe width="640" height="480" src="https://sketchfab.com/models/'.$uid.'/embed" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" onmousewheel=""></iframe>');
    update_post_meta( $post_id, '_download_limit', '');
    update_post_meta( $post_id, '_download_expiry', '');
    update_post_meta( $post_id, '_download_type', '');
}

/* Woocommerce product insert */
$shop_url = "http://2.236.89.96/soulShape/wp/soulshape.earth/?post_type=product";
header('Location: '.$shop_url);
?>
