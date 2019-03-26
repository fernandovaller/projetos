<?php
namespace System;

class Html {

    private static function parseAttr($attributes) {
        if (is_string($attributes)) {
            return (!empty($attributes)) ? ' ' . trim($attributes) : '';
        }
        if (is_array($attributes)) {
            $attr = '';
            foreach ($attributes as $key => $val) {
                $attr .= ' ' . $key . '="' . $val . '"';
            }
            return $attr;
        }
    }


    //Gera um html link 
    //Ex: <a href="{link}">{html}</a>
    public static function link($link = '#', $label = null, $attributes = null){
        $attr = self::parseAttr($attributes);
        return '<a href="'.$link.'" '.$attr.'>'.$label.'</a>';
    }  

}