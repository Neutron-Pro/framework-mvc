const app = document.getElementById('app');
if (app) {
    const request = new XMLHttpRequest();
    request.onreadystatechange = (e) => {
        if(request.readyState === 4) {
            app.innerHTML += marked(request.response);
            const codes = document.getElementsByTagName('code');
            for (const code of codes) {
                code.innerHTML = hljs.highlight('php', code.innerText).value;
            }
        }
    };
    request.open('GET','/api/readme');
    request.send();
}
console.log('Bienvenue sur le Framework MVC de NeutronStars !');
