<main class="container">
    <div class="jumbotron">
        Le framework est correctement installé.
    </div>
    <h1>Bienvenue sur le framework MVC de NeutronStars !</h1>
    <div class="separator"></div>

    <section>
        <h2>Les routes</h2>
        <p>Pour ajouter des nouvelles routes, allez dans le fichier <span>routes.php</span> qui se trouve dans le dossier <span>config</span>.</p>
        <pre class="code"><code id="route1"></code></pre>
        <p>Les routes sont ajoutées grâce à la méthode <span>add</span> de <span>Router</span>. Ensuite vous devez lui renseigner un nom et un tableau contenant des paramètres clef.</p>
        <pre class="code"><code id="route2"></code></pre>
        <p>Il y a aussi la possibilité d'ajouter des routes enfants ainsi que des paramètres customisés.</p>
        <pre class="code"><code id="route3"></code></pre>
    </section>

    <div class="separator"></div>

    <section>
        <h2>Les controllers</h2>
        <p>Les controllers seront appelés à la suite d'une route. Elles permettront d'y ajouter la logique de votre page avant son rendu.</p>
        <pre class="code"><code id="controller"></code></pre>
    </section>

    <div class="separator"></div>

    <section>
        <h2>Les layouts et les vues</h2>
        <p>Le layout est la partie qui est le plus courant de votre code HTML, Elle contiendra votre <span>head</span>, <span>body</span>, <span>header</span> et <span>footer</span>.</p>
        <p>Il ne faudra pas oublier d'ajouter le <span>echo $view;</span> à l'endroit ou vous souhaitez que le rendu de votre vue se place.</p>
        <pre class="code"><code id="layout"></code></pre>
        <p>Les vues est la partie la plus dense de votre site, c'est l'affichage qui change constamment d'une route à l'autre.</p>
        <pre class="code"><code id="vue"></code></pre>
    </section>

    <div class="separator"></div>

    <section>
        <h2>Les models</h2>
        <p>Les models vous permettent de gérer vos requêtes SQL en dehors de vos controllers.</p>
        <pre class="code"><code id="model1"></code></pre>
        <p>Pour utiliser votre model dans vos controller, vous devez simplement l'initialiser</p>
        <pre class="code"><code id="model2"></code></pre>
    </section>
</main>
