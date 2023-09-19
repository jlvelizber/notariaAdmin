<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class UserFormRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'form_request_body',
        'form_doc_id',
        'status_id',
    ];


    public function user(): Relation
    {
        return $this->belongsTo(User::class);
    }


    public function doc() : Relation 
    {
        return $this->belongsTo(FormDoc::class);    
    }
    
    
    
    public function status() : Relation 
    {
        return $this->belongsTo(UserFormStatus::class);    
    }
}
