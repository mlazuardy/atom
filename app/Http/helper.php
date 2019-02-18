<?php


if(!function_exists('ifError')){
    function ifError($field,$class = null)
    {
        if(isset($errors)){
            if($errors->has($field)){
                $$say = sprintf('<span %s>%s</span>', $class != null ? "class=$class" : '', $errors->first($field));
                return $say;
            }
        }
    }
}