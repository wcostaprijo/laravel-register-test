function applyCepMask(value) {
    return value.replace(/\D/g, '').replace(/^(\d{2})(\d{3})(\d{3})/, '$1 $2-$3').substring(0, 10);
}

document.querySelector('input[name="cep"]').addEventListener('input', function(event) {
    event.target.value = applyCepMask(event.target.value);

    document.querySelector('[name="street"]').value = '';
    document.querySelector('[name="neighborhood"]').value = '';
    document.querySelector('[name="city"]').value = '';
    document.querySelector('[name="state"]').value = '';

    if(event.target.value.toString().length == 10) {
        document.querySelector('#registerForm button').innerText = 'Aguarde ...';
        document.querySelector('input[name="cep"]').setAttribute("disabled", "disabled");
        fetch(`https://viacep.com.br/ws/${event.target.value.replace(/\D/g, '')}/json/`)
        .then(response => response.json())
        .then(data => {
            if(data.hasOwnProperty('erro')) {
                notification('danger', 'CEP não encontrado');
                document.querySelector('#registerForm button').setAttribute("disabled", "disabled");
                document.querySelector('input[name="cep"]').classList.remove('border-gray-300');
                document.querySelector('input[name="cep"]').classList.remove('dark:border-gray-600');
                document.querySelector('input[name="cep"]').classList.add('border-rose-500');
            } else {
                document.querySelector('[name="street"]').value = data.logradouro;
                document.querySelector('[name="neighborhood"]').value = data.bairro;
                document.querySelector('[name="city"]').value = data.localidade;
                document.querySelector('[name="state"]').value = data.uf;
                document.querySelector('#registerForm button').removeAttribute("disabled");
                document.querySelector('input[name="cep"]').classList.add('border-gray-300');
                document.querySelector('input[name="cep"]').classList.add('dark:border-gray-600');
                document.querySelector('input[name="cep"]').classList.remove('border-rose-500');
            }

            document.querySelector('input[name="cep"]').removeAttribute("disabled");
            document.querySelector('#registerForm button').innerText = 'Criar Conta';
        });
    }
});

document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();
    document.querySelector('#registerForm button').innerText = 'Acessando ...';
    document.querySelector('#registerForm button').setAttribute("disabled", "disabled");

    fetch('/register', {
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
        document.querySelector('#registerForm button').innerText = 'Criar Conta';
        document.querySelector('#registerForm button').removeAttribute("disabled");
        
        if(!response.hasOwnProperty('errors')) {
            window.location.href = '/home';
        } else {
            let message = '';
            for(let k in response.errors) {
                message += `${response.errors[k].join('<br><br>')}<br>`;
            }
            notification('danger', message);
        }
    });
});