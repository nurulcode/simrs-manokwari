<div class="card">
    <div class="card-header">
        Data Pasien
        <div class="card-header-actions">
            <b-link class="card-header-action btn-minimize" v-b-toggle.pasien>
              <i class="icon-arrow-up"></i>
            </b-link>
        </div>
    </div>
    <b-collapse id="pasien" visible>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <b-form-group label="Pasien:">
                        <input
                            class="form-control text-right"
                            disabled
                            placeholder="Pasien"
                            readonly
                            type="text"
                            value="{{ $pasien->nama }}"
                            >
                        </input>
                    </b-form-group>
                </div>
                <div class="col">
                    <b-form-group label="Nomor Rekam Medis:">
                        <input
                            class="form-control text-right"
                            disabled
                            placeholder="Nomor Rekam Medis"
                            readonly
                            type="text"
                            value="{{ $pasien->no_rekam_medis }}"
                            >
                        </input>
                    </b-form-group>
                </div>
                <div class="col">
                    <b-form-group label="Tempat, Tanggal Lahir:">
                        <input
                            class="text-right form-control"
                            disabled
                            placeholder="Tanggal Lahir"
                            readonly
                            @if(!empty($pasien->tanggal_lahir))
                                value="{{ $pasien->tanggal_lahir->format('d M Y') }}"
                            @endif
                            >
                        </input>
                    </b-form-group>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <b-form-group label="Umur:">
                        <input
                            class="text-right form-control"
                            disabled
                            placeholder="Umur"
                            readonly
                            @if(!empty($pasien->tanggal_lahir))
                                value="{{ $pasien->tanggal_lahir->diff(now())->format('%y Tahun %m Bulan') }}"
                            @endif
                            >
                        </input>
                    </b-form-group>
                </div>
                <div class="col">
                    <b-form-group label="Alamat:">
                        <input
                            class="text-right form-control"
                            disabled
                            placeholder="Alamat"
                            readonly
                            value="{{ $pasien->alamat }}"
                            >
                        </input>
                    </b-form-group>
                </div>
                <div class="col">
                    <b-form-group label="Telepon/HP:">
                        <input
                            class="text-right form-control"
                            disabled
                            placeholder="Telepon/HP"
                            readonly
                            value="{{ $pasien->telepon }}"
                            >
                        </input>
                    </b-form-group>
                </div>
            </div>
        </div>
    </b-collapse>
</div>