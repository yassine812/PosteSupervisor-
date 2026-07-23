@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <a href="javascript:history.back()" class="btn btn-primary mb-3 float-end">
        ←
    </a>
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span></h4>

    <div class="card mb-4">
        @if (session()->has('update'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('update')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

        @include('layouts.error-message')
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">modifier un Fonctionnaire</h5>
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
            <form action="{{ url('users/' . $user->id . '/edit') }}" method="post">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Prénom</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" placeholder="John" name="firstname" value="{{ old('firstname', $user->firstname) }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Nom de famille</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" placeholder="Doe" name="lastname" value="{{ old('lastname', $user->lastname) }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <input type="email" id="basic-default-email" class="form-control" placeholder="john.doe@example.com" name="email" value="{{ old('email', $user->email) }}">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Numéro de téléphone</label>
                    <div class="col-sm-10">
                        <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" name="phoneNumber" value="{{ old('phoneNumber', $user->phoneNumber) }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="basic-default-name" placeholder="Votre mot de passe" name="password" value="{{ old('password', $user->password) }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Confirmer le mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="basic-default-name" placeholder="Confirmer le mot de passe" name="confirmerPassword">
                        @error('confirmerPassword')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
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
