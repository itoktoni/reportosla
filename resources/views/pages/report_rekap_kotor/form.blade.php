<x-layout>
    <x-form :model="$model" method="GET" action="{{ moduleRoute('getPrint') }}" :upload="true">
        <x-card>
            <x-action form="print" />

            @bind($model)
                <x-form-select col="6" class="search" name="rs_id" label="Rumah Sakit" :options="$rs" />

                <x-form-input col="3" type="date" label="Tanggal Mulai" name="start_date" />
                <x-form-input col="3" type="date" label="Tanggal Akhir" name="end_date" />
            @endbind

        </x-card>
    </x-form>
</x-layout>
