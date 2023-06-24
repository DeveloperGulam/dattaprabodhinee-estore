<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('seller_model');
		$this->load->library('session');
    }
    public function is_logged_in()
	{
		if(!$this->session->userdata('seller')){
			redirect('seller/');
		}
		else
		{
			$logged_user=$this->session->userdata('seller');
		}
	}
	public function index()
	{
		$this->load->view('seller/login');
	}
	public function seller_signup()
	{
		$this->load->view('seller_registration');
	}
	public function seller_login()
	{
		$username=$this->input->post('email');
		$password=$this->input->post('password');
		$fetchdata=$this->seller_model->seller_login($username);
		// print_r($fetchdata);exit;
		if(!empty($fetchdata)){
		$dbid=$fetchdata->id;
		$status=$fetchdata->status;
		$dbname=$fetchdata->name;
		$dbnumber=$fetchdata->number;
		$dbmail=$fetchdata->email;
		$dbpassword=$fetchdata->password;
		}
		
			if($dbmail==$username){
				if($dbpassword==$password){
					if($status=='1'){
						$this->session->set_userdata('seller', $dbid);
						redirect('seller/dashboard/');
					}
					else{
						$this->session->set_userdata('insert_id', $dbid);
						redirect('you-are-in-preview/');
					}
				}
				else{
					$this->session->set_flashdata('err', 'You have enter wrong password!');
					redirect('seller/');
				}
			}
			else{
				$this->session->set_flashdata('err', 'Email Address does not exist!');
				redirect('seller/');
			}
	}
	public function dashboard()
	{
		if($this->session->userdata('seller')){
			$seller_id=$this->session->userdata('seller');
			$limit=5;
			$data['order_details']=$this->seller_model->orders($seller_id,$limit);
			$data['seller_details']=$this->seller_model->user_details($seller_id);
			//echo "<pre>";
			//print_r($data['order_details']);die;
			$data['pending_orders']=$this->seller_model->count_orders($status=0,$seller_id);
			$data['placed_orders']=$this->seller_model->count_orders($status=1,$seller_id);
			$data['progress_orders']=$this->seller_model->count_orders($status=2,$seller_id);
			$data['cancel_orders']=$this->seller_model->count_orders($status=3,$seller_id);
			$data['completed_orders']=$this->seller_model->count_orders($status=4,$seller_id);
			//print_r($data['completed_orders']);die;
			$this->load->view('seller/include/header');
			$this->load->view('seller/index', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller/');
		}
		
	}
	public function seller_registration(){
	    $pincode=$this->input->post('pincode');
	    $pincodes=implode(', ',$pincode);
	    //print_r($pincodes);die;
		$name=$this->input->post('name');
		$number=$this->input->post('number');
		$email=$this->input->post('email');
		$data=array(
			'name'=>$this->input->post('name'),
			'business_name'=>$this->input->post('business_name'),
			'email'=>$this->input->post('email'),
			'number'=>$this->input->post('number'),
			'street'=>$this->input->post('street'),
			'city'=>$this->input->post('city'),
			'pincode'=>$pincodes,
			'state'=>$this->input->post('state'),
			'password'=>$this->input->post('password')
		);
		$result=$this->seller_model->signup_test($number,$email);
		$matchemail=$result->email;
		$matchnumber=$result->number;
			if($matchemail==$email){
			$this->session->set_flashdata('err', 'Email Address Already Exist.');
			redirect('seller');
			}
			else{
				if($matchnumber==$number){
					$this->session->set_flashdata('err', 'Mobile Number Already Exist.');
					redirect('seller');
				}
				else{
					$insert_id=$this->seller_model->seller_registration($data);
					$otp=rand(100000,999999);
					$msg="Hello ".$name." Your Dattaprabodhinee E-Store OTP for verification is ".$otp;
					// Account details
					$apiKey = urlencode('u6EtTAPkVrw-zaS0Dbm5s7llV2axVCbaPOwwyABpi4');
					$sender = urlencode('TXTLCL');
					// Prepare data for POST request
					$data = array('apikey' => $apiKey, 'numbers' => $number, 'sender' => $sender, 'message' => $msg);
					// Send the POST request with cURL
					$ch = curl_init('https://api.textlocal.in/send/');
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$response = curl_exec($ch);
					curl_close($ch);
					// Process your response here
					if($response==TRUE)
					{
						$this->session->set_flashdata('msg', 'OTP has been Send!');
						$this->session->set_userdata('otpcode', $otp);
						$this->session->set_userdata('insert_id', $insert_id);
						redirect('verify-otp');
						
					}
					else{
						$this->session->set_flashdata('err', 'SMS Server Down! Please Try afer some time.');
						redirect('verify-otp');
					}
				}
			}
	}
	public function otp()
	{
		$this->load->view('seller_verification');
	}
	public function verify_otp()
	{
		$otpcodes=$this->session->userdata('otpcode');
		$user_id=$this->session->userdata('insert_id');
		$otp=$this->input->post('otp');
		if($otpcodes==$otp){
			$updated=$this->seller_model->verification_update($user_id);
			if($updated==TRUE){
				redirect('seller-document/');
			}
		}
		else{
			$this->session->set_flashdata('err', 'Wrong OTP !');
			redirect('verify-otp');
		}
	}
	public function seller_bank_details()
	{
		$this->load->view('seller_bank_details');
	}
	public function pending_accounts()
	{
		$this->load->library('session');
		$this->load->library('cart');
        $this->load->model('model');
		$user_id=$this->session->userdata('insert_id');
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
		$data['cart_products']=$this->cart->contents();
		$data['user_details']=$this->seller_model->user_details($user_id);
		$this->load->view('include/header', $data);
		$this->load->view('pending_accounts',$data);
		$this->load->view('include/footer',$data);
	}
	public function save_bank_details()
	{
		$user_id=$this->session->userdata('insert_id');
		$data=array(
			'bank_name'=>$this->input->post('bank_name'),
			'account_number'=>$this->input->post('account_number'),
			'branch'=>$this->input->post('branch'),
			'type_of_account'=>$this->input->post('type_of_account'),
			'ifsc_code'=>$this->input->post('ifsc_code')
		);
		$result=$this->seller_model->save_bank_details($data,$user_id);
		if($result==TRUE){
			redirect('you-are-in-preview');
		}
		else{
			echo"failed";
		}
	}
	public function seller_document()
	{
		$this->load->view('seller_document');
	}
	function ss(){
		$this->load->library('upload');
		
		  $image = array();
		  $ImageCount = count($_FILES['image_name']['name']);
        for($i = 0; $i < $ImageCount; $i++){
			// print_r($_FILES['image_name']['name']);die;
            $_FILES['file']['name']       = $_FILES['image_name']['name'][$i];
            $_FILES['file']['type']       = $_FILES['image_name']['type'][$i];
            $_FILES['file']['tmp_name']   = $_FILES['image_name']['tmp_name'][$i];
            $_FILES['file']['error']      = $_FILES['image_name']['error'][$i];
            $_FILES['file']['size']       = $_FILES['image_name']['size'][$i];

            // File upload configuration
			$new_name = time().'-dattaprabodhinee-'.'products';
            $uploadPath = './assets/images/documents/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
			// $config['encrypt_name'] = TRUE;
			$config['file_name'] = $new_name;

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if($this->upload->do_upload('file')){
                // Uploaded file data
                $imageData = $this->upload->data();
                 $uploadImgData[$i]['image_name'] = $imageData['file_name'];

            }
        }
         if(!empty($uploadImgData)){
            // Insert files data into the database
            $this->pages_model->multiple_images($uploadImgData);              
        }
	}
	public function seller_documentation()
	{
		$user_id=$this->session->userdata('insert_id');
		$pan_card=$_FILES['pan_card']['name'];
		$aadhar_front=$_FILES['aadhar_front']['name'];
		$aadhar_back=$_FILES['aadhar_back']['name'];
		$gst_cirtificate=$_FILES['gst_cirtificate']['name'];
		$income_tax_file=$_FILES['income_tax_file']['name'];
		$business_registration=$_FILES['business_registration']['name'];
		$msme_registration=$_FILES['msme_registration']['name'];
		$driving_licence_or_ration_card=$_FILES['driving_licence_or_ration_card']['name'];
		
		$config['upload_path']          = './assets/images/documents/';
        $config['allowed_types']        = 'gif|jpg|png|svg|ico';
		// $config['encrypt_name'] = TRUE;
		if($pan_card!==''){
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('pan_card'))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('err', $error);
				redirect('seller-document');
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
			}
		}
		if($aadhar_front!==''){
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('aadhar_front'))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('err', $error);
				redirect('seller-document');
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
			}
		}
		if($aadhar_back!==''){
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('aadhar_back'))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('err', $error);
				redirect('seller-document');
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
			}
		}
		if($gst_cirtificate!==''){
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('gst_cirtificate'))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('err', $error);
				redirect('seller-document');
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
			}
		}
		if($income_tax_file!==''){
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('income_tax_file'))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('err', $error);
				redirect('seller-document');
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
			}
		}
		if($business_registration!==''){
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('business_registration'))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('err', $error);
				redirect('seller-document');
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
			}
		}
		if($msme_registration!==''){
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('msme_registration'))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('err', $error);
				redirect('seller-document');
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
			}
		}
		if($driving_licence_or_ration_card!==''){
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('driving_licence_or_ration_card'))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('err', $error);
				redirect('seller-document');
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
			}
		}
				$data=array(
					'pan_card'=>$pan_card,
					'aadhar_front'=>$aadhar_front,
					'aadhar_back'=>$aadhar_back,
					'gst_cirtificate'=>$gst_cirtificate,
					'income_tax_file'=>$income_tax_file,
					'business_registration'=>$business_registration,
					'msme_cirtificate'=>$msme_registration,
					'driving_licence_or_ration_card'=>$driving_licence_or_ration_card
				);
				// print_r($data);die;
				$result=$this->seller_model->upload_documents($data,$user_id);
				if($result==TRUE){
					redirect('bank-details/');
				}
				else{
					$this->session->set_flashdata('err', 'Something went to wrong!');
					redirect('seller-document/');
				}
	}
	function orders()
	{
		if($this->session->userdata('seller')){
			$seller_id=$this->session->userdata('seller');
			$limit='';
			$data['order_details']=$this->seller_model->orders($seller_id,$limit);
			// print_r($data);die;
			$this->load->view('seller/include/header');
			$this->load->view('seller/orders', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller/');
		}
	}
	public function Report()
	{
		if($this->session->userdata('seller')){
			$order_id=$this->uri->segment(4);
			$data['report_info']=$this->seller_model->report($order_id);
			$this->load->view('seller/include/header');
			$this->load->view('seller/order_report', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller/');
		}
	}
	public function order_details()
	{
		if($this->session->userdata('seller')){
			$pid=$this->uri->segment(4);
			$data['order_info']=$this->seller_model->order_details($pid);
			$data['item_info']=$this->seller_model->item_details($pid);
			$this->load->view('seller/include/header');
			$this->load->view('seller/order_view', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller/');
		}
	}
	function request_stock()
	{
	    if($this->session->userdata('seller')){
	        $data['product_id']=$this->input->post('product_id');
	        $data['product_name']=$this->input->post('product_name');
	        $data['packing_size']=$this->input->post('packing_size');
	        $data['packing_type']=$this->input->post('packing_type');
	        $data['price']=$this->input->post('price');
			$this->load->view('seller/include/header');
			$this->load->view('seller/request_stock', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller/');
		}
	}
	function requestStock()
	{
	    if($this->session->userdata('seller')){
	        $data=array(
	            'stock_qty'=>$this->input->post('stock_qty'),
	            'product_id'=>$this->input->post('product_id'),
	            'product_name'=>$this->input->post('product_name'),
	            'packing_size'=>$this->input->post('packing_size'),
	            'packing_type'=>$this->input->post('packing_type'),
	            'price'=>$this->input->post('price'),
	            'seller_id'=>$this->session->userdata('seller'),
	            'stock_status'=>'0'
	        );
			$this->seller_model->requestStock($data);
			$this->session->set_flashdata('msg', 'Stock Requested Successfully.');
			redirect('seller/products/');
		}
		else{
			redirect('seller/');
		}
	}
	public function edit_order()
	{
		if($this->session->userdata('seller')){
			$pid=$this->uri->segment(4);
			$data['order_info']=$this->seller_model->order_details($pid);
			$data['item_info']=$this->seller_model->item_details($pid);
			$this->load->view('seller/include/header');
			$this->load->view('seller/order_edit', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller/');
		}
	}
	public function update_order_status($id)
	{
		if($this->session->userdata('seller')){
			$data=array(
				'status'=>$this->input->post('status')
			);
			$result=$this->seller_model->update_order_status($data,$id);
			if($result==TRUE){
				redirect('seller/orders');
			}
			else{
				redirect('seller/orders');
			}
		}
		else{
			redirect('seller/');
		}
	}
	function stocks()
	{
		if($this->session->userdata('seller')){
			$seller_id=$this->session->userdata('seller');
			$data['product']=$this->seller_model->stocks($seller_id);
			$data['category_list']=$this->seller_model->category_list();
			$this->load->view('seller/include/header');
			$this->load->view('seller/stocks', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller');
		}
	}
	function products()
	{
		if($this->session->userdata('seller')){
			$seller_id=$this->session->userdata('seller');
			$data['product']=$this->seller_model->products($seller_id);
			//echo "<pre>";
			//print_r($data['product']);die;
			$data['category_list']=$this->seller_model->category_list();
			$this->load->view('seller/include/header');
			$this->load->view('seller/products', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller');
		}
	}
	function edit_stock($stock_id)
	{
		if($this->session->userdata('seller')){
			$data['product']=$this->seller_model->stock_details($stock_id);
			$this->load->view('seller/include/header');
			$this->load->view('seller/edit_stock', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller/');
		}
	}
	function update_stock($stock_id)
	{
	    if($this->session->userdata('seller')){
			$data=array(
				'stock_qty'=>$this->input->post('stock_qty')
			);
			$result=$this->seller_model->update_stock($data,$stock_id);
			$this->session->set_flashdata('msg', 'Stock Updated Successfully.');
			redirect('seller/edit_stock/'.$stock_id);
		}
		else{
			redirect('seller/');
		}
	}
	function stock_details($stock_id)
	{
		if($this->session->userdata('seller')){
			$data['product']=$this->seller_model->stock_details($stock_id);
			// print_r($data);die;
			$this->load->view('seller/include/header');
			$this->load->view('seller/stock_details', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller/');
		}
	}
	function product_details()
	{
		if($this->session->userdata('seller')){
			$pid=$this->uri->segment(5);
			$data['product']=$this->seller_model->product_details($pid);
			// print_r($data);die;
			$this->load->view('seller/include/header');
			$this->load->view('seller/product_view', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller/');
		}
	}
	public function add_product()
	{
		if($this->session->userdata('seller')){
			$data['category_list']=$this->seller_model->category_list();
			// print_r($s);die;
			$this->load->view('seller/include/header');
			$this->load->view('seller/add_product',$data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller');
		}
	}
	public function review()
	{
		if($this->session->userdata('seller')){
			$data['category_list']=$this->seller_model->category_list();
			// print_r($s);die;
			$this->load->view('seller/include/header');
			$this->load->view('seller/review',$data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller');
		}
	}
	public function edit_product()
	{
		$this->load->library('session');
		$this->load->model('seller_model');
		if($this->session->userdata('seller')){
			$pid=$this->uri->segment(5);
			$data['category_list']=$this->seller_model->category_list();
			$table_name='products';
			$data['details']=$this->seller_model->get_details($pid,$table_name);
			// print_r($data);die;
			$this->load->view('seller/include/header');
			$this->load->view('seller/edit_product', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller');
		}
	}
	public function add_categories()
	{
		$this->load->library('session');
		$img_name=$_FILES['category_img']['name'];
		if($img_name!==''){
			$image_name=strtolower(str_replace(' ', '-',$img_name));
			$exist_name=@end(explode(',',$image_name));
			$name_test=strtolower($exist_name);
			$new_name=time().'-dattaprabodhinee-'.$name_test;
				$config['upload_path']          = './assets/images/category/';
                $config['allowed_types']        = 'gif|jpg|png|svg|ico';
				$config['file_name'] = $new_name;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('category_img'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        //$this->load->view('upload_form', $error);
						$this->session->set_flashdata('err', 'Something went to wrong!');
						redirect('seller/add_category');
                }
                else
                {
                    $data=array(
						'name'=>$this->input->post('name'),
						'status'=>$this->input->post('status'),
						'category_img'=>$new_name,
						'description'=>$this->input->post('description')
					);
					$this->load->model('seller_model');
					$this->seller_model->add_category($data);
					$this->session->set_flashdata('msg', 'Category Added Successfully.');
					redirect('seller/add_category');
                }
		}
	}
	public function update_details()
	{
		$this->load->library('session');
		$item_id=$this->uri->segment(3);
		$table_name=$this->uri->segment(4);
		// print_r($item_id);die;
		$img_name=$_FILES['category_img']['name'];
		if($img_name!==''){
			$image_name=strtolower(str_replace(' ', '-',$img_name));
			$exist_name=@end(explode(',',$image_name));
			$name_test=strtolower($exist_name);
			$new_name=time().'-dattaprabodhinee-'.$name_test;
				$config['upload_path']          = './assets/images/category/';
                $config['allowed_types']        = 'gif|jpg|png|svg|ico';
				$config['file_name'] = $new_name;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('category_img'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        //$this->load->view('upload_form', $error);
						$this->session->set_flashdata('err', 'Something went to wrong!');
						redirect('seller/edit_category');
                }
                else
                {
                    $data=array(
						'name'=>$this->input->post('name'),
						'status'=>$this->input->post('status'),
						'category_img'=>$new_name,
						'description'=>$this->input->post('description')
					);
					$this->load->model('seller_model');
					$result=$this->seller_model->update_details($data,$item_id,$table_name,$config);
					if($table_name=='category'){
						$this->session->set_flashdata('msg', 'Category Update Successfully.');
						redirect('seller/category');
					}
                }
		}
		else{
			$data=array(
						'name'=>$this->input->post('name'),
						'status'=>$this->input->post('status'),
						'description'=>$this->input->post('description')
					);
					$this->load->model('seller_model');
					$result=$this->seller_model->update_details($data,$item_id,$table_name,$config='');
					if($table_name=='category'){
						$this->session->set_flashdata('msg', 'Category Update Successfully.');
						redirect('seller/category');
					}
		}
	}
	public function edit_profile()
	{
		if($this->session->userdata('seller')){
		    $user_id=$this->session->userdata('seller');
			$data['user_details']=$this->seller_model->user_details($user_id);
			// print_r($data);die;
		    if(isset($_POST['submit'])){
    			//$pincode=$this->input->post('pincode');
        	    //$pincodes=implode(', ',$pincode);
        	   // print_r($pincodes);die;
    			$data=array(
    				'name'=>$this->input->post('name'),
    				'business_name'=>$this->input->post('business_name'),
    				'email'=>$this->input->post('email'),
    				'number'=>$this->input->post('number'),
    				'street'=>$this->input->post('street'),
    				'city'=>$this->input->post('city'),
    				'state'=>$this->input->post('state')
    			);
    			$response=$this->seller_model->update_profile($data,$user_id);
    			if($response==TRUE)
    			{
    				$this->session->set_flashdata('msg', 'Profile Info Updated Successfully..');
    				redirect('seller/edit_profile/');
    			}
    			else{
    				$this->session->set_flashdata('err', 'Something Wrong!');
    				redirect('seller/edit_profile/');
    			}
    		}
			
			$this->load->view('seller/include/header');
			$this->load->view('seller/edit_profile', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller');
		}
	}
	public function add_products()
	{
		$seller_id=$this->session->userdata('seller');
		$product_no=substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz", 11)), 0, 11);
		$img_name=$_FILES['product_img']['name'];
		// $img_count=count($_FILES['product_img']['name']);
		// print_r($img_count);die;
		if($img_name!==''){
				$image_name=strtolower(str_replace(' ', '-',$img_name));
		    	$exist_name=@end(explode(',',$image_name));
				$name_test=strtolower($exist_name);
				$new_name=time().'-dattaprabodhinee-'.$name_test;
				//$loc='./upload/';
				//move_uploaded_file($_FILES['product_img']['tmp_name'],$loc);
				$config['upload_path']          = './assets/images/product/';
                $config['allowed_types']        = 'gif|jpg|png|ico';
				$config['file_name'] = $new_name;
                $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('product_img'))
                {
                        $error = array('error' => $this->upload->display_errors());
						$this->session->set_flashdata('err', 'Something went to wrong!');
						redirect('seller/add_product');
                }
                else
                {
                    $data=array(
						'user_id'=>$seller_id,
						'product_no'=>$product_no,
						'name'=>$this->input->post('name'),
						'category'=>$this->input->post('category'),
						'orignal_price'=>$this->input->post('orignal_price'),
						'price'=>$this->input->post('price'),
						'stock'=>$this->input->post('stock'),
						'packing_size'=>$this->input->post('packing_size'),
				        'packing_type'=>$this->input->post('packing_type'),
						'delivery_charge'=>$this->input->post('delivery_charge'),
						'banner_product'=>'0',
						'status'=>'0',
						'product_img'=>$new_name,
						'description'=>$this->input->post('description'),
						'long_description'=>$this->input->post('long_description')
					);
					$this->load->model('seller_model');
					$this->seller_model->add_products($data);
					$this->session->set_flashdata('msg', 'Product Added Successfully and Your Product in Review Please wait some time.');
					redirect('seller/add_product/');
                }  
			
		}
	}
	public function update_product($id)
	{
		$img_name=$_FILES['product_img']['name'];
		if($img_name!==''){
				$image_name=strtolower(str_replace(' ', '-',$img_name));
				$exist_name=@end(explode(',',$image_name));
				$name_test=strtolower($exist_name);
				$new_name=time().'-dattaprabodhinee-'.$name_test;
				$config['image_library'] = 'gd2';
				$config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
				$config['upload_path']          = './assets/images/product/';
                $config['allowed_types']        = 'gif|jpg|jpeg|png|ico';
                $config['quality'] = '60%';  
                 $config['width'] = 200;  
                 $config['height'] = 200; 
                //$config['max_size']      = 1024;
				$config['file_name'] = $new_name;
				$this->load->library('image_lib', $config);  
                 $this->image_lib->resize(); 
                $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('product_img'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        //$this->load->view('upload_form', $error);
						$this->session->set_flashdata('err', 'Something went to wrong!');
						redirect('admin/add_product');
                }
                else
                {
                    $table_name='products';
			        $product_details=$this->seller_model->get_details($id,$table_name);
            		if($product_details->product_img!=='')
            		{
            			unlink(FCPATH.'./assets/images/product/'.$product_details->product_img);
            		}
                    $data=array(
						'name'=>$this->input->post('name'),
						'category'=>$this->input->post('category'),
						'orignal_price'=>$this->input->post('orignal_price'),
						'price'=>$this->input->post('price'),
						'packing_size'=>$this->input->post('packing_size'),
						'packing_type'=>$this->input->post('packing_type'),
						'stock'=>$this->input->post('stock'),
						'status'=>$this->input->post('status'),
						'product_img'=>$new_name,
						'description'=>$this->input->post('description'),
						'long_description'=>$this->input->post('long_description')
					);
					$this->seller_model->update_products($data,$id);
					$this->session->set_flashdata('msg', 'Product Update Successfully.');
					redirect('seller/products/');
                }
		}
		else
		{
		    $data=array(
				'name'=>$this->input->post('name'),
				'category'=>$this->input->post('category'),
				'orignal_price'=>$this->input->post('orignal_price'),
				'price'=>$this->input->post('price'),
				'packing_size'=>$this->input->post('packing_size'),
				'packing_type'=>$this->input->post('packing_type'),
				'stock'=>$this->input->post('stock'),
				'status'=>$this->input->post('status'),
				'description'=>$this->input->post('description'),
				'long_description'=>$this->input->post('long_description')
			);
			$this->seller_model->update_products($data,$id);
			$this->session->set_flashdata('msg', 'Product Update Successfully.');
			redirect('seller/products/');
		}
	}
	
	public function registration()
	{
		$this->load->view('sign_up');
	}
	public function signup(){
		$name=$this->input->post('name');
		$number=$this->input->post('number');
		$email=$this->input->post('email');
		$data=array(
			'name'=>$this->input->post('name'),
			'email'=>$this->input->post('email'),
			'number'=>$this->input->post('number'),
			'password'=>$this->input->post('password')
		);
		$this->load->library('session');
		$this->load->model('model');
		$insert_id=$this->model->signup_test($number,$email);
		$uid=$insert_id->id;
		$matchemail=$insert_id->email;
		$matchnumber=$insert_id->number;
		if($uid=='1'){
			if($matchemail==$email){
			$this->session->set_flashdata('err', 'Email Address Already Exist.');
			redirect('signup');
			}
			else{
				if($matchnumber==$number){
					$this->session->set_flashdata('err', 'Mobile Number Already Exist.');
					redirect('signup');
				}
				else{
					$insert_id=$this->model->sign_up($data);
					$otp=rand(100000,999999);
					$msg="Hello ".$name." Your Dattaprabodhinee E-Store OTP for verification is ".$otp;
					// Account details
					$apiKey = urlencode('u6EtTAPkVrw-zaS0Dbm5s7llV2axVCbaPOwwyABpi4');
					$sender = urlencode('TXTLCL');
					// Prepare data for POST request
					$data = array('apikey' => $apiKey, 'numbers' => $number, 'sender' => $sender, 'message' => $msg);
					// Send the POST request with cURL
					$ch = curl_init('https://api.textlocal.in/send/');
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$response = curl_exec($ch);
					curl_close($ch);
					// Process your response here
					if($response==TRUE)
					{
						$this->session->set_flashdata('msg', 'OTP has been Send!');
						$this->session->set_userdata('otpcode', $otp);
						$this->session->set_userdata('insert_id', $insert_id);
						redirect('otp');
						
					}
					else{
						$this->session->set_flashdata('err', 'SMS Server Down! Please Try afer some time.');
						redirect('otp');
					}
				}
			}
		}
		else{
			$otp=rand(100000,999999);
					$msg="Hello ".$name." Your Dattaprabodhinee E-Store OTP for verification is ".$otp;
					// Account details
					$apiKey = urlencode('u6EtTAPkVrw-zaS0Dbm5s7llV2axVCbaPOwwyABpi4');
					$sender = urlencode('TXTLCL');
					// Prepare data for POST request
					$data = array('apikey' => $apiKey, 'numbers' => $number, 'sender' => $sender, 'message' => $msg);
					// Send the POST request with cURL
					$ch = curl_init('https://api.textlocal.in/send/');
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$response = curl_exec($ch);
					curl_close($ch);
					// Process your response here
					if($response==TRUE)
					{
						$this->session->set_flashdata('msg', 'OTP has been Send!');
						$this->session->set_userdata('otpcode', $otp);
						$this->session->set_userdata('insert_id', $insert_id);
						redirect('otp');
						
					}
					else{
						$this->session->set_flashdata('err', 'SMS Server Down! Please Try afer some time.');
						redirect('otp');
					}
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
	function payment_gateway(){
		if($this->session->userdata('seller')){
			//$data['customer']=$this->seller_model->newsletter();
			// print_r($data);die;
			$this->load->view('seller/include/header');
			$this->load->view('seller/payment_setting');
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller/');
		}
	}
	function razorpay_payment_gateway(){
		if($this->session->userdata('seller')){
			$this->load->view('seller/include/header');
			$this->load->view('seller/razorpay_payment_gateway');
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller/');
		}
	}
	public function add_razorpay_payment_gateway()
	{
		if($this->session->userdata('seller')){
		    $seller_id=$this->session->userdata('seller');
			$data=array(
			    'seller_id'=>$seller_id,
				'key_id'=>$this->input->post('key_id'),
				'key_secret'=>$this->input->post('key_secret')
			);
			$result=$this->seller_model->add_razorpay_payment_gateway($data);
			if($result==TRUE){
			    $this->session->set_flashdata('msg', 'Payment Gateway Added Successfully.');
				redirect('seller/razorpay_payment_gateway/');
			}
			else{
			    $this->session->set_flashdata('err', 'Something Wrong! Please Try Again Later.');
				redirect('seller/razorpay_payment_gateway/');
			}
		}
		else{
			redirect('seller/');
		}
	}
	public function add_payment_gateway()
	{
		if($this->session->userdata('seller')){
		    $seller_id=$this->session->userdata('seller');
			$data=array(
			    'seller_id'=>$seller_id,
				'private_key'=>$this->input->post('private_key'),
				'private_token'=>$this->input->post('private_token'),
				'private_salt'=>$this->input->post('private_salt')
			);
			$result=$this->seller_model->add_payment_gateway($data);
			if($result==TRUE){
			    $this->session->set_flashdata('msg', 'Payment Gateway Added Successfully.');
				redirect('seller/payment_gateway/');
			}
			else{
			    $this->session->set_flashdata('err', 'Something Wrong! Please Try Again Later.');
				redirect('seller/payment_gateway/');
			}
		}
		else{
			redirect('seller/');
		}
	}
	public function customers()
	{
		$this->load->library('session');
		$this->load->model('seller_model');
		if($this->session->userdata('seller')){
			$data['customer']=$this->seller_model->customers();
			//print_r($data);die;
			$this->load->view('seller/include/header');
			$this->load->view('seller/customers', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller/');
		}
	}
	public function customer_details()
	{
		$this->load->library('session');
		$this->load->model('seller_model');
		if($this->session->userdata('seller')){
			$cid=$this->uri->segment(4);
			$data['customer']=$this->seller_model->customer_details($cid);
			// print_r($data);die;
			$this->load->view('seller/include/header');
			$this->load->view('seller/customer_view', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller/');
		}
	}
	public function contact()
	{
		$this->load->library('session');
		$this->load->model('seller_model');
		if($this->session->userdata('seller')){
			$data['customer']=$this->seller_model->contact();
			//print_r($data);die;
			$this->load->view('seller/include/header');
			$this->load->view('seller/contact', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller/');
		}
	}
	public function deleteItem()
	{
		$this->load->library('session');
		$this->load->model('seller_model');
		if($this->session->userdata('seller')){
			$did=$this->uri->segment(3);
			$table_name=$this->uri->segment(4);
			// print_r($table_name);die;
			// $did=$_POST['id'];
			$del=$this->seller_model->deleteItem($did,$table_name);
			if($del==true){
				echo "success";
			}
			else{
				echo "somthing wrong!";
			}
		}
		else{
			redirect('seller/');
		}
	}
	public function ActionOnItem()
	{
		$this->load->library('session');
		$this->load->model('seller_model');
		if($this->session->userdata('seller')){
			$eid=$this->uri->segment(3);
			$table_name=$this->uri->segment(4);
			$event=$this->uri->segment(5);
			$redirect_url=$this->uri->segment(6);
			$ev=$this->seller_model->ActionOnItem($eid,$table_name,$event);
			if($ev==true){
				redirect('seller/'.$redirect_url);
			}
			else{
				echo "somthing wrong!";
			}
		}
		else{
			redirect('seller/');
		}
	}
	public function Audit() {
	    if($this->session->userdata('seller')){
			$data['product']=$this->seller_model->products2();
			//echo"<pre>";
			//print_r($data['seller_details']);die;
			$this->load->view('seller/include/header');
			$this->load->view('seller/audit', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller/');
		}
	}
	function salesDetails($id) {
	    if($this->session->userdata('seller')){
			$data['product']=$this->seller_model->salesDetails($id);
			$this->load->view('seller/include/header');
			$this->load->view('seller/sales_details', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller/');
		}
	}
	function getAudit() {
	    if($this->session->userdata('seller')){
	        $seller_id = $this->session->userdata('seller');
			$data['products'] = $this->seller_model->getAudit($seller_id);
	        $this->load->view('seller/include/header');
			$this->load->view('seller/audit_report', $data);
			$this->load->view('seller/include/footer');
		}
		else{
			redirect('seller/');
		}
	    
	}
	function addAudit(){
	    $seller_id = $this->session->userdata('seller');
	    $input_val = $this->input->post("wholesale");
	    if($input_val == 1) {
	        $wholesale = 1;
	    }
	    else {
	        $wholesale = 0;
	    }
	    $data = array(
	        'seller_id'=>$seller_id,
	        "bill_no"=>$this->input->post("bill_no"),
	        "payment_mode"=>$this->input->post("payment_mode"),
	        "date"=>$this->input->post("date"),
	        "customer_name"=>$this->input->post("customer_name"),
	        "number"=>$this->input->post("number"),
	        "address"=>$this->input->post("address"),
	        "reference_name"=>$this->input->post("reference_name"),
	        "wholesale"=>$wholesale,
	        "product"=>$this->input->post("product_name"),
	        "unit_price"=>$this->input->post("price"),
	        "qty"=>$this->input->post("qty"),
	        );
	        $response = $this->seller_model->addAudit($data);
	        if($response == TRUE) {
	            $this->session->set_flashdata("msg", "Saved.");
	            redirect("seller/audit/");
	        }
	        else{
	            $this->session->set_flashdata("msg", "Something went to wrong!");
	            redirect("seller/audit/");
	        }
	}
}
