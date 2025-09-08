<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public string $name = '';
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('اطلاعات شخصی شما')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <div>
                <flux:text size="sm">نام و نام خانوادگی</flux:text>
                <flux:heading size="lg">{{ $name }}</flux:heading>
            </div>
            <div>
                <flux:text size="sm">ایمیل</flux:text>
                <flux:heading size="lg">{{ $email }}</flux:heading>
            </div>
        </form>

    </x-settings.layout>
</section>
