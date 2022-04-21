<?php
class CategoryController extends AdminController
{
	// ACTION: INDEX
	public function indexAction()
	{
		$this->_view->_title = 'Category Controller :: List';

		$itemsStatusCount = $this->_model->countItems($this->_arrParam, ['task' => 'count-items-status']);
		$totalItems		  = $itemsStatusCount[$this->_arrParam['status'] ?? 'all'];
		
		$configPagination = ['totalItemsPerPage' => 5, 'pageRange' => 3];
		$this->setPagination($configPagination);
		$this->_view->pagination = new Pagination($totalItems, $this->_pagination);

		$this->_view->items = $this->_model->listItems($this->_arrParam);
		$this->_view->itemsStatusCount = $itemsStatusCount;
		$this->_view->render('category/index');
	}

	// ACTION: ADD & EDIT CATEGORY
	public function formAction()
	{
		$this->_view->_title = 'Category Controller :: Add';
		if(!empty($_FILES)) $this->_arrParam['form']['picture'] = $_FILES['picture'];

		if(isset($this->_arrParam['id']) && !isset($this->_arrParam['form']['token'])){
			$this->_view->_title = 'Category Controller :: Edit';
			$this->_arrParam['form'] = $this->_model->getInfoItem($this->_arrParam);
			if(empty($this->_arrParam['form'])) URL::redirect('backend', 'category', 'index');
		}

		if(isset($this->_arrParam['form']['token'])){
			$task = isset($this->_arrParam['id']) ? 'edit' : 'add';
			$validate = new Validate($this->_arrParam['form']);
			$validate->addRule('name',	 		'string', ['min'  => 3, 'max' => 255])
					 ->addRule('status', 		'status', ['deny' => ['default']])
					 ->addRule('picture',		'file'	, ['min'  => 100, 'max' => 1000000, 'extension' => ['jpg', 'png']], $task == 'add' ? true : false)
					 ->addRule('show_at_home',  'status', ['deny' => ['default']]);
			$validate->run(); 
			$this->_arrParam['form'] = $validate->getResult();
			if($validate->isValid() == false){
				$this->_view->errors = $validate->showErrors();
			}else{
				$this->_model->saveItem($this->_arrParam, ['task' => $task]);
				URL::redirect('backend', 'category', 'index');
			}
		}
		$this->_view->arrParams = $this->_arrParam;
		$this->_view->render('category/form');
	}

	// ACTION: AJAX CHANGE STATUS
	public function ajaxChangeStatusAction()
	{ 
		require_once PATH_LIBRARY_EXT . 'XML.php';
		$result = $this->_model->changeStatus($this->_arrParam);
		$arrCategories = $this->_model->listItems($this->_arrParam, ['task' => 'xml-category']);
		XML::createXML($arrCategories, 'categories.xml');
		echo json_encode($result);
	}

	// ACTION: AJAX CHANGE SHOW AT HOME
	public function ajaxChangeShowAtHomeAction()
	{	
		$result = $this->_model->changeShowAtHome($this->_arrParam);
		echo json_encode($result);
	}

	// ACTION: AJAX CHANGE ORDERING
	public function ajaxChangeOrderingAction(){
		$result = $this->_model->changeOrdering($this->_arrParam);
		echo json_encode($result);
	}
}
