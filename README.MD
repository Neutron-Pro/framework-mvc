# Framework MVC By NeutronStars

---

## Installation du framework

```sh
git clone https://github.com/Neutron-Pro/frameword-mvc.git mvc-neutronstars
```

## Configuration du framework

- Copier le fichier `config-dist.php` dans le dossier `config` et coller le dans ce même dossier en le renommant `config.php`.
```php
// Changer la location si vous souhaitez déplacer le dossier des layouts.
define('LAYOUTS', '../src/layouts');

// Changer la location si vous souhaitez déplacer le dossier des vues.
define('VIEWS', '../src/views');

// Configuration de la base de donnée. (Ce n'est pas obligatoire si vous ne l'utilisez pas.)
// Le framework utilise une base de donnée SQL.
define('DB_HOST', '127.0.0.1');
define('DB_PORT', 3306);

// Le nom de votre base de donnée.
define('DB_NAME', '');
// Le nom de l'utilisateur.
define('DB_USER', '');
// Le mot de passe
define('DB_PASSWORD', '');
// Le jeu d'encodage des caractères.
define('DB_CHARSET', 'utf8mb4');
```

Pensez à bien démarrer votre serveur vers le dossier `public`.

## Démarrer le serveur avec PHP

```shell
# Si votre console se trouve à la racine du projet:
php -S 127.0.0.1:8080 -t public/

# Si votre console se trouve dans le dossier public:
php -S 127.0.0.1:8080
```

---

## Les routes

Pour ajouter des nouvelles routes, allez dans le fichier `routes.php` qui se trouve dans le dossier `config`.

```php
use NeutronStars\Kernel;

Kernel::get()->getRouter()
    ->add('home', [
        'path'       => '/',
        'controller' => 'App\\Controller\\HomeController#home'
    ])
    ->add('404', [
        'path'       => '/404',
        'controller' => 'App\\Controller\\ErrorController#call404'
    ]);
```

Les routes sont ajoutées grâce à la méthode `add` de `Router`. Ensuite vous devez lui renseigner un nom et un tableau contenant des paramètres clef.

```php
$params = [
    /* L'URL à entrer dans le navigateur. */
    'path' => '/test',
    /* 
        Le chemin vers le controller ou la route se rendra ainsi que la méthode à appeler se trouvant dans se même controller. 
        Pattern: Your\\Namespace\\YourClassController#yourMethod
    */
    'controller' => 'App\\Controller\\TestController#index'
];
// Ajouter votre route
$router->add('test', $params);
```

Il y a aussi la possibilité d'ajouter des routes enfant ainsi que des paramètres customisés.

```php
$params = [
    'path' => '/parent',
    'controller' => 'App\\Controller\\ParentController#index',
    /* Ajouter un enfant à la route pour ajouter un chemin après le /test */
    'children' => [
        /* Pour les route enfant c'est exactement les même paramètre que le parent. Juste qu'il prends son nom directement via la clef. */
        'child' => [
            /* Ceci donnera: /parent/children */
            'path' => '/children',
            /*  */
            'controller' => 'App\\Controller\\ParentController#child'
        ]
    ]
];
// Ajouter votre route
$router->add('test', $params);
```
