document.getElementById('logoutForm').addEventListener('submit', function(event) {
    event.preventDefault();

    fetch('/logout', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': this.querySelector('input[name="_token"]').value,
        },
    })
    .then(response => {
        window.location.href = '/login';
    });
});