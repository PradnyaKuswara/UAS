@extends('layout.transportasi')

@section('container')   
<form action="/listPesawat" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container" >
        <div class="container" style="margin-left: 10%;width:75% ; background: gray">
            <label for="exampleInputEmail1" class="form-label">Keberangkatan</label>
                <div class="mb-3">
                    <select name="keberangkatan" id="keberangkatan">
                        <option value="option_select" disabled selected>Keberangkatan</option>
                        @foreach($kotas as $kota)
                            <option value="{{ $kota->id }}">{{ $kota->name}}</option>
                        @endforeach
                      </select>    
                </div>
                @error('keberangkatan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            <label for="exampleInputEmail1" class="form-label">Tujuan</label>
                <div class="mb-3">
                    <select name="tujuan" id="tujuan">
                        <option value="option_select" disabled selected>Tujuan</option>
                        @foreach($kotas as $kota)
                            <option value="{{ $kota->id }}">{{ $kota->name}}</option>
                        @endforeach
                      </select>    
                </div>
                @error('tujuan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

                <label for="exampleInputEmail1" class="form-label">Jumlah Penumpang</label>
                <div class="mb-3"> 
                    <input class="form-control @error('penumpang') is-invalid @enderror" id="penumpang" name="penumpang" aria-describedby="emailHelp" type="number" value="{{ old('penumpang') }}">
                    @error('penumpang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <label for="exampleInputEmail1" class="form-label">Tanggal</label>
                <div class="mb-3"> 
                    <input class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" type="date" aria-describedby="emailHelp" value="{{ old('tanggal') }}">
                    @error('tanggal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <label for="exampleInputEmail1" class="form-label">Kelas</label>
                <div class="mb-3"> 
                    <input class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas"  aria-describedby="emailHelp"  value="{{ old('kelas') }}">
                    @error('kelas')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" name="search"
                        style="background-color:#ff4e44;">Search</button>
                </div>
        </div>
    </div>
</form>
@endsection