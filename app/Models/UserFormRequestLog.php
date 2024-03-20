<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
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

    /**
     * Casting
     */

    // protected function serializeDate(DateTimeInterface $date): string
    // {
    //     Carbon::setLocale(config('app.locale'));
    //     setlocale(LC_ALL, 'es_MX', 'es', 'ES', 'es_MX.utf8');
    //     return (new Carbon($date))->locale('ES')->toDayDateTimeString();
    // }
}
