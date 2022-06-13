<?php
namespace App\Http\Filters;

class TaskFilter extends QueryFilter
{

    /**
     * @param string $name
     */
    public function name(string $name)
    {
        $this->builder->where('name', 'like', "%".$name."%");
    }

    /**
     * @param string $status
     */
    public function status(string $status)
    {
        $this->builder->where('status', '=', $status);
    }

    public function search(string $text){
        $this->builder
            ->where('email', 'like', "%".$text."%")
            ->orWhere('description', 'like', "%".$text."%");
    }
}
