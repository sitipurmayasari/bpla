<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class ManageUser extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public $name, $email, $password, $role, $user_id, $search = "", $paginate = 10, $filterrole = "";
    public $isOpen = 0,$nik;

    public function render()
    {
        $users = User::latest()
            ->when($this->filterrole, function ($query) {
                $query->where('role', $this->filterrole);
            })
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->paginate);

        return view('livewire.user.manage-user', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = "";
        $this->search = "";
        $this->user_id = '';
        $this->filterrole = "";
       
        $this->role = "";
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        if ($this->user_id) { //Update
            $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'role' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);
            if ($this->password != "") {
                $this->validate([
                    'password' => ['required', 'min:8'],
                ]);
            }
        } else {
            $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'role' => ['required'],
                'password' => ['required', 'min:8'],
            ]);
        }
      


        if ($this->user_id) {
            User::updateOrCreate(['id' => $this->user_id], [
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
            ]);
            if ($this->password != "") {
                $user = User::find($this->user_id);
                $user->password = bcrypt($this->password);
                $user->save();
            }
            
        } else {  
            $save = User::updateOrCreate(['id' => $this->user_id], [
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role' => $this->role,
            ]);

          
        }

        $this->user_id ? $this->alertSuccess('User berhasil diupdate') : $this->alertSuccess('User berhasil ditambahkan');

        $this->closeModal();
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        $n = User::find($id);
        $n->delete();
        session()->flash('success', $n->name . ' Deleted Successfully.');
    }

    public function alertSuccess($message)
    {
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => $message]
        );
    }

    // alert error
    public function alertError($message)
    {
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'error',  'message' => $message]
        );
    }
}
