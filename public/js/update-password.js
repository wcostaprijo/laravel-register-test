document.getElementById('updateForm').addEventListener('submit', function(event) {
    event.preventDefault();
    document.querySelector('#updateForm button').innerText = 'Aguarde ...';
    document.querySelector('#updateForm button').setAttribute("disabled", "disabled");

    fetch('/password/reset', {
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
        document.querySelector('#updateForm button').innerText = 'Criar Conta';
        document.querySelector('#updateForm button').removeAttribute("disabled");

        if(!response.hasOwnProperty('errors')) {
            window.location.href = '/home';
        } else {
            let message = '';
            for(let k in response.errors) {
                message += `${response.errors[k].join('<br>')}<br>`;
            }
            notification('danger', message);
        }
    });
});