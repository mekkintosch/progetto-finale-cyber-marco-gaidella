<x-layout>
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Modifica Profilo</h4>
                </div>

                <div class="card-body">

                    @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf

                        <!-- NAME -->
                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" 
                                   name="name" 
                                   class="form-control" 
                                   value="{{ auth()->user()->name }}" 
                                   required>
                        </div>

                        <!-- EMAIL -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control" 
                                   value="{{ auth()->user()->email }}" 
                                   required>
                        </div>

                        <!-- PASSWORD -->
                        <div class="mb-3">
                            <label class="form-label">Nuova Password</label>
                            <input type="password" 
                                   name="password" 
                                   class="form-control" 
                                   placeholder="Lascia vuoto per non cambiare">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Salva Modifiche
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
</x-layout>