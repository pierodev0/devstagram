<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likes;

    public function mount()
    {
        $this->isLiked = $this->post->checkLike(auth()->user());
        $this->likes = $this->post->likes->count();
    }
    public function click()
    {
        if ($this->post->checkLike(auth()->user())){
            auth()->user()->likes()->where('post_id',$this->post->id)->delete();
            $this->isLiked = false;
            $this->likes--;

        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }
    public function render()
    {
        return view('livewire.like-post');
    }
}
