<main>
    <h1>Liste des utilisateurs</h1>
    <div class="users">
        <?php foreach ($users as $user): ?>
            <div class="user">
                <h2><?=$user->name?></h2>
                <p>Email: <b><?=$user->email?></b></p>
                <p>Son identifiant est: <b><?=$user->id?></b> <a href="<?= $router->get('users.user', ['id' => $user->id]) ?>">En savoir plus</a></p>
            </div>
        <?php endforeach; ?>
    </div>
</main>
