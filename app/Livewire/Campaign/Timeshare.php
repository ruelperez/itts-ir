<?php

namespace App\Livewire\Campaign;

use App\Models\Campaign;
use App\Models\Client;
use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Dtr;
use App\Models\DtrContent;
use App\Models\Heart;
use App\Models\Link;
use App\Models\Note;
use App\Models\TimeSetting;
use App\Models\User;
use App\Models\UserPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Timeshare extends Component
{
    use WithFileUploads;

    #[Validate('image|max:5120')] // 5MB Max
    public $registrationSwitch, $did, $link = [
        ['title' => '', 'textLink' => ''],
    ],  $schedule, $geo, $clientList = [], $iteration = 0, $authorizer, $cntName, $restriction, $campaign, $campList = [], $tcpa = false, $felony = false, $client_name, $client_list = [], $campaignList = [], $campName, $employeeData, $tf = false, $fj = 0, $email= false, $thatsthem= false, $dupe= false, $blacklist = false, $govt= false, $dtrData = [], $campaign_stat = "active", $edit_comment_id, $editTextComment, $linkData = [], $imagePath, $title, $images = [], $comment_reactors = [], $method, $comment_heart = [], $client, $lawfirm, $note_id, $all_comment = [], $text_comment, $comment = [], $selectedNotes = [], $reactors = [], $campaign_name = "all", $searchInput, $heart = [], $text, $photo, $ids, $tags, $fullname, $webName, $user_id, $is_admin, $user_fullname, $notes_all;

    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $fe = User::find($this->user_id)->user_access->first();
        $this->authorizer = $fe->campaign_settings;
        $jj = \App\Models\Employee::where('user_id',$this->user_id)->get();
        foreach ($jj as $yy){
            $emp = \App\Models\Employee::find($yy->id);
            $this->employeeData = $emp->designation;
        }
        $this->user_fullname = auth()->user()->fullname;
        $this->photo = auth()->user()->photo;
        $this->heart = Heart::all();
        $this->dtrData = Dtr::all();
        $this->comment_heart = CommentHeart::all();
        $this->all_comment = Comment::all();
        $this->linkData = Link::all();
        if ($this->searchInput == ""){
            if ($this->campaign_name == "all"){
                $this->notes_all = Note::where('client',$this->client_name)
                    ->orderBy('updated_at', 'desc')
                    ->get();
            }else{
                $this->notes_all = Note::where('campaign',$this->campaign_name)
                    ->where('client',$this->client_name)
                    ->orderBy('updated_at', 'desc')
                    ->get();
            }

        }else{
            $this->notes_all = Note::where('id','LIKE', '%'.$this->searchInput.'%')
                ->orWhere('tags', 'LIKE', '%'.$this->searchInput.'%')
                ->get();
        }
        $this->client_list = Note::select('client')
            ->distinct()
            ->orderBy('updated_at', 'desc')
            ->get();
        $this->campList = Campaign::all();
        $this->clientList = Client::all();
        $this->campaignList = Note::select('campaign')
            ->where('client', $this->client_name)
            ->distinct()->get();
        return view('livewire.campaign.timeshare');
    }

    public function updatedImages()
    {
        $this->validate([
            'images.*' => 'image|max:5120', // Ensure each image is under 5MB
        ]);
    }

    public function submit_campaign(){
        try {
            Campaign::create([
                'name' => $this->campName,
            ]);
            $this->campName = "";
            session()->flash('good', "Successfully saved");
        }catch (\Exception $e){
            session()->flash('bad', "Failed to save");
        }
    }

    public function submit_client(){
        try {
            Client::create([
                'name' => $this->cntName,
            ]);
            $this->cntName = "";
            session()->flash('goodClient', "Successfully saved");
        }catch (\Exception $e){
            session()->flash('badClient', "Failed to save");
        }
    }

    public function campRemove($id,$name){
        Campaign::find($id)->delete();
        $ha = Note::where('campaign',$name)->get();
        foreach ($ha as $has){
            Note::find($has->id)->delete();
        }
        \App\Models\Logs::create([
            'action' => "delete campaign named ".$name,
            'user_id' => $this->user_id,
            'photo' => $this->photo,
            'fullname' => $this->fullname,
        ]);
    }
    public function clientRemove($id,$name){
        Client::find($id)->delete();
        $ha = Note::where('client',$name)->get();
        foreach ($ha as $has){
            Note::find($has->id)->delete();
        }
        \App\Models\Logs::create([
            'action' => "delete client named ".$name,
            'user_id' => $this->user_id,
            'photo' => $this->photo,
            'fullname' => $this->fullname,
        ]);
    }
    public function addUser()
    {
        $this->link[] = ['title' => '', 'textLink' => ''];
    }

    public function removeUser($index)
    {
        unset($this->link[$index]);
        $this->link = array_values($this->link); // Re-index the array
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
        $rs = CommentHeart::where('comment_id', $id)->get();
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
        $this->client_list = Note::select('client')
            ->distinct()
            ->orderBy('updated_at', 'desc')
            ->get();
        foreach ($this->client_list as $df){
            $this->client_name = $df->client;
            break;
        }
        $this->campaignList = Note::select('campaign')
            ->where('client', $this->client_name)
            ->distinct()->get();
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

    public function storeImage()
    {
        if ($this->image) {
            $filename = Str::random(40) . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('photos/campaign', $filename, 'public'); // 🔁 Correct disk and path
            $this->imagePath = $filename;
        }
    }

    public function submit()
    {
        $uploadedImages = [];

        if (!empty($this->images)) {
            foreach ($this->images as $img) {
                $filename = Str::random(40) . '.' . $img->getClientOriginalExtension();
                $img->storeAs('photos/campaign', $filename, 'public'); // ✅ correct path
                $uploadedImages[] = $filename;
            }
        }

        try {
            $note = Note::create([
                'text' => $this->text,
                'user_id' => $this->user_id,
                'user_fullname' => $this->user_fullname,
                'tags' => $this->tags,
                'campaign' => $this->campaign,
                'photo' => $this->photo,
                'title' => $this->title,
                'client' => $this->client,
                'image' => json_encode($uploadedImages), // ✅ save image names only
                'campaign_stat' => $this->campaign_stat,
                'tcpa' => $this->tcpa,
                'blacklist' => $this->blacklist,
                'thatsthem' => $this->thatsthem,
                'dupe' => $this->dupe,
                'email' => $this->email,
            ]);

            foreach ($this->link as $links) {
                Link::create([
                    'title' => $links['title'],
                    'link' => $links['textLink'],
                    'note_id' => $note->id,
                ]);
            }

            \App\Models\Logs::create([
                'action' => "create post",
                'user_id' => $this->user_id,
                'note_id' => $note->id,
                'fullname' => $this->fullname,
                'photo' => $this->photo,
            ]);

            $this->clearInput();
            session()->flash('good', "Successfully added");
        } catch (\Exception $e) {
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

    public function edit($id)
    {
        $this->ids = $id;
        $rt = Note::find($id);

        $this->tags = $rt->tags;
        $this->text = $rt->text;
        $this->title = $rt->title;
        $this->campaign = $rt->campaign;
        $this->client = $rt->client;
        $this->campaign_stat = $rt->campaign_stat;
        $this->tcpa = $rt->tcpa;
        $this->tf = $rt->tf;
        $this->blacklist = $rt->blacklist;
        $this->dupe = $rt->dupe;
        $this->email = $rt->email;
        // 👇 Decode image string to array for editing
//        $this->images = json_decode($rt->image, true) ?? [];
        // Handle link data
        $lnk = Link::where('note_id', $id)->get();
        $this->link = [];
        foreach ($lnk as $ln) {
            $this->link[] = ['title' => $ln->title, 'textLink' => $ln->link];
        }
    }
    public function submit_edit()
    {
        $note = Note::find($this->ids);

        if (!$note) {
            session()->flash('badEdit', "Note not found");
            return;
        }

        try {
            // If there's a new image uploaded
            if ($this->fj === 1 && $this->image) {
                $this->storeImage(); // Store image and set $this->imagePath
                $note->image = $this->imagePath;
            }

            // Update the fields
            $note->tags = $this->tags;
            $note->text = $this->text;
            $note->title = $this->title;
            $note->campaign = $this->campaign;
            $note->client = $this->client;
            $note->campaign_stat = $this->campaign_stat;
            $note->tcpa = $this->tcpa;
            $note->blacklist = $this->blacklist;
            $note->thatsthem = $this->thatsthem;
            $note->dupe = $this->dupe;
            $note->email = $this->email;
            $note->save();

            // Delete old links and replace with updated
            Link::where('note_id', $this->ids)->delete();

            foreach ($this->link as $links) {
                if (!empty($links['title']) || !empty($links['textLink'])) {
                    Link::create([
                        'title' => $links['title'],
                        'link' => $links['textLink'],
                        'note_id' => $this->ids,
                    ]);
                }
            }

            // Log the edit
            \App\Models\Logs::create([
                'action' => "edit",
                'user_id' => $this->user_id,
                'note_id' => $this->ids,
                'photo' => $this->photo,
                'fullname' => $this->fullname,
            ]);

            $this->clearInput();
            session()->flash('goodEdit', "Successfully updated");

        } catch (\Exception $e) {
            session()->flash('badEdit', "Failed to update");
        }
    }


    public function clearInput(){
        $this->tags = "";
        $this->text = "";
        $this->title = "";
        $this->client = "";
        $this->campaign = "";
        $this->lawfirm = "";
        $this->method = "";
        $this->did = "";
        $this->schedule = "";
        $this->geo = "";
        $this->felony = false;
        $this->restriction = "";
        $this->campaign_stat = "active";
        $this->tcpa = false;
        $this->tf = false;
        $this->blacklist = false;
        $this->thatsthem = false;
        $this->dupe = false;
        $this->email = false;
        $this->govt = false;
        $this->link = [
            ['title' => '', 'textLink' => ''],
        ];
        $this->images = [];
        $this->iteration++;
    }

    public function logout(){
        Auth::logout();
        return redirect()->to('/login');
    }

    public function updated($field){
        if ($field == "client_name"){
            $this->notes_all = Note::where('campaign',$this->campaign_name)
                ->where('client',$this->client_name)
                ->orderBy('updated_at', 'desc')
                ->get();
            $this->campaignList = Note::select('campaign')->where('client',$this->client_name)
                ->distinct()
                ->orderBy('updated_at', 'desc')
                ->get();
            $this->campaign_name = "all";
        }
        if ($field == "campaign_name"){
            if ($this->campaign_name == "all"){
                $this->notes_all = Note::where('client',$this->client_name)
                    ->orderBy('updated_at', 'desc')
                    ->get();
            }else{
                $this->notes_all = Note::where('campaign',$this->campaign_name)
                    ->where('client',$this->client_name)
                    ->orderBy('updated_at', 'desc')
                    ->get();
            }
            $this->campaignList = Note::select('campaign')->where('client',$this->client_name)
                ->distinct()
                ->orderBy('updated_at', 'desc')
                ->get();
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
            $user = User::find($this->user_id)->comment;
            foreach ($user as $usr){
                $jn = Comment::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->comment_heart;
            foreach ($user as $usr){
                $jn = CommentHeart::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->dtr;
            foreach ($user as $usr){
                $jn =Dtr::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->dtr_content;
            foreach ($user as $usr){
                $jn =DtrContent::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->log;
            foreach ($user as $usr){
                $jn =\App\Models\Logs::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->note;
            foreach ($user as $usr){
                $jn = Note::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->time_setting;
            foreach ($user as $usr){
                $jn = TimeSetting::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = UserPassword::find($this->user_id);
            $user->photo = $filename;
            $user->save();
            return redirect('/itts/4/news-feed');
        }

    }
}
