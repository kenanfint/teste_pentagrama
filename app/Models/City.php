<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class City extends Model
{
    protected $fillable = [
        'name',
        'state',
        'foundation_date',
    ];

    use HasFactory;

    /**
     * Relationship: city has one district.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function district(): HasOne
    {
        return $this->hasOne(District::class);
    }

    /**
     * Global pagination of cities 
     */
    private $pagination = 4;

    /**
     * Return the global pagination of cities,
     * 
     * @return int
     */
    public function getPagination(): Int
    {
        return $this->pagination;
    }
}
