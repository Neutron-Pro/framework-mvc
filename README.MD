# Framework MVC par NeutronStars

---

## Installation du framework

```sh
git clone https://github.com/Neutron-Pro/frameword-mvc.git mvc-neutronstars
```

---

## Configuration du framework

- Copier le fichier `config-dist.php` dans le dossier `config` et coller le dans ce même dossier en le renommant `config.php`.

```php

use NeutronStars\Service\PHPMailer\PHPMailer;
use NeutronStars\View\ViewEngine;

// Changer la base de l'url. Ne rien mettre si celui-ci ce trouve à la racine.
// Exemple: '' => http(s)://sub.domain.ext/
// Exemple: '/test' => http(s)://sub.domain.ext/test/
define('BASE_PATH', '');

/*
 * Le moteur par défaut que vous souhaitez sélectionner:
 * ViewEngine::DEFAULT ou ViewEngine::BLADE
 */
define('VIEW_ENGINE', ViewEngine::DEFAULT);

// Changer la location si vous souhaitez déplacer le dossier des layouts.
define('LAYOUTS', '../src/layouts');

// Changer la location si vous souhaitez déplacer le dossier des vues.
define('VIEWS', '../src/views');

// Le cache de vos vues. (Uniquement pour le moteur de Blade)
define('BLADE_CACHE', '../cache');

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
// Le type des résultats que vous souhaitez pour vos réponses.
define('DB_FETCH_MODE', PDO::FETCH_OBJ);
// Le mode d'erreur en cas de problème sur vos requêtes.
define('DB_ERROR_MODE', PDO::ERRMODE_WARNING);

// Configuration de PHPMailer. (Ce n'est pas obligatoire si vous ne souhaitez pas envoyer de mail.)
// Le serveur de votre boite mail
define('MAIL_HOST', '');
// Le port du serveur de votre boite mail
define('MAIL_PORT', '');
// L'email qui servira à l'envoi.
define('MAIL_USER', '');
// Le mot de passe de l'email.
define('MAIL_PASSWORD', '');
// Le jeu de caractère dans les emails à envoyer.
define('MAIL_CHARSET', PHPMailer::CHARSET_UTF8);
// L'email qui sera affiché dans la section de l'expéditeur dans le mail du client. (Peut-être fictif)
define('MAIL_RECIPIENT_EMAIL', '');
// Le nom de l'expéditeur que le client verra.
define('MAIL_RECIPIENT_NAME', '');

```

Pensez à bien démarrer votre serveur vers le dossier `public`.

---

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

Il y a aussi la possibilité d'ajouter des routes enfants ainsi que des paramètres customisés.

```php
$params = [
    'path' => '/parent',
    'controller' => 'App\\Controller\\ParentController#index',
    /* Ajouter un enfant à la route pour ajouter un chemin après le /test */
    'children' => [
        /* Pour les route enfant c'est exactement les mêmes paramètres que le parent. Juste qu'il prend un nom directement via la clef. */
        'child' => [
            /* Ceci donnera: /parent/children */
            'path' => '/children',
            /*  */
            'controller' => 'App\\Controller\\ParentController#child'
        ],
        'child2' => [
            /* 
              Pour ajouter une route avec un paramètre customisable, il vous faudra utiliser les accolades
              Ceci donnera: /parent/test-101
            */
            'path' => '/{slug}-{id}',
            'controller' => 'App\\Controller\\ParentController#child2',
            /* Ensuite utilisez les paramètres pour indiquer via une regex, la règle à appliquer sur vos clefs dans le path. */
            'params' => [
                /* Le slug accepte tous les caractère de A à Z et de 0 à 9 sans faire attention à la case. */
                'slug' => '/[a-zA-Z0-9]+/',
                /* L'id accepte tous les caractères numérique. */
                'id'   => '/[0-9]+/'
            ],
            /* Vous pouvez bien sur continuer à créer des enfants dans les enfants sans limite: */
            'children' => [
                'subChild' => [
                    /* Ceci donnera: /parent/test-101/sub-child */
                    'path' => '/sub-child',
                    /* Ainsi de suite */
                    ...
                ]
            ]
        ]
    ]
];
// Puis Ajouter votre route
$router->add('test', $params);
```

---

## Les controllers

Les controllers seront appelés à la suite d'une route. Elles permettront d'y ajouter la logique de votre page avant son rendu.

