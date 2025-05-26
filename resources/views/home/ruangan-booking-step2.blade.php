<div class="pb-5">
    <div class="container">
        <form action="{{ url('ruangan/' . $room['room_id'] . '/booking') }}" method="post">
            @csrf 
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-clrsec p-3 mb-3 text-light">
                                <p class="fsz-10 m-0 mb-1">Nama Lengkap</p>
                                <p class="m-0 fw-bold">{{ $booking['customer_fullname'] }}</p>
                            </div>
                            <div class="card bg-clrsec p-3 mb-3 text-light">
                                <p class="fsz-10 m-0 mb-1">Email</p>
                                <p class="m-0 fw-bold">{{ $booking['customer_email'] }}</p>
                            </div>
                            <div class="card bg-clrsec p-3 mb-3 text-light">
                                <p class="fsz-10 m-0 mb-1">Tujuan Peminjaman</p>
                                <textarea name="booking_desc" id="booking_desc" cols="30" rows="6" class="form-control bg-transparent p-2 text-light" placeholder="Isi di sini..."></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 text-light fsz-11">
                                <h5>Perhatian!</h5>
                                <ol>
                                    <li>Dilarang merusak properti ruangan</li>
                                    <li>Selalu menjaga kebersihan</li>
                                    <li>Tidak melebihi kapasitas ruangan</li>
                                    <li>Dilarang membawa makanan dan minuman ke dalam ruangan</li>
                                    <li>Gunakan fasilitas dengan bijak dan sesuai peruntukannya</li>
                                    <li>Dilarang membuat kebisingan yang mengganggu</li>
                                    <li>Matikan lampu, AC, dan peralatan elektronik setelah digunakan</li>
                                    <li>Simpan kembali peralatan ke tempat semula setelah digunakan</li>
                                    <li>Dilarang merokok di dalam ruangan</li>
                                </ol>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-clr4 p-3 mt-3 mt-md-0">
                        <div class="">
                            <h5 class="text-clr2 fw-bold">Informasi Ruangan</h5>
                            <div class="mt-3 mx-3">
                                <div class="d-flex align-items-center gap-4 text-light">
                                    <div class="d-flex justify-content-center" style="width:15px"><i class="fas fa-location-dot"></i></div>
                                    <p class="m-0">{{ $room['room_name'] }}</p>
                                </div>
                                <div class="d-flex align-items-center gap-4 text-light mt-3">
                                    <div class="d-flex justify-content-center" style="width:15px"><i class="fas fa-calendar"></i></div>
                                    <p class="m-0" id="booking_date_display">{{ $booking['booking_date'] }}</p>
                                </div>
                                <div class="d-flex align-items-center gap-4 text-light mt-3">
                                    <div class="d-flex justify-content-center" style="width:15px"><i class="fas fa-clock"></i></div>
                                    <p class="m-0" id="booking_time_display">{{ $booking['booking_start'] . '-' . $booking['booking_end'] }}</p>
                                </div>
                                <div class="d-flex align-items-center gap-4 text-light mt-3">
                                    <div class="d-flex justify-content-center" style="width:15px"><i class="fas fa-hourglass"></i></div>
                                    <p class="m-0" id="booking_duration_display">{{ $booking['booking_duration'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h5 class="text-light fw-bold m-0">Total Harga</h5>
                            <div class="m-0 fsz-10 text-light">
                                <div class="d-flex align-items-center gap-1">
                                    <p class="m-0">Rp. {{ $room['room_price'] }}</p>
                                    <p class="m-0">/ jam</p>
                                </div>
                            </div>
                            <div class="mt-2 mx-3">
                                <div class="d-flex text-clr2 fsz-20 align-items-center justify-content-end gap-2">
                                    <p class="m-0 fw-bold" id="booking_price_display">{{ $booking['booking_price_formated'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <input type="hidden" name="step-2">
                            <button type="submit" class="btn btn-outline-light rounded-pill w-100">Konfirmasi</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>