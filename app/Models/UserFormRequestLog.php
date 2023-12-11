<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class UserFormRequestLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_request_id',
        'user_id',
        'action',
        'description'
    ];

    /**
     * Relationships
     */


    /*
     * Relation FOrm
     */
    public function formRequest(): Relation
    {
        return $this->belongsTo(UserFormRequest::class, 'form_request_id');
    }


    public function user(): Relation
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
