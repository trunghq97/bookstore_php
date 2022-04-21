<?php
class SliderController extends AdminController
{
	// ACTION: INDEX
	public function indexAction()
	{
		$this->_view->_title = 'Slider Controller :: List';

		$itemsStatusCount = $this->_model->countItems($this->_arrParam, ['task' => 'count-items-status']);
		$totalItems		  = $itemsStatusCount[$this->_arrParam['status'] ?? 'all'];
		
		$configPagination = ['totalItemsPerPage' => 5, 'pageRange' => 3];
		$this->setPagination($configPagination);
		$this->_view->pagination = new Pagination($totalItems, $this->_pagination);

		$this->_view->items = $this->_model->listItems($this->_arrParam);
		$this->_view->itemsStatusCount = $itemsStatusCount;
		$this->_view->render('slider/index');
	}

	// ACTION: ADD & EDIT SLIDER
	public function formAction() 
	{
		$this->_view->_title = 'Slider Controller :: Add';
		if(!empty($_FILES)) $this->_arrParam['form']['picture'] = $_FILES['picture'];

		if(isset($this->_arrParam['id']) && !isset($this->_arrParam['form']['token'])){
			$this->_view->_title = 'Slider Controller :: Edit';
			$this->_arrParam['form'] = $this->_model->getInfoItem($this->_arrParam);
			if(empty($this->_arrParam['form'])) URL::redirect('backend', 'slider', 'index');
		}

		if(isset($this->_arrParam['form']['token'])){
			$task = isset($this->_arrParam['id']) ? 'edit' : 'add';
			$validate = new Validate($this->_arrParam['form']);
			$validate->addRule('name',	 		'string', ['min'  => 3, 'max' => 255])
					 ->addRule('status', 		'status', ['deny' => ['default']])
					 ->addRule('picture',		'file'	, ['min'  => 100, 'max' => 1000000, 'extension' => ['jpg', 'png']], $task == 'add' ? true : false);

			$validate->run(); 
			$this->_arrParam['form'] = $validate->getResult();
			if($validate->isValid() == false){
				$this->_view->errors = $validate->showErrors();
			}else{
				$this->_model->saveItem($this->_arrParam, ['task' => $task]);
				URL::redirect('backend', 'slider', 'index');
			}
		}
		$this->_view->arrParams = $this->_arrParam;
		$this->_view->render('slider/form');
	}

	// ACTION: AJAX CHANGE ORDERING
	public function ajaxChangeOrderingAction(){
		$result = $this->_model->changeOrdering($this->_arrParam);
		echo json_encode($result);
	}
}
