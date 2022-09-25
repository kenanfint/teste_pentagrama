@extends('layouts.login')

@section('title')
Registrar-se
@endsection

@section('content')

<div class="container-fluid ps-md-0">
  <div class="row g-0">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">

              @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif

              @if(session('danger'))
              <div class="alert alert-danger">
                {{ session('danger') }}
              </div>
              @endif

              <h3 class="login-heading mb-4">Crie sua conta!</h3>

              <!-- Sign In Form -->
              <form action="{{ route('users.store') }}" method="post">
                @csrf
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="floatingInput" name="username">
                  <label for="floatingInput">Nome</label>
                </div>

                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                  <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                  <label for="floatingPassword">Senha</label>
                </div>

                <div class="d-grid">
                  <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" type="submit">Registrar</button>
                  <div class="text-center">
                    <a class="small" href="{{ route('users.login') }}">Fazer login</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection