<?php
namespace App\Core\abstract;
 

abstract class  AbstractEntity{
   abstract public  static function toObject(array $data):static;
   abstract public  function toArray():array;
   
   public function toJson() : string {
        return json_encode($this->toArray());
    }
}
