<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form id="reset-form">
            <input type="hidden" name="token" id="token" value="{{ $token }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div>
                <label for="email">E-Mail Address:</label>
                <input id="email" type="email" name="email" required autofocus>
            </div>

            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" required>
            </div>

            <div>
                <label for="password-confirm">Confirm Password:</label>
                <input id="password-confirm" type="password" name="password_confirmation" required>
            </div>

            <div>
                <button type="submit">Reset Password</button>
            </div>
        </form>
        <div id="message"></div>
    </div>

    <script>
    document.getElementById('reset-form').addEventListener('submit', function(e) {
        e.preventDefault();

        let token = document.getElementById('token').value;
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        let passwordConfirmation = document.getElementById('password-confirm').value;

        fetch('{{ route('password.update') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({
                token: token,
                email: email,
                password: password,
                password_confirmation: passwordConfirmation
            })
        })
        .then(response => response.json())
        .then(data => {
            let messageDiv = document.getElementById('message');
            if (data.status) {
                messageDiv.innerHTML = '<p style="color:green;">Password reset successfully!</p>';
                setTimeout(() => {
                    window.location.href = '{{ route('login') }}';
                }, 2000);
            } else {
                messageDiv.innerHTML = '<p style="color:red;">Error: ' + data.email[0] + '</p>';
            }
        })
        .catch(error => console.error('Error:', error));
    });
    </script>
</body>
</html>
