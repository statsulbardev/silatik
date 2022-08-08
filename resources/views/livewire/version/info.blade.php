@section('title', 'Versi Aplikasi')

<div>
    <section class="section">
        @include('components.partials.header', ['judul' => 'Versi Aplikasi'])

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card card-primary">
                    <div class="card-header ui-sortable-handle d-flex justify-content-between">
                        <h4>Versi Aplikasi : <i class="fa-solid fa-tags"></i> {{ $tag }}</h4>
                        <span class="font-weight-bold">
                            Versi Commit : <i class="fa-solid fa-code-commit"></i> {{ $commit }}
                        </span>
                        <span class="font-weight-bold">
                            Versi Branch : <i class="fa-solid fa-code-branch"></i> {{ $branch }}
                        </span>
                    </div>
                    <div class="card-body">
                        <h4>Daftar Perbaikan dan Peningkatan :</h4>
                        <ol>
                            @foreach ($deskripsi as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
