@extends('layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <a href="javascript:history.back()" class="btn btn-primary mb-3 float-end">
        ←
    </a>
    <h4 class="fw-bold py-3 mb-4">Profil de l'utilisateur</h4>

    <div class="card mb-4">
        @if (session()->has('update'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Profil mis à jour avec succès !
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @include('layouts.error-message')
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Modifier le Profil</h5>
        </div>
        <div class="card-body">
            <!-- Profile Photo Section -->
            <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4 pb-3 border-bottom">
                @if ($user->profile_photo_path)
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" style="object-fit: cover;" />
                @else
                    <div class="d-flex align-items-center justify-content-center bg-label-primary rounded fw-bold text-uppercase" style="width: 100px; height: 100px; font-size: 2.2rem; min-width: 100px;" id="uploadedAvatar">
                        {{ substr($user->firstname, 0, 1) }}{{ substr($user->lastname, 0, 1) }}
                    </div>
                @endif
                <div class="button-wrapper">
                    <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                        <form action="{{ route('profile.avatar.upload', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data" id="avatarUploadForm">
                            @csrf
                            <label for="upload" class="btn btn-primary me-2" tabindex="0">
                                <span class="d-none d-sm-block">Téléverser une photo</span>
                                <i class="ti ti-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" name="avatar" class="account-file-input" hidden accept="image/png, image/jpeg" onchange="document.getElementById('avatarUploadForm').submit();" />
                            </label>
                        </form>
                        
                        @if ($user->profile_photo_path)
                            <form action="{{ route('profile.avatar.delete', ['id' => $user->id]) }}" method="POST" class="d-inline" id="avatarDeleteForm">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-label-danger btn-avatar-delete" id="deleteAvatarButton">
                                    <i class="ti ti-trash d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block font-semibold">Supprimer la photo</span>
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="text-muted small">Autorisé : JPG ou PNG. Taille max : 800Ko.</div>
                </div>
            </div>
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
                    <label class="col-sm-2 col-form-label" for="firstname">Prénom</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname', $user->firstname) }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="lastname">Nom de famille</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="phoneNumber">Numéro de téléphone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber', $user->phoneNumber) }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="password">Nouveau mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="confirmerPassword">Confirmer le mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="confirmerPassword" name="confirmerPassword">
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

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    let deleteBtn = document.getElementById('deleteAvatarButton');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (window.Swal) {
                Swal.fire({
                    title: '<h4 class="fw-bold mb-2 text-danger">Supprimer la photo de profil ?</h4>',
                    html: '<p class="text-muted mb-0">Êtes-vous sûr de vouloir supprimer votre photo ?<br><span class="text-danger fw-semibold"><i class="ti ti-alert-triangle me-1"></i> Cette action est définitive et irréversible.</span></p>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '<i class="ti ti-trash me-1"></i> Oui, supprimer',
                    cancelButtonText: 'Annuler',
                    customClass: {
                        confirmButton: 'btn btn-danger me-3 waves-effect waves-light',
                        cancelButton: 'btn btn-label-secondary waves-effect'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('avatarDeleteForm').submit();
                    }
                });
            } else {
                if (confirm("Voulez-vous vraiment supprimer votre photo de profil ?")) {
                    document.getElementById('avatarDeleteForm').submit();
                }
            }
        });
    }
});
</script>
@endpush
@endsection
