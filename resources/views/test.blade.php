

    @extends('layouts.app')

    @section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm mb-4 border-0 rounded-3">
                    <div class="card-header bg-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-file-pdf me-2"></i>{{ __('Fusionner des PDF') }}</h5>
                            <form action="{{route('logout')}}" method="post" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-light">
                                    <i class="fas fa-sign-out-alt me-1"></i>Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
    
                    <div class="card-body p-4">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
    
                        <div class="text-center mb-4">
                            <img src="{{ asset('images/pdf-merge.svg') }}" alt="PDF Merge" class="img-fluid" style="max-height: 120px;">
                            <p class="text-muted mt-3">Sélectionnez plusieurs fichiers PDF pour les fusionner en un seul document</p>
                        </div>
    
                        <form action="{{ route('merge.pdf') }}" method="POST" enctype="multipart/form-data" class="dropzone-form">
                            @csrf
                            <div class="mb-4 pdf-upload-zone p-4 text-center border rounded-3 bg-light">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                <h5>Déposez vos fichiers PDF ici</h5>
                                <p class="text-muted small">ou</p>
                                <label for="pdfFiles" class="btn btn-outline-primary">
                                    <i class="fas fa-folder-open me-2"></i>Parcourir les fichiers
                                </label>
                                <input class="d-none" type="file" id="pdfFiles" name="pdfFiles[]" accept=".pdf" multiple required>
                                <p class="text-muted small mt-2">Formats acceptés: PDF uniquement</p>
                            </div>
                            
                            <div id="selectedFiles" class="mb-4">
                                <p class="text-muted text-center">Aucun fichier sélectionné</p>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary py-2" id="mergeButton" disabled>
                                    <i class="fas fa-object-group me-2"></i>Fusionner les PDF
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
    
                @if(session('mergedPdf'))
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-success text-white py-3">
                        <h5 class="mb-0"><i class="fas fa-check-circle me-2"></i>{{ __('Résultat') }}</h5>
                    </div>
                    <div class="card-body p-4 text-center">
                        <div class="mb-4">
                            <i class="fas fa-file-pdf fa-4x text-success mb-3"></i>
                            <h5>Votre fichier PDF a été créé avec succès!</h5>
                        </div>
                        <div class="d-grid gap-2">
                            <a href="{{ session('mergedPdf') }}" class="btn btn-success py-2" download>
                                <i class="fas fa-download me-2"></i>Télécharger le PDF fusionné
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        document.getElementById('pdfFiles').addEventListener('change', function(e) {
            const fileList = document.getElementById('selectedFiles');
            const mergeButton = document.getElementById('mergeButton');
            
            if (this.files.length > 0) {
                let html = '<div class="card border-0 shadow-sm"><div class="card-header bg-light"><h6 class="mb-0">Fichiers sélectionnés</h6></div><ul class="list-group list-group-flush">';
                let totalSize = 0;
                
                for (let i = 0; i < this.files.length; i++) {
                    const file = this.files[i];
                    const fileSize = Math.round(file.size / 1024);
                    totalSize += fileSize;
                    
                    html += `<li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-file-pdf text-danger me-2"></i>${file.name}
                                </div>
                                <span class="badge bg-primary rounded-pill">${fileSize} KB</span>
                            </li>`;
                }
                
                html += '</ul>';
                html += `<div class="card-footer bg-light">
                            <div class="d-flex justify-content-between">
                                <span><strong>${this.files.length}</strong> fichier(s)</span>
                                <span>Taille totale: <strong>${totalSize} KB</strong></span>
                            </div>
                        </div></div>`;
                
                fileList.innerHTML = html;
                mergeButton.disabled = false;
            } else {
                fileList.innerHTML = '<p class="text-muted text-center">Aucun fichier sélectionné</p>';
                mergeButton.disabled = true;
            }
        });
        
        // Drag and drop functionality
        const dropZone = document.querySelector('.pdf-upload-zone');
        const fileInput = document.getElementById('pdfFiles');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            dropZone.classList.add('border-primary', 'bg-light');
        }
        
        function unhighlight() {
            dropZone.classList.remove('border-primary', 'bg-light');
        }
        
        dropZone.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            
            // Trigger change event
            const event = new Event('change');
            fileInput.dispatchEvent(event);
        }
    </script>
    @endpush
    
    @push('styles')
    <style>
        .pdf-upload-zone {
            border: 2px dashed #dee2e6;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .pdf-upload-zone:hover {
            border-color: #0d6efd;
            background-color: rgba(13, 110, 253, 0.05) !important;
        }
        
        .pdf-upload-zone.border-primary {
            border-color: #0d6efd !important;
            background-color: rgba(13, 110, 253, 0.1) !important;
        }
    </style>
    @endpush
    @endsection