<?php
	session_start();
	include '../config/connect.php';
	
	$admin_login = null;
	if(isset($_SESSION["admin_login"])){
	// login pass
	$admin_login = $_SESSION["admin_login"];
	}
        //turn on php error reporting
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             
             $product_id = $_POST['product_id'];
             $product_name = $_POST['product_name'];
             $check_img = $_POST['check_img'];
             $price = $_POST['price'];
             $img_name = $_POST['img_name'];
             $title_name = $_POST['title_name'];
             $details = $_POST['details'];
             $category = $_POST['category'];
             $type_id = $_POST['type'];
             
 			/*echo $product_name.'<== $product_name <br>';
 			echo $price.'<== $price <br>';
 			echo $img_name.'<== $img_name <br>';
 			echo $title_name.'<== $title_name <br>';
 			echo $details.'<== $details <br>';
 			echo $category.'<== $category <br>';*/
 			
            $name     = $_FILES['file']['name'];
            $type	  = $_FILES['file']['type'];
            $tmpName  = $_FILES['file']['tmp_name'];
            $error    = $_FILES['file']['error'];
            $size     = $_FILES['file']['size'];
            $ext      = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            
            //print_r($_FILES['file']);
            
        if($check_img == 1){
           
           	 switch ($error) {
                case UPLOAD_ERR_OK:
                    $valid = true;
                    //validate file extensions
                    if ( !in_array($ext, array('jpg','jpeg','png','gif')) ) {
                        $valid = false;
                        $response = 'Invalid file extension.';
                    }
                    //validate file size
                    if ( $size/1024/1024 > 2 ) {
                        $valid = false;
                        $response = 'File size is exceeding maximum allowed size.';
                    }
                    //upload file
                    if ($valid) {
                    	
                    $proname = $img_name.'.'.$ext;
                    	
                		$pdo = Database::connect();
				        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				        $sql = "UPDATE `adidas_product` SET `adidas_category_id` = ?, `adidas_type_id` = ?, `adidas_product_name` = ?, `adidas_product_price` = ?, `adidas_product_img` = ?, `adidas_product_title` = ?, `adidas_product_details` = ?, `adidas_product_datetime` = NOW() WHERE  `adidas_product`.`adidas_product_id` = ?;";
				        $q = $pdo->prepare($sql);
				    	$q->execute(array($category,$type_id,$product_name,$price,$proname,$title_name,$details,$product_id)); 
						Database::disconnect();
						
                        $targetPath =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR. '../img_product/' . DIRECTORY_SEPARATOR. $img_name.'.'.$ext;
                        move_uploaded_file($tmpName,$targetPath);
                      	header( 'Location: product_edit_view.php');
                       //	echo $productname;
                       	
                       	 
                        exit;
                    }
                    break;
                case UPLOAD_ERR_INI_SIZE:
                    $response = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $response = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $response = 'The uploaded file was only partially uploaded.';
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $response = 'No file was uploaded.';
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $response = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $response = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $response = 'File upload stopped by extension. Introduced in PHP 5.2.0.';
                    break;
                default:
                    $response = 'Unknown error';
                break;
            }
        }else{
        	 $pdo = Database::connect();
	         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	         $sql = "UPDATE `adidas_product` SET `adidas_category_id` = ?, `adidas_type_id` = ?, `adidas_product_name` = ?, `adidas_product_price` = ?, `adidas_product_details` = ?, `adidas_product_datetime` = NOW() WHERE `adidas_product_id` = ?;";
	         $q = $pdo->prepare($sql);
	    	 $q->execute(array($category,$type_id,$product_name,$price,$details,$product_id)); 
			 Database::disconnect();
			 header( 'Location: product_edit_view.php');
        }
           echo $response;
    }
?>