<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <form id="registerForm">
        @csrf
        <div>
            <label>Name:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Confirm Password:</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <div>
            <label>CEP:</label>
            <input type="text" name="cep" required>
        </div>
        <div>
            <label>Street:</label>
            <input type="text" name="street" required>
        </div>
        <div>
            <label>Neighborhood:</label>
            <input type="text" name="neighborhood" required>
        </div>
        <div>
            <label>Number:</label>
            <input type="text" name="number" required>
        </div>
        <div>
            <label>City:</label>
            <input type="text" name="city" required>
        </div>
        <div>
            <label>State:</label>
            <input type="text" name="state" required>
        </div>
        <button type="submit">Register</button>
    </form>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('/register', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Content-type': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '/home';
                } else {
                    alert('Registration failed');
                }
            });
        });
    </script>
</body>
</html>
