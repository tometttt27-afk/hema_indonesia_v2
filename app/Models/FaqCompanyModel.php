<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCompanyModel extends Model
{
    protected $table = 'faq_company';
    protected $fillable = [
        'title',
        'description',
        'code_faq',
        'is_active'
    ];
}