<main class="container">
    <div class="jumbotron">
        Le framework est correctement installé.
    </div>

    <?php if($send): ?>
        <?php if($success): ?>
            <div class="jumbotron success">
                Le mail a bien été envoyé ! Veuillez regarder votre boite mail.
            </div>
        <?php else: ?>
            <div class="jumbotron error">
                Le mail n'a pas pu être envoyé. Vérifiez vos paramètres de configuration.
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <h1>Envoyer un mail</h1>
    <div class="separator"></div>
    <?=
        $form->addLabel('Nom *', 'name')
                ->addInput('name', 'name')
                ->addLabel('Email *', 'email')
                ->addInput('email', 'email', 'email')
                ->addLabel('Message *', 'message')
                ->addTextArea('message', 'message')
                ->addSubmit('send', 'Envoyer')
    ?>
</main>
