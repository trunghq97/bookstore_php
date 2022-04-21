<?php
class Bootstrap
{
	private $_params;
	private $_controllerObject;

	public function init()
	{
		$this->setParam();
		$controllerName = $this->convertNameURLToClassName($this->_params['controller']) . 'Controller';
		$filePath	= PATH_APPLICATION . $this->_params['module'] . DS . 'controllers' . DS . $controllerName . '.php';

		if (file_exists($filePath)) {
			$this->loadExistingController($filePath, $controllerName);
			$this->callMethod();
		}else{
			URL::redirect('frontend', 'index', 'notice', ['type' => 'not-url']);
		}
	}

	private function convertNameURLToClassName($nameURL){
		return str_replace('-', '', ucwords(strtolower($nameURL), '-'));
	}

	// CALL METHODE
	private function callMethod()
	{
		$actionName = $this->_params['action'] . 'Action';
		if (method_exists($this->_controllerObject, $actionName) == true) {

			$module 	= $this->_params['module'];
			$controller = $this->_params['controller'];
			$action 	= $this->_params['action'];
			$requestURL = "$module-$controller-$action";
			$userInfo	= Session::get('user');
			$logged		= (($userInfo['login'] ?? '' == true) && ($userInfo['time'] + TIME_LOGIN) >= time());

			// MODULE BACKEND
			if($module == 'backend'){
				if($logged == true){
					if($userInfo['group_acp'] == 1){
						// if(in_array($requestURL, $userInfo['info']['privilege']) == true){
							$this->_controllerObject->$actionName();
						// }else{
						// 	URL::redirect('frontend', 'index', 'notice', ['type' => 'not-permission']);
						// }
					}else{
						URL::redirect('frontend', 'index', 'notice', ['type' => 'not-permission']);
					}
				}else{
					$this->callLoginAction($module);
				}
			// MODULE BACKEND
			}else if($module == 'frontend'){
				if($controller == 'user'){
					if($logged == true){
						$this->_controllerObject->$actionName();
					}else{
						$this->callLoginAction($module);
					}
				}else{
					$this->_controllerObject->$actionName();
				}
			}
		}else{
			URL::redirect('frontend', 'index', 'notice', ['type' => 'not-url']);
		}
	}

	// SET PARAMS
	public function setParam()
	{
		$this->_params 	= array_merge($_GET, $_POST);
		$this->_params['module'] 		= isset($this->_params['module']) 		? $this->_params['module'] 	   : DEFAULT_MODULE;
		$this->_params['controller'] 	= isset($this->_params['controller']) 	? $this->_params['controller'] : DEFAULT_CONTROLLER;
		$this->_params['action'] 		= isset($this->_params['action']) 		? $this->_params['action'] 	   : DEFAULT_ACTION;
	}

	// CALL LOGIN ACTION
	public function callLoginAction($module = 'frontend')
	{
		Session::delete('user');
		require_once (PATH_APPLICATION . $module . DS . 'controllers' . DS . 'IndexController.php');
		$indexController = new IndexController($this->_params);
		$indexController->loginAction();
	}

	// LOAD EXISTING CONTROLLER
	private function loadExistingController($filePath, $controllerName)
	{

		if($this->_params['module'] == 'backend') {
			require_once PATH_APPLICATION . $this->_params['module'] . DS . 'controllers' . DS . 'AdminController.php';
		}
		
		if($this->_params['module'] == 'frontend') {
			require_once PATH_APPLICATION . $this->_params['module'] . DS . 'controllers' . DS . 'DefaultController.php';
		}

		require_once $filePath;
		$this->_controllerObject = new $controllerName($this->_params);
	}
}
