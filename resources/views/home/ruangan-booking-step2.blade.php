<div class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7"></div>
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
                        <input type="hidden" name="step-1">
                        <button type="submit" class="btn btn-outline-light rounded-pill w-100">Konfirmasi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>