<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 25/01/2023
 * Time: 15:18
 * File: Subject.php
 */

namespace App\Modules\Subjects\Dto;

class Subject
{
    public function __construct(
        public readonly string $name
    )
    {
    }
}
