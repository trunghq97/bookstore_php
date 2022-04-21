<?php
class BookController extends DefaultController
{
	// ACTION: LIST BOOKS
	public function indexAction()
	{
		$this->_view->_title = 'Sách';
		$totalItems = $this->_model->countItems($this->_arrParam, ['task' => 'count-items']);
		$configPagination 				= ['totalItemsPerPage' => 2, 'pageRange' => 3];
		$this->setPagination($configPagination);
		$this->_view->pagination 		= new Pagination($totalItems, $this->_pagination);
		$this->_view->categoryName = $this->_model->getInfoItem($this->_arrParam, ['task' => 'get-category-name']);
		$this->_view->items 	   = $this->_model->listItems($this->_arrParam,   ['task' => 'books-in-category']);
		$this->_view->render('book/index');
	}

	// ACTION: DETAIL BOOK
	public function detailAction()
	{
		$this->_view->_title = 'Thông Tin Sách';
		// $totalItems = $this->_model->countItems($this->_arrParam, ['task' => 'count-items']);
		// $configPagination 				= ['totalItemsPerPage' => 2, 'pageRange' => 3];
		// $this->setPagination($configPagination);
		// $this->_view->pagination 		= new Pagination($totalItems, $this->_pagination);

		$this->_view->bookInfo 		= $this->_model->getInfoItem($this->_arrParam, ['task' => 'book-info']);
		$this->_view->bookRelate 	= $this->_model->listItems($this->_arrParam,   ['task' => 'books-relate']);
		$this->_view->render('book/detail');
	}
}
