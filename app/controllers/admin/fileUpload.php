<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class FileUpload extends CI_Controller {

	

	private $imagePath = '../btPublic/bt-uploads/';

	private $waterMarkImage = '../btPublic/images/watermark.png';		

	

	function uploadFile_Single($galleryId){

		$config['upload_path'] = realpath(APPPATH . $this->imagePath);

		$config['allowed_types'] = 'gif|jpg|jpeg|JPG|png';

		$config['max_size']	= 0;

		$config['max_width']  = 0;

		$config['max_height']  = 0;

		$config['encrypt_name'] = 0;



		$this->upload->initialize($config);



		if ( ! $this->upload->do_upload()){

			

			$error = array($this->upload->display_errors());	

			

			setMessage('error_message', $error[0]);

			redirect(base_url().'admin/gallery/add/'.$galleryId, 'refresh');

		}

		else{

			

			$data = array($this->upload->data());

			$image_name = $data[0]['file_name'];

							

			$this->resize_image($image_name, 'medium', 800, 600);

			$this->resize_image($image_name, 'thumbs', 110, 110);	

			

			unset($data);

									

			$dbFieldsArray = array('agentId', 'galleryId', 'imageName', 'imageTitle', 'imageDescription');

			$infoFieldsArray = array($this->session->userdata('agentId'), $galleryId, $image_name, $this->input->post('imageTitle'), $this->input->post('imageDescription'));

			

			$this->general_model->addInfo_Simple($dbFieldsArray, $infoFieldsArray, 'tbl_gallery_images');

			

			setMessage('success_message', 'New image added successfully!');

			redirect(base_url().'admin/gallery/add/'.$galleryId, 'refresh');

		}

	}

	

	function updateFile_Single($galleryId, $photoId){

		$config['upload_path'] = realpath(APPPATH . $this->imagePath);

		$config['allowed_types'] = 'gif|jpg|png';

		$config['max_size']	= '1000';

		$config['max_width']  = 0;

		$config['max_height']  = 0;

		$config['encrypt_name'] = 0;



		$this->upload->initialize($config);



		$imageStatus = $this->input->post('imageStatus');

		if($imageStatus == 'EMPTY'){

			$dbFieldsArray = array('agentId', 'imageTitle', 'imageDescription');

			$infoFieldsArray = array($this->session->userdata('agentId'), $this->input->post('imageTitle'), $this->input->post('imageDescription'));

			$this->general_model->updateInfo_Simple($photoId, 'ID', $dbFieldsArray, $infoFieldsArray, 'tbl_gallery_images');

		}

		else{

			

			if ( ! $this->upload->do_upload()){

				

				$error = array($this->upload->display_errors());	

				

				setMessage('error_message', $error[0]);

				redirect(base_url().'admin/gallery/updatePhoto/'.$photoId, 'refresh');

			}

			else{

				

				$data = array($this->upload->data());

				$image_name = $data[0]['file_name'];

								

				$this->resize_image($image_name, 'medium', 220, 220);

				$this->resize_image($image_name, 'thumbs', 110, 110);					

										

				$dbFieldsArray = array('agentId', 'imageName', 'imageTitle', 'imageDescription');

				$infoFieldsArray = array($this->session->userdata('agentId'), $image_name, $this->input->post('imageTitle'), $this->input->post('imageDescription'));

				

				$this->general_model->updateInfo_Simple($photoId, 'ID', $dbFieldsArray, $infoFieldsArray, 'tbl_gallery_images');

				

				$oldImage = $this->input->post('oldImage');

				unlink(realpath(APPPATH.$this->imagePath.'/'.$oldImage));

				unlink(realpath(APPPATH.$this->imagePath.'medium'.'/'.$oldImage));

				unlink(realpath(APPPATH.$this->imagePath.'thumbs'.'/'.$oldImage));								

			}

		}

		

		setMessage('success_message', 'Photo details updated successfully!');

		redirect(base_url().'admin/gallery/add/'.$galleryId, 'refresh');

	}

	

	

	private function resize_image($image_name, $new_directory, $newWidth, $newHeight){

	

	  $config_img = array();

	  $config_img['image_library'] = 'gd2';

	  $config_img['source_image'] = realpath(APPPATH . $this->imagePath . $image_name);

	  

	  if($new_directory != ''){

		   $config_img['new_image'] = realpath(APPPATH . $this->imagePath.$new_directory.'/');

	  }

	  

	  $config_img['maintain_ratio'] = TRUE;

	  $config_img['width'] = $newWidth;

	  $config_img['height'] = $newHeight;

	  $config_img['quality'] = 100;

	  

	  $this->image_lib->initialize($config_img);

	  

	  if ( ! $this->image_lib->resize()){

		  echo $this->image_lib->display_errors();

	  }	  

	}				

	

	

	

	private function addWaterMark($image_name, $directory_name){

		

		$config['source_image']	= realpath(APPPATH . $this->imagePath .$image_name);

		if($directory_name != ''){

			$config['source_image']	= realpath(APPPATH . $this->imagePath.$directory_name.'/'.$image_name);

		}

		$config['wm_type'] = 'overlay';

		$config['wm_overlay_path'] = realpath(APPPATH . $this->waterMarkImage); //'./GtRt_Sys/fonts/texb.ttf';

		$config['wm_opacity']	= 0;

		$config['wm_x_transp'] = 4;

		$config['wm_y_transp'] = 4;

		$config['wm_vrt_alignment'] = 'middle';

		$config['wm_hor_alignment'] = 'center';

		

		$this->image_lib->initialize($config); 				

		

		 if ( ! $this->image_lib->watermark()){

		  echo $this->image_lib->display_errors();

	  }	

	}

	

	

	public function removeImage($imageName, $ID, $galleryId){

		

		if($this->general_model->deleteData($ID, 'ID', 'tbl_gallery_images')){			

			

			unlink(realpath(APPPATH.$this->imagePath.'/'.$imageName));

			unlink(realpath(APPPATH.$this->imagePath.'medium'.'/'.$imageName));

			unlink(realpath(APPPATH.$this->imagePath.'thumbs'.'/'.$imageName));

		}

		setMessage('success_message', 'Image removed successfully!');

		redirect(base_url().'admin/gallery/add/'.$galleryId, 'refresh');		

	}

}



/* End of file fileUpload.php */

/* Location: ./application/controllers/fileUpload.php */