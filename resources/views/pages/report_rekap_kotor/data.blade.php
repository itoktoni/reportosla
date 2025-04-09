<table border="0" class="header">
	<tr>
		<td></td>
		<td colspan="6">
			<h3>
				<b>REKAP KOTOR </b>
			</h3>
		</td>
		<td rowspan="3">
			<x-logo/>
		</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="10">
			<h3>
				RUMAH SAKIT : {{ $rs->field_name ?? 'Semua Rumah Sakit' }}
			</h3>
		</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="10">
            <h3>
                @php
                $start_tanggal_bersih = \Carbon\Carbon::parse(request()->get('start_date'))->addDay(+1);
                $end_tanggal_bersih = \Carbon\Carbon::parse(request()->get('end_date'))->addDay(+1);
                @endphp
				Tanggal Kotor : {{ formatDate(request()->get('start_date')) }} - {{ formatDate(request()->get('end_date')) }}
				<br>
                Tanggal Bersih : {{ formatDate($start_tanggal_bersih) }} - {{ formatDate($end_tanggal_bersih) }}
			</h3>
		</td>
	</tr>
</table>

<div class="table-responsive" id="table_data">
	<table id="export" border="1" style="border-collapse: collapse !important; border-spacing: 0 !important;"
		class="table table-bordered table-striped table-responsive-stack">
		<thead>
            <tr>
                <th style="width: 10px" width="1">No. </th>
                <th style="width: 200px" width="20">Nama Linen</th>
                @foreach($location->sortBy('ruangan_nama') as $loc)
                    <th>{{ $loc->field_name }}</th>
                @endforeach
                <th>Belum teregister</th>
                <th>Beda RS</th>
                <th>Total Kotor (Pcs)</th>
                <th>(Kg) Kotor</th>
                <th>Total Bersih (Pcs)</th>
                <th>-</th>
                <th>+</th>
            </tr>
        </thead>
		<tbody>
            @php
                $sum_kurang = $sum_lebih = $sum_per_linen = $sum_kotor = $sum_beda_rs = $sum_kg = $sum_lawan = 0;
                $total_number = $selisih = 0;
                $total_lawan = 0;
            @endphp
            @forelse($linen->sortBy('jenis_nama') as $jenis)
                @php
                $name = $jenis->jenis_nama;
                $total_number++;
                @endphp
                <tr>
                    <td>{{ $total_number }}</td>
                    <td>{{ $name }}</td>
                    @foreach($location->sortBy('ruangan_nama') as $loc)
                        <td>
							@php
                            $total_ruangan = $kotor
                            ->where('ruangan_id', $loc->ruangan_id)
                            ->where('jenis_id', $jenis->jenis_id)
                            ->where('beda_rs', 0)
                            ->sum('qty');
                            @endphp
                            {{ $total_ruangan > 0 ? $total_ruangan : '' }}
                        </td>
                    @endforeach
                    <td><!-- tempat belum register --></td>
                    <td><!-- tempat beda rs --></td>
                    <td>
                        @php
                        $total_kotor = $kotor
                            ->where('jenis_id', $jenis->jenis_id)
                            ->where('beda_rs', 0)
                            ->sum('qty');
                        @endphp
                        {{ $total_kotor > 0 ? $total_kotor : '' }}
                    </td>
                    <td>
                        @php
                        $total_kg = $total_kotor * $jenis->jenis_berat;
                        @endphp
                        {{ $total_kg > 0 ? $total_kg : '' }}
                    </td>
                    <td>
                        @php
                        $total_bersih = $bersih
                            ->where('jenis_id', $jenis->jenis_id)
                            ->sum('qty');
                        @endphp
                        {{ $total_bersih > 0 ? $total_bersih : '' }}
                    </td>
                    @php
                    $selisih = $total_bersih - $total_kotor;
                    @endphp
                     <td>{{ $selisih < 0 ? $selisih : '' }}</td>
                     <td>{{ $selisih > 0 ? $selisih : '' }}</td>
                </tr>
			@empty
			@endforelse
            <tr>
                <td>{{ $total_number + 1 }}</td>
                <td>Belum Register / Beda Rs</td>
                @foreach($location as $loc)
                <td></td>
                @endforeach
                <td>
                @php
                $total_belum_register = $kotor->where('beda_rs', 2)->sum('qty');
                $total_beda_rs = $kotor->where('beda_rs', 1)->sum('qty');
                @endphp
                {{ $total_belum_register > 0 ? $total_belum_register : '0' }}
                </td>
                <td>{{ $total_beda_rs }}</td>
                <td>{{ $total_belum_register }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
		</tbody>
	</table>
</div>