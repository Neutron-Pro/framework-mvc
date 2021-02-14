<div style="width: 100%; max-width: 768px; padding: 10px; margin: auto">
    <h1 style="text-align: center">Bonjour {{ $name }}</h1>
    <p style="margin: 16px 0">Nous avons bien pris en compte votre demande d'inscription sur note site.</p>
    <a style="display: inline-block; width: fit-content; padding: 10px 20px; background-color: #2355a1; color: white"
       href="@router('auth.confirm.account.account', ['id' => $id, 'token' => $token], true)">
        Valider votre compte
    </a>
    <p style="text-align: right; font-style: italic">Envoyer à partir du framework MVC de <span style="font-weight: bold">NeutronStars</span></p>
</div>
