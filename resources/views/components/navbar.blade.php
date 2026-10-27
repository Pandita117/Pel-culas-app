<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Películas App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('generos.index') }}">Géneros</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('clasificaciones.index') }}">Clasificaciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('plataformas.index') }}">Plataformas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('nacionalidades.index') }}">Nacionalidades</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('productoras.index') }}">Productoras</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('reviews.index') }}">Reseñas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('actors.index') }}">Actores</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('awards.index') }}">Premios</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('directors.index') }}">Directores</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('movies.index') }}">Peliculas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('series.index') }}">Series</a></li>

                </ul>
            </div>
        </div>
    </nav>
</div>