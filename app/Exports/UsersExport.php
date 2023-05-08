<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $users = User::all();

        return view('admin.users.export-excel', compact('users'));
    }
}
