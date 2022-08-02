<div class="card-body">
    <div class="empty-state" data-height="600" style="height: 600px;">
        <img class="img-fluid" src="{{ secure_asset(env('APP_URL') . 'icons/not-found.svg') }}" alt="image">
        <h2 class="mt-4">Surat yang anda cari tidak ditemukan.</h2>
        <p class="lead">
            {{ $pesan }}
        </p>
    </div>
</div>
