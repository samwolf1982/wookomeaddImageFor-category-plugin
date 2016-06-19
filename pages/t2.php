<?php
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
/*if ( current_user_can( 'manage_options' ) ) {
global $wpdb;
print_r( $wpdb->queries );
}*/

//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Menu Test Plugin Options', 'mt_trans_domain' ) . "</h2>";

    // options form
    
    ?>
   <?php
//*******
//$temp_tax= get_term( 67);

//print_r($temp_tax);
//die();
//*******


$counterS=0;

global $wpdb;




//die();
//      well done start 
$desc = "GOu GOu";


$c= $wpdb->get_results( "SELECT * FROM `wp_terms` where 1 " );
foreach ( $c as $livepost ) {
      
$id_F  =$livepost->term_id;

//$id_F=71;
$temp_tax= get_term( $id_F);
 $db= $wpdb->get_var( "   SELECT `parent` FROM `wp_term_taxonomy` where `term_id` = $id_F"  );  

          //36       id автостекло
 if (!is_null($db) & $db!=0 &$db !=36 ) {
$url=null;
$search=$livepost->name;
$all= $wpdb->get_results( "SELECT * FROM `wp_productparse` where 1 " );
foreach ( $all as $s ) {
       $j= json_decode($s->bred2);
      foreach ($j as $key => $value) {

       $key=trim( $key,'›');
       if ($key== $search) {
         # code... url ok
        //echo "<br>i did".str_replace('.html','',$s->url)."<br>";


       // print_r($key.' ******** '.$value);
        $sss='http://light-glass.com.ua'.$value;
        // echo "SSS ".$sss;
       // continue;
//die();
         $urlSearch= $wpdb->get_row( "SELECT * FROM `wp_grouplikeproduct` WHERE `url` LIKE ('%".$sss."%')");
               if(!is_null($urlSearch)){
                      
                        $url=$urlSearch->metaimg;;
                        $counterS++;   
               }


        // break;
            }
         }

//$id_F  =$s->term_id;
}




if (is_null($url)) {
  # code...
  continue;
}


print_r("<br>$counterS : IMG :".$url);
//continue;


//  download
$filename = media_sideload_image($url, 0, $desc,'src');
$filename=str_replace('http://localhost2/wp-content', '/home/sam/sites/localhost2/wp-content', $filename);
//print_r($filename."<br>");

//      
//die();
// The ID of the post this attachment is for.
//$parent_post_id = 62;

// Check the type of file. We'll use this as the 'post_mime_type'.
$filetype = wp_check_filetype( basename( $filename ), null );

// Get the path to the upload directory.
$wp_upload_dir = wp_upload_dir();

// Prepare an array of post data for the attachment.
$attachment = array(
  'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
  'post_mime_type' => $filetype['type'],
  'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
  'post_content'   => '',
  'post_status'    => 'inherit'
);

// Insert the attachment.
$attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );








$p_id=$db;

  $r=array ( 'action' => 'editedtag', 'tag_ID' => $id_F, 'taxonomy' => 'product_cat', '_wp_original_http_referer' => 'http://localhost2/wp-admin/edit-tags.php?taxonomy=product_cat&post_type=product', '_wpnonce' => '8434d36c26', '_wp_http_referer' => '/wp-admin/term.php?taxonomy=product_cat&tag_ID=76&post_type=product&wp_http_referer=%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct', 
    'name' => $temp_tax->name,
     'slug' => $temp_tax->slug,
      'parent' => $p_id, 'description' => '', 'display_type' => '', 'product_cat_thumbnail_id' => $attach_id, 'submit' => 'Обновить', );

 $taxonomy= "product_cat";
$_POST=$r;
$ret = wp_update_term( $id_F, $taxonomy, $_POST);
echo 
print_r("RET: ".PHP_EOL.var_export($ret));
print_r("<br>"."ATTID: ".$attach_id);

  // end if NULL from parent 
 }
 else  {
   # code...
  echo "<br> NO parent or parent id == 0";
 }

print_r("<br> id: ".$id_F."  parent: ".$p_id );




        // ebd foreach
 }


die();


// WELL DONE
// end test 



