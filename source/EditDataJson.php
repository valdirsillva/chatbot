<?php


class EditDataJson 
{
   private $file = '../data/keyword.json';

   public function edit() 
   {
       if (isset($_REQUEST['id'])) {

          $request = json_decode($_GET['id'], true);

          $serialize = $this->load();
       }
   }

   public function load() 
   {
       $current = file_get_contents($this->file);
      
       return json_decode($current, true);;
   }
}


$edit = new EditDataJson;
$edit->edit();