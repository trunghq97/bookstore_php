<?php
class UserController extends AdminController
{
	public function indexAction()
	{
		$this->_view->_title 			= 'User Controller :: List';

		$itemsStatusCount 				= $this->_model->countItems($this->_arrParam, ['task' => 'count-items-status']);
		$totalItems		  				= $itemsStatusCount[$this->_arrParam['status'] ?? 'all'];
		
		$configPagination 				= ['totalItemsPerPage' => 5, 'pageRange' => 3];
		$this->setPagination($configPagination);
		$this->_view->pagination 		= new Pagination($totalItems, $this->_pagination);

		$this->_view->slbGroup			= $this->_model->itemInSelectbox($this->_arrParam);
		$this->_view->items 			= $this->_model->listItems($this->_arrParam);
		$this->_view->itemsStatusCount 	= $itemsStatusCount;
		$this->_view->render('user/index');
	}

	public function ajaxChangeGroupAction()
	{
		$result = $this->_model->changeGroup($this->_arrParam);
		echo json_encode($result);
	}
	// ACTION: ADD & EDIT GROUP
	public function formAction()
	{
		$this->_view->_title = 'User Controller :: Add';
		$this->_view->slbGroup			= $this->_model->itemInSelectbox($this->_arrParam);
		if(isset($this->_arrParam['id']) && !isset($this->_arrParam['form']['token'])){
			$this->_view->_title = 'User Controller :: Edit';
			$this->_arrParam['form'] = $this->_model->getInfoItem($this->_arrParam);
			if(empty($this->_arrParam['form'])) URL::redirect('backend', 'user', 'index');
		}

		if(isset($this->_arrParam['form']['token'])){
			$task      = 'add';
			$requirePass  = true;
			$queryUserName  = "SELECT `id` FROM `" . TBL_USER . "` WHERE `username` = '" . $this->_arrParam['form']['username'] . "'";
			$queryEmail    = "SELECT `id` FROM `" . TBL_USER . "` WHERE `email` = '" . $this->_arrParam['form']['email'] . "'";
			if (isset($this->_arrParam['form']['id'])) {
				$task       = 'edit';
				$requirePass   = false;
				$queryUserName   .= " AND `id` <> '" . $this->_arrParam['form']['id'] . "'";
				$queryEmail   .= " AND `id` <> '" . $this->_arrParam['form']['id'] . "'";
			}
			$validate 		= new Validate($this->_arrParam['form']);
			$validate->addRule('username'	,'string-notExistRecord',['database' => $this->_model, 'query' => $queryUserName, 'min' => 3, 'max' => 25])
					 ->addRule('email'		,'email-notExistRecord'	,['database' => $this->_model, 'query' => $queryEmail])
					 ->addRule('password'	,'password'				,['action' 	 => $task], $requirePass)
					 ->addRule('status'		,'status'				,['deny' 	 => ['default']])
					 ->addRule('group_id'	,'status'				,['deny' 	 => ['default']]);
			$validate->run();

			$this->_arrParam['form'] = $validate->getResult();
			if($validate->isValid() == false){
				$this->_view->errors = $validate->showErrors();
			}else{
				$this->_model->saveItem($this->_arrParam, ['task' => $task]);
				URL::redirect('backend', 'user', 'index');
			}
		}
		$this->_view->arrParams = $this->_arrParam;
		$this->_view->render('user/form');
	}

	// ACTION: PassWord
	public function formChangePasswordAction()
	{
		$this->_view->_title = 'User Controller :: Change Password';
		if (isset($this->_arrParam['id']) &&  !isset($this->_arrParam['form']['token'])) {
			$this->_arrParam['form'] = $this->_model->getInfoItem($this->_arrParam);
			$this->_arrParam['form']['password'] = HelperBackend::randomString(8);
			if(empty($this->_arrParam['form'])) URL::redirect('backend', 'user', 'index');
		}

		if (isset($this->_arrParam['form']['token'])){
			$validate 		= new Validate($this->_arrParam['form']);
			$validate->addRule('password'	,'password', ['action' 	 => 'edit']);
			$validate->run();
			$this->_arrParam['form'] = $validate->getResult();
			if ($validate->isValid() == false) {
				$this->_view->errors = $validate->showErrors();
			} else {
				$this->_model->saveItem($this->_arrParam, ['task' => 'password']);
				URL::redirect('backend', 'user', 'index');
			}
		}
		$this->_view->arrParams = $this->_arrParam;
		$this->_view->render('user/form_change_password');
	}
}
