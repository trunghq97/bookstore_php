<?php
class UserModel extends Model
{	
	//private $_columns = ['id', 'username', 'email', 'fullname', 'password', 'created', 'created_by', 'modified', 'modified_by', 'status', 'group_id'];
	private $_notAcceptColumns = ['token'];
	private $_userInfo;
	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_USER);
		$userObj			= Session::get('user');
		$this->_userInfo	= $userObj['info'] ?? '';
	}

	public function listItems($params, $options = null)
	{
		$query[] 	= "SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`fullname`, `u`.`created`, `u`.`created_by`, `u`.`modified`, 
		`u`.`modified_by`, `u`.`status`, `u`.`phone`, `u`.`address`, `g`.`name` AS `group_name`, `u`.`group_id`";
		$query[]	= "FROM `{$this->table}` AS `u` LEFT JOIN `" . TBL_GROUP . "` AS `g` ON `u`.`group_id` = `g`.`id`";
		$query[]	= "WHERE `u`.`id` > 0";

		if (!empty(trim($params['search'] ?? ''))) {
			$query[] = "AND (`username` LIKE '%{$params['search']}%' OR `email` LIKE '%{$params['search']}%')";
		}

		if (isset($params['status']) && $params['status'] != 'all') {
			$query[] = "AND `u`.`status` = '{$params['status']}'";
		}

		// GROUP ID
		if (isset($params['group']) && $params['group'] != 'default') {
			$query[] = "AND `u`.`group_id` = '{$params['group']}'";
		}

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

	public function changeStatus($params, $options = null)
	{
		$status = $params['status'] == 'active' ? 'inactive' : 'active';
		$modified_by = $this->_userInfo['username'];
		$modified	 = date('Y-m-d H:i:s', time());
		$data = ['status' => $status, 'modified' => $modified, 'modified_by' => $modified_by];
		$this->update($data, [['id', $params['id']]]);
		if($this->affectedRows()){
			return [
				'status' 	=> 'success',
				'data'		=> [
					'html' 		=> HelperBackend::itemStatus($params['module'], $params['controller'], $params['id'], $status),
					'message'	=> 'Cập nhật thành công!'
				]
			];
		}else{
			return [
				'status' 	=> 'error',
				'data'		=> [
					'message'	=> 'Có lỗi xảy ra, vui lòng thử lại!'
				]
			];
		}
	}

	public function changeGroup($params, $options = null)
	{	
		$modified_by = $this->_userInfo['username'];
		$modified	 = date('Y-m-d H:i:s', time());
		$id			 = $params['id'];
		$group_id 	 = $params['group_id'];
		$data = ['group_id' => $group_id, 'modified' => $modified, 'modified_by' => $modified_by];

		$this->update($data, [['id', $params['id']]]);
		// $query	= "UPDATE `$this->table` SET `group_id` = $group_id, `modified` = '$modified', `modified_by` = '$modified_by'  WHERE `id` = '" . $id . "'";
		// $this->query($query);
		// $modifiedHTML = HelperBackend::itemHistory($modified_by, $modified);
		if($this->affectedRows()){
			return [
				'status' 	=> 'success',
				'data'		=> [
					'message'	=> 'Cập nhật thành công!'
				]
			];
		}else{
			return [
				'status' 	=> 'error',
				'data'		=> [
					'message'	=> 'Có lỗi xảy ra, vui lòng thử lại!'
				]
			];
		}
	}

	public function multiStatus($params, $options = null)
	{
		if ($options['task'] == 'active' || $options['task'] == 'inactive') {
			$modified_by = $this->_userInfo['username'];
			$modified	 = date('Y-m-d H:i:s', time());
			$ids = implode(', ', $params['cid']);
			$query = "UPDATE `{$this->table}` SET `status` = '{$options['task']}', `modified` = '$modified', `modified_by` = '$modified_by' WHERE `id` IN ({$ids})";
			$this->query($query);
			Session::set('message', ['class' => 'success', 'content' => 'Có ' . $this->affectedRows() . ' phần tử được cập nhật trạng thái!']);
		}
	}

	public function deleteItem($params, $options = null)
	{
		$ids = isset($params['id']) ? [$params['id']] : $params['cid'];
		$this->delete($ids);
		Session::set('message', ['class' => 'success', 'content' => 'Có ' . $this->affectedRows() . ' phần tử đã được xóa!']);
	}

	public function saveItem($params, $options = null)
	{
		if($options['task'] == 'add'){
			$params['form']['created'] 		= date('Y-m-d H:i:s', time());
			$params['form']['created_by']	= $this->_userInfo['username'];
			$params['form']['password']		= md5($params['form']['password']);
			// $data = array_intersect_key($params['form'], array_flip($this->_columns));
			$data = array_diff_key($params['form'], array_flip($this->_notAcceptColumns));
			$this->insert($data);
			Session::set('message', ['class' => 'success', 'content' => 'Dữ liệu được lưu thành công!']);
			return $this->lastID();
		}
		if($options['task'] == 'edit'){
			$this->_notAcceptColumns 		= ['token', 'email', 'username', 'password'];
			$params['form']['modified'] 	= date('Y-m-d H:i:s', time());
			$params['form']['modified_by']	= $this->_userInfo['username'];
			// $data = array_intersect_key($params['form'], array_flip($this->_columns));
			$data = array_diff_key($params['form'], array_flip($this->_notAcceptColumns));
			$this->update($data, [['id', $params['form']['id']]]);
			Session::set('message', ['class' => 'success', 'content' => 'Dữ liệu được lưu thành công!']);
			return $params['form']['id'];
		}
		if ($options['task'] == 'password') {
			// unset($params['form']['token']);
			// unset($params['form']['username']);
			// unset($params['form']['email']);
			// unset($params['form']['fullname']);
			$this->_notAcceptColumns = ['token', 'email', 'username', 'fullname'];
			$data 					= array_diff_key($params['form'], array_flip($this->_notAcceptColumns));
			$data['password']		= md5($params['form']['password']);
			$data['modified']		= date('Y-m-d H:i:s', time());
			$data['modified_by']	= $this->_userInfo['username'];

			$this->update($data, [['id', $params['form']['id']]]);
			// $query	= "UPDATE `$this->table` SET `password` = '$password', `modified` = '$modified', `modified_by` = '$modified_by'  WHERE `id` = '" . $id . "'";
			Session::set('message', array('class' => 'success', 'content' => 'Thay đổi mật khẩu thành công!'));
		}
	}

	public function getInfoItem($params, $options = null)
	{
		if($options == null){
			$query[] = "SELECT `id`, `username`, `email`, `fullname`, `group_id`, `status`, `phone`, `address`";
			$query[] = "FROM `{$this->table}`";
			$query[] = "WHERE `id` = {$params['id']}";
			$query	 = implode(' ', $query);
			$result  = $this->fetchRow($query);
			return $result;
		}
	}

	public function countItems($params, $options = null)
	{
		if ($options['task'] == 'count-items-status') {
			$query[] = "SELECT `status`, COUNT(*) AS `count`";
			$query[] = "FROM `{$this->table}` WHERE `id` > 0";

			if (!empty(trim(@$params['search'] ?? ''))) {
				$query[] = "AND (`username` LIKE '%{$params['search']}%' OR `email` LIKE '%{$params['search']}%')";
			}

			$query[] = "GROUP BY `status`";
			$query = implode(' ', $query);
			$items = $this->fetchAll($query);
			$result = array_combine(array_column($items, 'status'), array_column($items, 'count'));
			$result = ['all' => array_sum($result)] + $result;
			return $result;
		}
	}

	public function itemInSelectbox($params, $options = null)
	{
		if($options == null){
			$query = "SELECT `id`, `name` FROM `" . TBL_GROUP . "`";
			$result = $this->fetchPairs($query);
			// $result['default'] = "- Select Group -";
			// ksort($result);
		}
		return $result;
	}
}
