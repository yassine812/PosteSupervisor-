@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <a href="javascript:history.back()" class="btn btn-primary mb-3 float-end">
        ←
    </a>

    <div class="card mb-4">
        @if (session()->has('modifier1'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('modifier1') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @include('layouts.error-message')

        <div class="card-header d-flex align-items-center justify-content-between">
        </div>

        <div class="card-body">
            @if ($errors->any())
            <div style="color:red">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ url('mv/'.$mv->id.'/editvm') }}" method="post">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Nom</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" placeholder="VM-" name="name" value="{{ old('name', $mv->name) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-ip">Adresse IP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-ip" placeholder="123.456.78.90" name="ipadress" value="{{ old('ipadress', $mv->ipadress) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-status">État</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-status" placeholder="Actif / Non actif" name="statut" value="{{ old('statut', $mv->statut) }}">
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success">Mettre à jour</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
