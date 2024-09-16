<?php

namespace App\Http\Controllers;

use App\Models\Master\Unit;
use App\Models\Meeting\Participant;
use App\Models\Meeting\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PartisipanController extends Controller
{
    public function index($slug) {
        $data = Program::where('slug',$slug)->first();
        if (!$data) {
            return view('livewire.meeting.nonpart');
            // return false;
        }
        $option_unit = Unit::all();
        return view('livewire.meeting.participants',compact('data','option_unit'));
    }

    public function upload(Request $request,$slug) {
        $validator = Validator::make($request->all(), [
            'origin' => 'required',
            'nama_lengkap' => 'required',
            'jabatan' => 'required',
            'signed' => 'required'
        ]);
        $date = date('Y-m-d');
        $data = Program::where('slug',$slug)->first();

        if (!$date) {
            $validator->errors()->add('program_id', 'Tidak ada program');
        }

        $cekAbsen = Participant::where('dates',$date)
                                ->where('program_id',$data->id)
                                ->where('participant_name',$request->nama_lengkap)
                                ->where('instansi',$request->name_instansi)
                                ->first();

        if ($cekAbsen) {
            $validator->errors()->add('nama_lengkap', 'Anda Sudah Absen');
        }

        $validator->validate();

        Participant::create([
            'program_id' => $data->id,
            'dates' => $date,
            'origin' => $request->origin,
            'participant_name' => $request->nama_lengkap,
            'unit' => $request->unit_kerja,
            'instansi' => $request->name_instansi,
            'position' => $request->jabatan,
            'gender' => 'P',
            'type' => $request->tipe,
            'sign' => $request->signed
        ]);
      
        return back()->with('success', 'Anda Berhasil Absen');
    }
}
