<?php

namespace App\Http\Livewire\Portal\Admin;

use App\Models\{Teacher, TeacherRole, User};
use App\Traits\CreateUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\{Component, WithPagination};

class TeacherLivewire extends Component
{

    use WithPagination, CreateUser;

    /**
     * Pagination
     * @var int $paginate
    */
    public $paginate = 5,

    /**
     * Search Query
     * @var mixed $search
    */
    $search = null,
    
    
    /**
     * Role
     * @var string[] $role
    */
    $role = [ 1 => 'Admin', 2 => 'Guru'],
    
    /**
     * [Input] Name
     * @var mixed $name
    */
    $name,
    
    /**
     * [Input] Nip
     * @var mixed $nip
    */
    $nip,

    /**
     * [Input] Email
     * @var mixed $email
    */
    $email,
    
    /**
     * [Input] Tempat Lahir
     * @var mixed $tempatLahir
    */
    $tempatLahir,
    
    /**
     * [Input] Tanggal Lahir
     * @var mixed $tanggalLahir
    */
    $tanggalLahir,
    
    /**
     * [Input] Phone number
     * @var mixed $phone_number
    */
    $phone_number,
    
    /**
     * [Input] Alamat
     * @var mixed $address
    */
    $address,
    
    /**
     * Teacher
     * @var App\Models\Teacher
    */
    $teacher,
    
    /**
     * ID
     * @var int|null $teachID
    */
    $teachID,

    /**
     * Protected User ID
     * @var int|null $userID
    */
    $userID,
    
    /**
     * Change Permission
     * @var bool $permission
    */
    $permission = false,
    
    /**
     * Permission Access
     * @var array $access
    */
    $access,
    
    /**
     * Gender
     * @var int $gender
    */
    $gender;


    /**
     * Render Component
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function render()
    {
        $search = $this->search;
        $u = new User();

        return view('livewire.portal.admin.teacher-livewire', [
            'teach' => Teacher::with('role')
            ->whereHas('user', function($q) use ($search) {
                if ($search) return $q->where('name', 'like', "%$search%'");
            })->paginate($this->paginate),
            'role' => $this->role,
            'genders' => $u->getGenders()
        ]);
    }

    /**
     * Dynamic Rules
     * @return (string|(string|\Illuminate\Validation\Rules\Unique)[])[]
    */
    protected function rules() {
        return [
            'name' => 'required|string',
            'nip' => 'integer',
            'email' => ['required','email', Rule::unique(User::class)->ignore($this->userID) ],
            'tempatLahir' => 'required|string',
            'tanggalLahir' => 'required|date',
            'phone_number' => 'required|regex:/(62)[0-9]{9,15}/',
            'address' => 'required',
            'gender' => ['required','integer', Rule::in([1,2])]
        ];

    }


    /**
     * Save
     * @return void
    */
    public function save()
    {
        $this->validate();

        // Insert / Update User
        $id = self::createNew(
            $this->userID,
            $this->name,
            $this->email,
            $this->tempatLahir,
            $this->tanggalLahir,
            $this->phone_number,
            $this->address,
            $this->teacher->user->password ?? null,
            $this->gender
        );

        // Update Teacher Side
        Teacher::updateOrCreate(['id' => $this->teachID], ['nip' => $this->nip, 'user_id' => $id]);
        $this->teachID = $this->userID = null;

        // Trigger Save
        $this->emit('saved');

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data telah tersimpan'
        ]);
    }

    /**
     * Set ID
     * @param int|null $id
     * @return void
    */
    public function setID(int $id = null)
    {
        $this->teachID = $id;
        
        // Set All Of These
        $this->teacher = Teacher::with('user')->find($id);
        
        $this->userID = $this->teacher->user_id ?? null;
        $this->name = $this->teacher->user->name ?? null;
        $this->nip = $this->teacher->nip ?? null;
        $this->email = $this->teacher->user->email ?? null;
        $this->tempatLahir = $this->teacher->user->tempatLahir ?? null;
        $this->tanggalLahir = $this->teacher && $this->teacher->user->tanggalLahir ? $this->teacher->user->tanggalLahir->toDateString() : null;
        $this->phone_number = $this->teacher->user->phone_number ?? null;
        $this->address = $this->teacher->user->address ?? null;

    }


    /**
     * Start Change Permission
     * @param int $id
     * @return void
    */
    public function changePermission(int $id)
    {
        $this->teachID = $id;
        // $this->access = TeacherRole::select('role')->where('teacher_id', $this->teachID)->get()->pluck('role');
        $this->dispatchBrowserEvent('change-permission');
        $this->permission = true;
    }


    /**
     * Update Permission
     * @return void
    */
    public function updatePermission()
    {

        TeacherRole::whereNotIn('role', $this->access)
        ->where('teacher_id', $this->teachID)
        ->delete();

        foreach ($this->access as $key) {
            TeacherRole::firstOrCreate([
                'teacher_id' => $this->teachID,
                'role' => $key
            ]);
        }

        $this->teachID = null;
        $this->permission = false;

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Kewenangan telah diperbarui'
        ]);
    }

    /**
     * Destroy
     * @param int $id
     * @return void
    */
    public function destroy(int $id)
    {
        if ($id === Auth::id()) abort(404);

        $teach = Teacher::find($id);

        User::find($teach->user_id)->delete();
        $teach->delete();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data telah terhapus'
        ]);
    }

}
