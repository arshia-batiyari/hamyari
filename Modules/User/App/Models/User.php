<?php

namespace Modules\User\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Area\App\Models\City;
use Modules\Area\App\Models\Province;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Partner\App\Models\Note;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name','mobile','lottery_code'];
    
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    // public function scopeFilters($query)
    // {
    //     return $query
    //     ->when(request('mobile'), fn($q) => $q->where('mobile', request('mobile')))
    //     ->when(request('national_code'), fn($q) => $q->where('national_code', request('national_code')))
    //     ->when(request('name'), fn($q) => $q->where('name', 'LIKE', '%' . request('name') . '%'));
    // }
}
