<x-layout>
    <x-form :model="$model">
        <x-card>
            <x-action form="form" />

                @bind($model)
                    <x-form-input col="6" name="name" />
                    <x-form-input col="3" name="username" />
                    <x-form-select col="3" class="search" name="role" :options="$roles" />
                    <x-form-input col="6" name="phone" />
                    <x-form-input col="6" name="email" />
                    <x-form-input col="6" name="password" type="password" />
                    <x-form-select col="6" class="search" label="Rumah Sakit" name="rs_id" :options="$rs" />
                @endbind

        </x-card>
    </x-form>
</x-layout>
