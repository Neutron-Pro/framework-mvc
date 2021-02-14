<header>
    <nav>
        <ul>
            <li><a href="@router('home')" class="@classRoute('home', 'link')"><i class="fas fa-home"></i></a></li>
            <li><a href="@router('contact')" class="@classRoute('contact', 'link')"><i class="fas fa-envelope"></i></a></li>
            @isConnected
                <li><a href="@router('users.profile')" class="@classRoute('users.profile', 'link')"><i class="fas fa-user"></i></a></li>
                <li><a href="@router('auth.logout')"><i class="fas fa-sign-out-alt"></i></a></li>
            @else
                <li><a href="@router('auth.login')" class="@classRoute('auth', 'link', false)"><i class="fas fa-sign-in-alt"></i></a></li>
            @endif
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
