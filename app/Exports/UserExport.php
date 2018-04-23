<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\User;

class UserExport implements FromCollection
{
    public function collection()
    {
        return User::all();
    }
}
