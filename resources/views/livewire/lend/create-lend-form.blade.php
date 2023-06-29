<div class='py-10'>
    {{ $this->form }}
        <x-primary-button class='mb-6 mt-2 float-right' wire:click.prevent='save' wire:loading.class="bg-blue-200" wire:loading.attr="disabled">
            Enregistrer
        </x-primary-button>
        <div wire:loading wire:target="save">
          Traitement en cours...
        </div>
    </div>
