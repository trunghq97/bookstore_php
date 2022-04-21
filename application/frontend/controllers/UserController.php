<?php
class UserController extends DefaultController
{
	public function indexAction()
	{	
		$userObj = Session::get('user');
		$userInfo = $userObj['info'];
		
		$this->_view->_title = 'Thông tin tài khoản';
		if(!empty($userInfo) && !isset($this->_arrParam['form']['token'])){
			$this->_arrParam['form'] = $this->_model->getInfoItem($this->_arrParam);
			if(empty($this->_arrParam['form'])) URL::redirect('frontend', 'user', 'index', ['id' => $userInfo['id']]);
		}

		if(isset($this->_arrParam['form']['token'])){
			// URL::checkRefreshPage($this->_arrParam['form']['token'], 'frontend', 'user', 'index', ['id' => $userObj['info']['id']]);
			$this->_model->saveItem($this->_arrParam, ['task' => 'user-update-info']);
			$userInfoDB   = $this->_model->getInfoItem($this->_arrParam);

			$arraySession = [
				'login'		=> true,
				'info'		=> $userInfoDB,
				'time'		=> time(),
				'group_acp'	=> $userInfoDB['group_acp']
			];
			Session::set('user', $arraySession);
			URL::redirect('frontend', 'user', 'index', ['id' => $userInfo['id']]);
		}

		$this->_view->arrParams = $this->_arrParam;
		$this->_view->render('user/index');
	}

	public function buyAction(){
		$this->_model->saveItem($this->_arrParam, ['task' => 'submit-cart']);
		URL::redirect('frontend', 'index', 'index');
	}

	public function cartAction(){
		$this->_view->_title = 'Giỏ hàng';
		$this->_view->items = $this->_model->listItem($this->_arrParam, ['task' => 'books-in-cart']);
		$this->_view->render('user/cart');
	}

	public function orderAction()
	{	
		$cart = Session::get('cart');
		$bookID = $this->_arrParam['book_id'];
		$price  = $this->_arrParam['price'];

		if(empty($cart)){
			$cart['quantity'][$bookID] = 1;
			$cart['price'][$bookID]    = $price;
		}else{
			if(key_exists($bookID, $cart['quantity'])){
				$cart['quantity'][$bookID] += 1;
				$cart['price'][$bookID] = $price * $cart['quantity'][$bookID];
			}else{
				$cart['quantity'][$bookID] = 1;
				$cart['price'][$bookID]    = $price;
			}
		}
		Session::set('cart', $cart);
		URL::redirect('frontend', 'book', 'detail', ['book_id' => $bookID]);
	}

	public function historyAction()
	{	
		$this->_view->_title = 'Lịch sử mua hàng';
		$this->_view->items  = $this->_model->listItem($this->_arrParam, ['task' => 'history-cart']);
		$this->_view->render('user/order_history');
	}

	public function formChangePasswordAction()
	{	
		$userObj  	= Session::get('user');
		$userInfo	= $userObj['info'];
		$this->_view->_title = 'Thay đổi mật khẩu';

		if(!empty($userInfo) && !isset($this->_arrParam['form']['token'])){
			$this->_arrParam['form'] = $this->_model->getInfoItem($this->_arrParam);
			if(empty($this->_arrParam['form'])) URL::redirect('frontend', 'user', 'index', ['id' => $userInfo['id']]);
		}

		if(isset($this->_arrParam['form']['token'])){
			
			$this->_model->saveItem($this->_arrParam, ['task' => 'user-change-new-password']);
			URL::redirect('frontend', 'user', 'formChangePassword', ['id' => $userInfo['id']]);
		}

		$this->_view->arrParams = $this->_arrParam;
		$this->_view->render('user/change_password');
	}
}
