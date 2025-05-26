<form action="{{ url('booking') }}" method="post" class="pb-5">
    @csrf
    <div class="row">
        <div class="col-md-7">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card p-3 rounded @error('booking_date') bg-clrdang @else bg-light @enderror">
                        <div class="d-flex justify-content-center">
                            <div id="kalender"></div>
                        </div>
                        @error('booking_date')
                            <p class="m-0 mt-3 text-light fsz-10"><i class="fas fa-exclamation-circle me-2"></i>{{ $message }}</p>
                        @enderror
                        <div class="row justify-content-center mt-3">
                            <div class="col-6 p-0 ps-1">
                                <button type="button" id="booking_date_button" 
                                    onclick="
                                        document.getElementById('booking_date').value = document.getElementById('booking_date_que1').value
                                        updateBookingDateDisplay();
                                    " 
                                    class="btn btn-clrdang w-100">Pilih Tanggal</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="room_id" value="{{ $room['room_id'] }}">
                    <input type="hidden" name="booking_date_que1" id="booking_date_que1">
                    <input type="hidden" name="booking_date" id="booking_date" value="{{ old('booking_date') }}">
                    <input type="hidden" name="booking_duration" id="booking_duration" value="">
                    <input type="hidden" name="booking_price" id="booking_price" value="">
                    <input type="hidden" name="booking_price_formated" id="booking_price_formated" value="">
                    <script>
                        flatpickr("#kalender", {
                            inline: true,
                            monthSelectorType: "static",
                            minDate: new Date(Date.now() + 86400000),
                            maxDate: new Date(Date.now() + 86400000 * 31),
                            onChange: function(selectedDates, dateStr) {
                                const input = document.getElementById("booking_date_que1");
                                input.value = dateStr;
                                const event = new Event('change');
                                input.dispatchEvent(event);
                            }
                        });
                    </script>
                </div>
                <div class="col-xl-6 p-2 p-xl-0">
                    <div class="card mt-3 mt-xl-0">
                        <div class="m-2 fsz-11" id="booked"></div>
                    </div>
                    @php
                        $startHour = (int) \Carbon\Carbon::parse($room['room_start'])->format('H');
                        $endHour = (int) \Carbon\Carbon::parse($room['room_end'])->format('H');
                    @endphp
                    
                    <div class="card mt-3 @error('booking_start') bg-clrdang @enderror">
                        <p class="m-2 text-dark">Pilih waktu mulai</p>
                        @error('booking_start')
                            <p class="m-2 mt-0 text-light fsz-10"><i class="fas fa-exclamation-circle me-2"></i>{{ $message }}</p>
                        @enderror
                        <p class="m-2 mt-0 fsz-10 @error('booking_start') text-light @enderror text-secondary" id="booking_start_none">Pilih tanggal dulu</p>
                        <select name="booking_start" id="booking_start" class="form-control d-none">
                            <option value="">-- Pilih Waktu --</option>
                            @for ($hour = $startHour; $hour < $endHour; $hour++)
                                @php $formatted = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00'; @endphp
                                <option value="{{ $formatted }}" {{ old('booking_start') == $formatted ? 'selected' : '' }}>
                                    {{ $formatted }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    
                    <div class="card mt-3 @error('booking_end') bg-clrdang @enderror">
                        <p class="m-2 text-dark">Pilih waktu selesai</p>
                        @error('booking_end')
                            <p class="m-2 mt-0 text-light fsz-10"><i class="fas fa-exclamation-circle me-2"></i>{{ $message }}</p>
                        @enderror
                        <p class="m-2 mt-0 fsz-10 @error('booking_end') text-light @enderror  text-secondary" id="booking_end_none">Pilih waktu mulai dulu</p>
                        <select name="booking_end" id="booking_end" class="form-control d-none" disabled>
                            <option value="">-- Pilih Waktu Selesai --</option>
                        </select>
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
                                <p class="m-0" id="booking_date_display">{{ old('booking_date', '-') }}</p>
                            </div>
                            <div class="d-flex align-items-center gap-4 text-light mt-3">
                                <div class="d-flex justify-content-center" style="width:15px"><i class="fas fa-clock"></i></div>
                                <p class="m-0" id="booking_time_display">{{ old('booking_start', '') . old('booking_end', '') }}</p>
                            </div>
                            <div class="d-flex align-items-center gap-4 text-light mt-3">
                                <div class="d-flex justify-content-center" style="width:15px"><i class="fas fa-hourglass"></i></div>
                                <p class="m-0" id="booking_duration_display"></p>
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
                                <p class="m-0 fw-bold" id="booking_price_display">-</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <input type="hidden" name="step-1">
                        <button type="submit" class="btn btn-outline-light rounded-pill w-100">Cek ketersediaan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
.flatpickr-calendar {
/* width: 200px !important; */
/* max-width: 100% !important; */
}
</style>
    
<script>
    const booking_date = document.getElementById('booking_date');
    const booking_start = document.getElementById('booking_start');
    const booking_end = document.getElementById('booking_end');
    const booking_start_none = document.getElementById('booking_start_none');
    const booking_end_none = document.getElementById('booking_end_none');
    
    const handleBookingDateFilled = () => {

        if (booking_date.value !== "") {
            booking_start.classList.remove('d-none');
            booking_start.classList.add('d-block');
            booking_start_none.classList.add('d-none');
            booking_end.classList.remove('d-none');
            booking_end.classList.add('d-block');
            booking_end_none.classList.add('d-none');
        }
    };

    
    const observer = new MutationObserver(() => {
        handleBookingDateFilled();
    });
    
    observer.observe(booking_date, { attributes: true, attributeFilter: ['value'] });
    
    document.addEventListener('DOMContentLoaded', handleBookingDateFilled);

    function updateBookingDateDisplay() {
        const bookingDate = document.getElementById('booking_date').value;
        const display = document.getElementById('booking_date_display');
        
        display.textContent = bookingDate === '' ? '-' : bookingDate;
    }

    const bookingStart = document.getElementById('booking_start');
    const bookingEnd = document.getElementById('booking_end');
    const bookingTimeDisplay = document.getElementById('booking_time_display');
    const bookingDurationDisplay = document.getElementById('booking_duration_display');
    const bookingPriceDisplay = document.getElementById('booking_price_display');
    const bookingPriceFormated = document.getElementById('booking_price_formated');
    const bookingPrice = document.getElementById('booking_price');
    const bookingDuration = document.getElementById('booking_duration');

    const roomPrice = {{ $room['room_price'] ?? 0 }};

    const updateBookingTimeDisplay = () => {
        const start = bookingStart.value.trim();
        const end = bookingEnd.value.trim();

        if (start === '' && end === '') {
            bookingTimeDisplay.textContent = '-';
            bookingDurationDisplay.textContent = '-';
            bookingPriceDisplay.textContent = '-';
        } else {
            bookingTimeDisplay.textContent = `${start || '?'} - ${end || '?'}`;

            if (start && end) {
                const [startHour, startMinute] = start.split(':').map(Number);
                const [endHour, endMinute] = end.split(':').map(Number);

                const startTotalMinutes = startHour * 60 + startMinute;
                const endTotalMinutes = endHour * 60 + endMinute;

                const durationMinutes = endTotalMinutes - startTotalMinutes;
                const durationHours = durationMinutes / 60;

                if (durationHours > 0) {
                    const durationFormatted = durationHours.toFixed(2);
                    const totalPrice = (durationHours * roomPrice).toFixed(0); // pembulatan ke bilangan bulat

                    bookingDurationDisplay.textContent = `${durationFormatted} jam`;
                    bookingPriceDisplay.textContent = `Rp${Number(totalPrice).toLocaleString('id-ID')}`;
                    bookingPriceFormated.value = `Rp${Number(totalPrice).toLocaleString('id-ID')}`;
                    bookingPrice.value = totalPrice;
                    bookingDuration.value = `${durationFormatted} jam`;
                } else {
                    bookingDurationDisplay.textContent = '-';
                    bookingPriceDisplay.textContent = '-';
                }
            } else {
                bookingDurationDisplay.textContent = '-';
                bookingPriceDisplay.textContent = '-';
            }
        }
    };

    bookingStart.addEventListener('input', updateBookingTimeDisplay);
    bookingEnd.addEventListener('input', updateBookingTimeDisplay);

    document.addEventListener('DOMContentLoaded', updateBookingTimeDisplay);


    bookingStart.addEventListener('input', updateBookingTimeDisplay);
    bookingEnd.addEventListener('input', updateBookingTimeDisplay);

    let previousStart = bookingStart.value;
    let previousEnd = bookingEnd.value;
    setInterval(() => {
        if (bookingStart.value !== previousStart || bookingEnd.value !== previousEnd) {
        previousStart = bookingStart.value;
        previousEnd = bookingEnd.value;
        updateBookingTimeDisplay();
        }
    }, 200);

    document.addEventListener('DOMContentLoaded', updateBookingTimeDisplay);
</script>
      
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
<script>
    const schedule = @json($room['schedule'] ?? []);
        $(document).ready(function () {
        $('#booking_date_que1').on('change', function () {
            const selectedDate = $(this).val();
            console.log("Tanggal dipilih:", selectedDate);

            const filtered = schedule.filter(item => item.booking_date === selectedDate);
            console.log("Hasil filter:", filtered);

            let html = '';
            if (filtered.length > 0) {
                html = '<p>Terpakai pada:</p>';
                filtered.forEach(item => {
                    html += `<li>${item.booking_start} - ${item.booking_end}</li>`;
                });
            } else {
                html = 'Tidak terbooking pada tanggal ini.';
            }

            $('#booked').html(html);
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const bookingStart = document.getElementById('booking_start');
        const bookingEnd = document.getElementById('booking_end');
        const endNote = document.getElementById('booking_end_none');

        const roomEndHour = {{ $endHour }};

        bookingStart.addEventListener('change', function () {
            const selected = this.value;
            bookingEnd.innerHTML = '<option value="">-- Pilih Waktu Selesai --</option>';

            if (selected) {
                const startHour = parseInt(selected.split(':')[0]);
                const firstEndHour = startHour + 1;

                for (let h = firstEndHour; h <= roomEndHour; h++) {
                    const formatted = String(h).padStart(2, '0') + ':00';
                    const option = document.createElement('option');
                    option.value = formatted;
                    option.textContent = formatted;
                    bookingEnd.appendChild(option);
                }

                bookingEnd.disabled = false;
                endNote.textContent = '';
            } else {
                bookingEnd.disabled = true;
                endNote.textContent = 'Pilih waktu mulai dulu';
            }
        });

        const oldStart = '{{ old('booking_start') }}';
        const oldEnd = '{{ old('booking_end') }}';
        if (oldStart) {
            bookingStart.value = oldStart;
            bookingStart.dispatchEvent(new Event('change'));
            setTimeout(() => {
                if (oldEnd) bookingEnd.value = oldEnd;
            }, 100);
        }
    });
</script>