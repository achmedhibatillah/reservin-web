<div class="bg-clr3">
    <div class="container">
        <div class="row justify-content-center m-0" style="padding-top:160px;padding-bottom:110px">
            <div class="col-11 col-md-9 col-lg-6">
                <div class="row">
                    <div class="col-4 p-0 d-flex align-items-center">
                        <div class="square position-relative rounded-circle d-flex justify-content-center align-items-center he-40
                        @if($step[0] == true) bg-clr2 text-light
                        @else bg-light text-secondary
                        @endif
                        ">
                            <p class="m-0">1</p>
                            <p class="m-0 text-light position-absolute translate-center-top text-center lh-1" style="bottom:-20px;left:50%;">Pilih Jadwal</p>
                        </div>
                        <div class="flex-grow-1 @if($step[1] == true) bg-clr2 @else bg-light @endif" style="height:3px"></div>
                    </div>
                    <div class="col-4 p-0 d-flex align-items-center">
                        <div class="flex-grow-1 @if($step[1] == true) bg-clr2 @else bg-light @endif" style="height:3px"></div>
                        <div class="square position-relative rounded-circle d-flex justify-content-center align-items-center he-40
                        @if($step[1] == true) bg-clr2 text-light
                        @else bg-light text-secondary
                        @endif
                        ">
                            <p class="m-0">2</p>
                            <p class="m-0 text-light position-absolute translate-center-top text-center lh-1" style="bottom:-20px;left:50%;">Konfirmasi</p>
                        </div>
                        <div class="flex-grow-1 @if($step[2] == true) bg-clr2 @else bg-light @endif" style="height:3px"></div>
                    </div>
                    <div class="col-4 p-0 d-flex align-items-center">
                        <div class="flex-grow-1 @if($step[2] == true) bg-clr2 @else bg-light @endif" style="height:3px"></div>
                        <div class="square position-relative rounded-circle d-flex justify-content-center align-items-center he-40
                        @if($step[2] == true) bg-clr2 text-light
                        @else bg-light text-secondary
                        @endif
                        ">
                            <p class="m-0">3</p>
                            <p class="m-0 text-light position-absolute translate-center-top text-center lh-1" style="bottom:-20px;left:50%;">Pembayaran</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('home/ruangan-booking-' . $stepview)
    </div> 
</div>




