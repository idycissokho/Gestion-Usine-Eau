<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Produitfini extends Model
{
    use HasFactory;
    protected $table = 'produitfini';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $fillable = [
        'nombre',
        'prix',
    ];

    public function getWeekPeriodAttribute()
    {
        $startDate = Carbon::parse($this->created_at);
        $endDate = (clone $startDate)->addDays(6); // Fin de la semaine (dimanche)

        return $startDate->format('d') . '-' . $endDate->format('d'); // Retourne "01-07" ou "08-13"
    }
}
