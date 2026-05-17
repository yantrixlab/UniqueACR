<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'phone', 'email', 'message', 'source_type', 'source_id', 'status'])]
class Enquiry extends Model
{
}
