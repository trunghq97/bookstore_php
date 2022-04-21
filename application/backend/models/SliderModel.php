<?php
class SliderModel extends Model
{	
	private $_columns  = ['id', 'name', 'picture', 'created', 'created_by', 'modified', 'modified_by', 'status', 'ordering', 'link', 'description'];
	private $_userInfo;

	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_SLIDER); 
		$userObj		 = Session::get('user');
		if(isset($userObj)){
			$this->_userInfo = $userObj['info'];
		}
	}

	public function listItems($params, $options = null)
	{
		$query[] 	= "SELECT `id`, `name`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `link`, `ordering`, `description`";
		$query[]	= "FROM `{$this->table}` WHERE `id` > 0";

		if (!empty(trim($params['search'] ?? ''))) {
			$query[] = "AND `name` LIKE '%{$params['search']}%'";
		}

		if (isset($params['status']) && $params['status'] != 'all') {
			$query[] = "AND `status` = '{$params['status']}'";
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
		$where = [['id', $params['id']]];
		$this->update($data, $where);
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

	public function changeOrdering($params, $options = null) 
	{
		$ordering = $params['ordering'];
		$modified_by = $this->_userInfo['username'];
		$modified	 = date('Y-m-d H:i:s', time());
		$data = ['ordering' => $ordering, 'modified' => $modified, 'modified_by' => $modified_by];
		$this->update($data, [['id', $params['id']]]);
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
		$ids = implode(',', $ids);

		// Remove image
		$query = "SELECT `id`, `picture` AS `name` FROM `$this->table` WHERE `id` IN ({$ids})";
		$arrImage = $this->fetchPairs($query);
		require_once PATH_LIBRARY_EXT . 'Upload.php';
		$uploadObj = new Upload();

		foreach($arrImage as $value){
			$uploadObj->removeFile('slider', $value);
		}

		// Delete From Database
		$query = "DELETE FROM `$this->table` WHERE `id` IN ({$ids})";
		$this->query($query);
		Session::set('message', ['class' => 'success', 'content' => 'Có ' . $this->affectedRows() . ' phần tử đã được xóa!']);
	}

	public function saveItem($params, $options = null)
	{	
		require_once PATH_LIBRARY_EXT . 'Upload.php';
		$uploadObj = new Upload();

		if($options['task'] == 'add'){
			$params['form']['picture'] 		= $uploadObj->uploadFile($params['form']['picture'], 'slider');
			$params['form']['created'] 		= date('Y-m-d H:i:s', time());
			$params['form']['created_by']	= $this->_userInfo['username'];
			$params['form']['name']			= mysqli_real_escape_string($this->connect, $params['form']['name']);
			$data = array_intersect_key($params['form'], array_flip($this->_columns));
			$this->insert($data);
			Session::set('message', ['class' => 'success', 'content' => 'Dữ liệu được lưu thành công!']);
			return $this->lastID();
		}

		if($options['task'] == 'edit'){
			$params['form']['modified'] 	= date('Y-m-d H:i:s', time());
			$params['form']['modified_by']	= $this->_userInfo['username'];
			$params['form']['name']	= mysqli_real_escape_string($this->connect, $params['form']['name']);
			
			if($params['form']['picture']['name'] == null){
				unset($params['form']['picture']);
			}else{
				$uploadObj->removeFile('slider', $params['form']['picture_hidden']);
				$params['form']['picture'] 		= $uploadObj->uploadFile($params['form']['picture'], 'slider');
			}

			$data = array_intersect_key($params['form'], array_flip($this->_columns));
			$this->update($data, [['id', $params['form']['id']]]);
			Session::set('message', ['class' => 'success', 'content' => 'Dữ liệu được lưu thành công!']);
			return $params['form']['id'];
		}
	}

	public function getInfoItem($params, $options = null)
	{
		if($options == null){
			$query[] = "SELECT `id`, `name`, `picture`, `status`, `link`, `ordering`, `description`";
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
			$query[] = "FROM `{$this->table}`";
			$query[] = "WHERE `id` > 0";

			if (!empty(trim(@$params['search'] ?? ''))) {
				$query[] = "AND `name` LIKE '%{$params['search']}%'";
			}

			$query[] = "GROUP BY `status`";
			$query = implode(' ', $query);
			$items = $this->fetchAll($query);
			$result = array_combine(array_column($items, 'status'), array_column($items, 'count'));
			$result = ['all' => array_sum($result)] + $result;
			return $result;
		}
	}
}
