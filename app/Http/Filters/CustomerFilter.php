<?php
namespace App\Http\Filters;

class CustomerFilter extends QueryFilter
{

    /**
     * @param string $name
     */
    public function search(string $text){
        $this->builder
            ->where('name', 'like', "%".$text."%")
            ->orWhere('phone', 'like', "%".$text."%")
            ->orWhere('email', 'like', "%".$text."%");
    }
}
