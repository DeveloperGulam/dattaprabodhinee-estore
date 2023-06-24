<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
		$this->load->library('session');
		$this->load->library('cart');
        $this->load->model('model');
		$this->load->helper("url");
		date_default_timezone_set("Asia/Kolkata");
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
	
	function setDeliveryCharges(){
	    $data = array(
	        'delivery_charge' => 150,
	        'shipping_charge' => 20,
	    );
	    echo json_encode($data);
	}
	function nine_categories(){
	    $data=$this->model->get_nine_category();
	    echo json_encode($data);
	}
	
	function RestAPIMethod(){
	    $body = file_get_contents('php://input');
	   // echo json_encode(array('response'=>$body));die;
	   //echo $body;die;
	    $body = json_decode($body);
	   // echo json_encode(array('response'=>$body));die;
	    foreach($body as $cart_item){
	        echo json_encode($cart_item->product_name);
	        echo "\n";
	   //             $data=array(
				// 		'order_id'=>$response,
				// 		'user_id'=>$user_id,
				// 		'seller_id'=>$seller_id,
				// 		'product_id'=>$cart_item['product_id'],
				// 		'product_name'=>$cart_item['product_name'],
				// 		'qty'=>$cart_item['qty'],
				// 		'subtotal'=>$cart_item['price'],
				// 		'earned'=>$earned
				// 	);
				// 	$result=$this->model->order_items($data);
				// 	if($result==TRUE){
				// 		echo json_encode(array("response"=>"true"));
				// 	}
				// 	else{
				// 		echo json_encode(array("response"=>"failed"));
				// 	}
	    }
	}
	
	function productByCategory() {
	    $cid=$this->input->post('cid');
	    $limit = $this->input->post('limit');
	    $data=$this->model->productByCategory($cid,$limit);
	    echo json_encode($data);
	}
	function astrology_books() {
	    $data=$this->model->astrology_books($limit=4);
	    echo json_encode($data);
	}
	function photos_and_murties() {
	    $data=$this->model->herbs($limit=4);
	    echo json_encode($data);
	}
	
	function latest_products() {
	    $data=$this->model->latest_products($limit=4);
	    echo json_encode($data);
	}
	function banner_products() {
	    $data=$this->model->banner_products();
	    echo json_encode($data);
	}
	
	function get_products()
	{
		$cid=$this->input->post('cid');
		$productData=$this->model->get_products($cid);
		echo json_encode($productData);
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
	public function update_profile()
	{
	    $uid = $this->input->post('uid');
	    $user_contact = $this->input->post('number');
	    $user_email = $this->input->post('email');
	    $res=$this->model->update_profile_validate($user_contact,$user_email, $uid);
	    if(!empty($res)){
	        echo json_encode(array("response"=>$res));
	    }
	    else{
    		$data=array(
    			'name'=>$this->input->post('name'),
    			'email'=>$user_email,
    			'number'=>$user_contact,
    			'city'=>$this->input->post('city'),
    			'zipcode'=>$this->input->post('pincode'),
    			'state'=>$this->input->post('state'),
    			'landmark'=>$this->input->post('landmark'),
    			'address'=>$this->input->post('address')
    		);
    		$response=$this->model->update_profile($data,$uid);
    		if($response==TRUE){
    		    echo json_encode(array("userdata"=>$data, "response"=>"true"));
    		}
    		else{
    			echo json_encode(array("response"=>"Something Wrong!"));
    		}
	    }
	}
	public function categories()
	{
		$categories=$this->model->get_category();
	    echo json_encode($categories);
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
	function view_all()
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
	    $input_value=$this->input->post('input_value');
	    $data=$this->model->get_search_data($input_value);
	    echo json_encode($data);
	}
	function all_products()
	{
		$new_products=$this->model->all_products();
		echo json_encode($new_products);
		
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
		$user_id=$this->input->post('uid');
		$data=$this->model->order_detail($user_id);
		echo json_encode($data);
		//$data['report_details']=$this->model->report_details($user_id);
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
		    $status=$fetchdata->status;
		    $dbmail=$fetchdata->email;
		    $dbpassword=$fetchdata->password;
		}
		
			if($dbmail==$username or $dbnumber==$username){
				if($dbpassword==$password){
				    if($status=='1'){
					if($verification_status=='1'){
						echo json_encode(array("userdata"=>$fetchdata, "response"=>"true"));
					}
					else{
						$otp=rand(100000,999999);
						$msg="Hello ".$dbname.",%nYour One Time Password (OTP) for verification is ".$otp.".";
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
							$otpdata['otpcode']=$otp;
							$otpdata['message']=$msg;
							$otpdata['otpnumber']=$dbnumber;
							$otpdata['insert_id']=$insert_id;
							///redirect('otp/');
							echo json_encode(array("otpdata"=>$otpdata, "response"=>"otp"));
							
						}
						else{
							//$this->session->set_flashdata('err', 'SMS Server Down! Please Try afer some time.');
							echo json_encode(array("response"=>"Your account does't verified!"));
						}
					}
				    }
				    else{
				        echo json_encode(array("response"=>"Your account has been blocked."));
				    }
				}
				else{
					echo json_encode(array("response"=>"You have enter wrong password!"));
				}
			}
			else{
				echo json_encode(array("response"=>"User does't exist!."));
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
						$msg="Hello ".$dbname.",%nYour One Time Password (OTP) for verification is ".$otp.".";
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
						$msg="Hello ".$dbname.",%nYour One Time Password (OTP) for verification is ".$otp.".";
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
			    echo json_encode(array("response"=>"Email Address Already Exist."));
			}
			else{
				if($matchnumber==$number){
					echo json_encode(array("response"=>"Mobile Number Already Exist."));
				}
				else{
					$insert_id=$this->model->sign_up($data);
					$otp=rand(100000,999999);
					$msg="Hello ".$name.",%nYour One Time Password (OTP) for verification is ".$otp.".";
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
					    require APPPATH .'libraries/mail/PHPMailerAutoload.php';

                        $mail = new PHPMailer;
                        
                        //$mail->SMTPDebug = 3;                               // Enable verbose debug output
                        
                        $mail->isSMTP();                                      // Set mailer to use SMTP
                        $mail->Host = 'smtp.hostinger.in';  // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->Username = 'contact@clickpye.com';                 // SMTP username
                        $mail->Password = 'Flippye@Asri@123';                           // SMTP password
                        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                    // TCP port to connect to
                        
                        $mail->setFrom('contact@clickpye.com', 'Dattaprabodhinee E-store');
                        $mail->addAddress($email, $name);     // Add a recipient
                        //$mail->addAddress('ellen@example.com');               // Name is optional
                        //$mail->addReplyTo('info@example.com', 'Information');
                        //$mail->addCC('cc@example.com');
                        //$mail->addBCC('bcc@example.com');
                        
                        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                        $mail->addAttachment('assets/images/dark-logo.png', 'dattaprabodhinee-e-store-logo.jpg');
                        $mail->addAttachment('assets/images/logo.png', 'dattaprabodhinee-e-store-logo.jpg');    // Optional name
                        $mail->isHTML(true);                                  // Set email format to HTML
                        
                        $mail->Subject = 'Dattaprabodhinee E-store One Time Password (OTP)';
                        $mail->Body    = $msg;
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                        
                        if(!$mail->send()) {
                            echo json_encode(array("response"=>"Mail OTP could not be sent."));
                            //echo 'Mailer Error: ' . $mail->ErrorInfo;
                        } else {
                            $this->session->set_flashdata('msg', 'OTP has been Send on your mobile number and email!');
    						$this->session->set_userdata('otpcode', $otp);
    						$this->session->set_userdata('insert_id', $insert_id);
    						$this->session->set_userdata('message', $msg);
    						echo json_encode(array("response"=>"true"));
                        }
					}
					else{
						echo json_encode(array("response"=>"OTP could not be sent."));
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
		$otpcodes=$this->input->post('otpcode');
		$insert_id=$this->input->post('insert_id');
		$number=$this->input->post('otpnumber');
		$user_id=$insert_id;
		$otp=$this->input->post('otp');
		$data=array(
		    'verification'=>1,
		    'status'=>1,
		);
		$updated=$insert_id=$this->model->verification_update($user_id,$data);
		if($updated==TRUE){
		    $fetchdata=$this->model->user_login($number);
			echo json_encode(array("userdata"=>$fetchdata, "response"=>"true"));
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
		$pid=$this->input->post('pid');
		$data=$this->model->product_details($pid);
		echo json_encode(array("productInfo"=>$data, "response"=>'true'));
	}
	function get_cart_products() {
	    $data = $this->cart->contents();
	    echo json_encode($data);
	}
	function add_to_cart(){
	    $pid = $this->input->post("pid");
	    $user_id = $this->input->post("user_id");
		$data=$this->model->product_details($pid);
		$packing_size = $data->packing_size;
		$packing_type = $data->packing_type;
		$packing_weight = 0;
		if($packing_type=='gm')
        {
            $packing_weight=$packing_size*1000;
        }
        if($packing_type=='kg')
        {
            $packing_weight=$packing_size*1000000;
        }
        if($packing_type=='l')
        {
            $packing_weight=$packing_size*1000;
        }
		$cart_info = array(
    			'id' => $data->id, 
    			'seller_id' => $data->user_id,
    			'product_no' => $data->product_no,
    			'name' => $data->name,
    			'price' => $data->price,
    			'product_img' => $data->product_img,
    			'orignal_price' => $data->orignal_price,
    			'packing_size' => $packing_weight,
    			'packing_type'=>$data->packing_type,
    			'description'=>$data->description,
    			'stock'=>$data->stock,
    			'qty' => 1,
    			'sub_category' => 0
    		);
    		echo json_encode(array("productInfo"=>$cart_info, "response"=>'true'));
//     		$data=array(
// 				'product_id'=>$pid,
// 				'user_id'=>$user_id,
// 				'product_name'=>$data->name,
// 				'qty'=>1,
// 				'price' => $data->price,
// 				'orignal_price' => $data->orignal_price,
// 				'packing_size' => $packing_weight,
// 				'packing_type'=>$data->packing_type,
//     			'description'=>$data->description,
//     			'stock'=>$data->stock,
//     			'sub_category' => 0
// 			);
// 		    $response = $this->model->insertCartInfo($data);
// 		    if($response == TRUE){
// 		        echo json_encode(array("productInfo"=>$cart_info, "response"=>'true'));
// 		    } else{
// 		        echo json_encode(array("productInfo"=>'', "response"=>'false'));
// 		    }
		
// 		if($data->product_img=='')
// 		{
// 		    $image='product.jpg';
// 		}
// 		else
// 		{
// 		    $image=$data->product_img;
// 		}
// 		$stock=$data->stock;
// 		$qty=$this->input->post('qty');
// 		if($qty>$stock)
// 		{
// 		    echo json_encode(array("response"=>'Sorry! '.$stock.' products available in our stock.'));
// 		}
// 		else{
//     		$data = array(
//     			'id' => $data->id, 
//     			'seller_id' => $data->user_id,
//     			'name' => $data->name,
//     			'qty' => $this->input->post('qty'),
//     			'image' => $image,
//     			'product_no' => $data->product_no,
//     			'orignal_price' => $data->orignal_price,
//     			'price' => $data->price,
//     			'packing_size' => $data->packing_size,
//     			'packing_type'=>$data->packing_type,
//     			'delivery_charge' => $data->delivery_charge,
//     			'sub_category' => 0
//     		);
//     		$this->cart->product_name_rules = '[:print:]';
//     		$result=$this->cart->insert($data);
//     		if($result==TRUE){
//     		    echo json_encode(array("productInfo"=>$data, "response"=>'Product Added Into Cart'));
//     		}
//     		else{
//     			echo json_encode(array("response"=>'Something went to wrong!'));
//     		}
// 		}
		
		 
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
	    $this->session->set_userdata('user_pincode', $this->input->post('zipcode'));
	    $this->session->set_userdata('email', $this->input->post('email'));
	    $this->session->set_userdata('name', $this->input->post('name'));
	    $this->session->set_userdata('number', $this->input->post('number'));
	    $this->session->set_userdata('total_amount', $this->input->post('total_amount'));
	    $this->session->set_userdata('address', $this->input->post('address'));
	    $this->session->set_userdata('landmark', $this->input->post('landmark'));
	    $this->session->set_userdata('address_type', $this->input->post('address_type'));
	    $this->session->set_userdata('paymentmethod', $this->input->post('paymentmethod'));
	    $this->session->set_userdata('sub_total', $this->input->post('sub_total'));
	    $this->session->set_userdata('locality', $this->input->post('locality'));
	    $this->session->set_userdata('state', $this->input->post('state'));
	    
		$payment_redirect_url=base_url('Welcome_controller/payments_by_mobile');
		
		$total_amount=$this->input->post('total_amount');
		$cart_value=$total_amount-120;
        if($cart_value<499)
        {
            $this->session->set_flashdata("orr", "Can't place order you must need minimum cart value of Rs.500");
        	redirect('checkout/');
        }
        		
		$user_pincode=$this->input->post('zipcode');
		$resp=$this->model->match_seller_pincode($user_pincode);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
			//	curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
				if(!empty($resp)){
				    $seller_id=$resp->id;
				    if($seller_id == 21){
        			    $seller_id = 15;
        			}
        			if($seller_id == 16 or $seller_id == 18){
        			    $seller_id = 13;
        			}
				    $result=$this->model->payment_gateway_info($seller_id);
				    if(!empty($result)){
    				    curl_setopt($ch, CURLOPT_HTTPHEADER,
    							array("X-Api-Key:".$result->private_key,
    								  "X-Auth-Token:".$result->private_token));
				    }
				    else{
				        curl_setopt($ch, CURLOPT_HTTPHEADER,
    							array("X-Api-Key:c47fa99c3a29f3373835eadd800dfb5e",
    								  "X-Auth-Token:0452d2faf645f6c182ce28446acbc177"));
				    }
				}
				else
				{
				    curl_setopt($ch, CURLOPT_HTTPHEADER,
    							array("X-Api-Key:c47fa99c3a29f3373835eadd800dfb5e",
    								  "X-Auth-Token:0452d2faf645f6c182ce28446acbc177"));
				}
				//curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Api-Key:test_64366c0bc9e7899985e0b1e1ec4", "X-Auth-Token:test_a1d74954b74535b4eb07c23b9c8"));
				$payload = Array(
					'purpose' => 'Buy Product',
					'amount' => $this->input->post('total_amount'),
					'phone' => $this->input->post('number'),
					'buyer_name' => $this->input->post('name'),
					'redirect_url' => $payment_redirect_url,
					'send_email' => true,
					'send_sms' => true,
					'email' => $this->input->post('email'),
					'allow_repeated_payments' => false
				);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
				$response = curl_exec($ch);
				curl_close($ch);
				$response=json_decode($response);
				$this->session->set_userdata('TID', $response->payment_request->id);
				redirect($response->payment_request->longurl);
	}
	function payments_by_mobile()
	{
	    $body = file_get_contents('php://input');
	    $body = json_decode($body);
	   // foreach($body->items as $cart_item){
	   //     echo json_encode($cart_item->product_id);
	   //     echo "\n";
	   // }die;
		$order_no       = rand(100000000,999999999);
		$now            = new DateTime();
		$now->setTimezone(new DateTimezone('Asia/Kolkata'));
		$date_time      = $now->format('d-m-Y H:i:sa');
		$user_pincode   = $body->user_pincode;
		$resp           = $this->model->match_seller_pincode($user_pincode);
		if(!empty($resp))
		{
			$seller_id=$resp->id;
			if($seller_id == 21){
			    $seller_id = 15;
			}
			if($seller_id == 16 or $seller_id == 18){
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
			$seller_id=0;
			$seller_name='Admin';
			$seller_number='9834009156';
			$seller_email='estore@dattaprabodhinee.com';
		}
// 		echo json_encode(array("response"=>"true", "order_id"=>334, "seller_id"=>$seller_id));die;
		    $user_id        = $body->user_id;
			$email          = $body->email;
			$name           = $body->name;
			$number         = $body->number;
			$totalamount    = $body->total_amount;
			$landmark       = $body->landmark;
			$address_type   = $body->address_type;
			$paymentmethod  = $body->paymentmethod;
			$sub_total      = $body->sub_total;
			$locality       = $body->locality;
			$state          = $body->state;
			$address        = $body->address;
			$cart_item      = $body->items;
			
			$img_url=base_url('assets/images/logo1.png');
			$vendor_msgn='Hello '.$seller_name.',%nYou have received an order on Dattaprabodhinee E-store.%nOrder Number is '.$order_no.'.%nPlease visit https://estore.dattaprabodhinee.com/seller/';
			$vendor_msg='Hello '.$seller_name.', <br/>You have Received an Order on Dattaprabodhinee E-store.<br/>Order By: '.$name.'<br/> Order Number: '.$order_no.',<br/>Order Amount: '.$totalamount.',<br/>Contact Number: '.$number.'<br/>Shipping Address: '.$address.'.<br/><br/><br/><h4>For more details please visit https://estore.dattaprabodhinee.com/seller/ <h4/>';
			$msgn='Hello '.$name.',%nYou have ordered successfully on Dattaprabodhinee E-store.%nYour Order Number is '.$order_no.',%nOrder Amount '.$totalamount.'.';
			$msg='Hello '.$name.', <br/> You have order successfully on Dattaprabodhinee E-store. <br/> Your order number is - '.$order_no.', <br/> Order value is - Rs.'.$totalamount.' <br/> Your shipping address - '.$address.' <br/><br/> Note: You will receive order 4-7days. </br></br></br>';
			$mail_msg='Test';
		    $data=array(
					'order_no'=>$order_no,
					'user_id'=>$user_id,
					'seller_id'=>$seller_id,
					'number'=>$number,
					'name'=>$name,
					'locality'=>$locality,
					'state'=>$state,
					'pincode'=>$user_pincode,
					'landmark'=>$landmark,
					'address'=>$address,
					'email'=>$email,
					'address_type'=>$address_type,
					'paymentmethod'=>$paymentmethod,
					'total_amount'=>$totalamount,
					'sub_total'=>$sub_total,
					'payment_status'=> 0,
					'date_time'=>$date_time
				);
			$response=$this->model->checkout($data);
			if($response==TRUE){
				foreach ($cart_item as $cart_item){
				   // $seller_id=$resp->id;
    			    $seller_data=$this->model->seller_details($seller_id);
    				$wallet_balance=$seller_data->wallet_balance;
    				$subtotal=$sub_total;
    				$latest_balance=$wallet_balance+$subtotal;
    				$res=$this->model->update_seller_wallet($latest_balance,$seller_id);
    				$pid=$cart_item->product_id;
    				$product_details=$this->model->product_details($pid);
    				$stock=$product_details->stock;
    				$qty=$cart_item->qty;
    				$available_stock=$stock-$qty;
    				$res1=$this->model->update_product_qty($pid,$available_stock);
				    $earned=($sub_total*90)/100;
					$data=array(
						'order_id'=>$response,
						'user_id'=>$user_id,
						'seller_id'=>$seller_id,
						'product_id'=>$cart_item->product_id,
						'product_name'=>$cart_item->product_name,
						'qty'=>$cart_item->qty,
						'subtotal'=>$cart_item->price,
						'earned'=>$earned
					);
					$result=$this->model->order_items($data);
				}
				echo json_encode(array("response"=>"true", "order_id"=>$response));die;
				$payment_data=array(
					'order_id'=>$response,
					'user_id'=>$user_id,
					'seller_id'=>$seller_id,
					'transaction_id'=>'',
					'payment_id'=>'',
					'payment_status'=>'',
					'payment_request_id'=>'',
					'date_time'=>$date_time
				);
				$result=$this->model->payment_details($payment_data);
				if($result==TRUE){
					$apiKey = urlencode('lzij6Zy/bc0-Zk3QeKbZWoWUutLPdMCc2KflH9QA2X');
					$sender = urlencode('DATTAN');
					$data = array('apikey' => $apiKey, 'numbers' => $number, 'sender' => $sender, 'message' => $msgn);
					$ch = curl_init('https://api.textlocal.in/send/');
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$response = curl_exec($ch);
					curl_close($ch);
					if($response==TRUE)
					{
    					$data = array('apikey' => $apiKey, 'numbers' => $seller_number, 'sender' => $sender, 'message' => $vendor_msgn);
    					$ch = curl_init('https://api.textlocal.in/send/');
    					curl_setopt($ch, CURLOPT_POST, true);
    					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    					$response = curl_exec($ch);
    					curl_close($ch);
    					echo json_encode(array("response"=>"true", "order_id"=>$response, "seller_id"=>$seller_id));
				
					   // require APPPATH .'libraries/mail/PHPMailerAutoload.php';

        //                 $mail = new PHPMailer;
                        
        //                 //$mail->SMTPDebug = 3;                               // Enable verbose debug output
                        
        //                 $mail->isSMTP();                                      // Set mailer to use SMTP
        //                 $mail->Host = 'smtpout.secureserver.net';  // Specify main and backup SMTP servers
        //                 $mail->SMTPAuth = true;                               // Enable SMTP authentication
        //                 $mail->Username = 'estore@dattaprabodhinee.com';                 // SMTP username
        //                 $mail->Password = 'Shankhini@77';                           // SMTP password
        //                 $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        //                 $mail->Port = 587;                                    // TCP port to connect to
                        
        //                 $mail->setFrom('estore@dattaprabodhinee.com', 'Dattaprabodhinee E-store');
        //                 $mail->addAddress($email, $name);
        //                 $mail->isHTML(true);                                  // Set email format to HTML
                        
        //                 $mail->Subject = 'Thank you for your order on Dattaprabodhinee E-store';
        //                 $mail->Body    = $msg.$mail_msg;
        //                 $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                        
        //                 if(!$mail->send()) {
        //                     echo 'Message could not be sent.';
        //                     echo 'Mailer Error: ' . $mail->ErrorInfo;
        //                 }
        //                 else {

        //                     $mail2 = new PHPMailer;
                            
        //                     //$mail->SMTPDebug = 3;                               // Enable verbose debug output
                            
        //                     $mail2->isSMTP();                                      // Set mailer to use SMTP
        //                     $mail2->Host = 'smtpout.secureserver.net';  // Specify main and backup SMTP servers
        //                     $mail2->SMTPAuth = true;                               // Enable SMTP authentication
        //                     $mail2->Username = 'estore@dattaprabodhinee.com';                 // SMTP username
        //                     $mail2->Password = 'Shankhini@77';                           // SMTP password
        //                     $mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        //                     $mail2->Port = 587;                                    // TCP port to connect to
                            
        //                     $mail2->setFrom('estore@dattaprabodhinee.com', 'Dattaprabodhinee E-store');
        //                     $mail2->addAddress($seller_email, $seller_name);
        //                     $mail2->isHTML(true);                                  // Set email format to HTML
                            
        //                     $mail2->Subject = 'You have received new order';
        //                     $mail2->Body    = $vendor_msg;
        //                     $mail2->AltBody = 'This is the body in plain text for non-HTML mail clients';
                            
        //                     if(!$mail2->send()) {
        //                         echo json_encode(array("response"=>"Mail OTP could not be sent."));
        //                     }
        //                     else {
        //                         echo json_encode(array("response"=>"true", "order_id"=>$response));
        //                     }
        //                 }
					}
					else{
						echo json_encode(array("response"=>"OTP could not be sent."));
					}
					
				}
				else{
				    echo json_encode(array("response"=>"Payment Failed!"));
				}
			}
			else{
			    echo json_encode(array("response"=>"Order Failed!"));
			}
	}
	function getproduct()
	{
		echo $this->model->getProduct($this->input->post('query'));
	}
	function Template()
	{
	    $this->load->view('template');
	}
	function generateOrderToken(){
	    
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.razorpay.com/v1/orders/',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('amount' => $this->input->post('amount'),'currency' => 'INR','receipt' => 'dwvgdhhedg'),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic cnpwX3Rlc3RfWklLcWhLSkdVNG5zSVE6Q2c0R2piNk9kOVVjYlRQYXNGZ2dvNktv'
          ),
        ));
        
        $response = curl_exec($curl);
        $result = json_decode($response);
        curl_close($curl);
        echo json_encode(array("response"=>true, "order_id"=>$result->id));
	}
	
	function addToCart(){
	    echo json_encode(array("response"=>"true"));die;
		$data = $this->input->post(NULL, TRUE);

		$cart_data = array(
			'user_id' 		=> $data['user_id'],
			'add_date' 		=> date("Y-m-d H:i:s"),
			'update_date' 	=> date("Y-m-d H:i:s")
		);
		$cart_id	= $this->model->insertCartData($cart_data);
		if(!empty($cart_id)){
			$cart_item = array(
				'cid' => $cart_id, 
				'product_id' => $data['product_id'],
				'price' => $data['price'],
				'packing_type' => $data['packing_type'],
				'packing_size' => $data['packing_size'],
				'qty' => 1,
			);
			$response	= $this->model->insertCartItem($cart_item);
			if($response == TRUE){
				echo json_encode(array("response"=>"true"));
			} else{
				echo json_encode(array("response"=>"failed"));
			}
		} else{
			echo json_encode(array("response"=>"failed"));
		}
	}
	
	function getSellerPaymentGateway()
	{
		$data = $this->model->getSellerPaymentGateway($this->input->post('seller_id'));
		if(!empty($data)){
		    if(!empty($data->key_id)){
    		    echo json_encode($data);
    		} else{
    		    $data = array(
    		        "key_id"=>"rzp_live_npn1CTjXpLizSY",
    		        "key_secret"=>"6OztyO5wymrBrVvlnTK8H0F7"
    		    );
    		    echo json_encode($data);
    		}
		} else{
		    $data = array(
		        "key_id"=>"rzp_live_npn1CTjXpLizSY",
		        "key_secret"=>"6OztyO5wymrBrVvlnTK8H0F7"
		    );
		    echo json_encode($data);
		}
	}
	
	function insertPaymentData()
	{
	    $data=array(
	        "user_id"=> $this->input->post('user_id'),
	        "order_id"=> $this->input->post('order_id'),
	        "razorpay_payment_id"=> $this->input->post('razorpay_payment_id'),
	        "razorpay_order_id"=> "Test",
	        "razorpay_signature"=> "Test",
	        "date_time"=>date("Y-m-d H:i:s")
	    );
		$response = $this->model->insertPaymentData($data);
		if($response == TRUE){
			echo json_encode(array("response"=>"true"));
		} else{
			echo json_encode(array("response"=>"Something went wrong!"));
		}
	}
}
