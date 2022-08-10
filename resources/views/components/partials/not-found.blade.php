<div class="card-body">
    <lottie-player class="mx-auto" src="https://assets7.lottiefiles.com/private_files/lf30_cgfdhxgx.json"  background="transparent"  speed="1"  style="width: 400px; height: 400px;"  loop  autoplay></lottie-player>

    <div class="text-center">
        <h4>Surat yang anda cari tidak ditemukan.</h4>
        <p class="lead">
            {{ $pesan }}
        </p>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endpush
