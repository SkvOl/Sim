<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contract;
use App\Models\Sim;

class GroupSim extends Model
{
    /** @use HasFactory<\Database\Factories\GroupSimFactory> */
    use HasFactory;

    protected $table = 'groups_sims';

    /**
     * Связь с таблицей контрактов
     */
    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }


    /**
     * Связь с таблицей сим-карт
     */
    public function sim(): BelongsToMany
    {
        return $this->belongsToMany(Sim::class, 'groups_to_sims', 'group_id', 'sim_id');
    }
}
