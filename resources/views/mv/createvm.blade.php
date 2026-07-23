@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <a href="javascript:history.back()" class="btn btn-primary mb-3 float-end">
        ←
    </a>
    <h4 class="fw-bold py-3 mb-4">Ajout d'une machine virtuelle </h4>
    <div class="card mb-4">
        @include('layouts.success-vmmessage')

        <div class="card-header d-flex align-items-center justify-content-between">
        </div>

        <div class="card-body">


            <form action="{{ route('mvs.store1') }}" method="post">
                @csrf

                <!-- Name Field -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Nom</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" placeholder="VM-" - name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- IP Address Field -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-ip">Adresse IP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-ip" placeholder="123.456.78.9" name="ipadress" value="{{ old('ipadress') }}">
                        @error('ipadress')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Statut Field -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-statut">État</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-statut" placeholder="Actif / Non actif" name="statut" value="{{ old('statut') }}">
                        @error('statut')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
