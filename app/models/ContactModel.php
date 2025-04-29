<?php

//user class

class ContactModel extends Model
{

    protected $table = 'user';

    protected $allowedColumns = [

        'phone',
        'email',
        'text',
    ];

    public function add($data){
      return $this->insert($data);
    }

}
