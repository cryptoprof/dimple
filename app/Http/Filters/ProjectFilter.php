<?php
namespace App\Http\Filters;

class ProjectFilter extends QueryFilter
{

    /**
     * @param string $name
     */
    public function name(string $name)
    {
        $this->builder->where('name', 'like', "%".$name."%");
    }

    public function description(string $description)
    {
        $this->builder->where('description', 'like', "%".$description."%");
    }

    public function search(string $text){
        $this->builder
            ->where('name', 'like', "%".$text."%")
            ->orWhere('description', 'like', "%".$text."%");
    }
}