/*$c= $wpdb->get_row( "SELECT *
FROM $wpdb->posts WHERE ID = 1"  );
echo '<p>Total commensts: ' . $c->post_title . '</p>';*/

//    start cat 1
/*
$c= $wpdb->get_results( "SELECT *
FROM wp_grouplikeproduct WHERE  1 GROUP BY `bred1`"  );
foreach ( $c as $livepost ) {
 $j= json_decode($livepost->bred1);
 foreach ($j as $key => $value) {

  $key=trim( $key,'›');

          $db= $wpdb->get_var( "SELECT `term_id` FROM `wp_terms` WHERE `name`='$key'"  );  

 if (!is_null($db)) {
   # code...
 echo '<p>'.$key.' = ' .$db. '</p>';

$url=$livepost->metaimg;
$desc = $key;


//  download
$filename = media_sideload_image($url, 0, $desc,'src');
$filename=str_replace('http://localhost2/wp-content', '/home/sam/sites/localhost2/wp-content', $filename);
echo var_export($filename);

//      

// The ID of the post this attachment is for.
$parent_post_id = 0;

// Check the type of file. We'll use this as the 'post_mime_type'.
$filetype = wp_check_filetype( basename( $filename ), null );

// Get the path to the upload directory.
$wp_upload_dir = wp_upload_dir();

// Prepare an array of post data for the attachment.
$attachment = array(
  'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
  'post_mime_type' => $filetype['type'],
  'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
  'post_content'   => '',
  'post_status'    => 'inherit'
);

// Insert the attachment.
$attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );


$temp_tax= get_term( $db);



//   appay POST  
  $r=array ( 'action' => 'editedtag',
   'tag_ID' => $db,
    'taxonomy' => 'product_cat',
     '_wp_original_http_referer' => 'http://localhost2/wp-admin/term.php?taxonomy=product_cat&tag_ID=65&post_type=product&wp_http_referer=%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct', 
     '_wpnonce' => '63b4717155',
      '_wp_http_referer' => '/wp-admin/term.php?taxonomy=product_cat&tag_ID=65&post_type=product&wp_http_referer=%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct&message=3',
       'name' => $temp_tax->name,
        'slug' => $temp_tax->slug,
         'parent' => $temp_tax->parent, 
         'description' => '', 
         'display_type' => '',
          'product_cat_thumbnail_id' => $attach_id ,
           'submit' => 'Обновить', );  
 $taxonomy= "product_cat";
$_POST=$r;
$ret = wp_update_term( $db, $taxonomy, $r);

echo print_r($ret);


 }




break;
       

 }




//die();
}*/
  ////////   end      cat      1

echo "t2";

//die();


//    start cat 2

$c= $wpdb->get_results( "SELECT * FROM `wp_productparse` group by `bred2` " );
foreach ( $c as $livepost ) {
 $j= json_decode($livepost->bred2);
 foreach ($j as $key => $value) {

  $key=trim( $key,'›');

          $db= $wpdb->get_row( "SELECT `term_id` FROM `wp_terms` WHERE `name`='$key'"  );  
 //echo '<p>'.$key.' = ' .$db->term_id. '</p>  ';
 if (!is_null($db)) {
   # code...
 echo '<p>'.$key.' = ' .$db->term_id. '</p>  ';
        
  /*  $ob= $wpdb->get_row( "SELECT `term_id` FROM `wp_terms` WHERE `name`='$key'"  );  */
    continue;
$url=$livepost->metaimg;
echo $url;
//continue;
$desc = $key;


//  download
$filename = media_sideload_image($url, 0, $desc,'src');
$filename=str_replace('http://localhost2/wp-content', '/home/sam/sites/localhost2/wp-content', $filename);
echo var_export($filename);

//      

// The ID of the post this attachment is for.
$parent_post_id = 62;

// Check the type of file. We'll use this as the 'post_mime_type'.
$filetype = wp_check_filetype( basename( $filename ), null );

// Get the path to the upload directory.
$wp_upload_dir = wp_upload_dir();

// Prepare an array of post data for the attachment.
$attachment = array(
  'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
  'post_mime_type' => $filetype['type'],
  'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
  'post_content'   => '',
  'post_status'    => 'inherit'
);

// Insert the attachment.
$attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );


$temp_tax= get_term( $db->term_id);



//   appay POST  
  $r=array ( 'action' => 'editedtag',
   'tag_ID' => $db->term_id,
    'taxonomy' => 'product_cat',
     '_wp_original_http_referer' => 'http://localhost2/wp-admin/term.php?taxonomy=product_cat&tag_ID=65&post_type=product&wp_http_referer=%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct', 
     '_wpnonce' => '63b4717155',
      '_wp_http_referer' => '/wp-admin/term.php?taxonomy=product_cat&tag_ID=65&post_type=product&wp_http_referer=%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct&message=3',
       'name' => $temp_tax->name,
        'slug' => $temp_tax->slug.'s',
         'parent' => $temp_tax->parent, 
         'description' => '', 
         'display_type' => '',
          'product_cat_thumbnail_id' => $attach_id ,
           'submit' => 'Обновить', );  
 $taxonomy= "product_cat";
$_POST=$r;
$ret = wp_update_term( $db->term_id, $taxonomy, $r);

echo print_r($ret);


 }




break;
       

 }




