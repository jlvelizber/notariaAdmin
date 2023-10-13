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


    public function category()
    {
        return $this->belongsTo(FormDocType::class, 'fom_type_id');
    }


    /**
     * Helper method that set values to key value form
     */

    public function setValuesToRequests(array $valuesForm)
    {
        $fieldRequestsCopy = $this->field_requests;

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
