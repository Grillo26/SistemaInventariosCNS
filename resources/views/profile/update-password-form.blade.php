<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Actualizar Contraseña') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Asegúrese de que su cuenta esté usando una contraseña larga y aleatoria para mantenerse seguro.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="form-group col-md-12 col-12">
                    <label>Contraseña Actual</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                            <input id="current_password" type="password" class="form-control phone-number" wire:model.defer="state.current_password" autocomplete="current-password">
                    </div>
                    <x-jet-input-error for="current_password" class="mt-2" />
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12 col-12">
                    <label>Nueva Contraseña</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                            <input id="password" type="password" class="form-control" wire:model.defer="state.password" autocomplete="current-password">
                    </div>
                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12 col-12">
                    <label>Confirmar Contraseña</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                            <input id="password_confirmation" type="password" class="form-control" wire:model.defer="state.password_confirmation" autocomplete="new-password">
                    </div>
                    <x-jet-input-error for="password_confirmation" class="mt-2" />
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Guardado.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Guardar') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
