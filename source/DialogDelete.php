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
                 if ($serialize[(int) $key]['id'] === $textId) {
                     unset( $serialize[ $key] );
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


$delete = new DialogDelete;
$delete->delete();