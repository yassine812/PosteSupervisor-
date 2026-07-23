@extends('layouts.app')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-0">
            <span class="text-muted fw-light">Administration /</span> Gestion des Machines Virtuelles
        </h4>
        <a href="javascript:history.back()" class="btn btn-label-secondary">
            <i class="ti ti-arrow-left me-1"></i> Retour
        </a>
    </div>

    @if (session()->has('delete1'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="d-flex align-items-center">
            <i class="ti ti-trash me-2"></i>
            {{ session('delete1') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- VM List Table -->
    <div class="card shadow-sm border-0">
        <div class="card-header border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h5 class="card-title mb-0">Liste des Machines Virtuelles</h5>
            <a class="btn btn-primary" href="{{ route('mvs.form') }}">
                <i class="ti ti-plus me-1"></i> Ajouter une Machine Virtuelle
            </a>
        </div>
        
        <div class="card-body mt-3">
            <div class="table-responsive">
                <table class="table table-hover border-top" id="vms-table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Adresse IP</th>
                            <th>Statut</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mvs as $mv)
                        <tr>
                            <td class="fw-semibold text-body">
                                <div class="d-flex align-items-center">
                                    <i class="ti ti-server me-2 text-primary"></i>
                                    {{ $mv->name }}
                                </div>
                            </td>
                            <td>
                                <code class="text-dark bg-light px-2 py-1 rounded">{{ $mv->ipadress }}</code>
                            </td>
                            <td>
                                @if (strtolower($mv->statut) == 'active')
                                <span class="badge bg-label-success d-inline-flex align-items-center">
                                    <span class="badge-status-dot bg-success me-1"></span> Active
                                </span>
                                @else
                                <span class="badge bg-label-danger d-inline-flex align-items-center">
                                    <span class="badge-status-dot bg-danger me-1"></span> Inactive
                                </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-sm btn-icon btn-label-primary edit-vm-btn" 
                                            data-id="{{ $mv->id }}" 
                                            data-name="{{ $mv->name }}" 
                                            data-ip="{{ $mv->ipadress }}" 
                                            data-statut="{{ $mv->statut }}" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editVmModal" 
                                            title="Modifier">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-icon btn-label-danger delete-vm-btn" 
                                            data-url="{{ route('mv.delete', ['id' => $mv->id]) }}" 
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

<style>
.badge-status-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    display: inline-block;
}
</style>

<!-- Edit VM Modal -->
<div class="modal fade" id="editVmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-bottom p-4">
                <h5 class="modal-title fw-bold" id="editVmModalLabel">
                    <i class="ti ti-server me-2 fs-3 text-primary"></i> Modifier la Machine Virtuelle
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editVmForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4 text-dark">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-dark fw-semibold" for="edit_vm_name">Nom de la machine virtuelle <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-dark bg-white" id="edit_vm_name" name="name" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-dark fw-semibold" for="edit_vm_ip">Adresse IP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-dark bg-white" id="edit_vm_ip" name="ipadress" required />
                        </div>
                        <div class="col-12">
                            <label class="form-label text-dark fw-semibold" for="edit_vm_statut">Statut <span class="text-danger">*</span></label>
                            <select class="form-select text-dark bg-white" id="edit_vm_statut" name="statut" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
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
    $('#vms-table').DataTable({
        order: [[0, 'asc']], // Order by VM Name
        dom: '<"row mx-0"<"col-md-6 d-flex align-items-center"l><"col-md-6 d-flex align-items-center justify-content-md-end"f>>t<"row mx-0"<"col-md-6"i><"col-md-6 d-flex align-items-center justify-content-md-end"p>>',
        language: {
            search: "",
            searchPlaceholder: "Rechercher...",
            lengthMenu: "Afficher _MENU_",
            paginate: {
                previous: "<i class='ti ti-chevron-left'></i>",
                next: "<i class='ti ti-chevron-right'></i>"
            },
            info: "Affichage de _START_ à _END_ sur _TOTAL_ machines",
            infoEmpty: "Aucune machine virtuelle trouvée",
            infoFiltered: "(filtré de _MAX_ au total)"
        },
        drawCallback: function() {
            $('.dataTables_paginate .paginate_button').addClass('page-item');
            $('.dataTables_paginate .paginate_button a').addClass('page-link');
        }
    });

    $('.dataTables_filter input').addClass('form-control form-control-sm ms-0').css('margin-bottom', '10px');
    $('.dataTables_length select').addClass('form-select form-select-sm').css('margin-bottom', '10px');
    
    // Enable Bootstrap Tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Edit VM Modal Binding
    $(document).on('click', '.edit-vm-btn', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var ip = $(this).data('ip');
        var statut = $(this).data('statut');
        
        $('#editVmForm').attr('action', '/mv/' + id + '/editvm');
        $('#edit_vm_name').val(name);
        $('#edit_vm_ip').val(ip);
        $('#edit_vm_statut').val(statut);
    });

    // Delete VM Modal Binding (SweetAlert2)
    $(document).on('click', '.delete-vm-btn', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        if (window.Swal) {
            Swal.fire({
                title: '<h4 class="fw-bold mb-2 text-danger">Supprimer la machine virtuelle ?</h4>',
                html: '<p class="text-muted mb-0">Êtes-vous sûr de vouloir supprimer cette machine virtuelle ?<br><span class="text-danger fw-semibold"><i class="ti ti-alert-triangle me-1"></i> Cette action est définitive et irréversible.</span></p>',
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
            if (confirm("Voulez-vous vraiment supprimer cette machine virtuelle ?")) {
                window.location.href = url;
            }
        }
    });
});
</script>
@endpush
