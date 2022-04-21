<?php
class GroupController extends AdminController
{
	// ACTION: INDEX
	public function indexAction()
	{
		$this->_view->_title = 'Group Controller :: List';

		$itemsStatusCount = $this->_model->countItems($this->_arrParam, ['task' => 'count-items-status']);
		$totalItems		  = $itemsStatusCount[$this->_arrParam['status'] ?? 'all'];
		
		$configPagination = ['totalItemsPerPage' => 5, 'pageRange' => 3];
		$this->setPagination($configPagination);
		$this->_view->pagination = new Pagination($totalItems, $this->_pagination);

		$this->_view->items = $this->_model->listItems($this->_arrParam);
		$this->_view->itemsStatusCount = $itemsStatusCount;
		$this->_view->render('group/index');
	}

	// ACTION: ADD & EDIT GROUP
	// public function formAction()
	// {
	// 	$this->_view->_title = 'Group Controller :: Add';
	// 	if(isset($this->_arrParam['id']) && !isset($this->_arrParam['form']['token'])){
	// 		$this->_view->_title = 'Group Controller :: Edit';
	// 		$this->_arrParam['form'] = $this->_model->getInfoItem($this->_arrParam);
	// 		if(empty($this->_arrParam['form'])) URL::redirect('backend', 'group', 'index');
	// 	}

	// 	if(isset($this->_arrParam['form']['token'])){
	// 		$validate = new Validate($this->_arrParam['form']);
	// 		$validate->addRule('name', 'string', ['min' => 3, 'max' => 255])
	// 				 ->addRule('status', 'status', ['deny' => ['default']])
	// 				 ->addRule('group_acp', 'status', ['deny' => ['default']]);
	// 		$validate->run();
	// 		$this->_arrParam['form'] = $validate->getResult();
	// 		if($validate->isValid() == false){
	// 			$this->_view->errors = $validate->showErrors();
	// 		}else{
	// 			$task = isset($this->_arrParam['id']) ? 'edit' : 'add';
	// 			$this->_model->saveItem($this->_arrParam, ['task' => $task]);
	// 			URL::redirect('backend', 'group', 'index');
	// 		}
	// 	}
	// 	$this->_view->arrParams = $this->_arrParam;
	// 	$this->_view->render('group/form');
	// }

	// ACTION: AJAX CHANGE GROUP ACP
	public function ajaxChangeGroupACPAction()
	{	
		$result = $this->_model->changeGroupACP($this->_arrParam);
		echo json_encode($result);
	}
}
