<?php
class UserModel extends Model
{	
	// private $_columns = [
	// 	'id', 'username', 'email', 'fullname', 'password', 'created',
	// 	'created_by', 'modified', 'modified_by', 'register_date', 
	// 	'register_ip', 'status', 'group_id'
	// ];

	private $_notAcceptColumns = ['token', 'email'];
	private $_userInfo;

	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_USER);

		$userObj		 = Session::get('user');
		$this->_userInfo = $userObj['info'] ?? '';
	}

	public function listItem($params, $options = null)
	{
		if($options['task'] == 'books-in-cart'){
			$cart = Session::get('cart');
			$result = [];
			if(!empty($cart)){
				$ids  = "(";
				foreach($cart['quantity'] as $key => $value) $ids .= "'$key', ";
				$ids .= " '0')";

				$query[]	= "SELECT `id`, `name`, `picture`";
				$query[]	= "FROM `".TBL_BOOK."`";
				$query[]	= "WHERE `status` = 'active' AND `id` IN $ids";
				$query[]	= "ORDER BY `ordering` ASC";

				$query 		= implode(" ", $query);
				$result		= $this->fetchAll($query);
				
				foreach($result as $key => $value){
					$result[$key]['quantity'] 		= $cart['quantity'][$value['id']];
					$result[$key]['total_price']	= $cart['price'][$value['id']];
					$result[$key]['price']	  		= $result[$key]['total_price'] / $result[$key]['quantity'];
				}
			}
			return $result;
		}

		if($options['task'] == 'history-cart'){
			$username	= $this->_userInfo['username'];

			$query[]	= "SELECT `id`, `books`, `prices`, `quantities`, `names`, `pictures`, `status`, `date`";
			$query[]	= "FROM `".TBL_CART."`";
			$query[]	= "WHERE `username` = '$username'";
			$query[]	= "ORDER BY `date` ASC";

			$query 		= implode(" ", $query);
			$result		= $this->fetchAll($query);
			return $result;
		}
	}

	public function getInfoItem($params, $options = null)
	{	$userObj = Session::get('user');
		$userInfo = $userObj['info'];
		if($options == null){
			// $query[] = "SELECT `id`, `username`, `phone`, `address`, `email`, `fullname`, `group_id`, `status`, `password`";
			// $query[] = "FROM `{$this->table}`";
			// $query[] = "WHERE `id` = {$params['id']}";
			// $query	 = implode(' ', $query);

			$query[]	= "SELECT `u`.`id`, `u`.`username`, `u`.`phone`, `u`.`address`, `u`.`fullname`, `u`.`email`, `u`.`group_id`, `g`.`group_acp`";
			$query[]	= "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`";
			$query[]	= "WHERE `u`.`id` = '{$userInfo['id']}'";
			$query		= implode(" ", $query);
			$result  = $this->fetchRow($query);
			return $result;
		}
	}

	public function saveItem($params, $options = null)
	{
		$userObj = Session::get('user');
		$userInfo = $userObj['info'];

		if($options['task'] == 'user-update-info'){
			$params['form']['modified'] 		= date('Y-m-d H:i:s', time());
			$params['form']['modified_by']		= $userInfo['username'];
			$params['form']['register_date']	= date('Y-m-d H:i:s', time());
			$params['form']['register_ip']		= getenv("REMOTE_ADDR");

			// $data = array_intersect_key($params['form'], array_flip($this->_columns));
			$data = array_diff_key($params['form'], array_flip($this->_notAcceptColumns));
			$this->update($data, [['id', $userInfo['id']]]);
			Session::set('message', ['class' => 'success', 'content' => 'Cập nhật thông tin thành công!']);
			return $this->lastID();
		}

		if($options['task'] == 'user-change-new-password'){
			$query = "SELECT `password` FROM `$this->table` WHERE `id` = '{$userInfo['id']}'";
			$passwordInDB = $this->fetchRow($query);
			
			$passwordInDB['password'];
			$oldPassword = md5($params['form']['oldpassword']);

			if($passwordInDB['password'] == $oldPassword){
				$newPassword = md5($params['form']['newpassword']);
				$queryUpdate = "UPDATE `user` SET `password` = '$newPassword' WHERE `id` = '{$userInfo['id']}'";
				$this->query($queryUpdate);
			}
			return $this->lastID();
		}

		if($options['task'] == 'submit-cart'){
			$id 		= $this->randomString(7);
			$username	= $this->_userInfo['username'];
			$books 		= json_encode($params['form']['book_id']);
			$prices 	= json_encode($params['form']['price']);
			$quantities = json_encode($params['form']['quantity']);
			$names 		= json_encode($params['form']['name'], JSON_UNESCAPED_UNICODE);
			$pictures 	= json_encode($params['form']['picture']);
			$date 		= date('Y-m-d H:i:s', time());

			$query = "INSERT INTO `".TBL_CART."` (`id`, `username`, `books`, `prices`, `quantities`, `names`, `pictures`, `status`, `date`)
					VALUES ('$id', '$username', '$books', '$prices', '$quantities', '$names', '$pictures', 'inactive', '$date')";
			$this->query($query);
			Session::delete('cart');
		}
	}

	private function randomString($length = 5)
	{
		$arrCharacter = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
		$arrCharacter = implode("", $arrCharacter);
		$arrCharacter = str_shuffle($arrCharacter);

		$result		= substr($arrCharacter, 0, $length);
		return $result;
	}
}
