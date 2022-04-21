<?php
class CategoryController extends DefaultController
{
	// ACTION: LIST CATEGORIES
	public function indexAction()
	{
		require_once PATH_LIBRARY_EXT . 'XML.php';

		$this->_view->_title = 'Danh mục sách';
		$totalItems = $this->_model->countItems($this->_arrParam, ['task' => 'count-items']);
		$configPagination 				= ['totalItemsPerPage' => 3, 'pageRange' => 2];
		$this->setPagination($configPagination);
		$this->_view->pagination 		= new Pagination($totalItems, $this->_pagination);
		$this->_view->items = XML::getContentXML('categories.xml');
		$this->_view->render('category/index');
	}
}
