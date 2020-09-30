<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SysTV - Sistema de Acompanhamento de Filmes e Seriados">
    <meta name="author" content="Endrigo">
    <link rel="icon" href="favicon.ico">

    <title>SysTV - Sistema de Acompanhamento de Filmes e Seriados</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css">

</head>

<body>

    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark p-2">
            <a class="navbar-brand p-0 m-0" href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="sysTV"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                </div>
                <div class="espaco-direita">
                    <form action="{{ route('pesquisa') }}" method="POST" class="form-inline mt-2 mt-md-0">
                        @csrf
                        <div class="input-group">
                            <input id="search" name="search" type="text" class="form-control" placeholder="Procurar Filme/Seriado" aria-label="Procurar Filme/Seriado" required minlength="3">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user pr-2 text-white"></i>
                            {{ Str::title(Str::limit(Auth::user()->name,30,'...')) }}

                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('lista') }}"><i class="fas fa-clipboard-list pr-1"></i> Meus Acompanhamentos</a>
                            <div class="dropdown-divider"></div>
                            <!-- <a class="dropdown-item" href="#"><i class="fas fa-key pr-1"></i> Alterar Senha</a> -->
                            <a class="dropdown-item" data-toggle="modal" href="#ExemploModalCentralizado"><i class="fas fa-user-slash pr-1"></i> Excluir Conta</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-door-open pr-1"></i> Sair</a>
                        </div>
                    </li>
                    @else
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('register') }}"><i class="fas fa-user-plus pr-2"></i>Cadastrar</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}"><i class="fas fa-sign-in-alt pr-2"></i>Acessar</a></li>
                    @endauth
                </ul>
            </div>
        </nav>
    </header>

    <main role="main">
        <div class="container">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show p-0" role="alert">
                <ul class="pt-2">
                    @if (Str::length($errors) > 1)
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    @else
                    <li>{{ $errors }}</li>
                    @endif
                </ul>
                <button type="button" class="close p-2" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show p-0" role="alert">
                <ul class="pt-2">
                    {{ session('success') }}
                </ul>
                <button type="button" class="close p-2" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card-deck">
                <div class="card border-dark mb-3">
                    <div class="card-header font-weight-bold text-capitalize card-header-bg p-2">
                        @yield('cabecalho')
                    </div>
                    <div class="card-body text-dark">
                        @yield('conteudo')
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
<!-- Modal -->
<div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('excluir_conta') }}">
                @csrf
                @method('DELETE')
                <div class=" modal-header">
                    <h5 class="modal-title" id="TituloModalCentralizado">Excluir Conta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Ao confirmar a exclusão sua conta e todo o seu histórico serão excluidos permanentemente, não podendo mais ser recuperados.</p>
                    <p>Confirma a exclusão da conta?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Sim</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>