//die();
}
  ////////   end      cat      2











die();


$terms = get_terms( 'product_cat' );
foreach ( $terms as $term ) {
//echo '<p>' .var_dump( $term,true). '</p>';
}

//echo var_dump(get_post_types());


   $defaults = array(
    'post' => 36,
    'before' => '',
    'sep' => ' ',
    'after' => '',
  );
   echo "<br>";
//echo var_dump( get_the_taxonomies(36),true);
echo "<br>";

//$id=36;
  //$r=  get_term_thumbnail_id( 36 );

//$r=the_term_thumbnail($id,'product_cat');


$p=array ( "action"=>  "editedtag" ,"tag_ID"=>  "65" ,"taxonomy"=>  "product_cat" ,"_wp_original_http_referer"=>  "http://localhost2/wp-admin/term.php?taxonomy=product_cat&tag_ID=65&post_type=product&wp_http_referer=%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct" ,"_wpnonce"=>  "5c291abf8e" ,"_wp_http_referer"=>  "/wp-admin/term.php?taxonomy=product_cat&tag_ID=65&post_type=product&wp_http_referer=%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct&message=3" ,"name"=>  "BMW / БМВ" ,"slug"=>  "bmw-бмв" ,"parent"=>  "36" ,"description"=>  "" ,"display_type"=>  "" ,"product_cat_thumbnail_id"=>  "285" ,"thumbnail"=>  "" ,"term-thumbnail-updated"=>  "1" ,"submit"=>  "Обновить");
$r=array();
 $r['action']="editedtag";
  $r['tag_ID'] = 65;
  $r ['taxonomy'] = "product_cat";
    $r ['name'] = "BMW / БМВ";
     $r ['slug'] = "bmw-бмв";
      $r ['parent'] = 36;
      $r ['description'] ="ololo";
      $r  ['display_type'] = "";
      $r  ['product_cat_thumbnail_id'] = 323;
      $r ['thumbnail'] = "";
      $r ['term-thumbnail-updated'] = 1;


$file = 'https://www.gravatar.com/avatar/1299e8d336a2d5faa4fc440d07ea44f8?s=32&d=identicon&r=PG';
$file='/home/sam/sites/localhost2/wp-content/uploads/2016/io/e.jpg';

# Function reference
# image_resize ( $file, $max_w, $max_h, $crop = false, $suffix = null, $dest_path = null, $jpeg_quality = 90 )

/*$wpUploadPath = wp_upload_dir();
$fileName = preg_replace('/^.*?\/(\d{4})\/(\d\d)\/(.*)$/', $wpUploadPath['basedir'].'/$1/$2/$3', $file);

$i=image_resize( $fileName, 200, 200, true, '200x200' );
echo  var_dump($i,true);*/


require_once(ABSPATH . '/wp-admin/includes/media.php');
require_once(ABSPATH . '/wp-admin/includes/image.php');

