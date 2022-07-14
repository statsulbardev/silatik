@section('title', str_replace('-',' ',ucwords(Route::currentRouteName(), '-')))

<div>
    <section class="section">
        @include('components.partials.header', [ 'judul' =>  str_replace('-',' ',ucwords(Route::currentRouteName(), '-')) ])

        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Surat</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-md">
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Nomor Agenda</td>
                                        <td width="2%">:</td>
                                        <td>{{ $surat->no_agenda }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tanggal Terima Surat</td>
                                        <td width="2%">:</td>
                                        <td>{{ DateFormat::convertDateTime($surat->tanggal_buat) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Nomor Surat</td>
                                        <td width="2%">:</td>
                                        <td>{{ $surat->no_surat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tanggal Surat</td>
                                        <td width="2%">:</td>
                                        <td>{{ DateFormat::convertDateTime($surat->tanggal_surat) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Pengirim</td>
                                        <td width="2%">:</td>
                                        <td>{{ $surat->pengirim_surat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Perihal Surat</td>
                                        <td width="2%">:</td>
                                        <td>{{ $surat->perihal_surat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Ajukan ke Kepala BPS</td>
                                        <td width="2%">:</td>
                                        <td>{{ $surat->usul_disposisi ? 'Sudah Diajukan' : 'Belum Diajukan'}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Tindak Lanjut / Disposisi Surat</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                <label class="form-check-label" for="inlineCheckbox1">1</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                <label class="form-check-label" for="inlineCheckbox1">1</label>
                              </div>
                        </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1">1</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1">1</label>
                          </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-icon icon-left btn-primary">
                            <i class="fas fa-paper-plane"></i> Kirim
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Arsip Surat</h4>
                    </div>
                    <div class="card-body text-center">
                        <div style="width: 22%" class="mb-4 mx-auto">
                            @include('components.icons.pdf-file')
                        </div>
                        <a href="{{ google_view_file($surat->tautan_surat) }}" target="_blank" class="btn btn-icon icon-left btn-primary">
                            <i class="fas fa-eye"></i>
                            Lihat Berkas
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6"></div>
        </div>
    </section>
</div>
