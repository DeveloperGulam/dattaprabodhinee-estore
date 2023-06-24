<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	function add_products($data)
	{
		return $this->db->insert('products',$data);
	}
	function add_category($data)
	{
		return $this->db->insert('category',$data);
	}
	function request_stocks()
	{
	    //return $this->db->query("SELECT * from stock INNER JOIN seller ON stock.seller_id=seller.id INNER JOIN products ON stock.product_id=products.id WHERE stock.stock_status=0")->result();
	    return $this->db->query("SELECT * from stock INNER JOIN seller ON stock.seller_id=seller.id WHERE stock.stock_status=0")->result();
	}
	function stocks_history()
	{
	    //$this->db->order_by('id', 'desc');
		//return $this->db->get('stock')->result();
		return $this->db->query("SELECT * from stock INNER JOIN seller ON stock.seller_id=seller.id WHERE stock.stock_status=1")->result();
	}
	
	function users_review($clause=1){
	    $this->db->select("product_rating.id, product_rating.rating, product_rating.title, product_rating.comment, product_rating.created, product_rating.status,
	    products.name as product_name, users.name as user_name");
        $this->db->from('product_rating');
        $this->db->join('products', 'products.id = product_rating.product_id', 'left');
        $this->db->join('users', 'users.id = product_rating.user_id', 'left');
        $this->db->where('product_rating.status', $clause);
        $query = $this->db->get();
        return $query->result();
	}
	
	function update_data($data, $id){
	    return $this->db->update('product_rating', $data, ['id' => $id]);
	}
	
	function stockAction($data,$sid)
	{
	    return $this->db->update('stock', $data, array('sid' => $sid));
	}
	function transfer_stock($data)
	{
	    return $this->db->insert('stock',$data);
	}
	function add_sub_category($data)
	{
		return $this->db->insert('sub_category',$data);
	}
	function createNewGroup($data)
	{
		return $this->db->insert('groups',$data);
	}
	function groupList()
	{
		return $this->db->get('groups')->result();
	}
	function add_promo($data)
	{
		return $this->db->insert('coupon',$data);
	}
	function sign_up($data)
	{
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}
	function verification_update($user_id)
	{
		// print_r($user_id);die;
		// $updatedata = [
            // 'verification' => '1',
        // ];
        // $this->db->where('id', $user_id);
        // return $this->db->update('orders', $updatedata);
		$result=$this->db->update('users', ['verification'=>'1'], array('id' => $user_id));
		return $result;
	}
	function admin_login($username)
	{
		return $this->db->get_where('admin',['email'=>$username])->row();
		//return $this->db->query("select * from users where email='$username' OR number='$username'")->row();
		
	}
	function seller_details(){
		$this->db->order_by('id', 'desc');
		return $this->db->get('seller')->result();
	}
	function count_orders($status)
	{
		$result=$this->db->get_where('orders',['status'=>$status])->result();
		return count($result);
	}
	function orders($limit){
		$this->db->order_by('id', 'desc');
		return $this->db->get('orders',$limit)->result();
	}
	function order_request($limit){
		$this->db->order_by('id', 'desc');
		return $this->db->get_where('orders', array('seller_id'=>''), $limit)->result();
	}
	function order_details($pid)
	{
		return $this->db->get_where('orders',['id'=>$pid])->row();
	}
	function item_details($pid)
	{
		$this->db->order_by('id', 'desc');
		return $this->db->get_where('order_item',['order_id'=>$pid])->result();
	}
	function report($order_id)
	{
		return $this->db->get_where('users_report', array('order_id' => $order_id))->result();
	}
	function assign_order($data,$id)
	{
		// print_r($id);die;
		return $this->db->update('orders', $data, array('id' => $id));
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
	function sub_category($id=''){
		// print_r($id);die;
		if(empty($id))
		{
			$this->db->order_by('id', 'desc');
			return $this->db->get('sub_category')->result();
		}
		else
		{
			$this->db->order_by('id', 'desc');
			return $this->db->get_where('sub_category', array('category_id'=>$id))->result();
		}
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
	function category_list(){
		return $this->db->get_where('category', array('status'=>'1'))->result();
		// $query = $this->db->query('SELECT name FROM category');
		// return $query->result();
	}
	function products(){
		$this->db->order_by('id', 'desc');
		return $this->db->get('products')->result();
	}
	function product_details($pid)
	{
		$result=$this->db->get_where('products',['id'=>$pid])->row();
		return $result;
	}
	function update_products($data,$id)
	{
		return $this->db->update('products', $data, array('id' => $id));
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
	function deleteItems($pids){
	    return $this->db->query("DELETE FROM products WHERE id in ($pids)");
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
    function getAudit() {
        $this->db->order_by('id', 'desc');
        return $this->db->get('sales_transaction')->result();
    }
    function salesDetails($id){
        return $this->db->get_where('sales_transaction', array("id"=>$id))->row();
    }
}