$file = 'http://images.ua.prom.st/110010176_w640_h640_acura_mdx_vned___2000_2006.jpg';
$file='http://images.ua.prom.st/101847267_w640_h640_ford_contour_2000.jpg';
//$file='/home/sam/sites/localhost2/wp-content/uploads/2016/io/e.jpg';
# Function reference
# image_resize ( $file, $max_w, $max_h, $crop = false, $suffix = null, $dest_path = null, $jpeg_quality = 90 )

$wpUploadPath = wp_upload_dir();
$fileName = preg_replace('/^.*?\/(\d{4})\/(\d\d)\/(.*)$/', $wpUploadPath['basedir'].'/$1/$2/$3', $file);

//$i=image_resize( $fileName, 200, 200, true, '200x200' );

$file='/home/sam/sites/localhost2/wp-content/uploads/2016/io/e.jpg';
//   attach
// $filename should be the path to a file in the upload directory.
//$filename = '/home/sam/sites/localhost2/wp-content/uploads/2016/io/e.jpg';

$url = "http://images.ua.prom.st/110010176_w640_h640_acura_mdx_vned___2000_2006.jpg";
$url='http://images.ua.prom.st/101847267_w640_h640_ford_contour_2000.jpg';
$desc = "The WordPress Logo";

$filename = media_sideload_image($url, 0, $desc,'src');
$filename=str_replace('http://localhost2/wp-content', '/home/sam/sites/localhost2/wp-content', $filename);
echo var_export($filename);
//die();

// The ID of the post this attachment is for.
$parent_post_id = 36;

// Check the type of file. We'll use this as the 'post_mime_type'.
$filetype = wp_check_filetype( basename( $filename ), null );

// Get the path to the upload directory.
$wp_upload_dir = wp_upload_dir();

// Prepare an array of post data for the attachment.
$attachment = array(
  'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
  'post_mime_type' => $filetype['type'],
  'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
  'post_content'   => '',
  'post_status'    => 'inherit'
);

// Insert the attachment.
$attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

echo "attach_id ".PHP_EOL.$attach_id."<br>";

// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
require_once( ABSPATH . 'wp-admin/includes/image.php' );

// Generate the metadata for the attachment, and update the database record.
$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
wp_update_attachment_metadata( $attach_id, $attach_data );

set_post_thumbnail( $parent_post_id, $attach_id );










//$r= wp_create_thumbnail($file,200);

//echo  var_dump($i,true);

//echo  var_dump($r,true);
//die();

 $r= array ( 'action' => 'editedtag', 
  'tag_ID' => 65,
  'taxonomy' => 'product_cat', 
  '_wp_original_http_referer' => 'http://localhost2/wp-admin/edit-tags.php?taxonomy=product_cat&post_type=product',
   '_wpnonce' => '5c291abf8e', 
   '_wp_http_referer' => '/wp-admin/term.php?taxonomy=product_cat&tag_ID=65&post_type=product&wp_http_referer=%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct',
    'name' => 'BMW / БМВ',
     'slug' => 'bmw-бмв', 
     'parent' => 36, 
     'description' =>'', 
     'display_type' => '',
      'product_cat_thumbnail_id' => "323",
       'thumbnail' => '',
       'term-thumbnail-updated' => 1, 'submit' => 'Обновить' );    

       $r=array ( 'action' => 'editedtag', 'tag_ID' => '65', 'taxonomy' => 'product_cat', '_wp_original_http_referer' => 'http://localhost2/wp-admin/term.php?taxonomy=product_cat&tag_ID=65&post_type=product&wp_http_referer=%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct', '_wpnonce' => '63b4717155', '_wp_http_referer' => '/wp-admin/term.php?taxonomy=product_cat&tag_ID=65&post_type=product&wp_http_referer=%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_cat%26post_type%3Dproduct&message=3', 'name' => 'BMW / БМВ22', 'slug' => 'bmw-бмв', 'parent' => '36', 'description' => '', 'display_type' => '', 'product_cat_thumbnail_id' => $attach_id , 'submit' => 'Обновить', );  
    $tag_ID= 65;
 $taxonomy= "product_cat";
$_POST=$r;
$ret = wp_update_term( $tag_ID, $taxonomy, $r);

echo print_r($ret);
// die();
//die();


  $tag = get_term( $tag_ID, $taxonomy );
