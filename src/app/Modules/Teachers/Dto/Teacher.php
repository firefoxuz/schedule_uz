<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 25/01/2023
 * Time: 17:17
 * File: Teacher.php
 */

namespace App\Modules\Teachers\Dto;

class Teacher
{
    public function __construct(
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $birth_date,
        public readonly ?string $phone,
    )
    {
    }
}
