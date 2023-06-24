<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_controller extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
		$this->load->library('session');
		$this->load->library('cart');
        $this->load->model('model');
		$this->load->helper("url");
		$this->load->library('email'); 
    }
    function smsApp(){
        $customer_name="Gulam";
		// $this->load->view('welcome_message');
		$this->load->view('test',$customer_name);
        // $email = "gulamgaus156@gmail.com";
        // $msg = "Dear Sir/Mam, your order successfully placed.";
         //email
        //  $email_setting  = array('mailtype'=>'html');
        // $this->email->initialize($email_setting);
        // $this->email->set_header('Content-Type', 'text/html');
        //  $from_email = "gulam.gaus@lovzme.com";
        //  $this->email->from($from_email, 'Lovzme'); 
        //  $this->email->to($email);
        //  $this->email->subject('Order Placed Successfully'); 
        //  $this->email->message($this->load->view('registration_email',$msg, true));
        //  if($this->email->send()) {
        //      echo "success";
        //  } else {
        //      echo 'Message could not be sent.';
        //      echo 'Mailer Error: ' . $this->email->ErrorInfo;
        //  }
    }
	public function index()
	{
		$data['cart_products']=$this->cart->contents();
		if (!$this->agent->is_mobile()) {
		    $limit = 5;
		}
		else{
		    $limit = 4;
		}
		$data['latest_product']=$this->model->latest_products($limit);
		$data['categories']=$this->model->get_category();
		$data['astrology_books']=$this->model->astrology_books($limit);
		//print_r($data['categories']);die;
		$data['herb']=$this->model->banner_products();
		$data['banner_category']=$this->model->banner_products2();
		//print_r($data['herb']);die;
		$data['herbs']=$this->model->herbs($limit);
		
		$data['nine_categories']=$this->model->get_nine_category();
		if($this->session->userdata('userlogin'))
		{
			$user_id=$this->session->userdata('userlogin');
			$data['logged_user']=$this->model->user_details($user_id);
		}
		if (!$this->agent->is_mobile()) {
            $this->load->view('include/header', $data);
		    $this->load->view('index', $data);
		    $this->load->view('include/footer', $data);
        }
        else {
            $this->load->view('mobile/include/header', $data);
		    $this->load->view('mobile/index', $data);
		    $this->load->view('mobile/include/footer', $data);
        }
	}
	public function cart()
	{
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
		$data['cart_products']=$this->cart->contents();
		if($this->session->userdata('userlogin'))
		{
			$user_id=$this->session->userdata('userlogin');
			$data['logged_user']=$this->model->user_details($user_id);
		}
		if (!$this->agent->is_mobile()) {
            redirect(base_url());
        }
        else {
            $this->load->view('mobile/include/header', $data);
		    $this->load->view('mobile/cart', $data);
		    $this->load->view('mobile/include/footer', $data);
        }
	}
	public function edit_profile()
	{
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
		$data['cart_products']=$this->cart->contents();
		if($this->session->userdata('userlogin'))
		{
			$user_id=$this->session->userdata('userlogin');
			$data['logged_user']=$this->model->user_details($user_id);
		}
		if (!$this->agent->is_mobile()) {
            redirect(base_url());
        }
        else {
            $this->load->view('mobile/include/header', $data);
		    $this->load->view('mobile/edit_profile', $data);
		    $this->load->view('mobile/include/footer', $data);
        }
	}
	public function update_profile($uid)
	{
	    $user_contact = $this->input->post('number');
	    $user_email = $this->input->post('email');
	    $res=$this->model->update_profile_validate($user_contact,$user_email, $uid);
	    if(!empty($res)){
	        $this->session->set_flashdata('err', $res);
			redirect('edit-profile/');
	    }
	    else{
    		$data=array(
    			'name'=>$this->input->post('name'),
    			'email'=>$user_email,
    			'number'=>$user_contact,
    			'city'=>$this->input->post('city'),
    			'state'=>$this->input->post('state'),
    			'zipcode'=>$this->input->post('pincode'),
    			'address'=>$this->input->post('address')
    		);
    		$response=$this->model->update_profile($data,$uid);
    		if($response==TRUE){
    			$this->session->set_flashdata('msg', 'Profile Updated Successfully.');
    			redirect('edit-profile/');
    		}
    		else{
    			$this->session->set_flashdata('err', 'Something Wrong !');
    			redirect('edit-profile/');
    		}
	    }
	}
	public function categories()
	{
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
		$data['cart_products']=$this->cart->contents();
		if($this->session->userdata('userlogin'))
		{
			$user_id=$this->session->userdata('userlogin');
			$data['logged_user']=$this->model->user_details($user_id);
		}
		if (!$this->agent->is_mobile()) {
            redirect(base_url());
        }
        else {
            $this->load->view('mobile/include/header', $data);
		    $this->load->view('mobile/categories', $data);
		    $this->load->view('mobile/include/footer', $data);
        }
	}
	function user_profile(){
		if($this->session->userdata('userlogin')){
			$user_id=$this->session->userdata('userlogin');
			$data['user_details']=$this->model->user_details($user_id);
			$data['logged_user']=$this->model->user_details($user_id);
			$data['cart_products']=$this->cart->contents();
			// echo"<pre>";
			// print_r($data['user_details']);die;
			$data['categories']=$this->model->get_category();
			$data['nine_categories']=$this->model->get_nine_category();
			$data['cart_products']=$this->cart->contents();
			if (!$this->agent->is_mobile()) {
            redirect(base_url());
            }
            else {
                $this->load->view('mobile/include/header', $data);
    		    $this->load->view('mobile/profile', $data);
    		    $this->load->view('mobile/include/footer', $data);
            }
		}
		else{
			redirect('login/');
		}
	}
	function fetchdata(){
		$limit=$this->input->post('limit');
		$offset=$this->input->post('start');
		$data['new_products']=$this->model->fetchdata($limit,$offset);
		// print_r($data);
	}
	function view_all($id)
	{
		$data['cart_products']=$this->cart->contents();
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
		$data['latest_products']=$this->model->view_all_products($id);
		//print_r($data['products']);die;
		if($this->session->userdata('userlogin'))
		{
			$user_id=$this->session->userdata('userlogin');
			$data['logged_user']=$this->model->user_details($user_id);
		}
		if (!$this->agent->is_mobile()) {
            $this->load->view('include/header', $data);
    		$this->load->view('view_all', $data);
    		$this->load->view('include/footer', $data);
        }
        else {
            $this->load->view('mobile/include/header', $data);
		    $this->load->view('mobile/view_all', $data);
		    $this->load->view('mobile/include/footer', $data);
        }
		
	}
	function shop_by_categories($id)
	{
		$data['cart_products']=$this->cart->contents();
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
		$data['sub_categories']=$this->model->shop_by_categories($id);
		$data['category_name']=$this->model->get_this_category($id);
		if($this->session->userdata('userlogin'))
		{
			$user_id=$this->session->userdata('userlogin');
			$data['logged_user']=$this->model->user_details($user_id);
		}
		if (!$this->agent->is_mobile()) {
            $this->load->view('include/header', $data);
    		$this->load->view('shop_by_categories', $data);
    		$this->load->view('include/footer', $data);
        }
        else {
            $this->load->view('mobile/include/header', $data);
		    $this->load->view('mobile/shop_by_categories', $data);
		    $this->load->view('mobile/include/footer', $data);
        }
		
	}
	function search_product()
	{
	    $data['cart_products']=$this->cart->contents();
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
	    $input_value=$this->input->post('input_value');
	    $data['search_result']=$this->model->get_search_data($input_value);
	    if($this->session->userdata('userlogin'))
		{
			$user_id=$this->session->userdata('userlogin');
			$data['logged_user']=$this->model->user_details($user_id);
		}
		if (!$this->agent->is_mobile()) {
            $this->load->view('include/header', $data);
    		$this->load->view('search_product', $data);
    		$this->load->view('include/footer', $data);
        }
        else {
            $this->load->view('mobile/include/header', $data);
		    $this->load->view('mobile/search_product', $data);
		    $this->load->view('mobile/include/footer', $data);
        }
	}
	function all_products()
	{
		$data['cart_products']=$this->cart->contents();
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
		$data['new_products']=$this->model->all_products();
		if($this->session->userdata('userlogin'))
		{
			$user_id=$this->session->userdata('userlogin');
			$data['logged_user']=$this->model->user_details($user_id);
		}
		if (!$this->agent->is_mobile()) {
            redirect(base_url());
         }
         else {
            $this->load->view('mobile/include/header', $data);
		    $this->load->view('mobile/all_products', $data);
		    $this->load->view('mobile/include/footer', $data);
         }
		
	}
	function load_more_products(){
	    $id=$this->input->post('id');
	    $totalRowCount=$this->model->count_total_post($id);
	    $showLimit = 8;
	    $data=$this->model->ajax_more_data($id,$showLimit);
	    if(count($data) > 0){
	        foreach($data as $latest_products){ ?>
						<div class="col-lg-3 col-md-6">
							<div class="product-item mb-30">
								<a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$latest_products->id)).'/'.strtolower(str_replace(' ', '-',$latest_products->name));?>" class="product-img">
									<img height="155px" src="<?php if($latest_products->product_img!==''){
									    echo base_url('assets/images/product/'.$latest_products->product_img);
									}
									else
									{
									    echo base_url('assets/images/product.jpg');
									}?>" alt="">
									<?php
									if($latest_products->orignal_price!=='0'){
										$value=($latest_products->price*100)/$latest_products->orignal_price;
										$off=100-$value;
									}
									else
									{
									    $off=0;
									}
										?>
									<div class="product-absolute-options">
										<span class="offer-badge-1"><?php echo substr($off, 0,2); ?>% off</span>
										<!--<span class="like-icon" title="wishlist"></span>-->
									</div>
								</a>
								<div class="product-text-dt">
									<p><?php if($latest_products->stock>'0'){
												echo"Available<span>(In Stock)</span>";
											}
											else{
												echo "Not Available<span>(Out Of Stock)</span>";
											}
											?></p>
									<h4><?php echo $latest_products->name; ?></h4>
									<div class="product-price">₹<?php echo $latest_products->price; ?> <span>₹<?php echo $latest_products->orignal_price; ?></span></div>
									<form action="<?php echo base_url('Welcome_controller/add_to_cart/'.$latest_products->id).'/home/'; ?>" method="post">
										<div class="qty-cart">
											<div class="quantity buttons_added">
												<input type="button" value="-" class="minus minus-btn">
												<input type="number" step="1" name="qty" value="1" class="input-text qty text">
												<input type="button" value="+" class="plus plus-btn">
											</div>
											<button style="border:none;background:none;" class="cart-icon"><i class="uil uil-shopping-cart-alt"></i></button>
										</div>
										<div class="product-price mt-3"><button style="padding-top:-5px;" class="add-cart-btn hover-btn form-control"> <i class="uil uil-shopping-cart-alt"></i> Add to cart (for buy)</button></div>
									</form>
								</div>
							</div>
						</div>
		<?php }
		if($totalRowCount > $showLimit){ ?>
            <div class="col-md-12">
				<div class="more-product-btn" id="show_more_main<?php echo $latest_products->id; ?>">
				    <button class="show-more-btn hover-btn show_more" id="<?php echo $latest_products->id; ?>" title="Load more product">Show More</button>
					<button class="show-more-btn hover-btn loding" style="display: none;"><span class="loding_txt">Loading...</span></button>
				</div>
			</div>
        <?php }
	    }
	}
	function ajax_more()
	{
	    $id=$this->input->post('id');
	    $totalRowCount=$this->model->count_total_post($id);
	    $showLimit = 8;
	    $data=$this->model->ajax_more_data($id,$showLimit);
	    if(count($data) > 0){ 
            foreach($data as $latest_products){
                $postID=$users_post->id; ?>
                <div class="col-6">
                            <div class="grid-product space-mb--20">
                                <div class="grid-product__image">
                                    <a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$latest_products->id)).'/'.strtolower(str_replace(' ', '-',$latest_products->name));?>">
                                        <img src="<?php if($latest_products->product_img==''){
                                            echo base_url('assets/images/product.jpg');
                                        }
                                        else{
                                            echo base_url('assets/images/product/'.$latest_products->product_img);
                                        }?>" class="img-fluid" alt="">
                                    </a>
                                    <!--<button class="icon"><img src="assets/img/icons/heart-dark.svg" class="injectable" alt=""></button>-->
									<div class="share-button hover-btn"><a href="javascript:;"
	   title="More share options" class="lid a2a_dd"><span class="fa fa-share-alt"></span></a></div>
                                </div>
                                <div class="grid-product__content">
                                    <h3 class="title" style="font-size:15px;"><a href="<?php echo base_url('details/').strtolower(str_replace(' ', '-',$latest_products->id)).'/'.strtolower(str_replace(' ', '-',$latest_products->name));?>"><?php echo $latest_products->name; ?></a></h3>
                                    <span class="category"><?php if($latest_products->stock>'0'){
												echo"Available<span>(In Stock)</span>";
											}
											else{
												echo "<span class='text-danger'>Out Of Stock</span>";
											}
											?></span>
                                    <div class="price mb-1">
                                        <span class="main-price">₹<?php echo $latest_products->orignal_price; ?></span>
                                        <span class="discounted-price">₹<?php echo $latest_products->price; ?></span>
                                    </div>
								<?php if(!empty($products['sub_category_image'])){
									echo "";
								}
								else{?>
									<form method="post" action="<?php echo base_url('Welcome_controller/add_to_cart/'.$latest_products->id).'/home/'; ?>">
									<input type="hidden" name="qty" value="1"/>
                                        <button class="btn btn-outline-success form-control btn-sm" style="font-size:12px;">Add To Cart (Buy)</button>
									</form>
								<?php }?>
                                </div>
                            </div>
                        </div>
           <?php }
           if($totalRowCount > $showLimit){ ?>
            <div class="show_more_main ml-3" id="show_more_main<?php echo $latest_products->id; ?>">
				<button class="btn btn-outline-success show_more" id="<?php echo $latest_products->id; ?>" title="Load more posts">Load more post</button>
                <button class="btn btn-outline-success loding" style="display: none;"><span class="loding_txt">Loading...</span></button>
            </div>
        <?php }
	    }
	}
	function product_by_category($id)
	{
		$this->load->library('pagination');
		$category_name=strtolower(str_replace('-', ' ',$id));
		$category_details=$this->model->get_category_details($category_name);
		//print_r($category_name);die;
		$cid=$category_details->id;
		$segment=$this->uri->segment(3);
		// $segment=0;
		$data['cart_products']=$this->cart->contents();
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
		$result=$this->model->num_rows($id);
		// print_r($result);die;
		$config=[
			'base_url'=>base_url('products/'.$id),
			'per_page'=>20,
			'total_rows'=>$result,
		];
		$this->pagination->initialize($config);
		$data['new_products']=$this->model->shop_by_categories3($cid,$config['per_page'],$segment);
		//print_r($data['new_products']);die;
		if($this->session->userdata('userlogin'))
		{
			$user_id=$this->session->userdata('userlogin');
			$data['logged_user']=$this->model->user_details($user_id);
		}
		$data['sub_categories']=$this->model->shop_by_categories($id);
		$data['category_name']=$this->model->get_this_category($id);
		if (!$this->agent->is_mobile()) {
            $this->load->view('include/header', $data);
    		$this->load->view('product_by_category', $data);
    		$this->load->view('include/footer', $data);
        }
        else {
            $this->load->view('mobile/include/header', $data);
		    $this->load->view('mobile/product_by_category', $data);
		    $this->load->view('mobile/include/footer', $data);
        }
	}
	function product_by_categories($id)
	{
		$this->load->library('pagination');
		$data['category_name']=$this->model->get_this_sub_category($id);
		//print_r($data['category_name']);die;
		$category_info=$data['category_name'];
		$data['category_info']=$category_info;
		$category_name=$data['category_name']->sub_category_name;
		$category_price=$data['category_name']->price;
		$data['category_name2']=$category_name;
		$data['category_price']=$category_price;
		//print_r($data['category_name']);die;
		$segment=$this->uri->segment(3);
		// $segment=0;
		$data['cart_products']=$this->cart->contents();
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
		$result=$this->model->num_rows($id);
		// print_r($result);die;
		$config=[
			'base_url'=>base_url('products/'.$id),
			'per_page'=>20,
			'total_rows'=>$result,
		];
		$this->pagination->initialize($config);
		$data['new_products']=$this->model->shop_by_categories2($id,$config['per_page'],$segment);
		// print_r($data['new_products']);die;
		if($this->session->userdata('userlogin'))
		{
			$user_id=$this->session->userdata('userlogin');
			$data['logged_user']=$this->model->user_details($user_id);
		}
		$data['sub_categories']=$this->model->shop_by_categories($id);
		$data['category_name']=$this->model->get_this_category($id);
		if (!$this->agent->is_mobile()) {
            $this->load->view('include/header', $data);
    		$this->load->view('product_by_categories', $data);
    		$this->load->view('include/footer', $data);
        }
        else {
            $this->load->view('mobile/include/header', $data);
		    $this->load->view('mobile/product_by_categories', $data);
		    $this->load->view('mobile/include/footer', $data);
        }
	}
	function product_by_categories2($id)
	{
		$this->load->library('pagination');
		$data['category_name']=$this->model->get_this_sub_category($id);
		// print_r($data['category_name']->sub_category_name);die;
		$category_info=$data['category_name'];
		$data['category_info']=$category_info;
		$category_name=$data['category_name']->sub_category_name;
		$category_price=$data['category_name']->price;
		$data['category_name2']=$category_name;
		$data['category_price']=$category_price;
		//print_r($data['category_name']);die;
		$segment=$this->uri->segment(3);
		// $segment=0;
		$data['cart_products']=$this->cart->contents();
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
		$result=$this->model->num_rows($id);
		// print_r($result);die;
		$config=[
			'base_url'=>base_url('products/'.$id),
			'per_page'=>20,
			'total_rows'=>$result,
		];
		$this->pagination->initialize($config);
		$data['new_products']=$this->model->shop_by_categories2($id,$config['per_page'],$segment);
		// print_r($data['new_products']);die;
		if($this->session->userdata('userlogin'))
		{
			$user_id=$this->session->userdata('userlogin');
			$data['logged_user']=$this->model->user_details($user_id);
		}
		$data['sub_categories']=$this->model->shop_by_categories($id);
		$data['category_name']=$this->model->get_this_category($id);
		if (!$this->agent->is_mobile()) {
            $this->load->view('include/header', $data);
    		$this->load->view('product_by_categories2', $data);
    		$this->load->view('include/footer', $data);
        }
        else {
            $this->load->view('mobile/include/header', $data);
		    $this->load->view('mobile/product_by_categories', $data);
		    $this->load->view('mobile/include/footer', $data);
        }
	}
	public function refund_and_return_policy()
	{
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
		$data['cart_products']=$this->cart->contents();
		$this->load->view('include/header', $data);
		$this->load->view('refund_and_return_policy');
		$this->load->view('include/footer',$data);
	}
	public function privacy_policy()
	{
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
		$data['cart_products']=$this->cart->contents();
		$this->load->view('include/header', $data);
		$this->load->view('privacy_policy');
		$this->load->view('include/footer',$data);
	}
	public function term_and_conditions()
	{
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
		$data['cart_products']=$this->cart->contents();
		$this->load->view('include/header', $data);
		$this->load->view('term_and_conditions');
		$this->load->view('include/footer',$data);
	}
	public function contactUs()
	{
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
		$data['cart_products']=$this->cart->contents();
		if($this->session->userdata('userlogin'))
		{
			$user_id=$this->session->userdata('userlogin');
			$data['logged_user']=$this->model->user_details($user_id);
		}
		if (!$this->agent->is_mobile()) {
            $this->load->view('include/header', $data);
    		$this->load->view('contact_us');
    		$this->load->view('include/footer');
        }
        else {
            $this->load->view('mobile/include/header', $data);
		    $this->load->view('mobile/contact_us', $data);
		    $this->load->view('mobile/include/footer', $data);
        }
	}
	function update_number(){
		$user_id=$this->session->userdata('userlogin');
		$data=array(
			'number'=>$this->input->post('number')
		);
		$result=$this->model->update_number($data,$user_id);
		if($result==TRUE)
		{
			//redirect(base_url());
			echo "success";
		}
		else{
		    echo "not update";
			//$this->session->set_flashdata('err', 'something wrong!');
			//redirect(base_url());
		}
	}
	function dashboard(){
		if($this->session->userdata('userlogin')){
			$user_id=$this->session->userdata('userlogin');
			$data['categories']=$this->model->get_category();
			$data['nine_categories']=$this->model->get_nine_category();
			$data['cart_products']=$this->cart->contents();
			$data['user_details']=$this->model->user_details($user_id);
			$data['order_details']=$this->model->order_details($user_id);
			$data['count_orders']=$this->model->count_orders($user_id);
			$this->load->view('include/header', $data);
			$this->load->view('dashboard', $data);
			$this->load->view('include/footer', $data);
		}
		else{
			redirect('login/');
		}
	}
	function my_orders(){
		if($this->session->userdata('userlogin')){
			$user_id=$this->session->userdata('userlogin');
			$data['categories']=$this->model->get_category();
			$data['nine_categories']=$this->model->get_nine_category();
			$data['cart_products']=$this->cart->contents();
			$data['user_details']=$this->model->user_details($user_id);
			$data['order_details']=$this->model->order_detail($user_id);
			$data['report_details']=$this->model->report_details($user_id);
			
			if($this->session->userdata('userlogin'))
    		{
    			$user_id=$this->session->userdata('userlogin');
    			$data['logged_user']=$this->model->user_details($user_id);
    		}
    		if (!$this->agent->is_mobile()) {
                $this->load->view('include/header', $data);
    			$this->load->view('my_orders', $data);
    			$this->load->view('include/footer', $data);
            }
            else {
                $this->load->view('mobile/include/header', $data);
    		    $this->load->view('mobile/my_orders', $data);
    		    $this->load->view('mobile/include/footer', $data);
            }
		}
		else{
			redirect('login/');
		}
	}
	function get_product_details($id){
		if($this->session->userdata('userlogin')){
			$user_id=$this->session->userdata('userlogin');
			$data['user_details']=$this->model->user_details($user_id);
			$data['categories']=$this->model->get_category();
			$data['nine_categories']=$this->model->get_nine_category();
			$data['cart_products']=$this->cart->contents();
			$data['order_details']=$this->model->get_product_details($user_id,$id);
			$data['sub_category_order_details']=$this->model->get_sub_category_details($user_id,$id);
			//echo"<pre>";
			//print_r($data['sub_category_order_details']);die;
			$data['count_orders']=$this->model->count_orders($user_id);
			if($this->session->userdata('userlogin'))
    		{
    			$user_id=$this->session->userdata('userlogin');
    			$data['logged_user']=$this->model->user_details($user_id);
    		}
    		if (!$this->agent->is_mobile()) {
                $this->load->view('include/header', $data);
    			$this->load->view('product_details', $data);
    			$this->load->view('include/footer', $data);
            }
            else {
                $this->load->view('mobile/include/header', $data);
    		    $this->load->view('mobile/product_details', $data);
    		    $this->load->view('mobile/include/footer', $data);
            }
		}
		else{
			redirect('login/');
		}
	}
	function product_report($id){
		if($this->session->userdata('userlogin')){
			$user_id=$this->session->userdata('userlogin');
			$report_no=rand(10000000000,99999999999);
			$now = new DateTime();
			$now->setTimezone(new DateTimezone('Asia/Kolkata'));
			$date_time=$now->format('d-m-Y');
			$data['user_details']=$this->model->user_details($user_id);
			$data=array(
				'report_no'=>$report_no,
				'order_id'=>$this->input->post('order_id'),
				'user_id'=>$data['user_details']->id,
				'user_name'=>$data['user_details']->name,
				'user_email'=>$data['user_details']->email,
				'user_number'=>$data['user_details']->number,
				'issue'=>$this->input->post('issues'),
				'report_date'=>$date_time
			);
			$result=$this->model->product_report($data);
			if($result==TRUE){
				redirect('my-orders/');
			}
			else{
				redirect('my-orders/');
			}
		}
		else{
			redirect('login/');
		}
	}
	function checkout(){
		if($this->session->userdata('userlogin')){
			$user_id=$this->session->userdata('userlogin');
			$order_id=$this->session->userdata('insert_id');
			$data['categories']=$this->model->get_category();
			$data['nine_categories']=$this->model->get_nine_category();
			$data['checkout_details']=$this->model->checkout_details($order_id);
			$data['user_details']=$this->model->user_details($user_id);
			$data['cart_products']=$this->cart->contents();
			//print_r($data['cart_products']);die;
			if($this->cart->total_items()==0 or $this->cart->total() < 499){
				redirect(base_url());
			}
			if($this->session->userdata('userlogin'))
    		{
    			$user_id=$this->session->userdata('userlogin');
    			$data['logged_user']=$this->model->user_details($user_id);
    		}
    		if (!$this->agent->is_mobile()) {
                $this->load->view('include/header', $data);
    			$this->load->view('checkout', $data);
    			$this->load->view('include/footer', $data);
            }
            else {
                $this->load->view('mobile/include/header', $data);
    		    $this->load->view('mobile/checkout', $data);
    		    $this->load->view('mobile/include/footer', $data);
            }
		}
		else{
		    $this->session->set_flashdata('err', 'Please login to continue!');
			redirect('login/');
		}
	}
	
	public function contact()
	{
		$data=array(
			'name'=>$this->input->post('name'),
			'email'=>$this->input->post('email'),
			'subject'=>$this->input->post('subject'),
			'message'=>$this->input->post('message')
		);
		$this->model->contact($data);
		//print_r($data);
		$this->session->set_flashdata('msg', 'Thanku for contact with us.');
		redirect('contact-us/');
	}
	function upadate_number(){
		$user_id=$this->session->userdata('userlogin');
		$data=array(
			'number'=>$this->input->post('number')
		);
		$result=$this->model->upadate_number($data,$user_id);
		if($result==TRUE)
		{
			redirect('dashboard/');
		}
		else{
			$this->session->set_flashdata('err', 'something wrong!');
			redirect('dashboard/');
		}
	}
	function upload_user_image(){
		// $customer_img=$_FILES['customer_img']['name'];
		// $customer_img=$this->input->post('customer_img');
		// echo $customer_img;die;
		if($customer_img!==''){
			$image_name=strtolower(str_replace(' ', '-',$customer_img));
			$exist_name=@end(explode(',',$image_name));
			$name_test=strtolower($exist_name);
			$new_name=time().'-dattaprabodhinee-'.$name_test;
			$config['upload_path']          = './assets/images/customers_img/';
			$config['allowed_types']        = 'gif|jpg|jpeg|png|svg|ico';
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('customer_img'))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('err', $error);
				redirect('dashboard/');
			}
			else
			{
				// $data = array('upload_data' => $this->upload->data());
				$user_id=$this->session->userdata('userlogin');
				$data=array(
					'customer_img'=>$customer_img
				);
				$result=$this->model->upload_user_image($data,$user_id);
				if($result==TRUE)
				{
					redirect('dashboard/');
				}
				else{
					$this->session->set_flashdata('err', 'something wrong!');
					redirect('dashboard/');
				}
			}
		}
	}
	public function login()
	{
	    include_once APPPATH . "libraries/vendor/autoload.php";

      $google_client = new Google_Client();
    
      $google_client->setClientId('854806303823-l8hu47tvlq3f5kmucg37r32vb5o44cc1.apps.googleusercontent.com'); //Define your ClientID
    
    	$google_client->setClientSecret('bt9fJooXGOk4wbR5bUq-dPsK'); //Define your Client Secret Key
    
      $google_client->setRedirectUri('https://estore.dattaprabodhinee.com/login'); //Define your Redirect Uri
    
      $google_client->addScope('email');
    
      $google_client->addScope('profile');
    
      if(isset($_GET["code"]))
      {
       $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    
       if(!isset($token["error"]))
       {
        $google_client->setAccessToken($token['access_token']);
    
        $this->session->set_userdata('access_token', $token['access_token']);
    
        $google_service = new Google_Service_Oauth2($google_client);
    
        $data = $google_service->userinfo->get();
         if($result=$this->model->Is_already_register($data['id'],$data['email']))
        {
            $got_id=$result->id;
            $login_oauth_uid=$result->login_oauth_uid;
            $image=$result->customer_img;
            if(!empty($login_oauth_uid)){
                $this->session->set_userdata('userlogin', $got_id);
            }
            else
            {
                if(!empty($image)){
                    $customer_img=$image;
                }
                else
                {
                    $customer_img=$data['picture'];
                }
                $user_data = array(
                  'login_oauth_uid'  => $data['id'],
                  'customer_img' => $customer_img,
                );
                $this->model->Update_user_data($user_data, $data['email']);
                $this->session->set_userdata('userlogin', $got_id);
                //redirect(base_url());
            }
        }
        else
        {
         $user_data = array(
          'login_oauth_uid' => $data['id'],
          'name'  => $data['given_name']." ".$data['family_name'],
          'email'  => $data['email'],
          'customer_img' => $data['picture'],
          'verification'=>1,
          'status'=>'1'
         );
         $insert_id=$this->model->Insert_user_data($user_data);
         $this->session->set_userdata('userlogin', $insert_id);
        }
        $this->session->set_userdata('email', $data['email']);
       }
      }
      $login_button = '';
      if(!$this->session->userdata('access_token'))
      {
       $login_button = '<a type="button" class="btn btn-danger hover-btn mt-3" href="'.$google_client->createAuthUrl().'" style="color:white;text-decoration:none;display:block;padding-top:9px;"><i class="fa fa-google"></i> Login With Google</a>';
       $data['login_button'] = $login_button;
       $this->load->view('sign_in', $data);
      }
      else
      {
       $this->index();
      }
	}
	public function test()
	{
	    echo "Welcome ".$this->session->userdata('access_token');
	}
	function otp_login()
	{
	    $this->load->view('otp_login');
	}
	public function user_login()
	{
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$fetchdata=$this->model->user_login($username);
		// print_r($fetchdata->id);exit;
		if(!empty($fetchdata)){
		    $dbid=$fetchdata->id;
		    $insert_id=$dbid;
		    $dbname=$fetchdata->name;
		    $dbnumber=$fetchdata->number;
		    $verification_status=$fetchdata->verification;
		    $dbmail=$fetchdata->email;
		    $dbpassword=$fetchdata->password;
		}
		
			if($dbmail==$username or $dbnumber==$username){
				if($dbpassword==$password){
					if($verification_status=='1'){
						$this->session->set_userdata('userlogin', $dbid);
						redirect(base_url());
					}
					else{
						$otp=rand(100000,999999);
						$msg="Hello user,%nYour Dattaprabodhinee Estore OTP for verification is ".$otp;
						// Account details
						$apiKey = urlencode('lzij6Zy/bc0-Zk3QeKbZWoWUutLPdMCc2KflH9QA2X');
						$sender = urlencode('DATTAN');
						// Prepare data for POST request
						$data = array('apikey' => $apiKey, 'numbers' => $dbnumber, 'sender' => $sender, 'message' => $msg);
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
							$this->session->set_userdata('message', $msg);
							$this->session->set_userdata('otpnumber', $dbnumber);
							$this->session->set_userdata('insert_id', $insert_id);
							redirect('otp/');
							
						}
						else{
							$this->session->set_flashdata('err', 'SMS Server Down! Please Try afer some time.');
							redirect('otp/');
						}
					}
				}
				else{
					$this->session->set_flashdata('err', 'You have enter wrong password!');
					redirect('login');
				}
			}
			else{
				$this->session->set_flashdata('err', 'Email Address does not exist!');
				redirect('login');
			}
	}
	public function otp_user_login()
	{
		$username=$this->input->post('username');
		$fetchdata=$this->model->otp_user_login($username);
		if(!empty($fetchdata)){
		$dbid=$fetchdata->id;
		$dbname=$fetchdata->name;
		$dbnumber=$fetchdata->number;
		}
				if($dbnumber==$username){
				
						$otp=rand(100000,999999);
						$msg="Hello user,%nYour Dattaprabodhinee Estore OTP for verification is ".$otp;
						// Account details
						$apiKey = urlencode('lzij6Zy/bc0-Zk3QeKbZWoWUutLPdMCc2KflH9QA2X');
						$sender = urlencode('DATTAN');
						// Prepare data for POST request
						$data = array('apikey' => $apiKey, 'numbers' => $dbnumber, 'sender' => $sender, 'message' => $msg);
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
							$this->session->set_userdata('message', $msg);
							$this->session->set_userdata('otpnumber', $dbnumber);
							$this->session->set_userdata('insert_id', $dbid);
							redirect('login-otp/');
							
						}
						else{
							$this->session->set_flashdata('err', 'SMS Server Down! Please Try afer some time.');
							redirect('login-otp/');
						}
				}
				else{
				    $this->session->set_flashdata('err', 'You need to register on this website.');
				    redirect('signup/');
					//$this->session->set_flashdata('err', 'This user does not exist!');
					//redirect('otp-login/');
				}
				
	}
	function forgot_password()
	{
	    $this->load->view('forgot_password');
	}
	public function forgot()
	{
		$username=$this->input->post('username');
		$fetchdata=$this->model->otp_user_login($username);
		if(!empty($fetchdata)){
		$dbid=$fetchdata->id;
		$dbname=$fetchdata->name;
		$dbnumber=$fetchdata->number;
		}
				if($dbnumber==$username){
				
						$otp=rand(100000,999999);
						$msg="Hello user,%nYour Dattaprabodhinee Estore OTP for verification is ".$otp;
						// Account details
						$apiKey = urlencode('lzij6Zy/bc0-Zk3QeKbZWoWUutLPdMCc2KflH9QA2X');
						$sender = urlencode('DATTAN');
						// Prepare data for POST request
						$data = array('apikey' => $apiKey, 'numbers' => $dbnumber, 'sender' => $sender, 'message' => $msg);
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
							$this->session->set_userdata('message', $msg);
							$this->session->set_userdata('otpnumber', $dbnumber);
							$this->session->set_userdata('insert_id', $dbid);
							redirect('forgot-otp/');
							
						}
						else{
							$this->session->set_flashdata('err', 'SMS Server Down! Please Try afer some time.');
							redirect('forgot-otp/');
						}
				}
				else{
					$this->session->set_flashdata('err', 'This user does not exist!');
					redirect('otp-login/');
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
			'name'=>$name,
			'email'=>$email,
			'number'=>$number,
			'password'=>$this->input->post('password')
		);
		$result=$this->model->signup_test($number,$email);
		if(!empty($result)){
    		$uid=$result->id;
    		$matchemail=$result->email;
    		$matchnumber=$result->number;
		}
		// print_r($uid);die;
			if($matchemail==$email){
			$this->session->set_flashdata('err', 'Email Address Already Exist.');
			redirect('signup/');
			}
			else{
				if($matchnumber==$number){
					$this->session->set_flashdata('err', 'Mobile Number Already Exist.');
					redirect('signup/');
				}
				else{
					$insert_id=$this->model->sign_up($data);
					$otp=rand(100000,999999);
					$msg="Hello user,%nYour Dattaprabodhinee Estore OTP for verification is ".$otp;
					// Account details
					$apiKey = urlencode('lzij6Zy/bc0-Zk3QeKbZWoWUutLPdMCc2KflH9QA2X');
					$sender = urlencode('DATTAN');
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
					    //email
    					$from_email = "estore@dattaprabodhinee.com";
                        $this->email->from($from_email, 'Dattaprabodhinee E-store'); 
                        $this->email->to($email);
                        $this->email->subject('Dattaprabodhinee E-store One Time Password (OTP)'); 
                        $this->email->message($msg);
                        if($this->email->send()) {
                            $this->session->set_flashdata("msg","OTP has been Send on your Mobile Number and Email Address.");
    						$this->session->set_userdata('otpcode', $otp);
    						$this->session->set_userdata('insert_id', $insert_id);
    						$this->session->set_userdata('message', $msg);
    						redirect('otp/');
    				    } else {
                            echo 'Message could not be sent.';
                            echo 'Mailer Error: ' . $this->email->ErrorInfo;
                		}
					    //end
					}
					else{
						$this->session->set_flashdata('err', 'SMS Server Down! Please Try afer some time.');
						redirect('otp/');
					}
				}
			}
	}
	public function otp()
	{
		$this->load->view('otp');
	}
	public function login_otp()
	{
		$this->load->view('login_otp');
	}
	public function forgot_otp()
	{
		$this->load->view('forgot_otp');
	}
	public function verify_otp()
	{
		$otpcodes=$this->session->userdata('otpcode');
		$insert_id=$this->session->userdata('insert_id');
		$user_id=$insert_id;
		$otp=$this->input->post('otp');
		if($otpcodes==$otp){
		    $data=array(
		        'verification'=>1,
		        'status'=>1,
		    );
			$updated=$insert_id=$this->model->verification_update($user_id,$data);
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
	function resend_otp_again()
	{
	    $msg=$this->session->userdata('message');
	    $dbnumber=$this->session->userdata('otpnumber');
	    // Account details
		$apiKey = urlencode('lzij6Zy/bc0-Zk3QeKbZWoWUutLPdMCc2KflH9QA2X');
		$sender = urlencode('DATTAN');
		$data = array('apikey' => $apiKey, 'numbers' => $dbnumber, 'sender' => $sender, 'message' => $msg);
		$ch = curl_init('https://api.textlocal.in/send/');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		
		curl_close($ch);
		if($response==TRUE)
				{
					$this->session->set_flashdata('msg', 'OTP has been resend successfully!');
							redirect('otp/');
				}
				else{
					$this->session->set_flashdata('err', 'SMS Server Down! Please Try afer some time.');
					redirect('otp/');
				}
	}
	function resend_otp()
	{
	    $msg=$this->session->userdata('message');
	    $dbnumber=$this->session->userdata('otpnumber');
	    // Account details
						$apiKey = urlencode('lzij6Zy/bc0-Zk3QeKbZWoWUutLPdMCc2KflH9QA2X');
						$sender = urlencode('DATTAN');
						// Prepare data for POST request
						$data = array('apikey' => $apiKey, 'numbers' => $dbnumber, 'sender' => $sender, 'message' => $msg);
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
							$this->session->set_flashdata('msg', 'OTP has been resend successfully!');
							redirect('login-otp/');
							
						}
						else{
							$this->session->set_flashdata('err', 'SMS Server Down! Please Try afer some time.');
							redirect('login-otp/');
						}
	}
	function resend_forgot_otp()
	{
	    $msg=$this->session->userdata('message');
	    $dbnumber=$this->session->userdata('otpnumber');
	    // Account details
						$apiKey = urlencode('lzij6Zy/bc0-Zk3QeKbZWoWUutLPdMCc2KflH9QA2X');
						$sender = urlencode('DATTAN');
						// Prepare data for POST request
						$data = array('apikey' => $apiKey, 'numbers' => $dbnumber, 'sender' => $sender, 'message' => $msg);
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
							$this->session->set_flashdata('msg', 'OTP has been resend successfully!');
							redirect('forgot-otp/');
							
						}
						else{
							$this->session->set_flashdata('err', 'SMS Server Down! Please Try afer some time.');
							redirect('forgot-otp/');
						}
	}
	function verify_forgot_otp()
	{
	    $otpcodes=$this->session->userdata('otpcode');
		$otp=$this->input->post('otp');
		if($otpcodes==$otp){
			redirect(base_url('change-password/'));
		}
		else{
			$this->session->set_flashdata('err', 'Wrong OTP !');
			redirect('forgot-otp/');
		}
	}
	function login_with_otp()
	{
	    $otpcodes=$this->session->userdata('otpcode');
		$user_id=$this->session->userdata('insert_id');
		$otp=$this->input->post('otp');
		if($otpcodes==$otp){
			$this->session->set_userdata('userlogin', $user_id);
			redirect(base_url());
		}
		else{
			$this->session->set_flashdata('err', 'Wrong OTP !');
			redirect('login-otp/');
		}
	}
	function logout(){
		$this->session->unset_userdata('userlogin');
	    $this->session->unset_userdata('access_token');
		redirect(base_url());
	}
	function change_password()
	{
	    $this->load->view('change_password');
	}
	function change_this_password()
	{
	    $npassword=$this->input->post('npassword');
	    $cpassword=$this->input->post('cpassword');
	    $user_id=$this->session->userdata('insert_id');
	    //print_r($user_id);die;
	    $data=array(
	        'password'=>$npassword
	        );
	    if($npassword==$cpassword)
	    {
	        $this->model->change_password($data,$user_id);
	        $this->session->set_flashdata('msg', 'Password change successfully.');
	        redirect('login/');
	    }
	    else
	    {
	        $this->session->set_flashdata('err', 'Password does not match.');
		    redirect('change-password');
	    }
	}
	function newsletter(){
		$data=array(
			'email'=>$this->input->post('email')
		);
		$this->model->newsletter($data);
		$this->session->set_flashdata('msg', 'Thanku for subcribe us.');
		redirect(base_url());
		
	}
	function filter(){
		$data['new_products']=$this->model->new_products();
		// print_r($data['new_products']);die;
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
		$this->load->view('include/header', $data);
		$this->load->view('new_products', $data);
		$this->load->view('include/footer', $data);
		
	}
	function new_products(){
		$data['cart_products']=$this->cart->contents();
		$data['new_products']=$this->model->new_products();
		// print_r($data['new_products']);die;
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
		$this->load->view('include/header', $data);
		$this->load->view('new_products', $data);
		$this->load->view('include/footer', $data);
		
	}
	
	function product_details(){
		$data['categories']=$this->model->get_category();
		$data['nine_categories']=$this->model->get_nine_category();
		$data['cart_products']=$this->cart->contents();
		
		$user_id = 0;
		if($this->session->userdata('userlogin'))
		{
			$user_id=$this->session->userdata('userlogin');
			$data['logged_user']=$this->model->user_details($user_id);
		}
		if($this->input->post('add_to_cart')){
			$data = array(
			'id' => $this->input->post('product_id'), 
			'name' => $this->input->post('product_name'), 
			'price' => $this->input->post('product_price')
			);
		}
		$pid=$this->uri->segment(2);
		$data['product_details']=$this->model->product_details($pid);
		if(!empty($data['product_details'])){
    		$data['product_ratings']=$this->model->getProductRatings($pid, $user_id);
    		$category=$data['product_details']->category;
    		$data['similar_products']=$this->model->similar_products($category);
    		$data['latest_product']=$this->model->latest_products($limit=5);
    		if (!$this->agent->is_mobile()) {
                $this->load->view('include/header', $data);
        		$this->load->view('details', $data);
        		$this->load->view('include/footer');
            }
            else {
                $this->load->view('mobile/include/header', $data);
    		    $this->load->view('mobile/details', $data);
    		    $this->load->view('mobile/include/footer', $data);
            }
		
		} else{
		    redirect();
		}
		
	}
	function add_to_cart($pid){
	    $redirect_name=$this->uri->segment(4);
		$data=$this->model->product_details($pid);
		//print_r($data);die;
		if($data->product_img=='')
		{
		    $image='product.jpg';
		}
		else
		{
		    $image=$data->product_img;
		}
		
		if($redirect_name){
		    $this->session->set_flashdata('cart_msg', 'Product Added into cart.');
			$redirect_url=base_url();
		}
		else{
			$redirect_url=base_url('details/').$data->id.'/'.strtolower(str_replace(' ', '-',$data->name)).'/';
		}
		$stock=$data->stock;
		$qty=$this->input->post('qty');
		if($qty>$stock)
		{
		    $this->session->set_flashdata('cerr', 'Sorry! '.$stock.' products available in our stock.');
			redirect($redirect_url);
		}
		
		$data = array(
			'id' => $data->id, 
			'seller_id' => $data->user_id,
			'name' => $data->name,
			'qty' => $this->input->post('qty'),
			'image' => $image,
			'product_no' => $data->product_no,
			'orignal_price' => $data->orignal_price,
			'price' => $data->price,
			'packing_size' => $data->packing_size,
			'packing_type'=>$data->packing_type,
			'delivery_charge' => $data->delivery_charge,
			'sub_category' => 0
		);
		$this->cart->product_name_rules = '[:print:]';
		$result=$this->cart->insert($data);
		if($result==TRUE){
			$this->session->set_flashdata('cmsg', 'Added Into Cart.');
			redirect($redirect_url);
		}
		else{
			if($result==TRUE){
			$this->session->set_flashdata('cerr', 'Something Wrong!');
			redirect($redirect_url);
		}
		}
		 
	}
	function add_to_cart2($sid){
		$data=$this->model->sub_category_details($sid);
		if($data->sub_category_img=='')
		{
		    $image='product.jpg';
		}
		else
		{
		    $image=$data->sub_category_img;
		}
		// print_r($data);die;
		$redirect_name=$this->uri->segment(4);
		$subcat_id=$this->uri->segment(5);
		$subcat_name=$this->uri->segment(6);
		$redirect_url=$redirect_name.'/'.$subcat_id.'/'.$subcat_name.'/';
		// echo $redirect_url;die;
		$data = array(
			'id' => $data->id, 
			'category_id' => $data->category_id,
			'name' => $data->sub_category_name,
			'qty' => $this->input->post('qty'),
			'sub_category_image' => $image,
			'product_no' => substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz", 11)), 0, 11),
			'orignal_price' => $data->orignal_price,
			'price' => $data->price,
			'delivery_charge' => $data->delivery_charge,
			'sub_category' => 1
		);
		// echo"<pre>";
		// print_r($data);die;
		$this->cart->product_name_rules = '[:print:]';
		$result=$this->cart->insert($data);
		// echo"success";die;
		if($result==TRUE){
		    $this->session->set_flashdata('cart_msg', 'Product Added into cart.');
			$this->session->set_flashdata('cmsg', 'Added Into Cart.');
			redirect($redirect_url);
		}
		else{
			if($result==TRUE){
			$this->session->set_flashdata('cerr', 'Something Wrong!');
			redirect($redirect_url);
		}
		}
		 
	}
	function updateItemQty(){
		$update=0;
		$rowid=$this->input->post('rowid');
		$qty=$this->input->post('qty');
		
		if(!empty($rowid) && !empty($qty)){
			$data=array(
				'rowid'=>$rowid,
				'qty'=>$qty,
			);
			// print_r($data);die;
			$update=$this->cart->update($data);
		}
		echo $update?'ok':'err';
	}
	function verifyOTP($otp){
		if(!empty($otp)){
			$data=array(
				'rowid'=>$rowid,
				'qty'=>$qty,
			);
			// print_r($data);die;
			$update=$this->cart->update($data);
		}
		echo $update?'ok':'err';
	}
	function removeItem($rowid){
		// print_r($rowid);die;
		$ulr=$this->uri->segment(4);
		//print_r($ulr);die;
		$this->cart->remove($rowid);
		if(!empty($ulr)){
				redirect('cart/');
			}
			else{
				redirect(base_url());
			}
	}
	function applyPromocode(){
		$ulr=$this->uri->segment(3);
		// print_r($ulr);die;
		$promocode=$this->input->post('promocode');
		$data['promo']=$this->model->promo_details($promocode);
		if(!empty($data['promo'])){
			// print_r($data['promo']->code);die;
			$this->session->set_userdata('promocode_success', 'Promocode '.$data['promo']->code.' Applied');
			if(!empty($ulr)){
				redirect(base_url());
			}
			else{
				redirect('checkout/');
			}
		}
		else{
			$this->session->set_flashdata('error', 'Invalid Promocode.');
			if(!empty($ulr)){
				redirect(base_url());
			}
			else{
				redirect('checkout/');
			}
		}
	}
	function removePromocode(){
		$ulr=$this->uri->segment(3);
		$this->session->unset_userdata('promocode_success');
		if(!empty($ulr)){
			redirect(base_url());
		}
		else{
			redirect('checkout/');
		}
	}
	
	
	function order_placed(){
		if($this->session->userdata('placed')){
			$order_id=$this->session->userdata('order_id');
			$data['order_details']=$this->model->order_placed($order_id);
			// print_r($data);die;
			$data['cart_products']=$this->cart->contents();
			$data['categories']=$this->model->get_category();
			$data['nine_categories']=$this->model->get_nine_category();
			if($this->session->userdata('userlogin'))
    		{
    			$user_id=$this->session->userdata('userlogin');
    			$data['logged_user']=$this->model->user_details($user_id);
    		}
    		if (!$this->agent->is_mobile()) {
                $this->load->view('include/header', $data);
    			$this->load->view('order_placed', $data);
    			$this->load->view('include/footer',$data);
            }
            else {
                $this->load->view('mobile/include/header', $data);
    		    $this->load->view('mobile/order_placed', $data);
    		    $this->load->view('mobile/include/footer', $data);
            }
		}
		else{
			redirect(base_url('/'));
		}
	}
	
	function by_mobile_orders(){
	    $now        = new DateTime();
		$now->setTimezone(new DateTimezone('Asia/Kolkata'));
		
	    $user_id        = $this->session->userdata('userlogin');
	    $order_no       = rand(100000000,999999999);
		$date_time      = $now->format('d-m-Y H:i:sa');
		$pincode        = $this->input->post('zipcode');
		$email          = $this->input->post('email');
	    $name           = $this->input->post('name');
	    $number         = $this->input->post('number');
	    $total_amount   = $this->input->post('total_amount');
	    $address        = $this->input->post('address');
	    $landmark       = $this->input->post('landmark');
	    $address_type   = $this->input->post('address_type');
	    $paymentmethod  = $this->input->post('paymentmethod');
	    $sub_total      = $this->input->post('sub_total');
	    $locality       = $this->input->post('locality');
	    $state          = $this->input->post('state');
	    $cart_value     = $total_amount-120;
	    
        if($cart_value<499)
        {
            $this->session->set_flashdata("orr", "Can't place order you must need minimum cart value of Rs.500");
        	redirect('checkout/');
        }
		
		$resp           = $this->model->match_seller_pincode($pincode);
		
		if(!empty($resp))
		{
			$seller_id=$resp->id;
			if($seller_id == 21){
			    $seller_id = 15;
			}
			else if($seller_id == 16 or $seller_id == 18){
                $seller_id = 13;
			}
			$seller_data=$this->model->seller_details($seller_id);
			$seller_name=$seller_data->name;
			$seller_number=$seller_data->number;
			$seller_email=$seller_data->email;
			
// 			$seller_name=$resp->name;
// 			$seller_number=$resp->number;
// 			$seller_email=$resp->email;
		}
		else
		{
			$seller_id='';
			$seller_name='Admin';
			$seller_number='9834009156';
			$seller_email='estore@dattaprabodhinee.com';
		}
	    
	    $data=array(
			'order_no'      => $order_no,
			'user_id'       => $user_id,
			'seller_id'     => $seller_id,
			'number'        => $number,
			'name'          => $name,
			'locality'      => $locality,
			'state'         => $state,
			'pincode'       => $pincode,
			'landmark'      => $landmark,
			'address'       => $address,
			'email'         => $email,
			'address_type'  => $address_type,
			'paymentmethod' => $paymentmethod,
			'total_amount'  => $total_amount,
			'sub_total'     => $sub_total,
			'date_time'     => $date_time
		);
		
		$response=$this->model->checkout($data);
		
		if($response == TRUE){
		    $id_order = $response;
		    $this->session->set_userdata('order_id', $response);
			$cart_item=$this->cart->contents();
			foreach ($cart_item as $cart_item){
    			$seller_data    = $this->model->seller_details($seller_id);
    			$wallet_balance = $seller_data->wallet_balance;
    			$subtotal       = $cart_item['subtotal'];
    			$latest_balance = $wallet_balance+$subtotal;
    			$res            = $this->model->update_seller_wallet($latest_balance,$seller_id);
    			$pid            = $cart_item['id'];
    			$product_details= $this->model->product_details($pid);
    			$stock          = $product_details->stock;
    			$qty            = $cart_item['qty'];
    			$available_stock= $stock-$qty;
    			$res1           = $this->model->update_product_qty($pid,$available_stock);
				$earned         = ($cart_item['subtotal']*90)/100;
				
				$order_item_data=array(
				    'order_id'      => $id_order,
					'user_id'       => $user_id,
					'seller_id'     => $seller_id,
					'product_id'    => $cart_item['id'],
					'product_name'  => $cart_item['name'],
					'qty'           => $cart_item['qty'],
					'subtotal'      => $cart_item['subtotal'],
					'earned'        => $earned
				);
				$this->model->order_items($order_item_data);
			}
			
			$payment_redirect_url   = base_url('Welcome_controller/payments_by_mobile');
			$payload = array(
				'purpose'       => 'Buy Product',
				'amount'        => $total_amount,
				'phone'         => $number,
				'buyer_name'    => $name,
				'redirect_url'  => $payment_redirect_url,
				'send_email'    => true,
				'send_sms'      => true,
				'email'         => $email,
				'allow_repeated_payments' => false
			);
// 			print_r(json_encode($payload));
// 			print_r(http_build_query($payload));
// 			die;
			
		    $ch = curl_init();
		    // new payment method
		    
		    curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/payment_links/');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"upi_link\": \"true\",\n  \"amount\": 100,\n  \"currency\": \"INR\",\n  \"reference_id\": \"#456\",\n  \"description\": \"Payment for policy no #23456\",\n  \"customer\": {\n    \"name\": \"Gaurav Kumar\",\n    \"contact\": \"+919999999999\",\n    \"email\": \"null\"\n  },\n  \"expire_by\": \"1526282829\",\n  \"notify\": {\n    \"sms\": true\n  },\n  \"reminder_enable\": true,\n  \"notes\": {\n    \"policy_name\": \"Jeevan Bima\"\n  }\n}");
            curl_setopt($ch, CURLOPT_USERPWD, 'rzp_live_EWQt0dHEwx4yMW' . ':' . 'AVKU83Ilt3M8ZrplmKQemNyT');
            
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            die;
            
		    //old payment method
//     		curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
//     // 		curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
    
// 			curl_setopt($ch, CURLOPT_HEADER, FALSE);
// 			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
// 			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
// 			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			
// // 			curl_setopt($ch, CURLOPT_HTTPHEADER, 
// // 				array("X-Api-Key:ee5a345d53aa587912df0650a7b139e6", 
// // 				    "X-Auth-Token:e4dd438bddc1527faabc56117caca385"));
        	
//         	if(!empty($seller_id)){
//     			$payment_gateway = $this->model->payment_gateway_info($seller_id);
//     			if(!empty($payment_gateway)){
//         			curl_setopt($ch, CURLOPT_HTTPHEADER,
//         			    array("X-Api-Key:".$payment_gateway->private_key, 
//         			        "X-Auth-Token:".$payment_gateway->private_token));
//     			} else{
//     				 curl_setopt($ch, CURLOPT_HTTPHEADER, 
//     				 array("X-Api-Key:c47fa99c3a29f3373835eadd800dfb5e", 
//     				    "X-Auth-Token:0452d2faf645f6c182ce28446acbc177"));
//     			}
// 			} else {
// 				curl_setopt($ch, CURLOPT_HTTPHEADER, 
// 				array("X-Api-Key:c47fa99c3a29f3373835eadd800dfb5e", 
// 				    "X-Auth-Token:0452d2faf645f6c182ce28446acbc177"));
// 			}


//     // 			curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Api-Key:test_64366c0bc9e7899985e0b1e1ec4", "X-Auth-Token:test_a1d74954b74535b4eb07c23b9c8"));
			
// 			curl_setopt($ch, CURLOPT_POST, true);
// 			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
// 			$json_response = curl_exec($ch);
// 			$response      = json_decode($json_response);
// 			curl_close($ch);
			
			$this->session->set_userdata('TID', $response->payment_request->id);
			redirect($response->payment_request->longurl);
		} else{
		    $this->session->set_flashdata("orr", "We're not accepting order at this time please try again later.");
        	redirect('checkout/');
		}
	}
	function payments_by_mobile()
	{
	    $now = new DateTime();
		$now->setTimezone(new DateTimezone('Asia/Kolkata'));
		
		$date_time          = $now->format('d-m-Y H:i:sa');
	    $payment_status     = $_REQUEST['payment_status'];
	    
	    if($payment_status == "Credit"){
    	    $payment_id         = $_REQUEST['payment_id'];
    		$payment_request_id = $_REQUEST['payment_request_id'];
    		$order_id           = $this->session->userdata('order_id');
    		$TID                = $this->session->userdata('TID');
    		$user_id            = $this->session->userdata('userlogin');
    		
    		$order_details      = $this->model->getOrderDetails($order_id);
    		$product_details    = $this->model->getProductrDetails($order_id);
    		$order_no           = $order_details->order_no;
    		$totalamount        = $order_details->total_amount;
    		$address            = $order_details->address;
    		$name               = $order_details->name;
    		$number             = $order_details->number;
    		$email              = $order_details->email;
    		$seller_id          = $order_details->seller_id;
    		
    		if(!empty($seller_id)){
    		    $seller_data    = $this->model->seller_details($seller_id);
    			$seller_name    = $seller_data->name;
    			$seller_number  = $seller_data->number;
    			$seller_email   = $seller_data->email;
    		} else {
    			$seller_name    = 'Admin';
    			$seller_number  = '9834009156';
    			$seller_email   = 'estore@dattaprabodhinee.com';
    		}
    		
    		$payment_data = array(
    			'order_id'           => $order_id,
    			'user_id'            => $user_id,
    			'seller_id'          => $seller_id,
    			'transaction_id'     => $TID,
    			'payment_id'         => $payment_id,
    			'payment_status'     => $payment_status,
    			'payment_request_id' => $payment_request_id,
    			'date_time'          => $date_time
    		);
    		$result = $this->model->payment_details($payment_data);
    		if($result==TRUE){
    		    $update_data = array(
    		        'payment_status' => 1
    		    );
    		    $response = $this->model->update_order($update_data, $order_id);
    		    if($response == TRUE){
    				
        			$vendor_msgn='Hello '.$seller_name.',%nYou have received an order on Dattaprabodhinee E-store.%nOrder Number is '.$order_no.'.%nPlease visit https://estore.dattaprabodhinee.com/seller/';
        			
        			$vendor_msg='Hello '.$seller_name.', <br/>You have Received an Order on Dattaprabodhinee E-store.<br/>Order By: '.$name.'<br/> Order Number: '.$order_no.',<br/>Order Amount: '.$totalamount.',<br/>Contact Number: '.$number.'<br/>Shipping Address: '.$address.'.<br/><br/><br/><h4>For more details please visit https://estore.dattaprabodhinee.com/seller/ <h4/>';
        			
        			$msgn='Hello '.$name.',%nYou have ordered successfully on Dattaprabodhinee E-store.%nYour Order Number is '.$order_no.',%nOrder Amount '.$totalamount.'.';
        			
        			$msg='Hello '.$name.', <br/> You have order successfully on Dattaprabodhinee E-store. <br/> Your order number is - '.$order_no.', <br/> Order value is - Rs.'.$totalamount.' <br/> Your shipping address - '.$address.' <br/><br/> Note: You will receive order 4-7days. </br></br></br>';
        			
        			$apiKey = urlencode('lzij6Zy/bc0-Zk3QeKbZWoWUutLPdMCc2KflH9QA2X');
    				$sender = urlencode('DATTAN');
    				$data = array('apikey' => $apiKey, 'numbers' => $number, 'sender' => $sender, 'message' => $msgn);
    				$ch = curl_init('https://api.textlocal.in/send/');
    				curl_setopt($ch, CURLOPT_POST, true);
    				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    				$json_msg = curl_exec($ch);
    				curl_close($ch);
    				if($json_msg==TRUE) {
    				    $apiKey = urlencode('lzij6Zy/bc0-Zk3QeKbZWoWUutLPdMCc2KflH9QA2X');
    					$sender = urlencode('DATTAN');
    					$data = array('apikey' => $apiKey, 'numbers' => $seller_number, 'sender' => $sender, 'message' => $vendor_msgn);
    					$ch = curl_init('https://api.textlocal.in/send/');
    					curl_setopt($ch, CURLOPT_POST, true);
    					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    					$response = curl_exec($ch);
    					curl_close($ch);
    				}
        			
        			$email_data = array(
                        'type'          => 'order',
                        'subject'       => '[E-store] Order confirmation',
                        'email'         => $email,
                        'name'          => $name,
                        'order_details' => $order_details,
                        'products'      => $product_details
                    );
                    
                    $view          = $this->load->view('order_confirmation_email', $email_data, true);
                    $config = Array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'tls://smtpout.secureserver.net',
                        'smtp_port' => '587',
                        'smtp_user' => 'estore@dattaprabodhinee.com', // change it to yours
                        'smtp_pass' => 'Shankhini@77', // change it to yours
                        'mailtype' => 'html',
                        'charset' => 'iso-8859-1',
                        'wordwrap' => TRUE
                    );
                    $this->load->library('email', $config);
                    
                    $from_email        = "estore@dattaprabodhinee.com"; // change it to yours
                    $email_setting     = array('mailtype'=>'html');
                    $this->email->initialize($email_setting);
                    $this->email->from($from_email, 'Dattaprabodhinee Estore'); 
                    $this->email->to($email);
                    $this->email->subject('[E-store] Order confirmation');
                    $this->email->message($view);
                    
                    if($this->email->send()) {
                        $from_email        = "estore@dattaprabodhinee.com"; // change it to yours
                        $email_setting     = array('mailtype'=>'html');
                        $this->email->initialize($email_setting);
                        $this->email->from($from_email, 'Dattaprabodhinee Estore'); 
                        $this->email->to($seller_email);
                        $this->email->subject('[E-store] Order confirmation');
                        $this->email->message($vendor_msg);
                        if($this->email->send()) {
                            $this->cart->destroy();
                			$this->session->set_userdata('placed', 'order');
                			redirect('placed/');
                        } else{
                            $this->session->set_flashdata('err', 'SMS Server Down! Please Try afer some time.');
    						redirect('placed/');
                        }
                    } else {
                        $this->session->set_flashdata('err', 'SMS Server Down! Please Try afer some time.');
    					redirect('placed/');
                    }
    		    } else{
    		        $this->session->set_flashdata('err', 'Order has been failed.');
    		        redirect(base_url());
    		    }
    		} else{
    		    $this->session->set_flashdata('err', 'Payment has been failed, Please contact with admin');
    		    redirect(base_url());
    		}
	    } else{
	        $this->session->set_flashdata('err', 'Payment has been failed.');
    		redirect('checkout/');
	    }
	}
	
	function get_data(){
		// $completes = array();
		$input_value=$this->input->post('query');
		$data['result']=$this->model->get_search_data($input_value);
		echo"<pre>";
		foreach($data['result'] as $result)
		{
			// array_push($completes, $result->name);
			echo "<li class='border-bottom' style='font-weight:bold;font-family:sans-serif;font-size:15px;'>".$result->name."</li>";
		}
		// echo json_encode($completes);
	}
	function getproduct()
	{
		echo $this->model->getProduct($this->input->post('query'));
	}
	function Template()
	{
	    $this->load->view('template');
	}
	
	function saveRatings(){
	    $input = $this->input->post(NULL, TRUE);
	    
	    $now = new DateTime();
		$now->setTimezone(new DateTimezone('Asia/Kolkata'));
		$date_time=$now->format('Y-m-d H:i:s');
	    
	    $data = array(
	        'user_id'       => $input['user_id'],
	        'product_id'    => $input['product_id'],
	        'rating'        => $input['rating'],
	        'title'         => $input['title'],
	        'comment'       => $input['comment'],
	        'created'       => $date_time,
	        'modified'      => $date_time
	    );
	    $response = $this->model->insertRating($data);
	    
	    if($response == TRUE){
	        echo "success";
	    } else{
	        echo "failed";
	    }
	}
}
