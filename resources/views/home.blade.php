@extends('layouts.app')

@section('page-title', 'Fusionner PDF')

@section('content')


<div class="content app-content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
    
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success')}}
            </div>
        @endif
        <div class="content-body" >
            <section id="multiple-column-form" class="">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10"> <!-- Limite la largeur de la barre d'outils -->
                        <div class="card shadow-sm border-0">
                            <div class="card-body ">
                                <div class="toolbar d-flex flex-wrap align-items-center mb-4">
                                    <button class="btn btn-outline-secondary tool-button d-flex align-items-center me-2">
                                        <i class="bi bi-plus-lg me-1"></i> Ajouter
                                    </button>
                                    <button class="btn btn-outline-secondary tool-button d-flex align-items-center me-2">
                                        <i class="bi bi-arrow-left me-1"></i> Gauche
                                    </button>
                                    <button class="btn btn-outline-secondary tool-button d-flex align-items-center me-2">
                                        <i class="bi bi-arrow-right me-1"></i> Droite
                                    </button>
                                    <div class="pages-switch ms-2 d-flex align-items-center">
                                        <span>Afficher les pages</span>
                                        <div class="form-check form-switch ms-2 me-1">
                                            <input class="form-check-input" type="checkbox" role="switch">
                                        </div>
                                        <span class="pro-badge badge bg-warning text-dark ms-1">Pro</span>
                                    </div>
                                    <button class="btn btn-outline-secondary ms-auto">
                                        Terminer
                                    </button>
                                </div>
                                <div class="dropzone p-4 text-center border rounded bg-light">
                                    <i class="bi bi-cloud-upload text-primary mb-4" style="font-size: 3rem;"></i>
                                    <button class="btn btn-primary mb-4 d-flex align-items-center mx-auto">
                                        <i class="bi bi-plus-lg me-1"></i> Sélectionner des fichiers
                                    </button>
                                    <p class="text-muted mb-2">Ajouter des fichiers PDF, image, Word, Excel et PowerPoint</p>
                                    <div class="d-flex justify-content-center mt-2 flex-wrap">
                                        <span class="badge bg-danger format-badge me-1">PDF</span>
                                        <span class="badge bg-primary format-badge me-1">DOC</span>
                                        <span class="badge bg-success format-badge me-1">XLS</span>
                                        <span class="badge bg-warning format-badge me-1">PPT</span>
                                        <span class="badge bg-secondary format-badge me-1">PNG</span>
                                        <span class="badge bg-info format-badge">JPG</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
</div>

@endsection
