<?php


header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header('Content-Type: application/json; charset=utf-8');


class DialogEdit 
{
   private $file = '../data/keyword.json';

   private $dataset = [];
   private $currentId;
   

   public function edit() 
   {
       if (isset($_REQUEST['edit'])) {

           $textId = (int) $_POST['id'];

           $request = json_decode($_POST['edit'], true);
           $serialize = $this->load();

           if (!empty($serialize)) {
            foreach($serialize as $key => $object) {
                if ($key === $textId) {
                    $serialize[$key]['keyword'] = $_POST['keyword'];
                    $serialize[$key]['text'] = $_POST['text'];
                    array_push($this->dataset, $serialize);
                }
            }
        }

        $data = json_encode($serialize, JSON_UNESCAPED_UNICODE);
        file_put_contents($this->file, $data,  LOCK_EX);
        
        header("Location: ../list.html");
       }
   }

   public function load() 
   {
       $current = file_get_contents($this->file);
      
       return json_decode($current, true);;
   }
}


$edit = new DialogEdit;
$edit->edit();