<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;

class AssignUserModel extends Model
{
    protected $table = 'assign_user';
    protected $fillable = [
        'type',
        'service_id',
        'user_id',
        'is_delete',
        'created_at',
        'updated_at',
    ];

    const TYPE = [
        'ZONE' => 'ZONE',
        'PUBLISHER' => 'PUBLISHER'
    ];

    public function getInfoAssign()
    {
        return $this->hasOne(User::class, 'id', 'user_id')
            ->first();
    }
}
