<?php

//user class

class medicine extends Model
{

    protected $table = 'medicines';

    protected $allowedColumns = [

        'medicine_id',
        'generic_name'
    ];

    public function medicine($id){
      return $this->read("select * from medicines where medicine_id = ?", [$id]);
    }



}
