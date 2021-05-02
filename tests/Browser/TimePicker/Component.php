<?php

namespace Tests\Browser\TimePicker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public User $user;

    public ?string $timeAmPm = null;

    public ?string $time24H = null;

    protected array $rules = ['user.birthday' => 'required|datetime'];

    public function mount()
    {
        $this->user = new User(['birthday' => '2021-05-01T23:05:51']);
    }

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }
}

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthday',
    ];

    protected $hidden = ['password'];

    protected $dates = ['birthday'];
}
