<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Heart;
use App\Models\IsRegistration;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewsUpdate extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')] // 1MB Max
    public $registrationSwitch, $title, $image, $comment_reactors = [], $method, $comment_heart = [], $client, $lawfirm, $note_id, $all_comment = [], $text_comment, $comment = [], $selectedNotes = [], $reactors = [], $campaign_name = "cl", $searchInput, $heart = [], $text, $photo, $ids, $tags, $fullname, $webName, $user_id, $is_admin, $user_fullname, $notes_all;

    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $this->is_admin = auth()->user()->is_admin;
        $this->user_fullname = auth()->user()->fullname;
        $this->photo = auth()->user()->photo;
        $this->heart = Heart::all();
        $this->comment_heart = CommentHeart::all();
        $this->all_comment = Comment::all();
        if ($this->searchInput == ""){
            $this->notes_all = Note::where('campaign',$this->campaign_name)->get();
        }else{
            $this->notes_all = Note::where('id','LIKE', '%'.$this->searchInput.'%')
                ->orWhere('tags', 'LIKE', '%'.$this->searchInput.'%')
                ->where('campaign',$this->campaign_name)->get();
        }
        return view('livewire.news-update');
    }

    public function send(){
        Comment::create([
            'text' => $this->text_comment,
            'photo' => $this->photo,
            'fullname' => $this->fullname,
            'user_id' => $this->user_id,
            'note_id' => $this->note_id,
        ]);
        $this->text_comment = "";
        $this->comment = Comment::where('note_id', $this->note_id)->get();
    }

    public function reactor($id){
        $dat = [];
        $rs = Heart::where('note_id', $id)->get();
        foreach ($rs as $rss){
            $dat[]= User::find($rss->user_id);
        }
        $this->reactors = $dat;
    }

    public function comment_reactor($id){
        $dat = [];
        $rs = CommentHeart::where('comment_id', $id)
            ->where('user_id',$this->user_id)->get();
        foreach ($rs as $rss){
            $dat[]= User::find($rss->user_id);
        }
        $this->comment_reactors = $dat;
    }

    public function commented($id){
        $this->selectedNotes = Note::where('id',$id)->get();
        $dat = [];
        $this->comment = Comment::where('note_id', $id)->get();
        $this->note_id = $id;
    }

    public function mount($name){
        $this->webName = $name;
    }

    public function clickHeart($id){
        $he = Heart::where('note_id',$id)
            ->where('user_id',$this->user_id)->get();
        if (count($he) < 1){
            Heart::create([
                'note_id' => $id,
                'user_id' => $this->user_id,
            ]);
        }
        else{
            foreach ($he as $hes){
                Heart::find($hes->id)->delete();
            }
        }

    }

    public function clickCommentHeart($id){
        $he = CommentHeart::where('comment_id',$id)
            ->where('user_id',$this->user_id)->get();
        if (count($he) < 1){
            CommentHeart::create([
                'note_id' => $this->note_id,
                'user_id' => $this->user_id,
                'comment_id' => $id,
                'photo' => $this->photo,
                'fullname' => $this->fullname,
            ]);
        }
        else{
            foreach ($he as $hes){
                CommentHeart::find($hes->id)->delete();
            }
        }

    }

    public function submit(){
        $this->image->store(path: 'public');
        $hashPhoto = $this->image->hashName();
        try {
            Note::create([
                'text' => $this->text,
                'user_id' => $this->user_id,
                'user_fullname' => $this->user_fullname,
                'tags' => $this->tags,
                'campaign' => $this->campaign_name,
                'photo' => $this->photo,
                'title' => $this->title,
                'client' => $this->client,
                'lawfirm' => $this->lawfirm,
                'method' => $this->method,
                'image' => $hashPhoto,
            ]);
            $this->text = "";
            $this->tags = "";
            $this->title = "";
            $this->client = "";
            $this->lawfirm = "";
            $this->method = "";
            $this->image = "";
            session()->flash('good', "Successfully added");
        }catch (\Exception $e){
            session()->flash('bad', "Failed to add");
        }
    }

    public function delete($id){
        Note::find($id)->delete();
    }
    public function edit_tags($id){
        $this->ids = $id;
        $rt = Note::find($id);
        $this->tags = $rt->tags;
    }

    public function submit_edit_tags(){
        $rt = Note::find($this->ids);
        try {
            $rt->tags = $this->tags;
            $rt->save();
            $this->tags = "";
            session()->flash('good', "Successfully updated");
        }catch (\Exception $e){
            session()->flash('bad', "Failed to update");
        }
    }

    public function edit($id){
        $this->ids = $id;
        $rt = Note::find($id);
        $this->tags = $rt->tags;
        $this->text = $rt->text;
        $this->title = $rt->title;
        $this->campaign_name = $rt->campaign;
        $this->client = $rt->client;
        $this->lawfirm = $rt->lawfirm;
    }

    public function submit_edit(){
        $rt = Note::find($this->ids);
        try {
            $rt->tags = $this->tags;
            $rt->text = $this->text;
            $rt->title = $this->title;
            $rt->campaign = $this->campaign_name;
            $rt->client = $this->client;
            $rt->lawfirm = $this->lawfirm;
            $rt->method = $this->method;
            $rt->save();
            $this->tags = "";
            $this->text = "";
            $this->title = "";
            $this->client = "";
            $this->lawfirm = "";
            $this->method = "";
            session()->flash('good', "Successfully updated");
        }catch (\Exception $e){
            session()->flash('bad', "Failed to update");
        }
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
            }
        }
    }

    public function updated($field){
        if ($field == "registrationSwitch"){
            $this->regSwitch();
        }
        if ($field == "campaign_name"){

        }
        if ($field == "photo"){
            $this->photo->store(path: 'public');
            $hashPhoto = $this->photo->hashName();
            $user = User::find($this->user_id);
            $user->photo = $hashPhoto;
            $user->save();
            return redirect('/itts/4/news-feed');
        }

    }
}
