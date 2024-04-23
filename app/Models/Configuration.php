<?php

namespace App\Models;

use App\Enums\ConfigTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = ['value'];


    /**
     * RELATIONSHIPS
     */
    public function children()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function scopeGetGeneralConfig()
    {
        $general = $this->where('key',ConfigTypeEnum::CONFIGURACION_GENERAL_KEY->value);
    }
}
