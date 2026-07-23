@extends('layouts.app')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-0">
            <span class="text-muted fw-light">Administration /</span> Gestion des Fonctionnaires
        </h4>
        <a href="javascript:history.back()" class="btn btn-label-secondary">
            <i class="ti ti-arrow-left me-1"></i> Retour
        </a>
    </div>

    @if (session()->has('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="d-flex align-items-center">
            <i class="ti ti-trash me-2"></i>
            {{ session('delete') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Users List Table -->
    <div class="card shadow-sm border-0">
        <div class="card-header border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h5 class="card-title mb-0">Liste des Fonctionnaires</h5>
            <a class="btn btn-primary" href="{{ route('users.create') }}">
                <i class="ti ti-plus me-1"></i> Ajouter un Fonctionnaire
            </a>
        </div>
        
        <div class="card-body mt-3">
            <div class="table-responsive">
                <table class="table table-hover border-top" id="users-table">
                    <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Nom de Famille</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="fw-semibold text-body">{{ $user->firstname }}</td>
                            <td class="fw-semibold text-body">{{ $user->lastname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="text-muted">{{ $user->phoneNumber }}</span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-sm btn-icon btn-label-primary edit-user-btn" 
                                            data-id="{{ $user->id }}" 
                                            data-firstname="{{ $user->firstname }}" 
                                            data-lastname="{{ $user->lastname }}" 
                                            data-email="{{ $user->email }}" 
                                            data-phone="{{ $user->phoneNumber }}" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editUserModal" 
                                            title="Modifier">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-icon btn-label-danger delete-user-btn" 
                                            data-url="{{ route('user.delete', $user->id) }}" 
                                            data-bs-toggle="tooltip" 
                                            title="Supprimer">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-bottom p-4">
                <h5 class="modal-title fw-bold" id="editUserModalLabel">
                    <i class="ti ti-user-edit me-2 fs-3 text-primary"></i> Modifier le Fonctionnaire
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4 text-dark">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-dark fw-semibold" for="edit_firstname">Prénom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-dark bg-white" id="edit_firstname" name="firstname" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-dark fw-semibold" for="edit_lastname">Nom de Famille <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-dark bg-white" id="edit_lastname" name="lastname" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-dark fw-semibold" for="edit_email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control text-dark bg-white" id="edit_email" name="email" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-dark fw-semibold" for="edit_phone">Numéro de téléphone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-dark bg-white" id="edit_phone" name="phoneNumber" required />
                        </div>
                        <div class="col-12">
                            <label class="form-label text-dark fw-semibold" for="edit_password">Nouveau mot de passe <small class="text-muted">(Laissez vide pour ne pas modifier)</small></label>
                            <input type="password" class="form-control text-dark bg-white" id="edit_password" name="password" placeholder="••••••••" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top p-3">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#users-table').DataTable({
        order: [[1, 'asc']], // Order by last name by default
        dom: '<"row mx-0"<"col-md-6 d-flex align-items-center"l><"col-md-6 d-flex align-items-center justify-content-md-end"f>>t<"row mx-0"<"col-md-6"i><"col-md-6 d-flex align-items-center justify-content-md-end"p>>',
        language: {
            search: "",
            searchPlaceholder: "Rechercher...",
            lengthMenu: "Afficher _MENU_",
            paginate: {
                previous: "<i class='ti ti-chevron-left'></i>",
                next: "<i class='ti ti-chevron-right'></i>"
            },
            info: "Affichage de _START_ à _END_ sur _TOTAL_ fonctionnaires",
            infoEmpty: "Aucun fonctionnaire trouvé",
            infoFiltered: "(filtré de _MAX_ au total)"
        },
        drawCallback: function() {
            // Apply bootstrap pagination classes to DataTables paginate elements
            $('.dataTables_paginate .paginate_button').addClass('page-item');
            $('.dataTables_paginate .paginate_button a').addClass('page-link');
        }
    });

    // Custom stylings for filters/search inside card header
    $('.dataTables_filter input').addClass('form-control form-control-sm ms-0').css('margin-bottom', '10px');
    $('.dataTables_length select').addClass('form-select form-select-sm').css('margin-bottom', '10px');
    
    // Enable Bootstrap Tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Edit User Modal Binding
    $(document).on('click', '.edit-user-btn', function() {
        var id = $(this).data('id');
        var firstname = $(this).data('firstname');
        var lastname = $(this).data('lastname');
        var email = $(this).data('email');
        var phone = $(this).data('phone');
        
        $('#editUserForm').attr('action', '/users/' + id + '/edit');
        $('#edit_firstname').val(firstname);
        $('#edit_lastname').val(lastname);
        $('#edit_email').val(email);
        $('#edit_phone').val(phone);
        $('#edit_password').val('');
    });

    // Delete User Modal Binding (SweetAlert2)
    $(document).on('click', '.delete-user-btn', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        if (window.Swal) {
            Swal.fire({
                title: '<h4 class="fw-bold mb-2 text-danger">Supprimer le fonctionnaire ?</h4>',
                html: '<p class="text-muted mb-0">Êtes-vous sûr de vouloir supprimer ce fonctionnaire ?<br><span class="text-danger fw-semibold"><i class="ti ti-alert-triangle me-1"></i> Cette action est définitive et irréversible.</span></p>',
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
                    window.location.href = url;
                }
            });
        } else {
            if (confirm("Voulez-vous vraiment supprimer ce fonctionnaire ?")) {
                window.location.href = url;
            }
        }
    });
});
</script>
@endpush
