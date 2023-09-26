<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormDoc extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'form_type_id',
        'code_name',
        'field_requests',
        'body',
    ];


    public function getByCategory($category)
    {
        $forms = FormDocType::where('name',$category)->first();
        if($forms)
        {
            return $this->where('form_type_id',$forms->id)->get();
        }
        return [];
    }



}
