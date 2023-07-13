@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    
    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="p-4 bg-white rounded-lg lg:p-12 lg:col-span-1 ">
            
                <form wire:submit.prevent="{{ $submit }}">      
                                {{ $form }}

                        @if (isset($actions))
                            <div class="flex items-center bg-white justify-end px-4 py-2 pt-4 bg-gray-50 text-right sm:px-6">
                                {{ $actions }}
                            </div>
                        @endif
                   
                </form>
            
        </div>
    </div>
    <x-jet-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-jet-section-title>
</div>
