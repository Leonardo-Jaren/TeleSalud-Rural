@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mb-4">
                    <div class="card-body">
                        <h1 class="h4">Bienvenido a {{ config('app.name', 'Laravel') }}</h1>
                        <p class="mb-0">Esta es la página de bienvenida.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
