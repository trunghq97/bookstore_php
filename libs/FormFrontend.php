<?php
class FormFrontend{

    // Create Input
    public static function cmsInput($type, $name, $id, $value, $class = null, $attribute = null)
    {
        $strAttribute   = ($attribute == null) ? '' : $attribute;
        $strClass       = ($class == null) ? '' : "class='$class'";
        
        $xhtml = sprintf('<input type="%s" id="%s" name="%s" value="%s" %s %s>', $type, $id, $name, $value, $strClass, $strAttribute);
        return $xhtml;
    }

    // Create Row
    public static function cmsRowForm($name, $lblName, $input, $classLabel = '', $classRow = '')
    {
        $xhtml = sprintf('<div class="%s"><label for="%s" class="%s">%s</label>%s</div>', $classRow, $name, $classLabel, $lblName, $input);
        return $xhtml;
    }

    public static function button($type, $id, $name, $value, $class)
    {
        return sprintf('<button type="%s" id="%s" name="%s" value="%s" class="%s">%s</button>', $type, $id, $name, $value, $class, $value);
    }

   
}

?>