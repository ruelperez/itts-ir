<?php

namespace App\Livewire;

use App\Models\AdminShow;
use App\Models\Dtr;
use App\Models\IsRegistration;
use App\Models\MyNote;
use App\Models\SuperadminShow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notes extends Component
{
    public $registrationSwitch, $search = "", $editInputTitle, $noteId, $editInputNotes, $myNotesData, $addInputNotes, $inputBase = 0, $baseId, $addInputTitle, $dtrData = [], $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo;

    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $this->position = auth()->user()->position;
        $this->photo = auth()->user()->photo;
        $this->dtrData = Dtr::all();
        if ($this->search != ""){
            $this->myNotesData = MyNote::where('user_id',$this->user_id)
            ->where('text','LIKE', '%'.$this->search.'%')
            ->orWhere('title', 'LIKE', '%'.$this->search.'%')->get();
//            ->orWhere('updated_at', 'LIKE', '%'.$this->search.'%')->get();

        }
        else{
            $this->myNotesData = MyNote::where('user_id', $this->user_id)->get();
        }

        return view('livewire.notes');
    }

    public function delete($id){
        MyNote::find($id)->delete();
    }

    public function closeBtn(){
        if ($this->inputBase == 1){
            if ($this->addInputTitle == "" and $this->addInputNotes == ""){
                MyNote::find($this->baseId)->delete();
            }
        }
        $this->inputBase = 0;
        $this->addInputNotes = "";
        $this->addInputTitle = "";
        $this->editInputTitle = "";
        $this->editInputNotes = "";
    }

    public function edit($id){
        $this->noteId = $id;
        $hj = MyNote::find($id);
        $this->editInputNotes = $hj->text;
        $this->editInputTitle = $hj->title;
    }

    public function mount($name){
        $this->webName = $name;
    }
    public function logout(){
        Auth::logout();
        return redirect()->to('/login');
    }

    public function clickSettings(){
        $data = IsRegistration::all();
        if (count($data) == 0){
            IsRegistration::create([
                'user_id' => auth()->user()->id,
                'on_off' => true,
            ]);
        }
        $an = IsRegistration::all();
        foreach ($an as $ans){
            $this->registrationSwitch = $ans->on_off;
        }
        if ($this->registrationSwitch == "0"){
            $this->registrationSwitch = false;
        }
        else{
            $this->registrationSwitch = true;
        }


        $data = AdminShow::all();
        if (count($data) == 0){
            AdminShow::create([
                'user_id' => auth()->user()->id,
                'on_off' => true,
            ]);
        }
        $an = AdminShow::all();
        foreach ($an as $ans){
            $this->adminSwitch = $ans->on_off;
        }
        if ($this->adminSwitch == "0"){
            $this->adminSwitch = false;
        }
        else{
            $this->adminSwitch = true;
        }

        $data = SuperadminShow::all();
        if (count($data) == 0){
            SuperadminShow::create([
                'user_id' => auth()->user()->id,
                'on_off' => true,
            ]);
        }
        $an = SuperadminShow::all();
        foreach ($an as $ans){
            $this->superAdminSwitch = $ans->on_off;
        }
        if ($this->superAdminSwitch == "0"){
            $this->superAdminSwitch = false;
        }
        else{
            $this->superAdminSwitch = true;
        }
    }

    public function regSwitch(){
        $data = IsRegistration::all();
        if (count($data) == 1){
            if ($this->registrationSwitch == false){
                foreach ($data as $datas){
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = false;
                    $datas->save();
                }
                $an = IsRegistration::all();
                foreach ($an as $ans){
                    $this->registrationSwitch = $ans->on_off;
                }
                \App\Models\Logs::create([
                    'action' => "disabled registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
            }
            else{
                foreach ($data as $datas){
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = true;
                    $datas->save();
                }
                $an = IsRegistration::all();
                foreach ($an as $ans){
                    $this->registrationSwitch = $ans->on_off;
                }
                \App\Models\Logs::create([
                    'action' => "enabled registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
            }
        }
        else{
            IsRegistration::create([
                'user_id' => auth()->user()->id,
                'on_off' => true,
            ]);
        }
    }

    public function admin_Switch(){
        $data = AdminShow::all();
        if (count($data) == 1){
            if ($this->adminSwitch == false){
                foreach ($data as $datas){
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = false;
                    $datas->save();
                }
                $an = AdminShow::all();
                foreach ($an as $ans){
                    $this->adminSwitch = $ans->on_off;
                }
                \App\Models\Logs::create([
                    'action' => "disabled admin registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
            }
            else{
                foreach ($data as $datas){
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = true;
                    $datas->save();
                }
                $an = AdminShow::all();
                foreach ($an as $ans){
                    $this->adminSwitch = $ans->on_off;
                }
                \App\Models\Logs::create([
                    'action' => "enabled admin registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
            }
        }
        else{
            AdminShow::create([
                'user_id' => auth()->user()->id,
                'on_off' => true,
            ]);
            $an = AdminShow::all();
            foreach ($an as $ans){
                $this->adminSwitch = $ans->on_off;
            }
        }
    }

    public function super_admin_Switch(){
        $data = SuperadminShow::all();
        if (count($data) == 1) {
            if ($this->superAdminSwitch == false) {
                foreach ($data as $datas) {
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = false;
                    $datas->save();
                }
                $an = SuperadminShow::all();
                foreach ($an as $ans) {
                    $this->superAdminSwitch = $ans->on_off;
                }
                \App\Models\Logs::create([
                    'action' => "disabled super admin registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
            } else {
                foreach ($data as $datas) {
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = true;
                    $datas->save();
                }
                $an = SuperadminShow::all();
                foreach ($an as $ans) {
                    $this->superAdminSwitch = $ans->on_off;
                }
                \App\Models\Logs::create([
                    'action' => "enabled super admin registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
            }
        }
    }

    public function updated($field){
        if ($field == "registrationSwitch"){
            $this->regSwitch();
        }
        if ($field == "adminSwitch"){
            $this->admin_Switch();
        }
        if ($field == "superAdminSwitch"){
            $this->super_admin_Switch();
        }
        if ($field == "photo"){
            $this->photo->store(path: 'public');
            $hashPhoto = $this->photo->hashName();
            $user = User::find($this->user_id);
            $user->photo = $hashPhoto;
            $user->save();
//            $com = Comment::find($this->user_id);
//            if (isset($com)){
//                $com->photo = $hashPhoto;
//                $com->save();
//            }
//            $comHeart = CommentHeart::find($this->user_id);
//            if (isset($comHeart)){
//                $comHeart->photo = $hashPhoto;
//                $comHeart->save();
//            }
//            $dtr = Dtr::find($this->user_id);
//            if (isset($comHeart)){
//                $comHeart->photo = $hashPhoto;
//                $comHeart->save();
//            }
            return redirect('/itts/5/dashboard');
        }
        if ($field == "addInputNotes"){
            if ($this->inputBase == 0){
                MyNote::create([
                    'text' => $this->addInputNotes,
                    'title' => $this->addInputTitle,
                    'fullname' => $this->fullname,
                    'user_id' => $this->user_id,
                ]);
                $this->inputBase = 1;
                $vs = MyNote::latest()->first();
                $this->baseId = $vs->id;
            }
            else{
                $moi = MyNote::find($this->baseId);
                $moi->text = $this->addInputNotes;
                $moi->title = $this->addInputTitle;
                $moi->save();

            }

        }
        if ($field == "addInputTitle"){
            if ($this->inputBase == 0){
                MyNote::create([
                    'text' => $this->addInputNotes,
                    'title' => $this->addInputTitle,
                    'fullname' => $this->fullname,
                    'user_id' => $this->user_id,
                ]);
                $this->inputBase = 1;
                $vs = MyNote::latest()->first();
                $this->baseId = $vs->id;
            }
            else{
                $moi = MyNote::find($this->baseId);
                $moi->text = $this->addInputNotes;
                $moi->title = $this->addInputTitle;
                $moi->save();
            }
        }
        if ($field == "editInputNotes"){
            $moi = MyNote::find($this->noteId);
            $moi->text = $this->editInputNotes;
            $moi->title = $this->editInputTitle;
            $moi->save();
        }
        if ($field == "editInputTitle"){
            $moi = MyNote::find($this->noteId);
            $moi->text = $this->editInputNotes;
            $moi->title = $this->editInputTitle;
            $moi->save();
        }
        if ($field == "search"){

        }

    }
}
