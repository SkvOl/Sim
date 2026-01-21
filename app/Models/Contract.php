<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\GroupSim;
use App\Models\User;

class Contract extends Model
{
    /** @use HasFactory<\Database\Factories\ContractFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'description'];

    /**
     * Связь с сим-картами
     */
    public function sim(): HasMany
    {
        return $this->hasMany(Sim::class);
    }

    /**
     * Связь с таблицей пользователей
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Связь с группами сим-карт
     */
    public function groupsim(): HasMany
    {
        return $this->hasMany(GroupSim::class);
    }

}
