<?php

class View
{

    // Subtitui as tags no html pelo seu valor
    private  static function render($caminho, $arr)
    {
        $html = file_get_contents($caminho);

        foreach ($arr as $key => $value) {
            $html = str_replace($key, $value, $html);
        }

        return $html;
    }

    public static function html($caminho, $arr)
    {
        $html = file_get_contents('./View/html.html');
        return str_replace(['%CONTEUDO%'], [self::render($caminho, $arr)], $html);
    }
}
