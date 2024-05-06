<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\EmailMinuteNotification;
use App\Notifications\EmailPermisoSalidaSucessNotification;
use App\Notifications\EmailVerificationNotification;
use App\Notifications\WelcomeUserNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'identification_type',
        'identification_num',
        'midle_name',
        'first_last_name',
        'second_last_name',
        'email',
        'password',
        'country_id',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }



    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * Funciones
     */
    function getMainRole(): Model | null
    {
        return $this->roles()->first();
    }

    /**
     * scopes
     */
    public function scopeMainRole($query)
    {
        return $query->leftJoin('role_user', 'role_user.user_id', 'users.id')->leftJoin('roles', 'roles.id', 'role_user.role_id')->selectRaw('users.*, roles.name as role_name');
    }

    /**
     * Extract users with roles names
     *
     * @param Builder $query
     * @param array $roleNames
     * @param string $selectField
     * @return void
     */
    public function scopeRolesWithRoleNames(Builder $query, array $roleNames, $selectField = '*'): void
    {
        $query->select($selectField)
            ->whereRelation('roles', function (Builder  $query) use ($roleNames) {
                $query->whereIn('name', $roleNames);
            });
    }


    /**
     *  END SCOPES
     */


    /**
     * Mutators
     */

    /**
     * Get the user's first name.
     */
    public function getFullName()
    {
        return $this->name . ' ' . $this->midle_name . ' ' . $this->first_last_name . ' ' . $this->second_last_name;
    }

    
    public function getRoleAttribute()
    {
        return $this->getMainRole()->name;
    }



    /**
     * Notifications
     */

    // Method to send email verification
    public function sendEmailVerificationNotification()
    {
        // We override the default notification and will use our own
        $this->notify(new EmailVerificationNotification());
    }


    // Method to send email welcome
    public function sendEmailWelCome()
    {
        $this->notify(new WelcomeUserNotification());
    }

    public function sendEmailPermisoSalidaSuccess(string $attachFileRoute)
    {
        $this->notify(new EmailPermisoSalidaSucessNotification($attachFileRoute));
    }

    public function sendEmailMinute(string $attachFileRoute)
    {
        $this->notify(new EmailMinuteNotification($attachFileRoute));
    }
}
