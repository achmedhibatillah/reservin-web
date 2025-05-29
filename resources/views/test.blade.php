<button id="pay-button">Bayar dengan Midtrans</button>



<script>
        document.getElementById('pay-button').onclick = function() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                // Tangani jika pembayaran berhasil
            },
            onPending: function(result) {
                // Tangani jika pembayaran pending
            },
            onError: function(result) {
                // Tangani jika pembayaran gagal
            }
        });
    };
</script>