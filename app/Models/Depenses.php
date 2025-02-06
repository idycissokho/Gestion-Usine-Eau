<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use Carbon\Carbon;

class Depenses extends Model
{
    use HasFactory;
    protected $table = 'depenses';
    public function Typedepense()
    {
        return $this->belongsTo(Type_Depense::class, 'typedepense_id');
    }
    public function getWeekPeriodAttribute()
    {
        $startDate = Carbon::parse($this->created_at);
        $endDate = (clone $startDate)->addDays(6); // Fin de la semaine (dimanche)

        return $startDate->format('d') . '-' . $endDate->format('d'); // Retourne "01-07" ou "08-13"
    }


}
