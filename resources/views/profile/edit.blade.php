<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold text-dark">Mi Perfil</h2>
    </x-slot>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-dashboard mb-4">
                <div class="card-header bg-white">Informacion del Perfil</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo Electronico</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-dark">Guardar Cambios</button>
                    </form>
                </div>
            </div>

            <div class="card card-dashboard">
                <div class="card-header bg-white">Eliminar Cuenta</div>
                <div class="card-body">
                    <p class="text-muted">Una vez eliminada tu cuenta, todos los datos seran borrados permanentemente.</p>
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')
                        <div class="mb-3">
                            <label class="form-label">Contrasena</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Estas seguro de eliminar tu cuenta?')">
                            Eliminar Cuenta
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
