<?php 

class ValidationForm {
    private $data;
    private $errors = [];
    private static $fields = ['name', 'email'];

    public function __construct($datas)
    {
        $this->data = $datas;   
    }

    public function validateForm()
    {
        foreach(self::$fields as $field)
        {
            if(!array_key_exists($field, $this->data)){
                trigger_error("'$field' is not present in the data");
                return;
            }
        }

        $this->nameValidation();
        $this->emailValidation();
        return $this->errors;
    }

    private function nameValidation()
    {
        $val = trim($this->data['name']);
        if(empty($val)){
            $this->addError('name', 'name is not available');
        }else{
            if(!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)){
                $this->addError('name', 'name must be 6-12 chars & alphanumeri');
            }
        }
    } 

    private function emailValidation()
    {
        $val = trim($this->data['email']);
        if(empty($val)){
            $this->addError('email', 'email is not available');
        }else{
            if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
                $this->addError('email', 'email must be valid');
            }
        }
    }

    private function addError($key, $value)
    {
        $this->errors[$key] = $value;
    }
}


?>