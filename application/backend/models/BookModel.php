<?php
class BookModel extends Model
{	
	// private $_columns = ['id', 'name', 'description', 'price', 'sale_off', 'picture', 'created', 'created_by', 'modified', 'modified_by', 'status', 'category_id'];
	private $_notAcceptColumns = ['token', 'picture_hidden'];
	private $_userInfo;
	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_BOOK);
		$userObj			= Session::get('user');
		$this->_userInfo	= $userObj['info'] ?? '';
	}

	public function listItems($params, $options = null)
	{
		$query[] 	= "SELECT `b`.`id`, `b`.`name`, `b`.`description`, `b`.`price`, `b`.`sale_off`, `b`.`picture`, `b`.`ordering`, `b`.`created`, `b`.`created_by`, `b`.`modified`, `b`.`modified_by`, `b`.`status`, `b`.`special`, `c`.`name` AS `category_name`, `b`.`category_id`";
		$query[]	= "FROM `{$this->table}` AS `b` LEFT JOIN `" . TBL_CATEGORY . "` AS `c` ON `b`.`category_id` = `c`.`id`";
		$query[]	= "WHERE `b`.`id` > 0";

		if (!empty(trim($params['search'] ?? ''))) {
			$query[] = "AND (`b`.`name` LIKE '%{$params['search']}%')";
		}

		if (isset($params['status']) && $params['status'] != 'all') {
			$query[] = "AND `b`.`status` = '{$params['status']}'";
		}

		// CATEGORY ID
		if (isset($params['category']) && $params['category'] != 'default') {
			$query[] = "AND `b`.`category_id` = '{$params['category']}'";
		}

		if (isset($params['special']) && $params['special'] != 'default') {
			$query[] = "AND `special` = {$params['special']}";
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

	public function changeStatus($params, $options = null){
		if($options['task'] == 'change-ajax-status'){
			$status 	 = ($params['status'] == 'active') ? 'inactive' : 'active';
			$modified_by = $this->_userInfo['username'];
			$modified	 = date('Y-m-d H:i:s', time());
			$data 		 = ['status' => $status, 'modified' => $modified, 'modified_by' => $modified_by];
			$this->update($data, [['id', $params['id']]]);
			if($this->affectedRows()){
				return [
					'status' 		=> 'success',
					'data'			=> [
						'html' 		=> HelperBackend::itemStatus($params['module'], $params['controller'], $params['id'], $status),
						'message'	=> 'Cập nhật thành công!'
					]
				];
			}else{
				return [
					'status' 		=> 'error',
					'data'			=> [
						'message'	=> 'Có lỗi xảy ra, vui lòng thử lại!'
					]
				];
			}
		}
	}

	public function changeSpecial($params, $options = null)
	{
		if($options['task'] == 'change-ajax-special'){
			$special = ($params['special'] == 0) ? 1 : 0;
			$modified_by = $this->_userInfo['username'];
			$modified	 = date('Y-m-d H:i:s', time());
			$data = ['special' => $special, 'modified' => $modified, 'modified_by' => $modified_by];
			$this->update($data, [['id', $params['id']]]);
			if($this->affectedRows()){
				return [
					'status' 	=> 'success',
					'data'		=> [
						'html' 		=> HelperBackend::itemSpecial($params['module'], $params['controller'], $params['id'], $special),
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
	}

	public function changeOrdering($params, $options = null) 
	{
		$ordering 	 = $params['ordering'];
		$modified_by = $this->_userInfo['username'];
		$modified	 = date('Y-m-d H:i:s', time());
		$data 		 = ['ordering' => $ordering, 'modified' => $modified, 'modified_by' => $modified_by];
		$this->update($data, [['id', $params['id']]]);
		if($this->affectedRows()){
			return [
				'status' 		=> 'success',
				'data'			=> [
					'message'	=> 'Cập nhật thành công!'
				]
			];
		}else{
			return [
				'status' 		=> 'error',
				'data'			=> [
					'message'	=> 'Có lỗi xảy ra, vui lòng thử lại!'
				]
			];
		}
	}

	public function changeCategory($params, $options = null)
	{	
		$modified_by = $this->_userInfo['username'];
		$modified	 = date('Y-m-d H:i:s', time());
		$id			 = $params['id'];
		$category_id = $params['category_id'];
		$data = ['category_id' => $category_id, 'modified' => $modified, 'modified_by' => $modified_by];

		$this->update($data, [['id', $params['id']]]);
		// $query	= "UPDATE `$this->table` SET `group_id` = $group_id, `modified` = '$modified', `modified_by` = '$modified_by'  WHERE `id` = '" . $id . "'";
		// $this->query($query);
		// $modifiedHTML = HelperBackend::itemHistory($modified_by, $modified);
		if($this->affectedRows()){
			return [
				'status' 		=> 'success',
				'data'			=> [
					'message'	=> 'Cập nhật thành công!'
				]
			];
		}else{
			return [
				'status' 		=> 'error',
				'data'			=> [
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
			$ids 		 = implode(', ', $params['cid']);
			$query 		 = "UPDATE `{$this->table}` SET `status` = '{$options['task']}', `modified` = '$modified', `modified_by` = '$modified_by' WHERE `id` IN ({$ids})";
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
		require_once PATH_LIBRARY_EXT . 'Upload.php';
		$uploadObj = new Upload();

		if($options['task'] == 'add'){
			$params['form']['picture'] 		= $uploadObj->uploadFile($params['form']['picture'], 'book');
			$params['form']['created'] 		= date('Y-m-d H:i:s', time());
			$params['form']['created_by']	= $this->_userInfo['username'];
			$params['form']['description']	= mysqli_real_escape_string($this->connect, $params['form']['description']);
			$params['form']['name']			= mysqli_real_escape_string($this->connect, $params['form']['name']);

			// $data = array_intersect_key($params['form'], array_flip($this->_columns));
			$data = array_diff_key($params['form'], array_flip($this->_notAcceptColumns));
			$this->insert($data);
			Session::set('message', ['class' => 'success', 'content' => 'Dữ liệu được lưu thành công!']);
			return $this->lastID();
		}
		if($options['task'] == 'edit'){
			$params['form']['modified'] 	= date('Y-m-d H:i:s', time());
			$params['form']['modified_by']	= $this->_userInfo['username'];
			$params['form']['description']	= mysqli_real_escape_string($this->connect, $params['form']['description']);
			$params['form']['name']			= mysqli_real_escape_string($this->connect, $params['form']['name']);
			
			if($params['form']['picture']['name'] == null){
				unset($params['form']['picture']);
			}else{
				$uploadObj->removeFile('book', $params['form']['picture_hidden']);
				$params['form']['picture'] 		= $uploadObj->uploadFile($params['form']['picture'], 'book');
			}

			// $data = array_intersect_key($params['form'], array_flip($this->_columns));
			$data = array_diff_key($params['form'], array_flip($this->_notAcceptColumns));
			$this->update($data, [['id', $params['form']['id']]]);
			Session::set('message', ['class' => 'success', 'content' => 'Dữ liệu được lưu thành công!']);
			return $params['form']['id'];
		}
	}

	public function getInfoItem($params, $options = null)
	{
		if($options == null){
			$query[] = "SELECT `id`, `name`, `picture`, `description`, `price`, `special`, `sale_off`, `category_id`, `status`";
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
				$query[] = "AND (`name` LIKE '%{$params['search']}%')";
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
			$query = "SELECT `id`, `name` FROM `" . TBL_CATEGORY . "`";
			$result = $this->fetchPairs($query);
			// $result['default'] = "- Select Group -";
			// ksort($result);
		}
		return $result;
	}
}
