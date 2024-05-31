<?php

namespace App\Livewire;

use App\Models\AdminShow;
use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Dtr;
use App\Models\Heart;
use App\Models\IsRegistration;
use App\Models\Link;
use App\Models\Note;
use App\Models\SuperadminShow;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewsUpdate extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')] // 1MB Max
    public $registrationSwitch, $did, $schedule, $geo, $restriction, $tcpa = false, $tf = false, $fj = 0, $email= false, $thatsthem= false, $dupe= false, $blacklist = false, $govt= false, $dtrData = [], $campaign_stat = "active", $superAdminSwitch, $position, $edit_comment_id, $editTextComment, $linkData = [], $imagePath, $link= [], $adminSwitch, $title, $image, $comment_reactors = [], $method, $comment_heart = [], $client, $lawfirm, $note_id, $all_comment = [], $text_comment, $comment = [], $selectedNotes = [], $reactors = [], $campaign_name = "Camp lejeune", $searchInput, $heart = [], $text, $photo, $ids, $tags, $fullname, $webName, $user_id, $is_admin, $user_fullname, $notes_all;

    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $this->position = auth()->user()->position;
        $this->user_fullname = auth()->user()->fullname;
        $this->photo = auth()->user()->photo;
        $this->heart = Heart::all();
        $this->dtrData = Dtr::all();
        $this->comment_heart = CommentHeart::all();
        $this->all_comment = Comment::all();
        $this->linkData = Link::all();
        if ($this->searchInput == ""){
            $this->notes_all = Note::where('campaign',$this->campaign_name)
                ->orderBy('updated_at', 'desc')
                ->get();
        }else{
            $this->notes_all = Note::where('id','LIKE', '%'.$this->searchInput.'%')
                ->orWhere('tags', 'LIKE', '%'.$this->searchInput.'%')
                ->where('campaign',$this->campaign_name)->get();
        }
        return view('livewire.news-update')->title('Campaign');
    }

    public function edit_comment($id){
        $this->edit_comment_id = $id;
        $gg = Comment::find($id);
        $this->editTextComment = $gg->text;
    }

    public function delete_comment($id){
        Comment::find($id)->delete();
        \App\Models\Logs::create([
            'action' => "delete comment",
            'user_id' => $this->user_id,
            'note_id' => $this->note_id,
            'photo' => $this->photo,
            'fullname' => $this->fullname,
        ]);
    }

    public function submitCommentEdit(){
        $hh = Comment::find($this->edit_comment_id);
        try {
            $hh->text = $this->editTextComment;
            $hh->save();
            \App\Models\Logs::create([
                'action' => "update comment",
                'user_id' => $this->user_id,
                'note_id' => $this->note_id,
                'photo' => $this->photo,
                'fullname' => $this->fullname,
            ]);
            session()->flash('good', "Updated successfully");
        }catch (\Exception $e){
            session()->flash('bad', "Failed to update");
        }
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

        \App\Models\Logs::create([
            'action' => "create comment",
            'user_id' => $this->user_id,
            'note_id' => $this->note_id,
            'photo' => $this->photo,
            'fullname' => $this->fullname,
        ]);
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

    public function storeImage(){
        $filename = Str::random(40) . '.' . $this->image->getClientOriginalExtension();
        $this->image->storeAs('photos', $filename, 'public_photos');
        $this->imagePath = $filename;
    }

    public function addInputField()
    {
        $this->link[] = '';
    }

    public function submit(){
        if ($this->image == null or $this->image == ""){
            $this->imagePath = "";
        }
        else{
            $this->storeImage();
//        $this->image->store(path: 'public');
//        $hashPhoto = $this->image->hashName();
        }

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
                'image' => $this->imagePath,
                'did' => $this->did,
                'schedule' => $this->schedule,
                'geo' => $this->geo,
                'restriction' => $this->restriction,
                'campaign_stat' => $this->campaign_stat,
                'tcpa' => $this->tcpa,
                'tf' => $this->tf,
                'blacklist' => $this->blacklist,
                'thatsthem' => $this->thatsthem,
                'dupe' => $this->dupe,
                'email' => $this->email,
                'govt' => $this->govt,
            ]);
            $this->text = "";
            $this->tags = "";
            $this->title = "";
            $this->client = "";
            $this->lawfirm = "";
            $this->method = "";
            $this->did = "";
            $this->schedule = "";
            $this->geo= "";
            $this->restriction= "";
            $this->campaign_stat= "";
            $this->tcpa= false;
            $this->tf= false;
            $this->blacklist= false;
            $this->thatsthem= false;
            $this->dupe= false;
            $this->email= false;
            $this->govt= false;
            $v = Note::latest()->first();

            foreach ($this->link as $links){
                Link::create([
                   'link' => $links,
                   'note_id' => $v->id,
                ]);
            }
            $this->link = [];
            \App\Models\Logs::create([
                'action' => "create post",
                'user_id' => $this->user_id,
                'note_id' => $v->id,
                'fullname' => $this->fullname,
                'photo' => $this->photo,
            ]);
            session()->flash('good', "Successfully added");
        }catch (\Exception $e){
            session()->flash('bad', "Failed to add");
        }
    }

    public function delete($id){
        Note::find($id)->delete();
        \App\Models\Logs::create([
            'action' => "delete",
            'user_id' => $this->user_id,
            'note_id' => $id,
            'photo' => $this->photo,
            'fullname' => $this->fullname,
        ]);
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
        $this->image = $rt->image;
        $this->method = $rt->method;
        $this->link = Link::where('note_id',$id)->get();
    }

    public function submit_edit(){
        if ($this->fj == 0){
            $rt = Note::find($this->ids);
            try {
                $rt->tags = $this->tags;
                $rt->text = $this->text;
                $rt->title = $this->title;
                $rt->campaign = $this->campaign_name;
                $rt->client = $this->client;
                $rt->lawfirm = $this->lawfirm;
                $rt->method = $this->method;
                $rt->image = $this->image;
//                $rt->link = $this->link;
                $rt->save();
                $this->tags = "";
                $this->text = "";
                $this->title = "";
                $this->client = "";
                $this->lawfirm = "";
                $this->method = "";
//                $this->link = "";
                \App\Models\Logs::create([
                    'action' => "edit",
                    'user_id' => $this->user_id,
                    'note_id' => $this->ids,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
                session()->flash('goodEdit', "Successfully updated");
            }catch (\Exception $e){
                session()->flash('badEdit', "Failed to update");
            }
        }
        else{
            $this->storeImage();
            $rt = Note::find($this->ids);
            try {
                $rt->tags = $this->tags;
                $rt->text = $this->text;
                $rt->title = $this->title;
                $rt->campaign = $this->campaign_name;
                $rt->client = $this->client;
                $rt->lawfirm = $this->lawfirm;
                $rt->method = $this->method;
                $rt->image = $this->imagePath;
//                $rt->link = $this->link;
                $rt->save();
                $this->tags = "";
                $this->text = "";
                $this->title = "";
                $this->client = "";
                $this->lawfirm = "";
                $this->method = "";
//                $this->link = "";
                session()->flash('good', "Successfully updated");
            }catch (\Exception $e){
                session()->flash('bad', "Failed to update");
            }
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
        if ($field == "image"){
            $this->fj = 1;
        }
        if ($field == "campaign_name"){

        }
        if ($field == "photo"){
            $filename = Str::random(40) . '.' . $this->photo->getClientOriginalExtension();
            $this->photo->storeAs('photos', $filename, 'public_photos');
            $user = User::find($this->user_id);
            $user->photo = $filename;
            $user->save();
            return redirect('/itts/4/news-feed');
        }

    }
}
