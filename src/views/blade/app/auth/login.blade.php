@extends('index')

@section('content')
    <main class="container">
        <h1>Espace de connexion</h1>
        <div class="separator"></div>
        {!!
            $form->addLabel('Email *', 'email')
                 ->addInput('email', 'email', 'email')
                 ->addLabel('Mot de passe *', 'password')
                 ->addInput('password','password','password')
                 ->addSubmit('connect', 'Se connecter')
        !!}
        <p><a href="#" class="a-href">Mot de passe oublié ? </a></p>
        <p>Pas encore de compte ? <a href="@router('auth.register')" class="a-href">S'enregistrer</a></p>
    </main>
@endsection
