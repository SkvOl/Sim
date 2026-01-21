<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contract;
use App\Models\GroupSim;


class Sim extends Model
{
    /** @use HasFactory<\Database\Factories\SimFactory> */
    use HasFactory;

    protected $table = 'sims';

    /**
     * Связь с таблицей контрактов
     */
    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

    /**
     * Связь с таблицей групп сим-карт
     */
    public function groupSim(): BelongsToMany
    {
        return $this->belongsToMany(GroupSim::class, 'groups_to_sims', 'sim_id', 'group_id');
    }

    /**
     * Сим-карты текущего пользователя
     */
    public function scopeCurrent(Builder $query, int $user_id)
    {
        return $query->whereHas('contract.users', fn ($q) => $q->where('id', $user_id));
    }

    /**
     * Поиск по группе
     */
    public function scopeInGroups(Builder $query, array $groups_id)
    {
        return $query->whereHas('groupSim', fn ($q) => $q->whereIn('group_id', $groups_id));
    }
}
