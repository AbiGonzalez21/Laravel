<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <img src="imagenes/tienda.png" width="100" alt="logo" class="navbat-brand">
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
        @if(Auth::guest())
                            <li><a class="nav-link" href="{{route('login')}}">Acceso</a></li>
                            <li>&nbsp</li>
                            <li><a class="nav-link" href="{{route('register')}}">Registro</a></li>
          @else
          <!-- / es la raiz del proyecto -->
          <a class="nav-link active" href="/">Home
            <span class="visually-hidden">(current)</span>
          </a>
        <!--Se pone la ruta a los index -->
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('clientes.index')}}">Clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('perfiles.index')}}">Perfiles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('facturas.index')}}">Facturacion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('formaspago.index')}}">Formas Pago</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('productos.index')}}">Productos</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="{{route('carrito')}}"> <i class="fa fa-shopping-cart fa-2x"></i> </a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
          </div>
        </li>
      </ul>

      <form class="d-flex">
        <input class="form-control me-sm-2" type="search" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>

      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>

      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
          </div>
        </li>
        @endif 
        </li>
      </ul>
      
    </div>
  </div>
</nav>