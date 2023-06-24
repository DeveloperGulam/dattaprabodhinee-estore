<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller_model extends CI_Model {

	function add_products($data)
	{
		return $this->db->insert('products',$data);
	}
	function add_payment_gateway($data)
	{
		return $this->db->insert('payment_gateway',$data);
	}
	function add_razorpay_payment_gateway($data)
	{
		return $this->db->insert('razorpay_payment_gateway',$data);
	}
	function add_category($data)
	{
		return $this->db->insert('category',$data);
	}
	function user_details($user_id)
	{
		return $this->db->get_where('seller',['id'=>$user_id])->row();
	}
	function update_profile($data,$user_id)
	{
		return $this->db->update('seller', $data, array('id' => $user_id));
	}
	function count_orders($status,$seller_id)
	{
		$result=$this->db->get_where('orders',array('seller_id' => $seller_id, 'status'=>$status))->result();
		return count($result);
	}
	function signup_test($number,$email)
	{
		$result=$this->db->get_where('seller',['email'=>$email])->row();
		$result=$this->db->get_where('seller',['number'=>$number])->row();
		return $result;
	}
	function seller_registration($data)
	{
		// print_r($data);
		$this->db->insert('seller',$data);
		return $this->db->insert_id();
	}
	function verification_update($user_id)
	{
		return $this->db->update('seller', ['verification'=>'1'], array('id' => $user_id));
	}
	function upload_documents($data,$user_id)
	{
		return $this->db->update('seller', $data, array('id' => $user_id));
	}
	function save_bank_details($data,$user_id)
	{
		return $this->db->update('seller', $data, array('id' => $user_id));
	}
	function seller_login($username)
	{
		return $this->db->get_where('seller',['email'=>$username])->row();
		//return $this->db->query("select * from users where email='$username' OR number='$username'")->row();
		
	}
	
	function orders($seller_id,$limit){
		if(!empty($limit))
		{
		    $this->db->select("*");
            $this->db->from('orders');
            $this->db->where('seller_id', $seller_id);
            // $this->db->where('payment_status', 1);
            $this->db->order_by("id", "desc");
            $this->db->limit($limit, 0);
            $query = $this->db->get();
            return $query->result();
		}
		else
		{
		    $this->db->select("*");
            $this->db->from('orders');
            $this->db->where('seller_id', $seller_id);
            // $this->db->where('payment_status', 1);
            $this->db->order_by("id", "desc");
            $query = $this->db->get();
            return $query->result();
		}
		
	}
	
	function report($order_id)
	{
		return $this->db->get_where('users_report', array('order_id' => $order_id))->result();
	}
	function order_details($pid)
	{
		return $this->db->get_where('orders',['id'=>$pid])->row();
		//return $this->db->query("select * from orders INNER JOIN users on orders.user_id=users.id where orders.id='$pid'")->row();
	}
	function item_details($pid)
	{
		$this->db->order_by('id', 'desc');
		return $this->db->get_where('order_item',['order_id'=>$pid])->result();
	}
	function update_stock($data,$stock_id)
	{
		return $this->db->update('stock', $data, array('sid' => $stock_id));
	}
	function requestStock($data)
	{
	    return $this->db->insert('stock', $data);
	}
	function update_order_status($data,$id)
	{
		// print_r($id);die;
		return $this->db->update('orders', $data, array('id' => $id));
	}
	function category(){
		$this->db->order_by('id', 'desc');
		return $this->db->get('category')->result();
	}
	function get_details($id,$table_name)
	{
		$result=$this->db->get_where($table_name,['id'=>$id])->row();
		return $result;
	}
	function update_details($data,$item_id,$table_name,$config)
	{
		if($config!=''){
			if($table_name=='category'){
			$imgName = $this->db->get_where($table_name, ['id'=>$item_id])->row()->category_img;
			}
			unlink($config['upload_path'].$imgName);
		}
		return $this->db->update($table_name, $data, array('id' => $item_id));
	}
	function stocks($seller_id){
		//$this->db->order_by('id', 'desc');
		//return $this->db->get_where('products', array('user_id'=>$seller_id))->result();
		return $this->db->query("SELECT * FROM stock INNER JOIN products ON stock.product_id=products.id WHERE stock.seller_id='$seller_id' AND stock.stock_status='1' order by stock.sid desc")->result();
	}
	function stock_details($stock_id)
	{
		return $this->db->query("SELECT * FROM stock INNER JOIN products ON stock.product_id=products.id WHERE stock.sid='$stock_id'")->row();
	}
	function products($seller_id){
		// print_r($seller_id);die;
		//$this->db->order_by('id', 'desc');
		//return $this->db->get_where('products', array('user_id'=>$seller_id))->result();
		return $this->db->query("SELECT * FROM products LEFT JOIN stock ON products.id=stock.product_id WHERE products.stock!='0' AND products.status!=0 order by products.id desc")->result();
	}
	function products2(){
		$this->db->order_by('id', 'desc');
		return $this->db->get('products')->result();
	}
	function update_products($data,$id)
	{
		return $this->db->update('products', $data, array('id' => $id));
	}
	function category_list(){
		return $this->db->get('category')->result();
		// $query = $this->db->query('SELECT name FROM category');
		// return $query->result();
	}
	function category_list2($product_id){
		return $this->db->get_where('category', array('id'=>$product_id))->row();
		// $query = $this->db->query('SELECT name FROM category');
		// return $query->result();
	}
	function product_details($pid)
	{
		return $this->db->get_where('products',['id'=>$pid])->row();
	}
	function customers(){
		$this->db->order_by('id', 'desc');
		return $this->db->get('users')->result();
	}
	function customer_details($cid)
	{
		$result=$this->db->get_where('users',['id'=>$cid])->row();
		return $result;
	}
	function contact(){
		$this->db->order_by('id', 'desc');
		return $this->db->get('contact')->result();
	}
	function newsletter(){
		$this->db->order_by('id', 'desc');
		return $this->db->get('newsletter')->result();
	}
	function deleteItem($did,$table_name){
		return $this->db->delete($table_name, array('id' => $did));
	}
	function ActionOnItem($eid,$table_name,$event){
		// echo $eid;
		// echo $table_name;
		// echo $event;die;
		return $this->db->update($table_name, ['status'=>$event], array('id' => $eid));
		// return $this->db->query('UPDATE '.$table_name.' set status='.$event.' WHERE id='.$eid);
	}
	function addAudit($data) {
     return $this->db->insert('sales_transaction', $data);
    }
    function getAudit($seller_id) {
        $this->db->order_by('id', 'desc');
        return $this->db->get_where('sales_transaction', array("seller_id"=>$seller_id))->result();
    }
    function salesDetails($id){
        return $this->db->get_where('sales_transaction', array("id"=>$id))->row();
    }
}
