console.log('Bienvenue sur le framework MVC par NeutronStars.');

function init()
{
    document.getElementById('route1').innerHTML = hljs.highlight('php',route1).value;
    document.getElementById('route2').innerHTML = hljs.highlight('php', route2).value;
    document.getElementById('route3').innerHTML = hljs.highlight('php', route3).value;
    document.getElementById('controller').innerHTML = hljs.highlight('php', controller).value;
    document.getElementById('layout').innerHTML = hljs.highlight('php', layout).value;
    document.getElementById('vue').innerHTML = hljs.highlight('php', vue).value;
    document.getElementById('model1').innerHTML = hljs.highlight('php', model1).value;
    document.getElementById('model2').innerHTML = hljs.highlight('php', model2).value;
}

const route1 = '```php\n' +
    'use NeutronStars\\Kernel;\n' +
    '\n' +
    'Kernel::get()->getRouter()\n' +
    '    ->add(\'home\', [\n' +
    '        \'path\'       => \'/\',\n' +
    '        \'controller\' => \'App\\\\Controller\\\\HomeController#home\'\n' +
    '    ])\n' +
    '    ->add(\'404\', [\n' +
    '        \'path\'       => \'/404\',\n' +
    '        \'controller\' => \'App\\\\Controller\\\\ErrorController#call404\'\n' +
    '    ]);\n' +
    '```';

const route2 = '$params = [\n' +
    '    /* L\'URL à entrer dans le navigateur. */\n' +
    '    \'path\' => \'/test\',\n' +
    '    /* \n' +
    '        Le chemin vers le controller ou la route se rendra ainsi que la méthode à appeler se trouvant dans se même controller. \n' +
    '        Pattern: Your\\\\Namespace\\\\YourClassController#yourMethod\n' +
    '    */\n' +
    '    \'controller\' => \'App\\\\Controller\\\\TestController#index\'\n' +
    '];\n' +
    '// Ajouter votre route\n' +
    '$router->add(\'test\', $params);';

const route3 = '$params = [\n' +
    '    \'path\' => \'/parent\',\n' +
    '    \'controller\' => \'App\\\\Controller\\\\ParentController#index\',\n' +
    '    /* Ajouter un enfant à la route pour ajouter un chemin après le /test */\n' +
    '    \'children\' => [\n' +
    '        /* Pour les route enfant c\'est exactement les mêmes paramètres que le parent. Juste qu\'il prend un nom directement via la clef. */\n' +
    '        \'child\' => [\n' +
    '            /* Ceci donnera: /parent/children */\n' +
    '            \'path\' => \'/children\',\n' +
    '            /*  */\n' +
    '            \'controller\' => \'App\\\\Controller\\\\ParentController#child\'\n' +
    '        ],\n' +
    '        \'child2\' => [\n' +
    '            /* \n' +
    '              Pour ajouter une route avec un paramètre customisable, il vous faudra utiliser les accolades\n' +
    '              Ceci donnera: /parent/test-101\n' +
    '            */\n' +
    '            \'path\' => \'/{slug}-{id}\',\n' +
    '            \'controller\' => \'App\\\\Controller\\\\ParentController#child2\',\n' +
    '            /* Ensuite utilisez les paramètres pour indiquer via une regex, la règle à appliquer sur vos clefs dans le path. */\n' +
    '            \'params\' => [\n' +
    '                /* Le slug accepte tous les caractère de A à Z et de 0 à 9 sans faire attention à la case. */\n' +
    '                \'slug\' => \'/[a-zA-Z0-9]+/\',\n' +
    '                /* L\'id accepte tous les caractères numérique. */\n' +
    '                \'id\'   => \'/[0-9]+/\'\n' +
    '            ],\n' +
    '            /* Vous pouvez bien sur continuer à créer des enfants dans les enfants sans limite: */\n' +
    '            \'children\' => [\n' +
    '                \'subChild\' => [\n' +
    '                    /* Ceci donnera: /parent/test-101/sub-child */\n' +
    '                    \'path\' => \'/sub-child\',\n' +
    '                    /* Ainsi de suite */\n' +
    '                    ...\n' +
    '                ]\n' +
    '            ]\n' +
    '        ]\n' +
    '    ]\n' +
    '];\n' +
    '// Puis Ajouter votre route\n' +
    '$router->add(\'test\', $params);';

