<x-layouts.app>
    <form wire:submit.prevent="register">
        
        <div>
            <label for="name">Name </label>
            <input wire:model="name" id="name" type="text" name="name" />
        </div>
    
        <div class="mt-4">
            <label for="email" value="{{ __('Email') }}">Email</label>
            <input wire:model="email" id="email" type="email" name="email" :value="old('email')"  />
        </div>
    
        <div class="mt-4">
            <label for="password" value="{{ __('Password') }}">Password</label>
            <input wire:model="password" id="password" type="password" name="password"  />
        </div>
    
        <div class="mt-4">
            <label for="password_confirmation" value="{{ __('Confirm Password') }}">Confirm Password</label>
            <input wire:model="password_confirmation" id="password_confirmation" type="password" name="password_confirmation"  />
        </div>
    
    
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="#">
                {{ __('Already registered?') }}
            </a>
    
            <input type="submit" value="Register" class="ml-4">
            
        </div>
    </form>
</x-layouts.app>

