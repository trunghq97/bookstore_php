<?php
class GroupModel extends Model
{	
	private $_columns = ['id', 'name', 'group_acp', 'created', 'created_by', 'modified', 'modified_by', 'status'];
	private $_userInfo; 

	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_GROUP);
		$userObj			= Session::get('user');
		$this->_userInfo	= $userObj['info'];
	}

	public function listItems($params, $options = null)
	{
		$query[] 	= "SELECT `id`, `name`, `group_acp`, `created`, `created_by`, `modified`, `modified_by`, `status`";
		$query[]	= "FROM `{$this->table}` WHERE `id` > 0";

		if (!empty(trim($params['search'] ?? ''))) {
			$query[] = "AND `name` LIKE '%{$params['search']}%'";
		}

		if (isset($params['status']) && $params['status'] != 'all') {
			$query[] = "AND `status` = '{$params['status']}'";
		}

		if (isset($params['group_acp']) && $params['group_acp'] != 'default') {
			$query[] = "AND `group_acp` = {$params['group_acp']}";
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

	public function changeGroupACP($params, $options = null)
	{
		$groupACP = $params['group_acp'] == 1 ? 0 : 1;
		$modified_by = $this->_userInfo['username'];
		$modified	 = date('Y-m-d H:i:s', time());
		$data = ['group_acp' => $groupACP, 'modified' => $modified, 'modified_by' => $modified_by];
		$where = [['id', $params['id']]];
		$this->update($data, $where); 
		if($this->affectedRows()){
			return [
				'status' 	=> 'success',
				'data'		=> [
					'html' 		=> HelperBackend::itemGroupACP($params['module'], $params['controller'], $params['id'], $groupACP),
					'message'	=> 'Cập nhật thành công!'
					// 'link'		=> URL::createLink($this->_arrParam['module'], $this->_arrParam['controller'], 'ajaxChangeGroupACP', ['id' => $this->_arrParam['id'], 'group_acp' => $groupACP]),
					// 'removeClass' 	=> $groupACP == 1 ? 'btn-danger' 	: 'btn-success',
					// 'addClass'		=> $groupACP == 1 ? 'btn-success' 	: 'btn-danger',
					// 'removeIcon'	=> $groupACP == 1 ? 'fa-minus'		: 'fa-check',
					// 'addIcon'		=> $groupACP == 1 ? 'fa-check'		: 'fa-minus'
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
			$data = array_intersect_key($params['form'], array_flip($this->_columns));
			$this->insert($data);
			Session::set('message', ['class' => 'success', 'content' => 'Dữ liệu được lưu thành công!']);
			return $this->lastID();
		}

		if($options['task'] == 'edit'){
			$params['form']['modified'] 	= date('Y-m-d H:i:s', time());
			$params['form']['modified_by']	= $this->_userInfo['username'];
			$data = array_intersect_key($params['form'], array_flip($this->_columns));
			$this->update($data, [['id', $params['form']['id']]]);
			Session::set('message', ['class' => 'success', 'content' => 'Dữ liệu được lưu thành công!']);
			return $params['form']['id'];
		}
	}

	public function getInfoItem($params, $options = null)
	{
		if($options == null){
			$query[] = "SELECT `id`, `name`, `group_acp`, `status`";
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
