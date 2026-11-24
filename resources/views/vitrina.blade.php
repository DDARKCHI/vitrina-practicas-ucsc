<!doctype html>
<html lang="es-CL">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Proyectos de práctica de Ingeniería de Ejecución en Informática del Instituto Tecnológico UCSC, sede Talcahuano.">
    <title>Proyectos de práctica | Instituto Tecnológico UCSC</title>
    <link rel="icon" type="image/png" href="{{ asset('imagenes/logo-ucsc.png') }}">
    <link rel="stylesheet" href="{{ asset('vitrina.css') }}">
</head>
<body>
    <a class="skip" href="#contenido">Saltar al contenido</a>
    <header>
        <div class="topbar">
            <div class="wrap topbar-inner">
                <span>Instituto Tecnológico · Sede Talcahuano</span>
                <a href="https://it.ucsc.cl/">Sitio del Instituto</a>
            </div>
        </div>
        <div class="wrap header-inner">
            <a class="brand" href="{{ route('portada') }}" aria-label="Vitrina de prácticas UCSC, inicio">
                <img src="{{ asset('imagenes/logo-ucsc.png') }}" alt="UCSC">
                <span>Vitrina de<br>prácticas</span>
            </a>
            <nav aria-label="Navegación principal">
                <a href="#proyectos">Proyectos</a>
                <a href="#acerca">Acerca de</a>
                <a href="#estudiantes">Estudiantes</a>
                <a href="#empresas">Empresas</a>
                <a href="#contacto">Contacto</a>
            </nav>
        </div>
    </header>

    <main id="contenido">
        <section class="hero" aria-labelledby="titulo">
            <div class="hero-copy">
                <p class="eyebrow">Prácticas profesionales · 2026</p>
                <h1 id="titulo">Proyectos<br>de práctica<span>.</span></h1>
                <p class="hero-description">Soluciones desarrolladas por estudiantes de Ingeniería de Ejecución en Informática de la sede Talcahuano.</p>
                <a class="button button-light" href="#proyectos">Explorar proyectos</a>
            </div>
            <figure class="hero-media">
                <img src="{{ asset('imagenes/sede-talcahuano.webp') }}" alt="Instituto Tecnológico UCSC, sede Talcahuano" fetchpriority="high">
                <figcaption>Instituto Tecnológico UCSC <span>·</span> Sede Talcahuano</figcaption>
            </figure>
        </section>

        <section class="wrap projects" id="proyectos" aria-labelledby="titulo-proyectos">
            <div class="section-heading">
                <div>
                    <h2 id="titulo-proyectos">Catálogo de proyectos</h2>
                    <p>Conoce cada solución y ábrela desde su ficha cuando esté disponible.</p>
                </div>
                <p class="project-count">{{ $projects->count() }} {{ $projects->count() === 1 ? 'proyecto' : 'proyectos' }}</p>
            </div>
            <div class="project-grid">
                @forelse ($projects as $project)
                    <article class="project">
                        <div class="project-art" aria-hidden="true">
                            @if (!empty($project['image']))
                                <img src="{{ asset($project['image']) }}" alt="" loading="lazy">
                            @else
                                <span>{{ $project['code'] }}</span>
                            @endif
                        </div>
                        <div class="project-copy">
                            <p class="project-category">{{ $project['category'] }}</p>
                            <h3>
                                @if ($project['url'])
                                    <a class="project-link" href="{{ $project['url'] }}">{{ $project['name'] }}<span class="sr-only">, abrir proyecto</span></a>
                                @else
                                    {{ $project['name'] }}
                                @endif
                            </h3>
                            <p class="project-description">{{ $project['description'] }}</p>
                        </div>
                        <div class="project-action">
                            @if ($project['url'])
                                <span>Ver proyecto</span>
                            @else
                                <span class="pending">Acceso pendiente</span>
                            @endif
                        </div>
                    </article>
                @empty
                    <p>Los proyectos se incorporarán al catálogo una vez disponibles.</p>
                @endforelse
            </div>
        </section>

        <section class="about" id="acerca" aria-labelledby="titulo-acerca">
            <div class="wrap about-inner">
                <h2 id="titulo-acerca">Sobre la vitrina</h2>
                <div>
                    <p>Esta vitrina reúne el trabajo de estudiantes del Instituto Tecnológico UCSC durante sus prácticas profesionales. Cada ficha explica qué problema aborda el proyecto y permite acceder a la solución cuando está disponible.</p>
                    <a class="text-link" href="https://it.ucsc.cl/carreras/ingenieria-de-ejecucion-en-informatica/">Conocer la carrera</a>
                </div>
            </div>
        </section>

        <div class="wrap participation">
            <section id="estudiantes" aria-labelledby="titulo-estudiantes">
                <h2 id="titulo-estudiantes">Estudiantes</h2>
                <p>Para incorporar tu proyecto, prepara el nombre, una descripción breve, una imagen representativa y el enlace donde se podrá abrir. Consulta con tu docente cómo entregar la ficha.</p>
            </section>
            <section id="empresas" aria-labelledby="titulo-empresas">
                <h2 id="titulo-empresas">Empresas</h2>
                <p>Conoce cómo vincularte con el Instituto Tecnológico y ofrecer oportunidades de práctica profesional.</p>
                <a class="text-link" href="https://it.ucsc.cl/sobre-el-instituto/practicas-y-pasantias/">Prácticas y pasantías</a>
            </section>
        </div>
    </main>

    <footer id="contacto">
        <div class="wrap footer-inner">
            <div>
                <p class="footer-title">Instituto Tecnológico</p>
                <p>Universidad Católica de la Santísima Concepción<br>Sede Talcahuano</p>
            </div>
            <div>
                <h2>Contacto</h2>
                <address>
                    Colón 2766, Talcahuano<br>
                    <a href="mailto:ittalcahuano@ucsc.cl">ittalcahuano@ucsc.cl</a><br>
                    <a href="tel:+56412345847">+56 41 234 5847</a>
                </address>
            </div>
        </div>
    </footer>
</body>
</html>
