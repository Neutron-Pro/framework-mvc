@extends('index')

@section('content')
    <main class="container">
        <h1>Espace d'inscription</h1>
        <div class="separator"></div>
        {!!
            $form->addLabel('Nom *', 'name')
                 ->addInput('name', 'name')
                 ->addLabel('Email *', 'email')
                 ->addInput('email', 'email', 'email')
                 ->addLabel('Mot de passe *', 'password')
                 ->addInput('password','password','password')
                 ->addLabel('Confirmer le mot de passe *', 'confirm_password')
                 ->addInput('confirm_password','confirm_password','password')
                 ->addSubmit('register', 'S\'enregistrer')
        !!}
    </main>
@endsection
