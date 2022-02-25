<?php



header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/json");



class DialogEdit 
{
   public $file = '../data/keyword.json';

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
                if ($serialize[$key]['id'] === $textId) {
                    $serialize[$key]['keyword'] = trim($_POST['keyword']);
                    $serialize[$key]['text'] = trim($_POST['text']);
                    array_push($this->dataset, $serialize);
                }
            }
        }

        $data = json_encode($serialize, JSON_UNESCAPED_UNICODE);
        file_put_contents($this->file, $data,  LOCK_EX);
        
        header("Location: ../list.html?action=list");
       }
   }

   public function load() 
   {
       return  file_get_contents($this->file);
   }
}


$edit = new DialogEdit;
$edit->edit();