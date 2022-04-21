<?php
class IndexController extends DefaultController
{
	public function noticeAction(){
		$this->_view->_title = 'Thông báo';
        $this->_view->render('index/notice');
    }

    public function indexAction(){
		$this->_view->_title = 'Trang chủ';
		$this->_view->specialBooks 		 = $this->_model->listItems($this->_arrParam, ['task' => 'books-special']);
		$this->_view->featuredCategories = $this->_model->listItems($this->_arrParam, ['task' => 'featured-categories']);
		$this->_view->sliderItems 		 = $this->_model->listItems($this->_arrParam, ['task' => 'get-item-slider']);
        $this->_view->render('index/index');
    }

	public function registerAction(){

		$userInfo	= Session::get('user');
		if(($userInfo['login'] ?? '' == true) && ($userInfo['time'] + TIME_LOGIN) >= time()){
			URL::redirect('frontend', 'user', 'index', ['id' => $userInfo['info']['id']]);
		}
		$this->_view->_title = 'Đăng ký tài khoản';

		if(isset($this->_arrParam['form']['token'])){
			URL::checkRefreshPage($this->_arrParam['form']['token'], 'frontend', 'user', 'register');
			
			$queryUserName  = "SELECT `id` FROM `" . TBL_USER . "` WHERE `username` = '" . $this->_arrParam['form']['username'] . "'";
			$queryEmail    = "SELECT `id` FROM `" . TBL_USER . "` WHERE `email` = '" . $this->_arrParam['form']['email'] . "'";

			$validate 		= new Validate($this->_arrParam['form']);
			$validate->addRule('username'	,'string-notExistRecord',['database' => $this->_model, 'query' => $queryUserName, 'min' => 3, 'max' => 25])
					 ->addRule('email'		,'email-notExistRecord'	,['database' => $this->_model, 'query' => $queryEmail])
					 ->addRule('password'	,'password'				,['action' 	 => 'add']);

			$validate->run();

			$this->_arrParam['form'] = $validate->getResult();
			if($validate->isValid() == false){
				$this->_view->errors = $validate->showErrorsFrontend();
			}else{
				
				$this->_model->saveItem($this->_arrParam, ['task' => 'user-register']);
				URL::redirect('frontend', 'index', 'notice', ['type' => 'register-success']);
			}
		}
		$this->_view->render('index/register');
	}

	public function loginAction()
	{	
		$userInfo	= Session::get('user');
		
		if(($userInfo['login'] ?? '' == true) && ($userInfo['time'] + TIME_LOGIN) >= time()){
			URL::redirect('frontend', 'user', 'index', ['id' => $userInfo['info']['id']]);
		}
		$this->_view->_title = 'Đăng nhập tài khoản';

		if(isset($this->_arrParam['form']['token'])){
			$validate = new Validate($this->_arrParam['form']);
			$email 	  = $this->_arrParam['form']['email'];
			$password = md5($this->_arrParam['form']['password']);
			$query 	  = "SELECT `id` FROM `user` WHERE `email` = '$email' AND `password` = '$password'";
			$validate->addRule('email', 'existRecord', ['database' => $this->_model, 'query' => $query]);
			$validate->run();

			if($validate->isValid() == true){
				$infoUser	  = $this->_model->getInfoItem($this->_arrParam);
				$arraySession = [
					'login'		=> true,
					'info'		=> $infoUser,
					'time'		=> time(),
					'group_acp'	=> $infoUser['group_acp']
				];
				Session::set('user', $arraySession);
				URL::redirect('frontend', 'user', 'index', ['id' => $infoUser['id']], 'tai-khoan.html');
			}else{
				$this->_view->errors = $validate->showErrorsFrontend();
			}
		}
		$this->_view->render('index/login');
	}

	public function logoutAction()
	{
		Session::delete('user');
		URL::redirect('frontend', 'index', 'index', null, 'index.html');
	}
}