@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <a href="javascript:history.back()" class="btn btn-primary mb-3 float-end">
        ←
    </a>
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Ajout d'un Fonctionnaire</h4>

    <div class="card mb-4">
        @include('layouts.success-message')
        <div class="card-header d-flex align-items-center justify-content-between">
        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Prénom</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" placeholder="John" name="firstname" value="{{ old('firstname') }}">
                        @error('firstname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Nom de famille</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" placeholder="Doe" name="lastname" value="{{ old('lastname') }}">
                        @error('lastname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <input type="text" id="basic-default-email" class="form-control" placeholder="johndoe@gmail.com" aria-label="john.doe" name="email" value="{{ old('email') }}">
                            <span class="input-group-text" id="basic-default-email2">@example.com</span>
                        </div>
                        <div class="form-text">Vous pouvez utiliser des lettres, des chiffres et des points &amp;tirets</div>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Numéro de téléphone</label>
                    <div class="col-sm-10">
                        <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" name="phoneNumber" value="{{ old('phoneNumber') }}">
                        @error('phoneNumber')
                        <div class="text-danger">{{ $message }}</div>                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="basic-default-name" placeholder="Mot de passe" name="password" value="{{ old('password') }}">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Confirmer le mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="basic-default-name" placeholder="Confirmer le mot de passe" name="confirmerPassword" value="{{ old('confirmerPassword') }}">
                        @error('confirmerPassword')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

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
