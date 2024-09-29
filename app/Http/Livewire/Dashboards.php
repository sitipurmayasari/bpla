<?php

namespace App\Http\Livewire;

use App\Models\Bpla;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Guest\Visitor;
use App\Models\Inventaris;
use App\Models\Labory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Dashboards extends Component
{
    public $role,$user, $id_barang,$kode_barang, $nama_barang, $user_id,$bpla_id,
    $dates,$labory_id, $time_start, $time_end, 
    $activity, $description, $option_labory=[];
    public $can_submit = false;

    protected $listeners = ['scan'=>'handleScan'];
    public function mount()
    {
        $this->user = auth()->user();
        $this->user_id = $this->user->id;
        $this->dates = date('Y-m-d');
        $this->time_start = date('H:i');
        $this->option_labory = Labory::all();
        $this->role = auth()->user()->role;
    }

    public function render()
    {
        $nowthn = (Carbon::now()->year);
        return view('livewire.dashboard.dashboards',[
          
        ]);
           
    }
    public function handleScan($scan){
        $this->can_submit = false;
        $scan = explode('/qR/', $scan)[1];
        $scan = explode('/inventaris', $scan)[0];
        try {
            $id = Crypt::decryptString($scan);
            $inv = Inventaris::where('id',$id)->first();
            // dd($id);
            if ($inv) {
                $this->id_barang = $inv->id;
                $this->kode_barang = $inv->kode_barang;
                $this->nama_barang = $inv->nama_barang;
                $this->can_submit = true;
                // CEK BARANG SEKARANG
                $bpla = Bpla::where('inventaris_id',$this->id_barang)
                    ->where('dates',$this->dates)
                    ->where('user_id',$this->user_id)
                    ->whereNull('time_end')
                    ->first();
                if ($bpla) {
                    $this->bpla_id = $bpla->id;
                    $this->time_start = $bpla->time_start;
                    $this->time_end = date('H:i');
                    $this->activity = $bpla->activity;
                    $this->description = $bpla->description;
                    $this->labory_id = $bpla->labory_id;

                    $this->alertSuccess('Alat ditemukan dan sedang di gunakan, harap update jam selesai');

                }else{
                    $this->alertSuccess('Alat ditemukan');

                }
                return;
            }
         
        }catch (DecryptException $e) {
            $this->alertError('Errr Barang tidak ditemukan');
            return;
        }
     
        $this->alertError('Barang tidak ditemukan');
        return;

    }

    public function store(){
        // dd($this->all());
        $this->validate([
            'kode_barang' =>'required',
            'labory_id' =>'required',
            'time_start' =>'required',
            'activity' =>'required',
            'description'=>'required'
            
        ]);
        if ($this->bpla_id) {
            $this->validate(
                [
                    'time_end' => 'required'
                ]
                );
        }

        Bpla::updateOrCreate([
            'id' => $this->bpla_id
        ],[
            'inventaris_id'=> $this->id_barang ,
            'user_id' => $this->user_id,
            'labory_id' => $this->labory_id,
            'dates' => $this->dates,
            'activity' => $this->activity,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'description' => $this->description
        ]);

        $this->alertSuccess('Berhasil di Simpan');
        sleep(1);
        return redirect()->route('home');
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
