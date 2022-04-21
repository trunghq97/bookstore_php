<?php
class BookModel extends Model
{	
	private $_columns = ['id', 'name', 'description', 'price', 'sale_off', 'picture', 'created', 'created_by', 'modified', 'modified_by', 'status', 'category_id'];
	private $_userInfo;

	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_BOOK); 
		$userObj		 = Session::get('user');
		if(isset($userObj)){
			$this->_userInfo = $userObj['info'];
		}
	}

	public function listItems($params, $options = null)
	{
		if($options['task'] == 'books-in-category'){
			$categoryID = $params['category_id'] ?? '';
			$query[] 	= "SELECT `id`, `name`, `picture`, `description`, `price`, `sale_off`, `category_id`";
			$query[]	= "FROM `{$this->table}`";
			
			if(!empty($categoryID)){
				$query[]	= "WHERE `status` = 'active' AND `category_id` = '$categoryID'";
			}else{
				$query[]	= "WHERE `status` = 'active'";
			}
			$query[]	= "ORDER BY `ordering` ASC";

			// PAGINATION
			$pagination			= $params['pagination'];
			$totalItemsPerPage	= $pagination['totalItemsPerPage'];
			if($totalItemsPerPage > 0){
				$position		= ($pagination['currentPage'] - 1) * $totalItemsPerPage;
				$query[]		= "LIMIT $position, $totalItemsPerPage";
			}
			
			$query	= implode(' ', $query);
			$result = $this->fetchAll($query);
			return $result;
		}

		if($options['task'] == 'books-relate'){
			$bookID 	= $params['book_id'];
			$catID		= $params['category_id'];

			$query[] 	= "SELECT `b`.`id`, `b`.`name`, `b`.`picture`, `b`.`price`, `b`.`sale_off`, `b`.`category_id`, `c`.`name` AS `category_name`";
			$query[]	= "FROM `".TBL_BOOK."` AS `b`, `".TBL_CATEGORY."` AS `c`";
			$query[]	= "WHERE `b`.`status` = 'active' AND `c`.`id` = `b`.`category_id` AND `b`.`category_id` = '{$catID}' AND `b`.`id` <> '{$bookID}'";
			$query[]	= "ORDER BY `b`.`ordering` ASC";

			$query 	  	= implode(" ", $query);
			$result		= $this->fetchAll($query);
			return $result;
		}
	}

	public function countItems($params, $options = null)
	{	
		if($options['task'] == 'count-items'){
			if(isset($params['category_id'])){
				$categoryID = $params['category_id']; // categoryID là thuộc tính id của bảng category
				$query = "SELECT COUNT(`id`) AS total FROM `$this->table` WHERE `category_id` = $categoryID";
			}else{
				$query = "SELECT COUNT(`id`) AS total FROM `$this->table`";
			}
		
			$query = $this->query($query);
			$data = $query->fetch_assoc();
			return $data['total'];
		}
	}

	public function getInfoItem($params, $options = null)
	{	
		if($options['task'] == 'get-category-name'){
			$categoryID = $params['category_id'] ?? '';
			$query = "SELECT `name` FROM `".TBL_CATEGORY."` WHERE `id` = '$categoryID'";
			$result  = $this->fetchRow($query);
			return $result['name'] ?? 'Tất cả sách';
		}

		if($options['task'] == 'book-info'){
			$query  = "SELECT `id`, `name`, `price`, `sale_off`, `picture`, `description` FROM `{$this->table}` WHERE `id` = '{$params['book_id']}'";
			$result = $this->fetchRow($query);
			return $result; 
		}
	}
}
 