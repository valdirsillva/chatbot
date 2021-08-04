<?php


header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");


class FileWriteDataJson 
{

    public static $file = '../data/keyword.json';
    public static $currentId = 0;
    public static $keyword  = [];


    /**
     * Recebe os dados  do formulario, cria um novo array e insere o novo valor no json com file_put_contents
     */
    public static function writeFromJson() 
    {   
        if (isset($_REQUEST)) {
           
            $request = json_decode($_POST['data'], true);

            $serialize = FileWriteDataJson::load();

            if (!empty($serialize)) {
                foreach($serialize as $key => $object) {
                    array_push(self::$keyword, $object);
                    self::$currentId = $key;
                }
            }

            $dataKeyword =  array(
                array(
                    "id" => ++self::$currentId,
                    "keyword" =>  $request['keyword_name'],
                    "text" => $request['text_context']
                )
            );

            if (empty($dataKeyword[0]['keyword'])) {
                file_put_contents(self::$file,  json_encode(self::$keyword, JSON_UNESCAPED_UNICODE),  LOCK_EX);
                return;
            } 

            $keywords = array_merge(self::$keyword, $dataKeyword);
            $data = json_encode($keywords, JSON_UNESCAPED_UNICODE);
            file_put_contents(self::$file, $data,  LOCK_EX);
        }
    }

    /**
     * Ler o arquivo json retorna como um array php
     */

    public static function load() 
    {
        $current = file_get_contents(self::$file);
       
        return json_decode($current, true);;
    }

} 
FileWriteDataJson::writeFromJson();
