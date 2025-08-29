<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function save_category(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `category_list` set {$data} ";
		}else{
			$sql = "UPDATE `category_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `category_list` where `name`='{$name}' ".($id > 0 ? " and id != '{$id}'" : ""))->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Category Name Already Exists.";
		}else{
			$save = $this->conn->query($sql);
			if($save){
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "Category details was successfully added.";
				else
					$resp['msg'] = "Category details was successfully updated.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_category(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `category_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Category has successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_brand(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `brand_list` set {$data} ";
		}else{
			$sql = "UPDATE `brand_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `brand_list` where `name`='{$name}' ".($id > 0 ? " and id != '{$id}'" : ""))->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Brand Name Already Exists.";
		}else{
			$save = $this->conn->query($sql);
			if($save){
				$bid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "Brand details was successfully added.";
				else
					$resp['msg'] = "Brand details was successfully updated.";
				if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
					$fname = 'uploads/brands/brand-'.$bid.'.png';
					$dir_path =base_app. $fname;
					$upload = $_FILES['img']['tmp_name'];
					$type = mime_content_type($upload);
					$allowed = array('image/png','image/jpeg');
					if(!in_array($type,$allowed)){
						$resp['msg'].=" But Image failed to upload due to invalid file type.";
					}else{
						$new_height = 200; 
						$new_width = 250; 
				
						list($width, $height) = getimagesize($upload);
						$t_image = imagecreatetruecolor($new_width, $new_height);
						imagealphablending( $t_image, false );
						imagesavealpha( $t_image, true );
						$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
						imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
						if($gdImg){
								if(is_file($dir_path))
								unlink($dir_path);
								$uploaded_img = imagepng($t_image,$dir_path);
								imagedestroy($gdImg);
								imagedestroy($t_image);
						}else{
						$resp['msg'].=" But Image failed to upload due to unkown reason.";
						}
					}
					if(isset($uploaded_img)){
						$this->conn->query("UPDATE brand_list set `image_path` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$bid}' ");
					}
				}
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_brand(){
		extract($_POST);
		$get = $this->conn->query("SELECT * FROM `brand_list` where id = '{$id}'");
		$del = $this->conn->query("DELETE FROM `brand_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Brand has successfully deleted.");
			if($get->num_rows>0){
				$res = $get->fetch_array();
				$res['image_path'] = explode('?',$res['image_path'])[0];
				if(is_file(base_app.$res['image_path']))
					unlink(base_app.$res['image_path']);
			}
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_car(){
		$_POST['status'] = isset($_POST['status']) && $_POST['status'] == 'on' ? 1 : 0;
		$_POST['description'] = htmlentities($_POST['description']);
		$_POST['condition'] = htmlentities($_POST['condition']);
		$_POST['features'] = htmlentities($_POST['features']);
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
				$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `car_list` set {$data} ";
		}else{
			$sql = "UPDATE `car_list` set {$data} where id = '{$id}' ";
		}
		
		$save = $this->conn->query($sql);
		if($save){
			$cid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['id'] = $cid;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "Product was successfully added.";
			else
				$resp['msg'] = "Product was successfully updated.";
				if(isset($_FILES['banner']) && $_FILES['banner']['tmp_name'] != ''){
					$fname = 'uploads/banners/car-'.$cid.'.png';
					$dir_path =base_app. $fname;
					$upload = $_FILES['banner']['tmp_name'];
					$type = mime_content_type($upload);
					$allowed = array('image/png','image/jpeg');
					if(!in_array($type,$allowed)){
						$resp['msg'].=" But Image failed to upload due to invalid file type.";
					}else{
						$new_height = 450; 
						$new_width = 800; 
				
						list($width, $height) = getimagesize($upload);
						$t_image = imagecreatetruecolor($new_width, $new_height);
						imagealphablending( $t_image, false );
						imagesavealpha( $t_image, true );
						$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
						imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
						if($gdImg){
								if(is_file($dir_path))
								unlink($dir_path);
								$uploaded_img = imagepng($t_image,$dir_path);
								imagedestroy($gdImg);
								imagedestroy($t_image);
						}else{
						$resp['msg'].=" But Image failed to upload due to unkown reason.";
						}
					}
				}
				if(isset($_FILES['images']) && count($_FILES['images']['tmp_name']) > 0){
					foreach($_FILES['images']['tmp_name'] as $k => $v){
						if(!empty($_FILES['images']['tmp_name'][$k])){
							if(!is_dir(base_app."uploads/cars/{$cid}"))
								mkdir(base_app."uploads/cars/{$cid}");
							$fname = "uploads/cars/{$cid}/car-".$cid.'_'.(time()).'.png';
							$dir_path =base_app. $fname;
							$i= 1;
							while(true){
								if(!is_file($dir_path)){
									break;
								}else{
									$fname = "uploads/cars/{$cid}/car-".$cid.'_'.(time()).'_'.$i.'.png';
									$dir_path =base_app. $fname;
									$i++;
								}
							}
							$upload = $_FILES['images']['tmp_name'][$k];
							$type = mime_content_type($upload);
							$allowed = array('image/png','image/jpeg');
							if(!in_array($type,$allowed)){
								$resp['msg'].=" But Image failed to upload due to invalid file type.";
							}else{
								$new_height = 450; 
								$new_width = 800; 
						
								list($width, $height) = getimagesize($upload);
								$t_image = imagecreatetruecolor($new_width, $new_height);
								imagealphablending( $t_image, false );
								imagesavealpha( $t_image, true );
								$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
								imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
								if($gdImg){
										if(is_file($dir_path))
										unlink($dir_path);
										$uploaded_img = imagepng($t_image,$dir_path);
										imagedestroy($gdImg);
										imagedestroy($t_image);
								}else{
								$resp['msg'].=" But Image failed to upload due to unkown reason.";
								}
							}
						}
					}
				}
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = "An error occured.";
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_car(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `car_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Product has successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_inquiry(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				if(!is_null($v)){
					$data .= " `{$k}`='{$v}' ";
				}else{
					$data .= " `{$k}`= NULL ";
				}
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `inquiry_list` set {$data} ";
		}else{
			$sql = "UPDATE `inquiry_list` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		if($save){
			$rid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "Inquiry Details was successfully submitted.";
			else
				$resp['msg'] = "Inquiry Details was successfully updated.";
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = "An error occured.";
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_inquiry(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `inquiry_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Inquiry has successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	public function read_inquiry(){
		extract($_POST);
		$update = $this->conn->query("UPDATE `inquiry_list` set `status` = 1 where id = $id");
		if($update){
			$this->settings->set_flashdata('success','inquiry has successfully verified.');
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
		}
		return json_encode($resp);
	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save_category':
		echo $Master->save_category();
	break;
	case 'delete_category':
		echo $Master->delete_category();
	break;
	case 'save_brand':
		echo $Master->save_brand();
	break;
	case 'delete_brand':
		echo $Master->delete_brand();
	break;
	case 'save_product':
		echo $Master->save_car();
	break;
	case 'delete_product':
		echo $Master->delete_car();
	break;
	case 'save_inquiry':
		echo $Master->save_inquiry();
	break;
	case 'delete_inquiry':
		echo $Master->delete_inquiry();
	break;
	default:
	case 'read_inquiry':
		echo $Master->read_inquiry();
	break;
		// echo $sysset->index();
		break;
}