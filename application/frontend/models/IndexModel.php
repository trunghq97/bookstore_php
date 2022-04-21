<?php
class IndexModel extends Model
{	
	private $_columns = [
		'id', 'username', 'email', 'fullname', 'password', 'created',
		'created_by', 'modified', 'modified_by', 'register_date', 
		'register_ip', 'status', 'group_id', 'phone', 'address'
	];
	//private $_notAcceptColumns = ['token'];

	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_USER);
	}

	public function listItems($params, $options = null)
	{
		if($options['task'] == 'books-special'){
			$query[] 	= "SELECT `b`.`id`, `b`.`name`, `b`.`picture`, `b`.`description`, `b`.`price`, `b`.`sale_off`, `b`.`category_id`, `c`.`name` AS `category_name`";
			$query[]	= "FROM `".TBL_BOOK."` AS `b`, `".TBL_CATEGORY."` AS `c`";
			$query[]	= "WHERE `b`.`status` = 'active' AND `b`.`special` = 1 AND `c`.`id` = `b`.`category_id`";
			$query[]	= "ORDER BY `b`.`ordering` ASC";
			// $query[]	= "LIMIT 0, 5";
			$query	= implode(' ', $query);
			$result = $this->fetchAll($query);
			return $result;
		}

		if($options['task'] == 'featured-categories'){
			$query[] 	= "SELECT `id`, `name`, `picture`";
			$query[]	= "FROM `".TBL_CATEGORY."`";
			$query[]	= "WHERE `status` = 'active' AND `show_at_home` = 1";
			$query[]	= "ORDER BY `ordering` ASC";
			// $query[]	= "LIMIT 0, 5";
			$query	= implode(' ', $query);
			$result = $this->fetchAll($query);
			foreach($result as &$value){
				
				$queryBooksInCategory = "SELECT `id`, `name`, `picture`, `price`, `sale_off`, `description`, `category_id` FROM `".TBL_BOOK."` WHERE `status` = 'active' AND `category_id` = '{$value['id']}' ORDER BY `ordering` ASC";
				$value['books'] = $this->fetchAll($queryBooksInCategory);
			}
			return $result;
		}

		if($options['task'] == 'get-item-slider'){
			$query[] 	= "SELECT `id`, `name`, `picture`, `description`, `link`";
			$query[]	= "FROM `".TBL_SLIDER."`";
			$query[]	= "WHERE `status` = 'active'";
			$query[]	= "ORDER BY `ordering` ASC";
			// $query[]	= "LIMIT 0, 5";
			$query	= implode(' ', $query);
			$result = $this->fetchAll($query);
			return $result;
		}
	}


	public function saveItem($params, $options = null)
	{
		if($options['task'] == 'user-register')
		{
			$params['form']['password']				= md5($params['form']['password']);
			$params['form']['register_date']		= date('Y-m-d H:i:s', time());
			$params['form']['register_ip']			= getenv("REMOTE_ADDR");
			$params['form']['status']				= 'inactive';
			// $data = array_diff_key($params['form'], array_flip($this->_notAcceptColumns));
			$data = array_intersect_key($params['form'], array_flip($this->_columns));
			$this->insert($data);
			return $this->lastID();
		}
	}

	public function getInfoItem($params, $options = null)
	{
		if($options == null){
			$email 	= $params['form']['email'];
			$password 	= md5($params['form']['password']);
			$query[]	= "SELECT `u`.`id`, `u`.`username`, `u`.`phone`, `u`.`address`, `u`.`fullname`, `u`.`email`, `u`.`group_id`, `g`.`group_acp`";
			$query[]	= "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`";
			$query[]	= "WHERE `email` = '$email' AND `password` = '$password'";

			$query		= implode(" ", $query); 
			$result		= $this->fetchRow($query);
			return $result;
		}
	}
	
}
