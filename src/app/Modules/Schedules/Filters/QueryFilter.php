<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 26/01/2023
 * Time: 10:14
 * File: QueryFilter.php
 */

namespace App\Modules\Schedules\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QueryFilter
{
    protected Builder $builder;
    protected Request $request;

    public function __construct($builder, $request)
    {
        $this->builder = $builder;
        $this->request = $request;
    }

    public function apply()
    {
        foreach ($this->filters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                if (!empty($value)){
                    $this->$filter($value);
                }
            }
        }
        return $this->builder;
    }

    public function filters(): array
    {
        return $this->request->all();
    }
}
