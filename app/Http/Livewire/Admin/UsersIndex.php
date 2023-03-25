<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;
    public $username;


    public function render()
    {

        DB::connection()->enableQueryLog();

        $users = User::where('name', 'LIKE', '%' . '' . '%')->paginate();
        // $users->items();
        return view('livewire.admin.users-index', compact('users'));
    }
}
