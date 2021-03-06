<?php

namespace App\Http\Livewire\Portal\Admin;

use App\Models\{
    Student,
    User
};
use App\Traits\{
    CreateUser,
    StudentTraits
};
use Illuminate\Validation\Rule;
use Livewire\{
    Component,
    WithPagination
};

class StudentLivewire extends Component
{
    use CreateUser,
    StudentTraits,
    WithPagination;


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
     * [Input] Name
     * @var mixed $name
    */
    $name,
    
    /**
     * [Input] Student ID (NIS / NIM)
     * @var mixed $studentID
    */
    $studentID,

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
     * Student
     * @var App\Models\Student
    */
    $student,

    /**
     * Protected User ID
     * @var int|null $userID
    */
    $userID,
    
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
        $u = new User();
        return view('livewire.portal.admin.student-livewire', [
            'siswa' => $this->finder($this->search)
            ->paginate($this->paginate),
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
            'email' => ['required','email', Rule::unique(User::class)->ignore($this->userID) ],
            'tempatLahir' => 'required|string',
            'tanggalLahir' => 'required|date',
            'phone_number' => 'required|regex:/(62)[0-9]{9,15}/',
            'address' => 'required',
            'studentID' => ['required', Rule::unique(Student::class, 'id')->ignore($this->userID, 'user_id') ],
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
            $this->student->user->password ?? null,
            $this->gender
        );

        // Update Student Side
        Student::updateOrCreate(
            ['user_id' => $this->userID],
            ['id' => $this->studentID, 'user_id' => $id
        ]);

        $this->studentID = $this->userID = null;

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
        $this->studentID = $id;
        
        // Set All Of These
        $this->student = Student::with('user')->find($id);
        
        $this->userID = $this->student->user_id ?? null;
        $this->name = $this->student->user->name ?? null;
        $this->studentID = $this->student->id ?? null;
        $this->email = $this->student->user->email ?? null;
        $this->tempatLahir = $this->student->user->tempatLahir ?? null;
        $this->tanggalLahir = $this->student && $this->student->user->tanggalLahir ? $this->student->user->tanggalLahir->toDateString() : null;
        $this->phone_number = $this->student->user->phone_number ?? null;
        $this->address = $this->student->user->address ?? null;

    }
}
