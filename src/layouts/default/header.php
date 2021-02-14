<header>
    <nav>
        <ul>
            <li>
                <a href="<?=$router->get('home')?>" class="<?= $router->isRoute('home') ? 'link' : '' ?>">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            <li>
                <a href="<?=$router->get('contact')?>" class="<?= $router->isRoute('contact') ? 'link' : '' ?>">
                    <i class="fas fa-envelope"></i>
                </a>
            </li>

            <?php if($auth->isConnected()): ?>
                <li>
                    <a href="<?=$router->get('users.profile')?>"
                       class="<?= $router->isRoute('users.profile') ? 'link' : '' ?>"
                    ><i class="fas fa-user"></i></a>
                </li>
                <li>
                    <a href="<?=$router->get('auth.logout')?>">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?=$router->get('auth.login')?>"
                       class="<?= $router->isRoute('auth', false) ? 'link' : '' ?>"
                    ><i class="fas fa-sign-in-alt"></i></a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="socials">
        <a href="https://github.com/Neutron-Pro/framework-mvc" target="_blank"><i class="fab fa-github"></i></a>
        <a href="https://discord.gg/vPMzZcu" target="_blank"><i class="fab fa-discord"></i></a>
        <a href="https://www.linkedin.com/in/alan-vion/" target="_blank"><i class="fab fa-linkedin"></i></a>
        <a href="https://twitter.com/Neutron_Stars_" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://www.youtube.com/channel/UCJCG0McLmkGEBCXf_pROlcw" target="_blank"><i class="fab fa-youtube"></i></a>
    </div>
</header>