echo print_r($tag );
echo PHP_EOL."OK".PHP_EOL;


echo  print_r($ret);
echo PHP_EOL."OK";
//die();





//set_term_thumbnail( 59, 322);
//echo  var_dump($r,true);

/*$r=get_terms('product_cat');
//echo  var_dump($r,true);

foreach ($r as $key => $value) {
  # code...
  echo  var_dump($value,true);
  break;
}


if (function_exists('get_wp_term_image'))
{
    $meta_image = get_wp_term_image($id); 
    //It will give category/term image url 
}

echo "IPO ".$meta_image."    OLPO"; // category/term image url


//   attach
// $filename should be the path to a file in the upload directory.
$filename = '/home/sam/sites/localhost2/wp-content/uploads/2016/io/e.jpg';

// The ID of the post this attachment is for.
$parent_post_id = 36;

// Check the type of file. We'll use this as the 'post_mime_type'.
$filetype = wp_check_filetype( basename( $filename ), null );

// Get the path to the upload directory.
$wp_upload_dir = wp_upload_dir();

// Prepare an array of post data for the attachment.
$attachment = array(
  'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
  'post_mime_type' => $filetype['type'],
  'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
  'post_content'   => '',
  'post_status'    => 'inherit'
);

// Insert the attachment.
$attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
require_once( ABSPATH . 'wp-admin/includes/image.php' );

// Generate the metadata for the attachment, and update the database record.
$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
wp_update_attachment_metadata( $attach_id, $attach_data );

set_post_thumbnail( $parent_post_id, $attach_id );*/






/*$file='/home/sam/sites/localhost2/wp-content/uploads/2016/io/e.jpg';

$r= wp_create_thumbnail($file,200);

set_term_thumbnail($t,$r);*/

/*$t= get_term( 36);
$f=get_term_thumbnail(36);
//$t=get_terms();

$file='/home/sam/sites/localhost2/wp-content/uploads/2016/io/e.jpg';

$r= wp_create_thumbnail($file,200);

set_term_thumbnail($t,$r);

echo  var_dump($r,true);
*/

//$t=get_categories();

    // foreach ($f as $key => $value) {
         # code..
      // echo var_dump($value,true); 

    // }

//echo var_dump(htmlentities( $f));


/*$image = wp_get_image_editor( '/home/sam/sites/localhost2/wp-content/uploads/2016/io/e.jpg' );
if ( ! is_wp_error( $image ) ) {
    $image->rotate( 90 );
    $image->resize( 300, 300, true );
    $image->save( 'new_image.jpg' );
}
echo var_dump( $image,true);;*/




/*
require_once(ABSPATH . '/wp-admin/includes/media.php');
require_once(ABSPATH . '/wp-admin/includes/image.php');

$file = 'https://www.gravatar.com/avatar/1299e8d336a2d5faa4fc440d07ea44f8?s=32&d=identicon&r=PG';
$file='/home/sam/sites/localhost2/wp-content/uploads/2016/io/e.jpg';
# Function reference
# image_resize ( $file, $max_w, $max_h, $crop = false, $suffix = null, $dest_path = null, $jpeg_quality = 90 )

$wpUploadPath = wp_upload_dir();
$fileName = preg_replace('/^.*?\/(\d{4})\/(\d\d)\/(.*)$/', $wpUploadPath['basedir'].'/$1/$2/$3', $file);

$i=image_resize( $fileName, 200, 200, true, '200x200' );
echo  var_dump($i,true);*/





   ?>




 <?php echo "<br>";?>
  <?php echo print_r($_POST);?>

  <?php echo "<br>";?>
<?php if (isset($_POST['Submit'] )& $_POST['Submit']=='load'): ?>
    <p> Ok Page Post load</p>
    
<?php endif ?>

<?php if (isset($_POST['Submit'] )& $_POST['Submit']=='start'): ?>
    <p> Ok Page Post start</p>
    
<?php endif ?>


<form name="form1" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Favorite Color:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="20">
</p><hr />

<p class="submit">
<input type="submit" name="Submit" value="<?php echo "load";?>" />
<input type="submit" name="Submit" value="<?php echo "start";?>" />
</p>

</form>
</div>

 
