document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    document.querySelector('#loginForm button').innerText = 'Acessando ...';
    document.querySelector('#loginForm button').setAttribute("disabled", "disabled");

    fetch('/login', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': this.querySelector('input[name="_token"]').value,
            'Content-type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify(Object.fromEntries((new FormData(this)).entries()))
    })
    .then(response => response.json())
    .then(response => {
        document.querySelector('#loginForm button').innerText = 'Acessar Conta';
        document.querySelector('#loginForm button').removeAttribute("disabled");
        
        if(!response.hasOwnProperty('message')) {
            window.location.href = '/home';
        } else {
            notification('danger', response.message);
        }
    });
});