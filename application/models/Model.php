<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model {

	function contact($data)
	{
		return $this->db->insert('contact',$data);
	}
	function insertPaymentData($data)
	{
		return $this->db->insert('razorpay_user_payments', $data);
	}
	function insertRating($data){
	    return $this->db->insert('product_rating', $data);
	}
	function insertCartInfo($data){
	    return $this->db->insert('cart_info',$data);
	}
	function newsletter($data)
	{
		return $this->db->insert('newsletter',$data);
	}
	function signup_test($number,$email)
	{
		$result=$this->db->get_where('users',['email'=>$email])->row();
		$result=$this->db->get_where('users',['number'=>$number])->row();
		return $result;
	}
	function view_all_products($id)
	{
		return $this->db->get_where('products',array('category'=>$id, 'status'=>1))->result();
	}
	function sign_up($data)
	{
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}
	function product_report($data)
	{
		return $this->db->insert('users_report',$data);
	}
	function sub_category_price($sub_category_id)
	{
	    $this->db->order_by('id', 'desc');
		return $this->db->get_where('products',array('sub_category_id'=>$sub_category_id, 'status'=>1))->result();
	}
	function banner_products()
	{
		return $this->db->get_where('products',array('banner_product'=>'1', 'status'=>1),5)->result();
	}
	function banner_products2()
	{
		return $this->db->get_where('category',array('banner_product'=>'1'),5)->result();
		
	}
	function seller_details($seller_id)
	{
		return $this->db->get_where('seller',['id'=>$seller_id])->row();
	}
	function update_seller_wallet($latest_balance,$seller_id)
	{
		return $this->db->update('seller', array('wallet_balance'=>$latest_balance), array('id'=>$seller_id));
	}
	function update_product_qty($pid,$available_stock)
	{
		return $this->db->update('products', array('stock'=>$available_stock), array('id'=>$pid));
	}
	function payment_gateway_info($seller_id){
		return $this->db->get_where('payment_gateway',['seller_id'=>$seller_id])->row();
	}
	function report_details($user_id)
	{
		return $this->db->get_where('users_report',array('user_id'=>$user_id))->row();
	}
	function update_profile_validate($user_contact,$user_email, $uid){
	    $data=$this->db->get_where('users', array('email'=>$user_email, 'id!='=>$uid))->row();
	    if(!empty($data)){
	        return "email address already linked with another account.";
	    }
	    else{
	        $data2=$this->db->get_where('users', array('number'=>$user_contact, 'id!='=>$uid))->row();
	        if(!empty($data2)){
	            return "mobile number already linked with another account.";
	        }
	        else{
	            return "";
	        }
	    }
	}
	function verification_update($user_id,$data)
	{
		return $this->db->update('users', $data, array('id' => $user_id));
	}
	function user_login($username)
	{
		//return $this->db->get_where('users', array('email'=>$username))->row();
		return $this->db->query("select * from users where email='$username' OR number='$username'")->row();
	}
	function otp_user_login($username)
	{
		return $this->db->get_where('users',array('number'=>$username))->row();
	}
	
	function upadate_number($data,$user_id)
	{
		return $this->db->update('users', $data, array('id' => $user_id));
	}
	function change_password($data,$user_id)
	{
		return $this->db->update('users', $data, array('id' => $user_id));
	}
	function update_profile($data,$uid)
	{
		return $this->db->update('users', $data, array('id' => $uid));
	}
	function upload_user_image($data,$user_id)
	{
		return $this->db->update('users', $data, array('id' => $user_id));
	}
	function get_search_data($input_value)
	{
		return $this->db->query("SELECT * FROM `products` WHERE `name` LIKE '%$input_value%' LIMIT 11")->result();
	}
	function match_seller_pincode($user_pincode)
	{
	//	$result=$this->db->get('seller',['pincode'=>$user_pincode]);
	//	$this->db->like('pincode', '$user_pincode');
	//	return $result->row();
		return $this->db->query("SELECT * FROM `seller` WHERE `pincode` REGEXP $user_pincode")->row();
	}
	function user_details($user_id)
	{
		return $this->db->get_where('users',['id'=>$user_id])->row();
		//return $this->db->query("select * from users where email='$username' OR number='$username'")->row();
	}
	function order_details($user_id)
	{
		// $where = "status='0' OR status='1' status='2' OR status='3'";
		// return $this->db->get_where('orders', array('user_id'=>$user_id, 'status'=>'0' OR 'status'=>'1'))->result();
		return $this->db->query('select * from orders where user_id='.$user_id.' AND status!="4"')->result();
	}
	function get_search_data2($input_value)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->like('name', $input_value);
		$query = $this->db->get();
		return $query->result();
	}
	
	function getProductRatings($pid, $user_id){
        if(!empty($user_id)){
            $this->db->select("product_rating.id as id, product_rating.title, product_rating.comment, product_rating.rating, product_rating.created, product_rating.modified, product_rating.status, users.name, users.customer_img, product_rating.user_id as user_id");
            $this->db->from('product_rating');
            $this->db->join('users', 'users.id = product_rating.user_id', 'left');
            $this->db->where('product_rating.product_id', $pid);
            // $this->db->where('product_rating.status', 1);
            // $this->db->where('product_rating.user_id', $user_id);
            $this->db->order_by("product_rating.id", "desc");
            $this->db->limit(10, 0);
            $query = $this->db->get();
            return $query->result();
        } else{
            $this->db->select("product_rating.id as id, product_rating.title, product_rating.comment, product_rating.rating, product_rating.created, product_rating.modified, product_rating.status, users.name, users.customer_img, product_rating.user_id as user_id");
            $this->db->from('product_rating');
            $this->db->join('users', 'users.id = product_rating.user_id', 'left');
            $this->db->where('product_rating.product_id', $pid);
            $this->db->where('product_rating.status', 1);
            $this->db->order_by("product_rating.id", "desc");
            $this->db->limit(10, 0);
            $query = $this->db->get();
            return $query->result();
        }
	}
	function order_detail($user_id)
	{
		// $where = "status='0' OR status='1' status='2' OR status='3'";
		// return $this->db->get_where('orders', array('user_id'=>$user_id, 'status'=>'0' OR 'status'=>'1'))->result();
		return $this->db->query('select * from orders where user_id='.$user_id)->result();
	}
	function get_product_details($user_id,$id)
	{
		return $this->db->query('select * from order_item INNER JOIN products ON order_item.product_id=products.id where order_item.order_id='.$id.' and order_item.user_id='.$user_id.' and order_item.sub_category!=1')->result();
	}
	function get_sub_category_details($user_id,$id)
	{
		return $this->db->query('select * from order_item INNER JOIN sub_category ON order_item.product_id=sub_category.id where order_item.order_id='.$id.' and order_item.user_id='.$user_id.' and order_item.sub_category=1')->result();
	}
	function count_orders($user_id)
	{
		$result=$this->db->query('select * from orders where status!="4" and user_id='.$user_id)->result();
		return count($result);
	}
	function get_category(){
		$this->db->order_by('id', 'desc');
		return $this->db->get_where('category', array('status'=>'1'))->result();
	}
	function get_this_category($id){
		// print_r($id);die;
		$this->db->order_by('id', 'desc');
		return $this->db->get_where('category', array('id'=>$id))->row();
	}
	function get_this_sub_category2($name){
		//print_r($name);die;
		$this->db->order_by('id', 'desc');
		return $this->db->get_where('products', array('category'=>$name))->row();
	}
	function get_this_sub_category($id){
		// print_r($id);die;
		$this->db->order_by('id', 'desc');
		return $this->db->get_where('sub_category', array('id'=>$id))->row();
	}
	function get_nine_category(){
		$this->db->order_by('id', 'desc');
		return $this->db->get_where('category',array('status'=>'1'), 9)->result();
	}
	function promo_details($promocode){
		return $this->db->get_where('coupon',['code'=>$promocode])->row();
	}
	function productByCategory($cid,$limit){
	    return $this->db->get_where('products',array('category'=>$cid), $limit)->result();
	}
	function astrology_books($limit){
		return $this->db->get_where('products',['category'=>'11'], $limit)->result();
	}
	function herbs($limit){
		return $this->db->get_where('products',['category'=>'21'], $limit)->result();
	}
	function similar_products($category){
		return $this->db->get_where('products',['category'=>$category],3)->result();
	}
	
	function fetchdata($limit,$offset){
		return $this->db->get('products', $limit,$offset)->result();
	}
	function num_rows($id){
		$result=$this->db->get_where('products', ['sub_category_id'=>$id])->result();
		return count($result);
	}
	function get_category_details($category_name){
		// echo $id;die;
		return $this->db->get_where('category', array('name'=>$category_name))->row();
	}
	function shop_by_categories($id){
		// print_r($id);die;
		$this->db->order_by('id', 'desc');
		return $this->db->get_where('sub_category', array('category_id'=>$id))->result();
	}
	function shop_by_categories2($id,$limit,$offset){
		// echo $id;die;
		$this->db->order_by('id', 'desc');
		return $this->db->get_where('products', array('sub_category_id'=>$id), $limit, $offset)->result();
	}
	function get_products($cid){
		$this->db->order_by('id', 'desc');
		return $this->db->get_where('products', array('category'=>$cid))->result();
	}
	function shop_by_categories3($cid,$limit,$offset){
		// echo $id;die;
		$this->db->order_by('id', 'desc');
		return $this->db->get_where('products', array('category'=>$cid), $limit, $offset)->result();
	}
	function new_products(){
		$this->db->order_by('id', 'desc');
		return $this->db->get_where('products', array('status'=>1), 12)->result();
	}
	function all_products(){
		$this->db->order_by('id', 'desc');
		return $this->db->get_where('products', array('status'=>1), 8)->result();
	}
	function count_total_post($id)
	{
	    return $this->db->query("SELECT COUNT(*) as num_rows FROM products WHERE id < ".$id." ORDER BY id DESC")->row_array();
	}
	function ajax_more_data($id,$showLimit)
	{
	    return $this->db->query("select * from products WHERE id < ".$id." ORDER BY id DESC LIMIT $showLimit")->result();
	}
	function update_number($data,$user_id)
	{
		return $this->db->update('users', $data, array('id' => $user_id));
	}
	function latest_products($limit){
		$this->db->order_by('id', 'desc');
		return $this->db->get_where('products', array('status'=>1), $limit)->result();
	}
	function product_details($pid){
		return $this->db->get_where('products',['id'=>$pid])->row();
	}
	function sub_category_details($sid){
		return $this->db->get_where('sub_category',['id'=>$sid])->row();
	}
	function checkout($data){
		$this->db->insert('orders',$data);
		return $this->db->insert_id();
	}
	function payment_details($payment_data){
		return $this->db->insert('product_payments',$payment_data);
	}
	function order_placed($order_id){
		return $this->db->get_where('orders',['id'=>$order_id])->row();
	}
	function checkout_details($order_id){
		return $this->db->get_where('orders',['id'=>$order_id])->row();
	}
	function sub_category(){
		return $this->db->get('sub_category')->result();
	}
	function order_items($data){
		$this->db->insert('order_item',$data);
		return $this->db->insert_id();
	}
	function orders($data,$number){
		$this->load->library('session');
		$insert_id=$this->session->userdata('insert_id');
		if($insert_id){
			if(!empty($number)){
				return $this->db->update('orders', $data, array('id' => $insert_id));
			}
			else{
				return $this->db->update('orders', $data, array('id' => $insert_id));
			}
		}
		else{
			if(!empty($number)){
				$this->db->insert('orders',$data);
				return $this->db->insert_id();
			}
			else{
				return $this->db->update('orders', $data, array('id' => $insert_id));
			}
		}
		// return $this->db->get_where('products',['id'=>$pid])->row();
	}
	public function getProduct($query)
		{
			$this->db->like('name',$query);
			$query=$this->db->get_where('products', array('status'=>1));
			if($query->num_rows() > 0)
			{
				foreach ($query->result() as $key) {
					$data[]=$key->name;
				}
				 echo json_encode($data);
			}
		}
	function Is_already_register($id,$email)
    {
      //$this->db->where('login_oauth_uid', $id);
      $query = $this->db->query("SELECT * FROM users where login_oauth_uid='$id' OR email='$email'");
      if($query->num_rows() > 0)
      {
        return $data=$query->row();
        //return $id=$data[0]->id;
       //return true;
      }
      else
      {
       return false;
      }
    }

 function Update_user_data($data, $email)
 {
  return $this->db->update('users', $data, array('email'=>$email));
 }

 function Insert_user_data($data)
 {
  $this->db->insert('users', $data);
  return $this->db->insert_id();
 }
 
 function insertCartData($cart_data)
 {
  $this->db->insert('user_cart', $cart_data);
  return $this->db->insert_id();
 }

 function insertCartItem($cart_item)
 {
    return $this->db->insert('cart_detail', $cart_item);
 }
 
 function getSellerPaymentGateway($seller_id){
    $this->db->select('key_id, key_secret');
    $this->db->from('razorpay_payment_gateway');
    $this->db->where('seller_id', $seller_id);
    $query = $this->db->get();
    return $query->row();
 }
 
    function update_order($data, $order_id){
	    return $this->db->update('orders', $data, ['id' => $order_id]);
	}
	
	function getOrderDetails($order_id){
	    return $this->db->get_where('orders', ['id' => $order_id])->row();
	   // $this->db->select('orders.id, orders.order_no, orders.total_amount, orders.address, orders.seller_id, users.name');
    //     $this->db->from('orders');
    //     $this->db->join('users', 'users.id = orders.user_id', 'left');
    //     $this->db->where('orders.id', $order_id);
    //     return $this->db->get()->row();
	}
	
	function getProductrDetails($order_id){
	    return $this->db->get_where('order_item', ['order_id' => $order_id])->result();
	}
 
}
