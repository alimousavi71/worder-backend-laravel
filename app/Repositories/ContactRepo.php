<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepo implements IContactRepo
{
    public function save(array $attr): Contact
    {
        return Contact::query()
            ->create($attr);
    }
}
