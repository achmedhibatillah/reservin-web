<div class="d-flex align-items-center justify-content-center bg-web bg-dark shadow-l" style="background-image:url('assets/images/static/bg-ruangan-top.svg');padding-top:160px;padding-bottom:110px">
    <div class="">
        <h1 class="text-clr2 fw-900 text-shadow">RUANGAN</h1>
    </div>
</div>
<div class="bg-clr3">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1">
                <div class="">
                    @foreach ($room as $x)
                        <div class="card border-none rounded-m bg-light overflow-hidden mb-4">
                            <div class="row" style="min-height:200px">
                                <div class="col-4 bg-web" style="background-image: url('{{ isset($x['images'][0]['ri_image']) ? $x['images'][0]['ri_image'] : asset('assets/images/static/blank-room.svg') }}');">
                                </div>                                
                                <div class="col-8 d-flex flex-column p-3 pe-4">
                                    <h5 class="text-dark fw-bold">{{ $x['room_name'] }}</h5>
                                    <div class="d-flex">
                                        <div class="fsz-10 bg-clrprim m-0 text-primary shadow-s px-2 rounded-pill">{{ $x['room_kategori'] }}</div>
                                    </div>
                                    <div class="d-flex gap-2 text-clrsuccess">
                                        @foreach ($x['facility'] as $f)
                                            <p class="fsz-8 m-0"><i class="fas fa-circle fsz-6 me-1"></i>{{ $f['facility_name'] }}</p>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="d-flex flex-column fsz-9 mb-3 text-clrsuc">
                                        <div class="d-flex align-items-center gap-1">
                                            <i class="fas fa-user m-0 we-15"></i>
                                            <p class="m-0">Kapasitas {{ $x['room_capacity'] }} orang</p>
                                        </div>
                                        <div class="d-flex align-items-center gap-1">
                                            <i class="fas fa-clock m-0 we-15"></i>
                                            <p class="m-0">{{ $x['room_start'] }} - {{ $x['room_end'] }}</p>
                                        </div>
                                    </div>
                                    <p class="text-secondary hide-text-2">{{ $x['room_desc'] }}</p>
                                    <div class="row mt-3">
                                        <div class="col-lg-6 pb-2 pb-lg-0">
                                            <p class="m-0 text-clr2 fw-bold">Rp. {{ $x['room_price'] }} / jam</p>
                                            <p class="m-0 text-secondary fsz-8 lh-1">Termasuk biaya operasional dan pajak.</p>
                                        </div>
                                        <div class="col-lg-6 d-flex justify-content-start justify-content-lg-end align-items-end pe-0 pe-lg-4">
                                            <div class="mt-2 mt-lg-0">
                                                <a href="{{ url('ruangan/' . $x['room_id']) }}" class="btn btn-clr2 rounded-pill lh-1 fsz-10 py-2 px-3">Selengkapnya</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 d-flex justify-content-end">
                    @include('templates/pagination', ['xxx' => $room])
                </div>
            </div>
            <div class="col-md-4 order-1 order-md-2">
                <div class="card p-4 mb-3">
                    <h5 class="fw-bold">Cari ruangan</h5>
                    <p class="m-0 fsz-10 text-secondary">Cari berdasarkan nama.</p>
                    <div class="mt-3">
                        <form action="{{ url('ruangan') }}" method="get">
                            @csrf 
                            <div class="d-flex gap-2">
                                <input type="text" placeholder="Cari nama ruangan..." name="k" value="{{ $k }}" class="form-control">
                                <button type="submit" class="btn btn-clr2"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card p-4 mb-3">
                    <h5 class="fw-bold">Tanggal</h5>
                    <p class="m-0 fsz-10 text-secondary">Cari berdasarkan ketersediaan berdasarkan rentang waktu tertentu.</p>
                    <div class="mt-3">
                        <form action="{{ url('ruangan') }}" method="get">
                            @csrf 
                            <div class="mb-3 p-0">
                                <input type="date" name="date" id="" value="{{ $schedule['date'] }}" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <select name="start" class="form-select" id="start-time">
                                        <option disabled {{ $schedule['start'] == '' ? 'selected' : '' }}>Pukul mulai</option>
                                        @for ($i = 0; $i < 24; $i++)
                                            @php $time = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00'; @endphp
                                            <option value="{{ $time }}" {{ $schedule['start'] == $time ? 'selected' : '' }}>{{ $time }} WIB</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select name="end" class="form-select" id="end-time">
                                        <option disabled {{ $schedule['end'] == '' ? 'selected' : '' }}>Pukul selesai</option>
                                        @for ($i = 0; $i < 24; $i++)
                                            @php $time = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00'; @endphp
                                            @if ($schedule['start'] && intval($time) > intval(substr($schedule['start'], 0, 2)))
                                                <option value="{{ $time }}" {{ $schedule['end'] == $time ? 'selected' : '' }}>{{ $time }} WIB</option>
                                            @elseif (!$schedule['start'])
                                                <option value="{{ $time }}" {{ $schedule['end'] == $time ? 'selected' : '' }}>{{ $time }} WIB</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-clr2 w-100 mt-3">Cek</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const startSelect = document.getElementById('start-time');
const endSelect = document.getElementById('end-time');

const allEndOptions = Array.from(endSelect.options).slice(1); 

startSelect.addEventListener('change', function () {
    const selectedStart = this.value;
    const selectedHour = parseInt(selectedStart.split(':')[0]);

    endSelect.options.length = 1;

    allEndOptions.forEach(option => {
        const optionHour = parseInt(option.value.split(':')[0]);
        if (optionHour > selectedHour) {
            endSelect.appendChild(option.cloneNode(true));
        }
    });

    endSelect.selectedIndex = 0;
});
</script>