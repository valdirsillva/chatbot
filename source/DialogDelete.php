<?php


class DialogDelete 
{
    private $file = '../data/keyword.json';
    private $dataset = [];
    private $currentId;

    public function  delete() 
    {
        if (isset($_REQUEST['delete'])) {

            $textId = (int) $_POST['id'];
 
            $request = json_decode($_POST['delete'], true);
            $serialize = $this->load();
 
            if (!empty($serialize)) {
             foreach($serialize as $key => $object) {
                 if ($key === $textId) {
                     unset(
                        $serialize[$key]['keyword'],
                        $serialize[$key]['text']
                     );
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
      
        return json_decode($current, true);
    }
}


$delete = new DialogDelete;
$delete->delete();