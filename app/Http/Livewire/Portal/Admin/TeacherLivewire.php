<?php

namespace App\Http\Livewire\Portal\Admin;

use App\Models\Teacher;
use Livewire\{Component, WithPagination};

class TeacherLivewire extends Component
{

    use WithPagination;

    /**
     * Pagination
    */
    public $paginate = 5,

    /**
     * Search Query
    */
    $search = null,
    
    
    /**
     * Role
    */
    $role = [ 1 => 'Admin', 2 => 'Guru'],
    
    /**
     * [Input] Name
    */
    $name,
    
    /**
     * [Input] Nip
    */
    $nip,

    /**
     * [Input] Email
    */
    $email,
    
    /**
     * [Input] Tempat Lahir
    */
    $tempatLahir,
    
    /**
     * [Input] Tanggal Lahir
    */
    $tanggalLahir,
    
    /**
     * [Input] Phone number
    */
    $phone_number,
    
    /**
     * [Input] Alamat
    */
    $address;

    protected $rules = [
        'name' => 'required|string',
        'nip' => 'integer',
        'email' => 'required|email',
        'tempatLahir' => 'required|string',
        'tanggalLahir' => 'required|date',
        'phone_number' => 'required',
        'address' => 'required'
    ];


    public function render()
    {
        $search = $this->search;

        return view('livewire.portal.admin.teacher-livewire', [
            'teach' => Teacher::with('role')
            ->whereHas('user', function($q) use ($search) {
                if ($search) return $q->where('name', 'like', "%$search%'");
            })->paginate($this->paginate),
            'role' => $this->role,
        ]);
    }


    /**
     * Save
    */
    public function save()
    {
        $this->validate();
        $this->emit('saved');
    }
}