```php
namespace App\Controller;
use NeutronStars\Controller\Controller;

class ParentController extends Controller
{
  public function index(): void
  {
    // Ajouter toute la logique de votre page ici avant de faire le rendu.
    // En cas d'erreur, il est possible de renvoyer la page 404 comme ceci:
    $this->page404(); // Pas besoin d'ajouter un 'die' en dessous, le code sera automatiquement coupé.
    
    // Pour appeler le ficher de votre vue, procédez comme suit:
    // Les points représentent la séparation de vos dossiers et l'extension ne doit pas être placé.
    $this->render('app.parent.index');
    // Après un rendu plus rien ne doit-être fait. Celui-ci doit toujours être la dernière chose à faire.
    
    // Si vous avez des variables à envoyer à votre vue:
    $this->render('app.parent.index', [
        'message' => 'Mon super message'
    ]);
    
    // Le layout par défaut est l'index mais si jamais vous avec un autre layout à placer, vous pourrez toujours l'appliquer en fin de paramètre:
    $this->render('app.parent.index', [], 'app.layout.index');
  }
  
  /* Si vous avez spécifié des paramètres customisable à vos routes, pensez à les récupérer dans le bon ordre en paramètre de méthode */
  private function child2($slug, $id): void
  {
    // Vous pouvez utiliser la méthode compact de php pour envoyez vos variables à votre vue.
    $this->render('app.parent.child', compact($slug, $id), 'app.layout.index');
  }
}
```

---

## Les layouts et les vues avec le moteur Blade

Le layout est la partie qui est le plus courant de votre code HTML, Elle contiendra votre `head`, `body`, `header` et `footer`.
Il ne faudra pas oublier d'ajouter le `@yield('content')` à l'endroit ou vous souhaitez que le rendu de votre vue se place.

Toutes vos vues doivent avoir l'extension `blade.php` pour fonctionner.

```html
{{-- Le layout est une page blade placé dans votre dossier de layout. (Renseigné dans votre config) --}}
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@hasSection('title') @yield('title') @else MVC Example By NeutronStars @endif</title>
        <!-- Vos styles à injecter -->
        @hasSection('style')
            @yield('style')
        @endSection
        
        <!-- Vos script à injecter -->
        @hasSection('script')
            @yield('script')
        @endSection
        <!-- Vos ressources 'link, script, ... à injecter par défault si besoin' -->
    </head>
    <body>
        <!-- Votre menu -->
        @hasSection('header')
            @yield('header')
        @else
            @include('header')
        @endif
        
        <!-- Coller le rendu de vos vues. -->
        @yield('content')
        
        @hasSection('footer')
            @yield('footer')
        @endif
    </body>
</html>
```

Les vues est la partie la plus dense de votre site, c'est l'affichage qui change constamment d'une route à l'autre.
Pour le cas de blade, il vous faudra aussi penser à inclure votre layout pour avoir la totalité de votre page.

```html
{{-- La vue est une page blade.php placé dans votre dossier de vue. (Renseigné dans votre config) --}}

{{-- Pour inclure vos layouts, utilisez @include de blade et séparer les dossiers par des points et terminer par le nom du fichier sans mettre l'extension  --}}
@include('app.index') {{-- {LAYOUTS}/app/index.blade.php --}}

{{-- Puis pour rendre votre vue, utiliser la section content. --}}
@addSection('content')
<main>
    {{-- Pour utiliser les paramètres injectés à votre vue: --}}
    <h1>{{ $message }}</h1>
    
    {{-- Pour générer une de vos routes --}}
    {{-- Il faut utiliser la directive @router et placer le nom de votre route --}}
    <a href="@router('parent')">Le Parent</a>
    
    {{-- Si vous avez besoin de récupérer une route enfant à votre parent, il suffit de mettre les noms séparer par des points. --}}
    <a href="@router('parent.child.subChild')">L'enfant</a>
    
    {{-- Si vous avez besoin de récupérer une route qui comporte des paramètres customisable: --}}
    <a href="@router('parent.child2', ['slug' => 'test', 'id' => '101'])">L'enfant custom</a>
</main>
@endSection
```

---

## Les layouts et les vues avec le moteur par défaut

Le layout est la partie qui est le plus courant de votre code HTML, Elle contiendra votre `head`, `body`, `header` et `footer`.
Il ne faudra pas oublier d'ajouter le `echo $view;` à l'endroit ou vous souhaitez que le rendu de votre vue se place.

```php
<?php //Le layout est une page php placé dans votre dossier de layout. (Renseigné dans votre config) ?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Mon super framework MVC</title>
        <!-- Vos ressources 'link, script, ...' -->
    </head>
    <body>
        <header>
            <!-- Votre menu -->
        </header>
        <!-- Coller le rendu de vos vues. -->
        <?= $view ?>
        <footer>
            &copy; 2021 - Framework MVC, NeutronStars & Co
        </footer>
    </body>
</html>
```

