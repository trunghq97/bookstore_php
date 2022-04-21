<?php
class Form{
    // Create Input
    public static function cmsInput($type, $name, $id, $value, $class = null, $size = null, $attribute = null)
    {
        $strSize        = ($size == null) ? '' : "size='$size'";
        $strClass       = ($class == null) ? '' : "class='$class'";
        $strAttribute   = ($attribute == null) ? '' : $attribute;

        $xhtml = "<input type='$type' name='$name' id='$id' value='$value' $strClass $strSize $strAttribute>";
        return $xhtml;
    }

    // Create Row
    public static function cmsRowForm($lblName, $input, $require = false){
        $strRequired = '';
        if($require) $strRequired = '<span class="text-danger">*</span>';
        $xhtml = sprintf('<div class="form-group"><label>%s %s</label>%s</div>', $lblName, $strRequired, $input);
        return $xhtml;
    }

    public static function cmsSelectbox($name, $class, $arrValue, $keySelect = 'default', $style = null, $attribute = ''){
        $strStyle    = ($style == null) ? '' : "style='$style'";
        $xhtml = "<select $strStyle name='$name' class='$class' $attribute>";
        foreach ($arrValue as $key => $value) {
            if(is_numeric($keySelect)) $keySelect = intval($keySelect);
            if ($key === $keySelect) {
                $xhtml .= '<option selected="selected" value="' . $key . '">' . $value . '</option>';
            } else {
                $xhtml .= '<option value="' . $key . '">' . $value . '</option>';
            }
        }
        $xhtml .= '</select>';
        return $xhtml;
    }
}

?>