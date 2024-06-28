document.getElementById('resetForm').addEventListener('submit', function(event) {
    event.preventDefault();
    document.querySelector('#resetForm button').innerText = 'Aguarde ...';
    document.querySelector('#resetForm button').setAttribute("disabled", "disabled");

    fetch('/password/email', {
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
        document.querySelector('#resetForm button').innerText = 'Recuperar Senha';
        document.querySelector('#resetForm button').removeAttribute("disabled");
        
        document.querySelector('#resetForm [name="email"]').value = '';
        notification('success', 'Se sua conta for encontrada você receberá as informações para recuperação de senha');
    });
});