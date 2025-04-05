<?php

namespace App\Livewire;

use Livewire\Component;

class DarkModeToggle extends Component
{
    public $isDark = false;

    public function mount()
    {
        $this->isDark = session('darkMode', false);
    }

    public function toggle()
    {
        $this->isDark = !$this->isDark;
        session(['darkMode' => $this->isDark]);
        $this->dispatchBrowserEvent('theme-changed', ['dark' => $this->isDark]);
    }

    public function render()
    {
        return view('livewire.dark-mode-toggle');
    }
}
