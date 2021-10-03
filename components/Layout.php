<?php



class Layout 
{
	public $filename  = './styles/main.json';
	public $colorname;

	function __construct() {
		if (isset($_REQUEST['color'])) {
            $request = json_decode($_POST['color'], true);

            $dataKeyword =  array(
                array(
                    "background" => $request['background']
                )
            );
          
            $data = json_encode($dataKeyword, JSON_UNESCAPED_UNICODE);
            file_put_contents($this->filename, $data,  LOCK_EX);
		}

	}

	public function loadJSON() 
    {
        return file_get_contents($this->filename);
    }

}

$color = new Layout;
echo $color->loadJSON();

