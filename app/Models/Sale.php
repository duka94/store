<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'date_to', 'created_by', 'updated_by', 'deleted_by'];

    protected $dates = ['date_to'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('discount', 'created_by', 'updated_by', 'deleted_by',
            'created_at', 'updated_at', 'deleted_at');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
