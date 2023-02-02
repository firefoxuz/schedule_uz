<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 25/01/2023
 * Time: 11:06
 * File: Room.php
 */

namespace App\Modules\Rooms\Dto;

class Room
{
    public function __construct(
        public readonly string $name
    )
    {
    }
}
