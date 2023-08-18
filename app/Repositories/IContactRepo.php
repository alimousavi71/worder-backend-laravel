<?php

namespace App\Repositories;

use App\Models\Contact;

interface IContactRepo
{
    public function save(array $attr): Contact;
}
