<main class="container">
    <h1>Bienvenue <?= $auth->getName() ?></h1>
    <div class="separator"></div>
    <p><span>Email: </span><?= $auth->getEmail() ?></p>
    <p><span>Inscrit le: </span><?= $auth->getCreatedAt()->format('d/m/Y') ?></p>
</main>
