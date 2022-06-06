<?php
namespace App\Http\Filters;

class UserFilter extends QueryFilter
{

    /**
     * @param string $name
     */
    public function name(string $name)
    {
        $this->builder->where('name', 'like', "%".$name."%");
    }

    public function email(string $email)
    {
        $this->builder->where('email', 'like', "%".$email."%");
    }

    public function search(string $text){
        $this->builder
            ->where('email', 'like', "%".$text."%")
            ->orWhere('email', 'like', "%".$text."%");
    }
}
