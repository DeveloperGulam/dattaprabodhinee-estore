<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
		$this->load->library('session');
    }
    
    function is_login(){
        if(!$this->session->userdata('admin'))
		{
			return redirect('admin/');
		}
    }
    
	public function index()
	{
		$this->load->view('admin/login');
	}
	
	public function admin_login()
	{
		$username=$this->input->post('email');
		$password=$this->input->post('password');
		$fetchdata=$this->admin_model->admin_login($username);
		// print_r($fetchdata->id);exit;
		$dbid=$fetchdata->id;
		$dbname=$fetchdata->name;
		$dbnumber=$fetchdata->number;
		$dbmail=$fetchdata->email;
		$dbpassword=$fetchdata->password;
		
			if($dbmail==$username){
				if($dbpassword==$password){
					$this->session->set_userdata('admin', $dbid);
					redirect('admin/dashboard/');
				}
				else{
					$this->session->set_flashdata('err', 'You have enter wrong password!');
					redirect('admin/');
				}
			}
			else{
				$this->session->set_flashdata('err', 'Email Address does not exist!');
				redirect('admin/');
			}
	}
	public function dashboard()
	{
		if($this->session->userdata('admin')){
			$limit=5;
			$data['order_details']=$this->admin_model->orders($limit);
			$data['pending_orders']=$this->admin_model->count_orders($status=0);
			$data['placed_orders']=$this->admin_model->count_orders($status=1);
			$data['progress_orders']=$this->admin_model->count_orders($status=2);
			$data['cancel_orders']=$this->admin_model->count_orders($status=3);
			$data['completed_orders']=$this->admin_model->count_orders($status=4);
			$this->load->view('admin/include/header');
			$this->load->view('admin/index', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
		
	}
	function orders()
	{
		if($this->session->userdata('admin')){
			$limit='';
			$data['order_details']=$this->admin_model->orders($limit);
			// print_r($data);die;
			$this->load->view('admin/include/header');
			$this->load->view('admin/orders', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	function request_stocks()
	{
		if($this->session->userdata('admin')){
		    $data['request_stocks']=$this->admin_model->request_stocks();
			$this->load->view('admin/include/header');
			$this->load->view('admin/request_stocks',$data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	function stockAction($sid)
	{
	    $actionName=$this->uri->segment(4);
	    if($actionName=='transfer'){
	        $data=array(
	            'stock_status'=>1
	        );
	        $this->session->set_flashdata('msg', 'Stock Transfered Successfully');
	    }
	    if($actionName=='reject'){
	        $data=array(
	            'stock_status'=>3
	        );
	        $this->admin_model->stockAction($data,$sid);
	        $this->session->set_flashdata('msg', 'Stock Rejected Successfully');
	    }
	    redirect('admin/request_stocks/');
	}
	function stocks_history()
	{
		if($this->session->userdata('admin')){
		    $data['stocks_history']=$this->admin_model->stocks_history();
			$this->load->view('admin/include/header');
			$this->load->view('admin/stocks_history',$data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	function transfer_stock()
	{
		if($this->session->userdata('admin')){
		    $data['seller_details']=$this->admin_model->seller_details();
		    $data['product']=$this->admin_model->products();
			$this->load->view('admin/include/header');
			$this->load->view('admin/transfer_stock',$data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	public function transfer_stock_now()
	{
		if($this->session->userdata('admin')){
			$data=array(
    			'product_id'=>$this->input->post('product_id'),
    			'product_name'=>$this->input->post('name'),
    			'price'=>$this->input->post('price'),
    			'packing_size'=>$this->input->post('packing_size'),
    			'packing_type'=>$this->input->post('packing_type'),
    			'stock_qty'=>$this->input->post('stock'),
    			'stock_status'=>1,
    			'seller_id'=>$this->input->post('seller_id'),
    		);
    		$res=$this->admin_model->transfer_stock($data);
			if($res==TRUE)
			{
				$this->session->set_flashdata('msg', 'Stock Transfered Successfully.');
    		    redirect('admin/transfer_stock/');
			}
			else{
				$this->session->set_flashdata('err', 'Something went to wrong!');
    		    redirect('admin/transfer_stock/');
			}
		}
		else{
			redirect('admin');
		}
	}
	function order_request()
	{
		if($this->session->userdata('admin')){
			$limit='';
			$data['order_details']=$this->admin_model->order_request($limit);
			//echo"<pre>";
			//print_r($data);die;
			$this->load->view('admin/include/header');
			$this->load->view('admin/order_request', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	public function assign_order()
	{
		if($this->session->userdata('admin')){
			$pid=$this->uri->segment(4);
			$data['order_info']=$this->admin_model->order_details($pid);
			$data['item_info']=$this->admin_model->item_details($pid);
			$data['seller_details']=$this->admin_model->seller_details();
			//echo"<pre>";
			//print_r($data['seller_details']);die;
			$this->load->view('admin/include/header');
			$this->load->view('admin/assign_order', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	public function assign_now($id)
	{
		if($this->session->userdata('admin')){
			$data=array(
				'seller_id'=>$this->input->post('seller_id')
			);
			//print_r($data);die;
			$result=$this->admin_model->assign_order($data,$id);
			if($result==TRUE){
				redirect('admin/order_request');
			}
			else{
				redirect('admin/order_request');
			}
		}
		else{
			redirect('admin/');
		}
	}
	public function Report()
	{
		if($this->session->userdata('admin')){
			$order_id=$this->uri->segment(4);
			$data['report_info']=$this->admin_model->report($order_id);
			// print_r($data);die;
			// $data['item_info']=$this->admin_model->item_details($pid);
			$this->load->view('admin/include/header');
			$this->load->view('admin/order_report', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	public function order_details()
	{
		if($this->session->userdata('admin')){
			$pid=$this->uri->segment(4);
			$data['order_info']=$this->admin_model->order_details($pid);
			$data['item_info']=$this->admin_model->item_details($pid);
			$this->load->view('admin/include/header');
			$this->load->view('admin/order_view', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	public function edit_order()
	{
		if($this->session->userdata('admin')){
			$pid=$this->uri->segment(4);
			$data['order_info']=$this->admin_model->order_details($pid);
			$data['item_info']=$this->admin_model->item_details($pid);
			$this->load->view('admin/include/header');
			$this->load->view('admin/order_edit', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	public function update_order_status($id)
	{
		if($this->session->userdata('admin')){
			$data=array(
				'status'=>$this->input->post('status')
			);
			$result=$this->admin_model->update_order_status($data,$id);
			if($result==TRUE){
				redirect('admin/orders');
			}
			else{
				redirect('admin/orders');
			}
		}
		else{
			redirect('admin/');
		}
	}
	public function createGroup()
	{
		if($this->session->userdata('admin')){
		    $data['seller_details']=$this->admin_model->seller_details();
			$this->load->view('admin/include/header');
			$this->load->view('admin/create_group',$data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	function createNewGroup()
	{
	    $seller_id=$this->input->post('seller_id');
        $sellers_id=implode(', ',$seller_id);
	    $data=array(
	        'group_name'=>$this->input->post('group_name'),
	        'seller_id'=>$sellers_id
	    );
	    $this->admin_model->createNewGroup($data);
	    $this->session->set_flashdata('msg', 'Group Created Successfully.');
		redirect('admin/createGroup/');
	}
	function groupList()
	{
	    if($this->session->userdata('admin')){
		    $data['group_list']=$this->admin_model->groupList();
		    $data['seller_details']=$this->admin_model->seller_details();
			$this->load->view('admin/include/header');
			$this->load->view('admin/group_list',$data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	public function add_coupon()
	{
		if($this->session->userdata('admin')){
			$this->load->view('admin/include/header');
			$this->load->view('admin/add_coupon');
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	public function add_promo()
	{
		if($this->session->userdata('admin')){
			$data=array(
				'name'=>$this->input->post('name'),
				'code'=>$this->input->post('code'),
				'discount_type'=>$this->input->post('discount_type'),
				'value'=>$this->input->post('value'),
				'from_date'=>$this->input->post('from_date'),
				'to_date'=>$this->input->post('to_date'),
				'status'=>$this->input->post('status')
			);
			$result=$this->admin_model->add_promo($data);
			if($result==TRUE)
			{
				$this->session->set_flashdata('msg', 'Coupon (Promocode) Added Successfully.');
				redirect('admin/add_coupon/');
			}
			else{
				$this->session->set_flashdata('err', 'Something Wrong !');
				redirect('admin/add_coupon/');
			}
		}
		else{
			redirect('admin');
		}
	}
	public function products()
	{
		if($this->session->userdata('admin')){
			$data['product']=$this->admin_model->products();
			//print_r($data);die;
			$this->load->view('admin/include/header');
			$this->load->view('admin/products', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin');
		}
	}
	public function product_details()
	{
		$this->load->library('session');
		$this->load->model('admin_model');
		if($this->session->userdata('admin')){
			$pid=$this->uri->segment(5);
			$data['product']=$this->admin_model->product_details($pid);
			// print_r($data);die;
			$this->load->view('admin/include/header');
			$this->load->view('admin/product_view', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	public function add_product()
	{
		if($this->session->userdata('admin')){
			$data['category_list']=$this->admin_model->category_list();
			$data['sub_category_list']=$this->admin_model->sub_category();
			// print_r($s);die;
			$this->load->view('admin/include/header');
			$this->load->view('admin/add_product',$data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin');
		}
	}
	function get_sub_category()
	{
		// $id=14;
		$id = $this->input->post('id',TRUE);
		$data=$this->admin_model->sub_category($id);
        echo json_encode($data);
        // print_r($data);
	}
	public function edit_product()
	{
		if($this->session->userdata('admin')){
			$pid=$this->uri->segment(5);
			$data['category_list']=$this->admin_model->category_list();
			$data['sub_category_list']=$this->admin_model->sub_category();
			$table_name='products';
			$data['details']=$this->admin_model->get_details($pid,$table_name);
			// print_r($data);die;
			$this->load->view('admin/include/header');
			$this->load->view('admin/edit_product', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
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
			        $product_details=$this->admin_model->get_details($id,$table_name);
            		if($product_details->product_img!=='')
            		{
            			unlink(FCPATH.'./assets/images/product/'.$product_details->product_img);
            		}
                    $data=array(
						'name'=>$this->input->post('name'),
						'category'=>$this->input->post('category'),
						'sub_category_id'=>$this->input->post('sub_categtory_id'),
						'orignal_price'=>$this->input->post('orignal_price'),
						'price'=>$this->input->post('price'),
						'packing_size'=>$this->input->post('packing_size'),
						'packing_type'=>$this->input->post('packing_type'),
						'stock'=>$this->input->post('stock'),
						'delivery_charge'=>$this->input->post('delivery_charge'),
						'banner_product'=>$this->input->post('banner_product'),
						'youtube'=>$this->input->post('youtube'),
						'subcription'=>$this->input->post('subcription'),
						'status'=>$this->input->post('status'),
						'product_img'=>$new_name,
						'description'=>$this->input->post('description'),
						'long_description'=>$this->input->post('long_description')
					);
					$this->admin_model->update_products($data,$id);
					$this->session->set_flashdata('msg', 'Product Update Successfully.');
					redirect('admin/products/');
                }
		}
		else
		{
		    $data=array(
				'name'=>$this->input->post('name'),
				'category'=>$this->input->post('category'),
				'sub_category_id'=>$this->input->post('sub_categtory_id'),
				'orignal_price'=>$this->input->post('orignal_price'),
				'price'=>$this->input->post('price'),
				'packing_size'=>$this->input->post('packing_size'),
				'packing_type'=>$this->input->post('packing_type'),
				'stock'=>$this->input->post('stock'),
				'delivery_charge'=>$this->input->post('delivery_charge'),
				'banner_product'=>$this->input->post('banner_product'),
				'youtube'=>$this->input->post('youtube'),
				'subcription'=>$this->input->post('subcription'),
				'status'=>$this->input->post('status'),
				'description'=>$this->input->post('description'),
				'long_description'=>$this->input->post('long_description')
			);
			$this->admin_model->update_products($data,$id);
			$this->session->set_flashdata('msg', 'Product Update Successfully.');
			redirect('admin/products/');
		}
	}
	public function add_category()
	{
		if($this->session->userdata('admin')){
			$this->load->view('admin/include/header');
			$this->load->view('admin/add_category');
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin');
		}
	}
	public function sub_category()
	{
		if($this->session->userdata('admin')){
			$data['category']=$this->admin_model->sub_category();
			$data['match_category']=$this->admin_model->category();
			// print_r($data['match_category']);die;
			$this->load->view('admin/include/header');
			$this->load->view('admin/sub_category', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin');
		}
	}
	public function edit_sub_category()
	{
		if($this->session->userdata('admin')){
			$id=$this->uri->segment(3);
			$table_name=$this->uri->segment(4);
			$data['category_list']=$this->admin_model->category_list();
			$data['details']=$this->admin_model->get_details($id,$table_name);
			$this->load->view('admin/include/header');
			$this->load->view('admin/edit_sub_category', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin');
		}
	}
	public function update_details2()
	{
		$item_id=$this->uri->segment(3);
		$table_name=$this->uri->segment(4);
		$img_name=$_FILES['sub_category_img']['name'];
		if($img_name!==''){
			$image_name=strtolower(str_replace(' ', '-',$img_name));
			$exist_name=@end(explode(',',$image_name));
			$name_test=strtolower($exist_name);
			$new_name=time().'-dattaprabodhinee-'.$name_test;
				$config['upload_path']          = './assets/images/sub_category/';
                $config['allowed_types']        = 'gif|jpg|jpeg|png|svg|ico';
				$config['file_name'] = $new_name;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('sub_category_img'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        //$this->load->view('upload_form', $error);
						$this->session->set_flashdata('err', $error);
						redirect('admin/add_sub_category');
                }
                else
                {
					$data=array(
						'category_id'=>$this->input->post('category_id'),
						'sub_category_name'=>$this->input->post('name'),
						'youtube'=>$this->input->post('youtube'),
						'blog'=>$this->input->post('blog'),
						'orignal_price'=>$this->input->post('orignal_price'),
						'price'=>$this->input->post('price'),
						'stock'=>$this->input->post('stock'),
						'status'=>$this->input->post('status'),
						'sub_category_img'=>$new_name,
						'description'=>$this->input->post('description')
					);
					$result=$this->admin_model->update_details($data,$item_id,$table_name,$config='');
					if($table_name=='sub_category'){
						$this->session->set_flashdata('msg', 'Sub Category Update Successfully.');
						redirect('admin/sub_category/');
					}
				}
		}
		else
		{
		    
		    $data=array(
						'category_id'=>$this->input->post('category_id'),
						'sub_category_name'=>$this->input->post('name'),
						'orignal_price'=>$this->input->post('orignal_price'),
						'price'=>$this->input->post('price'),
						'stock'=>$this->input->post('stock'),
						'youtube'=>$this->input->post('youtube'),
						'blog'=>$this->input->post('blog'),
						'status'=>$this->input->post('status'),
						'description'=>$this->input->post('description')
					);
					$result=$this->admin_model->update_details($data,$item_id,$table_name,$config='');
					if($table_name=='sub_category'){
						$this->session->set_flashdata('msg', 'Sub Category Update Successfully.');
						redirect('admin/sub_category/');
					}
		}
			
	}
	public function add_sub_category()
	{
		if($this->session->userdata('admin')){
			$data['category_list']=$this->admin_model->category_list();
			$this->load->view('admin/include/header');
			$this->load->view('admin/add_sub_category', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	public function add_sub_categories()
	{
	    //echo "hi";die;
	    if($this->input->post('category_id')=='')
        {
            $this->session->set_flashdata('err', 'Please Choose Category.');
			redirect('admin/add_sub_category/');
        }
		$img_name=$_FILES['sub_category_img']['name'];
		if($img_name!==''){
			$image_name=strtolower(str_replace(' ', '-',$img_name));
			$exist_name=@end(explode(',',$image_name));
			$name_test=strtolower($exist_name);
			$new_name=time().'-dattaprabodhinee-'.$name_test;
				$config['upload_path']          = './assets/images/sub_category/';
                $config['allowed_types']        = 'gif|jpg|jpeg|png|svg|ico';
				$config['file_name'] = $new_name;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('sub_category_img'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        //$this->load->view('upload_form', $error);
						$this->session->set_flashdata('err', $error);
						redirect('admin/add_sub_category/');
                }
                else
                {
					$data=array(
						'category_id'=>$this->input->post('category_id'),
						'sub_category_name'=>$this->input->post('name'),
						'youtube'=>$this->input->post('youtube'),
						'blog'=>$this->input->post('blog'),
						'status'=>$this->input->post('status'),
						'sub_category_img'=>$new_name,
						'description'=>$this->input->post('description')
					);
					$this->admin_model->add_sub_category($data);
					$this->session->set_flashdata('msg', 'Sub Category Added Successfully.');
					redirect('admin/add_sub_category/');
				}
		}
		else
		{
		    $data=array(
						'category_id'=>$this->input->post('category_id'),
						'sub_category_name'=>$this->input->post('name'),
						'youtube'=>$this->input->post('youtube'),
						'blog'=>$this->input->post('blog'),
						'status'=>$this->input->post('status'),
						'description'=>$this->input->post('description')
					);
					$this->admin_model->add_sub_category($data);
					$this->session->set_flashdata('msg', 'Sub Category Added Successfully.');
					redirect('admin/add_sub_category/');
		}
	}
	public function add_categories()
	{
		$img_name=$_FILES['category_img']['name'];
		if($img_name!==''){
			$image_name=strtolower(str_replace(' ', '-',$img_name));
			$exist_name=@end(explode(',',$image_name));
			$name_test=strtolower($exist_name);
			$new_name=time().'-dattaprabodhinee-'.$name_test;
				$config['upload_path']          = './assets/images/category/';
                $config['allowed_types']        = 'gif|jpg|jpeg|png|svg|ico';
				$config['file_name'] = $new_name;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('category_img'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        //$this->load->view('upload_form', $error);
						$this->session->set_flashdata('err', 'Something went to wrong!');
						redirect('admin/add_category');
                }
                else
                {
                    $data=array(
						'name'=>$this->input->post('name'),
						'status'=>$this->input->post('status'),
						'category_img'=>$new_name,
						'description'=>$this->input->post('description')
					);
					$this->load->model('admin_model');
					$this->admin_model->add_category($data);
					$this->session->set_flashdata('msg', 'Category Added Successfully.');
					redirect('admin/add_category');
                }
		}
		else
		{
		    $data=array(
						'name'=>$this->input->post('name'),
						'status'=>$this->input->post('status'),
						'description'=>$this->input->post('description')
					);
					$this->load->model('admin_model');
					$this->admin_model->add_category($data);
					$this->session->set_flashdata('msg', 'Category Added Successfully.');
					redirect('admin/add_category');
		}
	}
	public function category()
	{
		$this->load->library('session');
		$this->load->model('admin_model');
		if($this->session->userdata('admin')){
			$data['category']=$this->admin_model->category();
			//print_r($data);die;
			$this->load->view('admin/include/header');
			$this->load->view('admin/category', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin');
		}
	}
	public function edit_category()
	{
		$this->load->library('session');
		$this->load->model('admin_model');
		if($this->session->userdata('admin')){
			$id=$this->uri->segment(3);
			$table_name=$this->uri->segment(4);
			$data['details']=$this->admin_model->get_details($id,$table_name);
			$this->load->view('admin/include/header');
			$this->load->view('admin/edit_category', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin');
		}
	}
	public function update_details()
	{
		$item_id=$this->uri->segment(3);
		$table_name=$this->uri->segment(4);
		$img_name=$_FILES['category_img']['name'];
		if($img_name!==''){
			$image_name=strtolower(str_replace(' ', '-',$img_name));
			$exist_name=@end(explode(',',$image_name));
			$name_test=strtolower($exist_name);
			$new_name=time().'-dattaprabodhinee-'.$name_test;
				$config['upload_path']          = './assets/images/category/';
                $config['allowed_types']        = 'gif|jpg|jpeg|png|svg|ico';
				$config['file_name'] = $new_name;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('category_img'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        //$this->load->view('upload_form', $error);
						$this->session->set_flashdata('err', 'Something went to wrong!');
						redirect('admin/edit_category');
                }
                else
                {
                    $data=array(
						'name'=>$this->input->post('name'),
						'status'=>$this->input->post('status'),
						'category_img'=>$new_name,
						'description'=>$this->input->post('description')
					);
					$this->load->model('admin_model');
					$result=$this->admin_model->update_details($data,$item_id,$table_name,$config);
					if($table_name=='category'){
						$this->session->set_flashdata('msg', 'Category Update Successfully.');
						redirect('admin/category');
					}
                }
		}
		else{
			$data=array(
						'name'=>$this->input->post('name'),
						'status'=>$this->input->post('status'),
						'description'=>$this->input->post('description')
					);
					$this->load->model('admin_model');
					$result=$this->admin_model->update_details($data,$item_id,$table_name,$config='');
					if($table_name=='category'){
						$this->session->set_flashdata('msg', 'Category Update Successfully.');
						redirect('admin/category');
					}
		}
	}
	public function add_products()
	{
	    if(empty($this->input->post('sub_categtory_id')))
	    {
	        $sub_category="";
	    }
	    else
	    {
	        $sub_category=$this->input->post('sub_categtory_id');
	    }
	    
	    $size=$this->input->post('size');
	    $packing_type=$this->input->post('type');
	    $packing_size=$size.' '.$packing_type;
		$product_no=substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz", 11)), 0, 11);
		$img_name=$_FILES['product_img']['name'];
		// $img_count=count($_FILES['product_img']['name']);
		// print_r($img_count);die;
		if($img_name!==''){
				$image_name=strtolower(str_replace(' ', '-',$img_name));
				$exist_name=@end(explode(',',$image_name));
				$name_test=strtolower($exist_name);
				$new_name=time().'-dattaprabodhinee-'.$name_test;
				$config['upload_path']          = './assets/images/product/';
                $config['allowed_types']        = 'gif|jpg|jpeg|png|ico';
				$config['file_name'] = $new_name;
                $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('product_img'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        //$this->load->view('upload_form', $error);
						$this->session->set_flashdata('err', 'Something went to wrong!');
						redirect('admin/add_product/');
                }
                else
                {
                    if($this->input->post('category')=='')
                    {
                        $this->session->set_flashdata('err', 'Please Choose Category.');
						redirect('admin/add_product/');
                    }
                    if($this->input->post('sub_categtory_id')=='')
                    {
                        $this->session->set_flashdata('err', 'Please Choose Sub Category.');
						redirect('admin/add_product/');
                    }
                    $data=array(
						'user_id'=>'0',
						'product_no'=>$product_no,
						'name'=>$this->input->post('name'),
						'category'=>$this->input->post('category'),
						'sub_category_id'=>$sub_category,
						'orignal_price'=>$this->input->post('orignal_price'),
						'price'=>$this->input->post('price'),
						'stock'=>$this->input->post('stock'),
						'delivery_charge'=>$this->input->post('delivery_charge'),
						'banner_product'=>$this->input->post('banner_product'),
						'youtube'=>$this->input->post('youtube'),
						'packing_size'=>$this->input->post('packing_size'),
				        'packing_type'=>$this->input->post('packing_type'),
						'subcription'=>$this->input->post('subcription'),
						'status'=>$this->input->post('status'),
						'product_img'=>$new_name,
						'description'=>$this->input->post('description'),
						'long_description'=>$this->input->post('long_description')
					);
					$this->load->model('admin_model');
					$this->admin_model->add_products($data);
					$this->session->set_flashdata('msg', 'Product Added Successfully.');
					redirect('admin/add_product');
                }  
			
		}
		$data=array(
						'user_id'=>'0',
						'product_no'=>$product_no,
						'name'=>$this->input->post('name'),
						'category'=>$this->input->post('category'),
						'sub_category_id'=>$sub_category,
						'orignal_price'=>$this->input->post('orignal_price'),
						'price'=>$this->input->post('price'),
						'stock'=>$this->input->post('stock'),
						'packing_size'=>$this->input->post('packing_size'),
				        'packing_type'=>$this->input->post('packing_type'),
						'delivery_charge'=>$this->input->post('delivery_charge'),
						'banner_product'=>$this->input->post('banner_product'),
						'youtube'=>$this->input->post('youtube'),
						'subcription'=>$this->input->post('subcription'),
						'status'=>$this->input->post('status'),
						'description'=>$this->input->post('description'),
						'long_description'=>$this->input->post('long_description')
					);
					$this->load->model('admin_model');
					$this->admin_model->add_products($data);
					$this->session->set_flashdata('msg', 'Product Added Successfully.');
					redirect('admin/add_product');
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
	public function otp()
	{
		$this->load->library('session');
		$this->load->view('otp');
	}
	public function verify_otp()
	{
		$this->load->library('session');
		$otpcodes=$this->session->userdata('otpcode');
		$insert_id=$this->session->userdata('insert_id');
		$user_id=$insert_id->id;
		$otp=$this->input->post('otp');
		if($otpcodes==$otp){
			$this->load->model('model');
			$updated=$insert_id=$this->model->verification_update($user_id);
			if($updated==TRUE){
				$this->session->set_userdata('userlogin', $insert_id);
				redirect(base_url());
			}
		}
		else{
			$this->session->set_flashdata('err', 'Wrong OTP !');
			redirect('otp');
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
	function newsletter(){
		$this->load->library('session');
		$this->load->model('admin_model');
		if($this->session->userdata('admin')){
			$data['customer']=$this->admin_model->newsletter();
			// print_r($data);die;
			$this->load->view('admin/include/header');
			$this->load->view('admin/newsletter', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	public function customers()
	{
		$this->load->library('session');
		$this->load->model('admin_model');
		if($this->session->userdata('admin')){
			$data['customer']=$this->admin_model->customers();
			//print_r($data);die;
			$this->load->view('admin/include/header');
			$this->load->view('admin/customers', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	public function customer_details()
	{
		$this->load->library('session');
		$this->load->model('admin_model');
		if($this->session->userdata('admin')){
			$cid=$this->uri->segment(4);
			$data['customer']=$this->admin_model->customer_details($cid);
			// print_r($data);die;
			$this->load->view('admin/include/header');
			$this->load->view('admin/customer_view', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	public function contact()
	{
		$this->load->library('session');
		$this->load->model('admin_model');
		if($this->session->userdata('admin')){
			$data['customer']=$this->admin_model->contact();
			//print_r($data);die;
			$this->load->view('admin/include/header');
			$this->load->view('admin/contact', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	public function deleteItems()
	{
		if($this->session->userdata('admin')){
			$pids=$this->input->post('product_id');
			$this->admin_model->deleteItems($pids);
			echo "success";
		}
		else{
			redirect('admin/');
		}
	}
	public function deleteItem()
	{
		if($this->session->userdata('admin')){
			$did=$this->uri->segment(3);
			$table_name=$this->uri->segment(4);
			$redirect_name=$this->uri->segment(5);
			$redirect_url=base_url('admin/'.$table_name.'/');
		//	print_r($table_name);die;
			// $did=$_POST['id'];
			$del=$this->admin_model->deleteItem($did,$table_name);
			if($del==true){
			    if($redirect_url==''){
				    redirect($redirect_url);
			    }
			    else
			    {
			        echo "success";
			    }
			}
			else{
				echo "somthing wrong!";
			}
		}
		else{
			redirect('admin/');
		}
	}
	public function ActionOnItem()
	{
		$this->load->library('session');
		$this->load->model('admin_model');
		if($this->session->userdata('admin')){
			$eid=$this->uri->segment(3);
			$table_name=$this->uri->segment(4);
			$event=$this->uri->segment(5);
			$redirect_url=$this->uri->segment(6);
			$ev=$this->admin_model->ActionOnItem($eid,$table_name,$event);
			if($ev==true){
				redirect('admin/'.$redirect_url);
			}
			else{
				echo "somthing wrong!";
			}
		}
		else{
			redirect('admin/');
		}
	}
	
	public function Audit() {
	    if($this->session->userdata('admin')){
			$pid=$this->uri->segment(4);
			$data['product']=$this->admin_model->products();
			//echo"<pre>";
			//print_r($data['seller_details']);die;
			$this->load->view('admin/include/header');
			$this->load->view('admin/audit', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	function salesDetails($id) {
	    if($this->session->userdata('admin')){
			$data['product']=$this->admin_model->salesDetails($id);
			$this->load->view('admin/include/header');
			$this->load->view('admin/sales_details', $data);
			$this->load->view('admin/include/footer');
		}
		else{
			redirect('admin/');
		}
	}
	function getAudit() {
	    $data['products'] = $this->admin_model->getAudit();
	    $this->load->view('admin/include/header');
			$this->load->view('admin/audit_report', $data);
			$this->load->view('admin/include/footer');
	}
	function addAudit(){
	    $input_val = $this->input->post("wholesale");
	    if($input_val == 1) {
	        $wholesale = 1;
	    }
	    else {
	        $wholesale = 0;
	    }
	    $data = array(
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
	        $response = $this->admin_model->addAudit($data);
	        if($response == TRUE) {
	            $this->session->set_flashdata("msg", "Saved.");
	            redirect("admin/audit/");
	        }
	        else{
	            $this->session->set_flashdata("msg", "Something went to wrong!");
	            redirect("admin/audit/");
	        }
	}
	
	function users_review()
	{
	    $this->is_login();
	    $data['title'] = "Users Review";
		$data['users_review']=$this->admin_model->users_review();
		$this->load->view('admin/include/header');
		$this->load->view('admin/users_review',$data);
		$this->load->view('admin/include/footer');
	}
	
	function pending_review()
	{
	    $this->is_login();
	    $data['title'] = "Pending Review";
		$data['users_review']=$this->admin_model->users_review($clause=0);
		$this->load->view('admin/include/header');
		$this->load->view('admin/pending_review',$data);
		$this->load->view('admin/include/footer');
	}
	
	public function accept_review($id)
	{
		$this->is_login();
		$data=array(
			'status'=> 1
		);
		$result=$this->admin_model->update_data($data, $id);
		if($result==TRUE){
			redirect('admin/pending_review');
		} else{
			redirect('admin/pending_review');
		}
	}
}