const controller = 'namespace App\\Controller;\n' +
    'use NeutronStars\\Controller\\Controller;\n' +
    '\n' +
    'class ParentController extends Controller\n' +
    '{\n' +
    '  public function index(): void\n' +
    '  {\n' +
    '    // Ajouter toute la logique de votre page ici avant de faire le rendu.\n' +
    '    // En cas d\'erreur, il est possible de renvoyer la page 404 comme ceci:\n' +
    '    $this->page404(); // Pas besoin d\'ajouter un \'die\' en dessous, le code sera automatiquement coupé.\n' +
    '    \n' +
    '    // Pour appeler le ficher de votre vue, procédez comme suit:\n' +
    '    // Les points représentent la séparation de vos dossiers et l\'extension ne doit pas être placé.\n' +
    '    $this->render(\'app.parent.index\');\n' +
    '    // Après un rendu plus rien ne doit-être fait. Celui-ci doit toujours être la dernière chose à faire.\n' +
    '    \n' +
    '    // Si vous avez des variables à envoyer à votre vue:\n' +
    '    $this->render(\'app.parent.index\', [\n' +
    '        \'message\' => \'Mon super message\'\n' +
    '    ]);\n' +
    '    \n' +
    '    // Le layout par défaut est l\'index mais si jamais vous avec un autre layout à placer, vous pourrez toujours l\'appliquer en fin de paramètre:\n' +
    '    $this->render(\'app.parent.index\', [], \'app.layout.index\');\n' +
    '  }\n' +
    '  \n' +
    '  /* Si vous avez spécifié des paramètres customisable à vos routes, pensez à les récupérer dans le bon ordre en paramètre de méthode */\n' +
    '  private function child2($slug, $id): void\n' +
    '  {\n' +
    '    // Vous pouvez utiliser la méthode compact de php pour envoyez vos variables à votre vue.\n' +
    '    $this->render(\'app.parent.child\', compact($slug, $id), \'app.layout.index\');\n' +
    '  }\n' +
    '}';

const layout = '<?php //Le layout est une page php placé dans votre dossier de layout. (Renseigné dans votre config) ?>\n' +
    '<!doctype html>\n' +
    '<html lang="fr">\n' +
    '    <head>\n' +
    '        <meta charset="UTF-8">\n' +
    '        <meta name="viewport" content="width=device-width, initial-scale=1.0">\n' +
    '        <meta http-equiv="X-UA-Compatible" content="ie=edge">\n' +
    '        <title>Mon super framework MVC</title>\n' +
    '        <!-- Vos ressources \'link, script, ...\' -->\n' +
    '    </head>\n' +
    '    <body>\n' +
    '        <header>\n' +
    '            <!-- Votre menu -->\n' +
    '        </header>\n' +
    '        <!-- Coller le rendu de vos vues. -->\n' +
    '        <?= $view ?>\n' +
    '        <footer>\n' +
    '            &copy; 2021 - Framework MVC, NeutronStars & Co\n' +
    '        </footer>\n' +
    '    </body>\n' +
    '</html>';

const vue = '<?php //La vue est une page php placé dans votre dossier de vue. (Renseigné dans votre config) ?>\n' +
    '<main>\n' +
    '    <!-- Pour utiliser les paramètres injectés à votre vue: -->\n' +
    '    <h1><?=$message?></h1>\n' +
    '    \n' +
    '    <!-- Pour générer une de vos routes -->\n' +
    '    <!-- Il faut utiliser la méthode get de $router et placer le nom de votre route -->\n' +
    '    <a href="<?= $router->get(\'parent\') ?>">Le Parent</a>\n' +
    '    \n' +
    '    <!-- Si vous avez besoin de récupérer une route enfant à votre parent, il suffit de mettre les noms séparer par des points. -->\n' +
    '    <a href="<?= $router->get(\'parent.child.subChild\') ?>">L\'enfant</a>\n' +
    '    \n' +
    '    <!-- Si vous avez besoin de récupérer une route qui comporte des paramètres customisable: -->\n' +
    '    <a href="<?= $router->get(\'parent.child2\', [\'slug\' => \'test\', \'id\' => \'101\']) ?>">L\'enfant custom</a>\n' +
    '</main>';

const model1 = 'namespace App\\Model;\n' +
    'use NeutronStars\\Model\\Model;\n' +
    '\n' +
    'class UserModel extends Model\n' +
    '{\n' +
    '  public function __construct()\n' +
    '  {\n' +
    '    // Spécifier le nom de la table SQL que gérera ce model\n' +
    '    parent::__construct(\'users\');\n' +
    '  }\n' +
    '  \n' +
    '  // Ajouter des requêtes à votre model\n' +
    '  public function insert($email, $password): void\n' +
    '  {\n' +
    '    $this->createQuery()\n' +
    '         ->insertInto(\'email,password\', \'?,?\')\n' +
    '         ->setParameters([$email, $password])\n' +
    '         ->execute();\n' +
    '  }\n' +
    '  \n' +
    '  public function userByEmail($email): ?Object\n' +
    '  {\n' +
    '    return $this->createQuery()\n' +
    '                ->select(\'*\')->where(\'email=?\')\n' +
    '                ->setParameters([$email])\n' +
    '                ->getResult();\n' +
    '  }\n' +
    '}';

const model2 = 'namespace App\\Controller;\n' +
    'use NeutronStars\\Controller\\Controller;\n' +
    'use App\\Model\\UserModel;\n' +
    '\n' +
    'class UserController extends Controller\n' +
    '{\n' +
    '  private UserModel $userModel;\n' +
    '  \n' +
    '  public function __construct() {\n' +
    '    $this->userModel = new UserModel();\n' +
    '  }\n' +
    '  \n' +
    '  public function index(){\n' +
    '    // Pour récupérer tous les utilisateurs enregistrés dans la base de donnée\n' +
    '    $users = $this->userModel->all();\n' +
    '  }\n' +
    '  \n' +
    '  public function user($id){\n' +
    '    // Pour récupérer tous un utilisateur enregistré dans la base de donnée\n' +
    '    $user = $this->userModel->findById($id);\n' +
    '  }\n' +
    '}';

init();
