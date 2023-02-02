<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 25/01/2023
 * Time: 14:22
 * File: Room.php
 */

namespace App\Modules\Groups\Dto;

class Group
{
    public function __construct(
        public readonly string $name
    )
    {
    }
}
