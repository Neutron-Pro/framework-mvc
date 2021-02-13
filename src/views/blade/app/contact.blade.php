@extends('index')

@section('content')
    <main class="container">
        <div class="jumbotron">
            Le framework est correctement installé.
        </div>

        @if($send)
            @if($success)
                <div class="jumbotron success">
                    Le mail a bien été envoyé ! Veuillez regarder votre boite mail.
                </div>
            @else
                <div class="jumbotron error">
                    Le mail n'a pas pu être envoyé. Vérifiez vos paramètres de configuration.
                </div>
            @endif
        @endif

        <h1>Envoyer un mail</h1>
        <div class="separator"></div>
            {!!
                 $form->addLabel('Nom *', 'name')
                     ->addInput('name', 'name')
                     ->addLabel('Email *', 'email')
                     ->addInput('email', 'email', 'email')
                     ->addLabel('Message *', 'message')
                     ->addTextArea('message', 'message')
                     ->addSubmit('send', 'Envoyer')
            !!}
    </main>
@endsection
