<div class="min-h-screen flex items-center justify-center p-4">
    <!-- Initialize Alpine.js component with two properties: localStatus and sending. -->
    <div class="bg-slate-800 border border-slate-700 grid grid-cols-6 gap-3 rounded-xl p-4 text-sm max-w-3xl w-full"
        x-data="{ 
            localStatus: @entangle('status'),
            sending: false
         }" x-init="
             window.addEventListener('resetSendButton', () => { sending = false });
         ">
        <h1 class="text-center text-slate-300 text-2xl font-bold col-span-6">Send Feedback</h1>

        {{-- Name Field --}}
        <input type="text" wire:model.defer="name" placeholder="Your name"
            class="bg-slate-700 text-slate-300 placeholder:text-slate-400 placeholder:opacity-50 border border-slate-600 col-span-6 rounded-lg p-2 outline-none focus:border-slate-300 duration-300" />
        @error('name')
        <span class="text-red-400 col-span-6 text-xs">{{ $message }}</span>
        @enderror

        {{-- Email Field --}}
        <input type="email" wire:model.defer="email" placeholder="Your email"
            class="bg-slate-700 text-slate-300 placeholder:text-slate-400 placeholder:opacity-50 border border-slate-600 col-span-6 rounded-lg p-2 outline-none focus:border-slate-300 duration-300" />
        @error('email')
        <span class="text-red-400 col-span-6 text-xs">{{ $message }}</span>
        @enderror

        {{-- Phone Field --}}
        <input type="text" wire:model.defer="phone" placeholder="Phone number" maxlength="10" inputmode="numeric"
            pattern="\d*"
            class="bg-slate-700 text-slate-300 placeholder:text-slate-400 placeholder:opacity-50 border border-slate-600 col-span-6 rounded-lg p-2 outline-none focus:border-slate-300 duration-300" />
        @error('phone')
        <span class="text-red-400 col-span-6 text-xs">{{ $message }}</span>
        @enderror

        {{-- Message --}}
        <textarea wire:model.defer="message" rows="4"
            class="bg-slate-700 text-slate-300 placeholder:text-slate-400 placeholder:opacity-50 border border-slate-600 col-span-6 rounded-lg p-2 outline-none resize-none focus:border-slate-300 duration-300"
            placeholder="Your feedback..."></textarea>
        @error('message')
        <span class="text-red-400 col-span-6 text-xs">{{ $message }}</span>
        @enderror

        {{-- Submit Row with Status Buttons --}}
        <div class="col-span-6 flex justify-between items-center gap-4 mt-2">
            {{-- Status Buttons --}}
            <div class="flex gap-2">
                {{-- Happy Face --}}
                <button type="button" @click="localStatus = 1" wire:click="$set('status', 1)"
                    x-bind:class="localStatus === 1 ? 'bg-blue-600 fill-blue-200 border-blue-300' : 'bg-slate-700 fill-slate-300'"
                    class="flex justify-center items-center rounded-lg p-2 duration-150 border border-slate-600 hover:border-slate-300">
                    <svg viewBox="0 0 512 512" height="24px" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm177.6 62.1C192.8 334.5 218.8 352 256 352s63.2-17.5 78.4-33.9c9-9.7 24.2-10.4 33.9-1.4s10.4 24.2 1.4 33.9c-22 23.8-60 49.4-113.6 49.4s-91.7-25.5-113.6-49.4c-9-9.7-8.4-24.9 1.4-33.9s24.9-8.4 33.9 1.4zM144.4 208a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm192-32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                    </svg>
                </button>

                {{-- Sad Face --}}
                <button type="button" @click="localStatus = 0" wire:click="$set('status', 0)"
                    x-bind:class="localStatus === 0 ? 'bg-blue-600 fill-blue-200 border-blue-300' : 'bg-slate-700 fill-slate-300'"
                    class="flex justify-center items-center rounded-lg p-2 duration-150 border border-slate-600 hover:border-slate-300">
                    <svg viewBox="0 0 512 512" height="24px" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM174.6 384.1c-4.5 12.5-18.2 18.9-30.7 14.4s-18.9-18.2-14.4-30.7C146.9 319.4 198.9 288 256 288s109.1 31.4 126.6 79.9c4.5 12.5-2 26.2-14.4 30.7s-26.2-2-30.7-14.4C328.2 358.5 297.2 336 256 336s-72.2 22.5-81.4 48.1zM144.4 208a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm192-32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                    </svg>
                </button>
            </div>

            {{-- Send Button --}}
            <button type="button" @click="sending = true" wire:click="submit" :disabled="sending"
                x-bind:class="sending ? 'bg-blue-600 stroke-blue-200 hover:border-blue-300' : 'bg-slate-700 stroke-slate-300 hover:border-slate-300'"
                class="border border-slate-600 rounded-lg p-4 flex-grow duration-300 flex justify-center items-center gap-2 h-12">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="none" viewBox="0 0 24 24">
                    <path
                        d="M7.4 6.32 15.89 3.49C19.7 2.22 21.77 4.3 20.51 8.11L17.68 16.6C15.78 22.31 12.66 22.31 10.76 16.6L9.92 14.08 7.4 13.24C1.69 11.34 1.69 8.23 7.4 6.32Z"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M10.11 13.65 13.69 10.06" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <span x-text="sending ? 'Sending...' : 'Send'"></span>
            </button>
        </div>

        @error('status')
        <span class="text-red-400 col-span-6 text-xs">{{ $message }}</span>
        @enderror

        {{-- Success Message --}}
        @if ($success)
        <span class="text-green-400 col-span-6 text-center text-sm">{{ $success }}</span>
        @endif
    </div>
</div>