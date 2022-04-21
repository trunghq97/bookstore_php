<?php
class IndexController extends AdminController
{
	public function loginAction()
	{	
		$userInfo	= Session::get('user');
		if(($userInfo['login'] ?? '' == true) && ($userInfo['time'] + TIME_LOGIN) >= time()){
			URL::redirect('backend', 'index', 'index');
		}

		$this->_templateObj->setFileTemplate('login.php');
		$this->_templateObj->load();

		$this->_view->_title = 'Login';
		if(isset($this->_arrParam['form']['token'])){
			$validate = new Validate($this->_arrParam['form']);
			$username = $this->_arrParam['form']['username'];
			$password = md5($this->_arrParam['form']['password']);
			$query 	  = "SELECT `id` FROM `user` WHERE `username` = '$username' AND `password` = '$password'";
			$validate->addRule('username', 'existRecord', ['database' => $this->_model, 'query' => $query]);
			$validate->run();

			if($validate->isValid() == true){
				$infoUser	  = $this->_model->infoItem($this->_arrParam);
				$arraySession = [
					'login'		=> true,
					'info'		=> $infoUser,
					'time'		=> time(),
					'group_acp'	=> $infoUser['group_acp']
				];
				Session::set('user', $arraySession);
				URL::redirect('backend', 'index', 'index');
			}else{
				$this->_view->errors = 'Thông tin đăng nhập không chính xác. Vui lòng kiểm tra lại!';
			}
		}
		$this->_view->render('index/login');
	}

	public function indexAction()
	{
		$this->_view->_title = 'Dashboard Admin';
		$this->_view->render('index/index');
	}

	public function profileAction(){
		$this->_view->_title 		= 'Profile';
		$userObj	= Session::get('user');

		$this->_view->arrParams['form']	= $userObj['info'];
		$this->_view->render('index/profile');
	}

	public function logoutAction()
	{
		Session::delete('user');
		URL::redirect('backend', 'index', 'login');
	}
}
