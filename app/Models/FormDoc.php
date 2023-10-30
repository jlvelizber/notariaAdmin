<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

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

    protected $casts = [
        'field_requests' => 'array',
    ];


    public function getByCategory($category)
    {
        $forms = FormDocType::where('name', $category)->first();
        if ($forms) {
            return $this->where('form_type_id', $forms->id)->get();
        }
        return [];
    }


    public function category(): Relation
    {
        return $this->belongsTo(FormDocType::class,'form_type_id','id');
    }


    /**
     * Helper method that set values to key value form
     */

    public function setValuesToRequests(array $valuesForm)
    {
        $fieldRequestsCopy = json_decode($this->field_requests, true);

        foreach ($valuesForm as $keyForm => $valueForm) {
            for ($i = 0; $i < count($fieldRequestsCopy); $i++) {
                if (array_key_exists('fields', $fieldRequestsCopy[$i])) {
                    // recorremos los campos
                    $countFields = count($fieldRequestsCopy[$i]['fields']);
                    $fieldsArray = $fieldRequestsCopy[$i]['fields'];

                    for ($j = 0; $j < $countFields; $j++) {
                        if (array_key_exists('name', $fieldsArray[$j]) && $fieldsArray[$j]['name'] == $keyForm) {
                            // setea valor
                            $fieldsArray[$j]['value'] = $valueForm;
                            $fieldRequestsCopy[$i]['fields'] = $fieldsArray;
                        } else {
                            continue;
                        }
                    }
                }
            }
        }

        $this->field_requests = $fieldRequestsCopy;
    }
}
