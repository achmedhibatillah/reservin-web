<div class="d-flex align-items-center justify-content-center bg-web bg-dark shadow-l" style="background-image:url('assets/images/static/bg-ruangan-top.svg');padding-top:160px;padding-bottom:110px">
    <div class="">
        <h1 class="text-clr2 fw-900 text-shadow">RUANGAN</h1>
    </div>
</div>
<div class="bg-clr3">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <div class="">
                    @foreach ($room as $x)
                        <div class="card border-none rounded-m bg-light overflow-hidden mb-4">
                            <div class="row" style="min-height:200px">
                                <div class="col-4 bg-web" style="background-image:url('{{ (isset($x['images'][0]['ri_image'])) ? $x['images'][0]['ri_image'] : url('assets/images/static/blank-room.svg') }}')">
                                    <img src="" class="w-100">
                                </div>
                                <div class="col-8 d-flex flex-column p-3">
                                    <h5 class="text-dark fw-bold">{{ $x['room_name'] }}</h5>
                                    <div class="d-flex gap-2 text-clrsuccess">
                                        @foreach ($x['facility'] as $f)
                                            <p class="fsz-8 m-0"><i class="fas fa-circle fsz-6 me-1"></i>{{ $f['facility_name'] }}</p>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="d-flex gap-2 fsz-9">
                                        <p class="m-0">{{ $x['room_capacity'] }} orang</p>
                                        <p>|</p>
                                        <p class="m-0">Rp. {{ $x['room_price'] }} / jam</p>
                                    </div>
                                    <p class="text-secondary">{{ $x['room_desc'] }}</p>
                                    <div class="">
                                        <a href="{{ url('ruangan/' . $x['room_id']) }}" class="btn btn-clr2 rounded-pill lh-1 fsz-10">Lihat selengkapnya</a>
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
            <div class="col-md-4">
                <div class="card p-4 mb-3">
                    <h5 class="fw-bold">Tanggal</h5>
                    <div class="mt-3">
                        <form action="{{ url('ruangan') }}" method="get">
                            @csrf 
                            <div class="mb-3 p-0">
                                <input type="date" name="tgl" id="" class="form-control">
                            </div>
                            <div class="row mb-3">
                                <div class="col-6 pe-1">
                                    <input type="time" name="tgl" id="" class="form-control">
                                </div>
                                <div class="col-6 ps-1">
                                    <input type="time" name="tgl" id="" class="form-control">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-clr2 w-100 mt-2">Cek</button>
                        </form>
                    </div>
                </div>
                <div class="card p-4 mb-3">
                    <h5 class="fw-bold">Cari ruangan</h5>
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
            </div>
        </div>
    </div>
</div>