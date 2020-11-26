<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBudget extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relation Model
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
