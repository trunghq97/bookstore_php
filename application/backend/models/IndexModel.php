<?php
class IndexModel extends Model
{	
	public function __construct()
	{
		parent::__construct();
	}

	public function infoItem($params, $options = null)
	{
		if($options == null){
			$username 	= $params['form']['username'];
			$password 	= md5($params['form']['password']);
			$query[]	= "SELECT `u`.`id`, `u`.`username`, `u`.`fullname`, `u`.`email`, `u`.`group_id`, `g`.`group_acp`, `g`.`privilege_id`";
			$query[]	= "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`";
			$query[]	= "WHERE `username` = '$username' AND `password` = '$password'";

			$query		= implode(" ", $query); 
			$result		= $this->fetchRow($query);

			$strPrivilegeID = '';
			if($result['group_acp'] == 1){
				$arrPrivilege = explode(',', $result['privilege_id']);
				foreach($arrPrivilege as $privilegeID) $strPrivilegeID .= "'$privilegeID', ";

				$queryPrivilege[] = "SELECT `id`, CONCAT(`module`, '-', `controller`, '-', `action`) AS `name`";
				$queryPrivilege[] = "FROM `".TBL_PRIVILEGE."` AS p";
				$queryPrivilege[] = "WHERE id IN ($strPrivilegeID'0')";

				$queryPrivilege			= implode(" ", $queryPrivilege);
				$result['privilege']	= $this->fetchPairs($queryPrivilege);
			}
			return $result;
		}
	}
}