Les vues est la partie la plus dense de votre site, c'est l'affichage qui change constamment d'une route à l'autre.

```php
<?php //La vue est une page php placé dans votre dossier de vue. (Renseigné dans votre config) ?>
<main>
    <!-- Pour utiliser les paramètres injectés à votre vue: -->
    <h1><?=$message?></h1>
    
    <!-- Pour générer une de vos routes -->
    <!-- Il faut utiliser la méthode get de $router et placer le nom de votre route -->
    <a href="<?= $router->get('parent') ?>">Le Parent</a>
    
    <!-- Si vous avez besoin de récupérer une route enfant à votre parent, il suffit de mettre les noms séparer par des points. -->
    <a href="<?= $router->get('parent.child.subChild') ?>">L'enfant</a>
    
    <!-- Si vous avez besoin de récupérer une route qui comporte des paramètres customisable: -->
    <a href="<?= $router->get('parent.child2', ['slug' => 'test', 'id' => '101']) ?>">L'enfant custom</a>
</main>
```

---

## Les models

Les models vous permettent de gérer vos requêtes SQL en dehors de vos controllers.

```php
namespace App\Model;
use NeutronStars\Model\Model;

class UserModel extends Model
{
  public function __construct()
  {
    // Spécifier le nom de la table SQL que gérera ce model
    parent::__construct('users');
  }
  
  // Ajouter des requêtes à votre model
  public function insert($email, $password): void
  {
    $this->createQuery()
         ->insertInto('email,password', '?,?')
         ->setParameters([$email, $password])
         ->execute();
  }
  
  public function userByEmail($email): ?Object
  {
    return $this->createQuery()
                ->select('*')->where('email=?')
                ->setParameters([$email])
                ->getResult();
  }
}
```

Pour utiliser votre model dans vos controller, vous devez simplement l'initialiser

```php
namespace App\Controller;
use NeutronStars\Controller\Controller;
use App\Model\UserModel;

class UserController extends Controller
{
  private UserModel $userModel;
  
  public function __construct() {
    $this->userModel = new UserModel();
  }
  
  public function index(){
    // Pour récupérer tous les utilisateurs enregistrés dans la base de donnée
    $users = $this->userModel->all();
  }
  
  public function user($id){
    // Pour récupérer tous un utilisateur enregistré dans la base de donnée
    $user = $this->userModel->findById($id);
  }
}
```

---

## Les envoies d'email

Les envoies d'email sont assez important pour échanger avec client en dehors du site. Il est donc important de savoir envoyer des mails.
Pour cela pensez à bien configurer la section email de votre config.

```php
namespace App\Controller;
use NeutronStars\Controller\Controller;use NeutronStars\View\ViewEngine;

class DefaultController extends Controller
{
  public function sendMail() {
    //Pour envoyer un mail, utiliser la méthode createEmail du controller.
    $this->createEmail()
        // Ajouter tous vos destinataires en concaténant la méthode add les uns à la suites des autres.
        ->add('email de votre destinataire 1', 'Le nom de votre destinataire 1')
        ->add('email de votre destinataire 2', 'Le nom de votre destinataire 2')
        //Puis envoyer votre email.
        /*
         * 1 = Le sujet du mail.
         * 2 = Le contenu du mail. (Ou le chemin de la vue comme pour le render si vous utiliser un moteur de rendu.)
         * 
         * //A partir d'ici les arguments ne sont pas obligatoires.
         * 3 = Les paramètre à donner à la vue si vous utilisez un moteur de rendu.
         * 4 = Le layout pour le mode de rendu, sinon laissez à null. (Seulement le moteur de rendu par défaut)
         * isHTML = Si le contenu est un rendu HTML. Si oui alors il vous faudra utiliser les vues. Par default c'est à true.
         * viewEngine = Le moteur de rendu à utiliser. (Par défaut ça prend celui indiqué dans la configuration.)
         */
        ->send('1', '2', [3], '4', $isHTML, $viewEngine)
        //Exemples:
        ->send('Mon Sujet', 'mail.index', ['name' => 'John Doe'])
        ->send('Mon Sujet', 'mail.index', ['name' => 'John Doe'], null, true, ViewEngine::BLADE)
        ->send('Mon Sujet', 'mail.index', ['name' => 'John Doe'], null, true, ViewEngine::DEFAULT)
        ->send('Mon Sujet', 'mail.index', ['name' => 'John Doe'], 'mail.layout.index', true, ViewEngine::DEFAULT)
        ->send('Mon Sujet', 'Bonjour Mr John Doe !', [], null, false);
  }
}
```
