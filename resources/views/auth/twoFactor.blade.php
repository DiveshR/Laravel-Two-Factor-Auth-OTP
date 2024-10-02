<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="h-20 w-20 fill-current text-gray-500" />
            </a>
        </x-slot>
 
        <div class="mb-4 text-sm text-gray-600">
            {{ new Illuminate\Support\HtmlString(__("You have received an email which contains two factor login code. If you haven't received it, press <a class=\"hover:underline\" href=\":url\">here</a>.", ['url' => route('verify.resend')])) }}
        </div>
 
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
 
        <form method="POST" action="{{ route('verify.store') }}">
            @csrf
 
            <div>
                <x-input-label for="two_factor_code" :value="__('Two factor code')" />
 
                <x-text-input id="two_factor_code" class="mt-1 block w-full"
                              type="text"
                              name="two_factor_code"
                              required
                              autofocus />
 
                <x-input-error :messages="$errors->get('two_factor_code')" class="mt-2" />
            </div>
 
            <div class="mt-4 flex justify-end">
                <x-primary-button>
                    {{ __('Verify') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>