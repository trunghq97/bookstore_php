<?php
class CategoryModel extends Model
{	
	private $_columns  = ['id', 'name', 'picture', 'created', 'created_by', 'modified', 'modified_by', 'status', 'show_at_home', 'ordering'];
	private $_userInfo;

	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_CATEGORY); 
		$userObj		 = Session::get('user');
		if(isset($userObj)){
			$this->_userInfo = $userObj['info'];
		}
	}

	public function listItems($params, $options = null)
	{
		$query[] 	= "SELECT `id`, `name`, `picture`";
		$query[]	= "FROM `{$this->table}`";
		$query[]	= "WHERE `status` = 'active'";
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

	public function countItems($params, $options = null)
	{	
		if($options['task'] == 'count-items'){
			$query = "SELECT COUNT(`id`) AS total FROM `$this->table`";
			$query = $this->query($query);
			$data = $query->fetch_assoc();
			return $data['total'];
		}
	}

	
}
