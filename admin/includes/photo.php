<?php


class Photo extends Db_object {

    protected static $db_table = 'photos';
    protected static $db_table_fields = array('photo_id', 'title', 'description', 'filename', 'type', 'size');
    public $photo_id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;

    public $tmp_part;
    public $upload_directory = "images";
    public $errors = array();
    public $upload_errors_array = array(

        UPLOAD_ERR_OK => 'uploading successfully done',
        UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
        UPLOAD_ERR_EXTENSION => 'File upload stopped by extension'

    );




    public function set_file($file) {

        if(empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "there was no file uploaded here";
            return false;
        }elseif($file['error'] != 0) {
            $this->errors = $this->upload_errors_array[$file['error']];
            return false;
        }else{

            $this->filename = basename($file['name']);
            $this->tmp_part = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];

        }
        
    }


    public function save() {
        if($this->photo_id) {
            $this->update();
        }else{
            if(!empty($this->errors)) {
                return false;
            }

            if(empty($this->filename) || empty($this->tmp_part)) {
                $this->errors[] = "this file not avalible";
                return false;
            }

            // $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;
            $target_path =  "./{$this->upload_directory}/{$this->filename}";

            if(file_exists($target_path)) {
                $this->errors[] = "this file {$this->filename} already exist";
                return false;
            }

            // move_uploaded_file($this->tmp_part, "./images/{$this->filename}");

            if(move_uploaded_file($this->tmp_part, $target_path)) {
                if($this->creat()) {
                    unset($this->tmp_part);
                    return true;
                }
            }else{
                $this->errors[] = "the file not permision";
                return false;
            }

            $this->creat();
        }
    }

}



?>