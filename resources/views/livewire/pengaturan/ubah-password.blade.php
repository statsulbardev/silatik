@section('title', 'Ganti Password')

<div>
    <section class="section">
        @include('components.partials.header', ['judul' => 'Peningkatan Keamanan Akun'])

        <form wire:submit.prevent="changePassword">
            <div class="card card-primary">
                <div class="card-header">
                    <i class="fa-solid fa-circle-info fa-lg text-primary mr-2"></i>
                    <h4>Informasi kebijakan keamanan aplikasi</h4>
                </div>
                <div class="card-body row">
                    <div class="col-12 col-lg-4 col-md-4 pr-4">
                        <p class="h6 text-justify" style="line-height: 20pt">
                            Berdasarkan kebijakan keamanan data BPS Republik Indonesia,
                            Penggunaan layanan <b><em>Single Sign On</em> (SSO)</b> hanya diizinkan untuk
                            aplikasi yang di <i>hosting</i> pada Data Center BPS RI.
                        </p><br>
                        <p class="h6 text-justify" style="line-height: 20pt">
                            Aplikasi silatik yang dibangun tidak menggunakan layanan hosting yang disediakan BPS RI,
                            sehingga proses otentikasi tidak dapat menggunakan SSO BPS. Oleh karena itu,
                            tim pengembang membangun fitur otentikasi untuk keperluan aplikasi silatik.
                        </p><br>
                        <p class="h6 text-justify" style="line-height: 20pt">
                            Berkaitan dengan hal tersebut, diminta kepada pengguna aplikasi silatik untuk dapat
                            mengganti kata sandi demi meningkatkan keamanan aplikasi. Jika membutuhkan bantuan, pengguna
                            dapat menghubungi tim admin silatik pada fungsi IPDS.
                        </p>
                    </div>
                    <div class="col-12 col-lg-8 col-md-8 pl-4">
                        <div class="form-group">
                            <label for="password" class="font-weight-bold">
                                Kata Sandi Baru
                            </label>
                            <input wire:model.defer="password" class="form-control" type="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="font-weight-bold">
                                Konfirmasi Kata Sandi
                            </label>
                            <input wire:model.defer="password" class="form-control" type="password" name="password_confirmation" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-secondary text-right">
                    <button class="btn btn-primary" type="submit">
                        <i class="fa-solid fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </section>
</div>
