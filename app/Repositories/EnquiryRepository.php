<?php

namespace App\Repositories;

use App\Models\Enquiry;

class EnquiryRepository
{
    public function create(array $data): Enquiry
    {
        return Enquiry::query()->create($data);
    }
}
