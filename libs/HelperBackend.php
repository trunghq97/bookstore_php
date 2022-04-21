<?php
class HelperBackend
{
    public static function button($type, $name, $class = 'btn-info', $options = ['small' => false, 'circle' => false])
    {
        $optionsClass = '';
        if ($options['small']) $optionsClass .= ' btn-sm';
        if ($options['circle']) $optionsClass .= ' rounded-circle';
        return sprintf('<button type="%s" class="btn %s %s">%s</button>', $type, $class, $optionsClass, $name);
    }

    public static function buttonLink($link, $name, $class = 'btn-info', $options = ['small' => false, 'circle' => false])
    {
        $optionsClass = '';
        if ($options['small']) $optionsClass .= ' btn-sm';
        if ($options['circle']) $optionsClass .= ' rounded-circle';
        return sprintf('<a href="%s" class="btn %s %s">%s</a>', $link, $class, $optionsClass, $name);
    }

    public static function itemGroupACP($module, $controller, $id, $value)
    {
        $link = URL::createLink($module, $controller, 'ajaxChangeGroupACP', ['id' => $id, 'group_acp' => $value]);
        $colorClass = 'btn-success';
        $icon = 'fa-check';

        if ($value == 0) {
            $colorClass = 'btn-danger';
            $icon = 'fa-minus';
        }

        return sprintf('<button type="button" data-url="%s" class="btn %s rounded-circle btn-sm btn-group-acp"><i class="fas %s"></i></button>', $link, $colorClass, $icon);
    }

    public static function itemShowAtHome($module, $controller, $id, $value)
    {
        $link = URL::createLink($module, $controller, 'ajaxChangeShowAtHome', ['id' => $id, 'show_at_home' => $value]);
        $colorClass = 'btn-success';
        $icon = 'fa-check';

        if ($value == 0) {
            $colorClass = 'btn-danger';
            $icon = 'fa-minus';
        }

        return sprintf('<button type="button" data-url="%s" class="btn %s rounded-circle btn-sm btn-show-at-home"><i class="fas %s"></i></button>', $link, $colorClass, $icon);
    }

    public static function itemStatus($module, $controller, $id, $value)
    {
        $link = URL::createLink($module, $controller, 'ajaxChangeStatus', ['id' => $id, 'status' => $value]);
        $colorClass = 'btn-success';
        $icon = 'fa-check';

        if ($value == 'inactive') {
            $colorClass = 'btn-danger';
            $icon = 'fa-minus';
        }

        return sprintf('<button type="button" data-url="%s" class="btn %s rounded-circle btn-sm btn-status"><i class="fas %s"></i></button>', $link, $colorClass, $icon);
    }

    public static function itemSpecial($module, $controller, $id, $value)
    {
        $link = URL::createLink($module, $controller, 'ajaxChangeSpecial', ['id' => $id, 'special' => $value]);
        $colorClass = 'btn-success';
        $icon = 'fa-check';

        if ($value == 0) {
            $colorClass = 'btn-danger';
            $icon = 'fa-minus';
        }

        return sprintf('<button type="button" data-url="%s" class="btn %s rounded-circle btn-sm btn-special"><i class="fas %s"></i></button>', $link, $colorClass, $icon);
    }

    public static function itemHistory($by, $time)
    {
        if ($time) $time = date('H:i:s d/m/Y', strtotime($time));
        $xhtml = sprintf('
        <p class="mb-0"><i class="far fa-user"></i> %s</p>
        <p class="mb-0"><i class="far fa-clock"></i> %s</p>
        ', $by, $time);
        return $xhtml;
    }

    public static function highlight($search, $value)
    {
        if (!empty(trim($search ?? ''))) {
            return preg_replace('/' . preg_quote($search, '/') . '/ui', '<mark>$0</mark>', $value);
        }

        return $value;
    }

    public static function showFilterStatus($module, $controller, $itemsStatusCount, $currentFilterStatus, $searchValue)
    {
        $xhtml = '';
        foreach ($itemsStatusCount as $key => $value) {
            $classColor = $key == $currentFilterStatus ? 'btn-info' : 'btn-secondary';
            $params = ['status' => $key];

            if (!empty($searchValue)) $params['search'] = $searchValue;

            $link = URL::createLink($module, $controller, 'index', $params);
            $name = '';
            switch ($key) {
                case 'all':
                    $name = 'All';
                    break;
                case 'active':
                    $name = 'Active';
                    break;
                case 'inactive':
                    $name = 'Inactive';
                    break;
            }
            $xhtml .= sprintf('<a href="%s" class="btn %s">%s <span class="badge badge-pill badge-light">%s</span></a> ', $link, $classColor, $name, $value);
        }
        return $xhtml;
    }

    public static function cmsMessage($message){
        
        $xhtml = '';
        if (!empty($message)){
            $xhtml = '<div class="alert alert-' . $message['class'] . ' alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <i class="icon fas fa-check"></i>
                                ' . $message['content'] . '
                            </div>';
        }
        return $xhtml;
    }

    public static function showInfoUser($arrInfoUser)
	{

		$xhtml = '';
		if (!empty($arrInfoUser)) {
			foreach ($arrInfoUser as $key => $value) {
				$xhtml .= '<p class="mb-0"><b class="name">' . $key . ': </b>' . $value . '</p>';
			}
		}
		return $xhtml;
	}

    public static function randomString($length = 5)
	{

		$arrCharacter = array_merge(range('a', 'z'), range(0, 9), range('A', 'Z'));
		$arrCharacter = implode("", $arrCharacter);
		// $arrCharacter .= "#$%^&*()+=-[]';,./{}|:<>?~";
		$arrCharacter = str_shuffle($arrCharacter);

		$result		= substr($arrCharacter, 0, $length);
		return $result;
	}

    // Create Image
    public static function createImage($folder, $pictureName, $attribute = null){
        $class      = !empty($attribute['class'])  ? $attribute['class']  : '';
        $strAttribute = "class='$class'";

        $picturePath        = PATH_UPLOAD . $folder . DS . $pictureName; 
        if(file_exists($picturePath)){
            $picture        = '<img '.$strAttribute.' src="' . URL_UPLOAD . $folder . DS . $pictureName . '">';
        }else{
            $picture        = '<img '.$strAttribute.' src="' . URL_UPLOAD . $folder . DS . 'default-picture.jpg' . '">';
        }
        return $picture;
    }

    public static function cmsTextArea($name, $value = null, $readonly = false, $class = null, $id = null)
    {
        $class        = ($class != null) ? $class : '';
        $id            = ($id != null) ? ' id="' . $id . '"' : '';
        $readonly      = ($readonly == true) ? 'readonly' : '';
        $xhtml         = '<textarea ' . $id . ' name="' . $name . '" ' . $readonly . ' class="form-control" rows="4" cols="50">' . $value . '</textarea>';

        return $xhtml;
    }
}
