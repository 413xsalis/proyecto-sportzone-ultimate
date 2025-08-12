<h2>Hola {{ $user->name }}</h2>

<p>Te hemos creado un usuario en nuestra plataforma. Estas son tus credenciales:</p>

<p><strong>Usuario:</strong> {{ $user->email }}</p>
<p><strong>Contraseña:</strong> {{ $password }}</p>
<p><strong>Rol asignado:</strong> {{ $user->getRoleNames()->first() }}</p>

<p>Puedes iniciar sesión en: <a href="{{ url('/login') }}">{{ url('/login') }}</a></p>

<p>¡Bienvenido!</p>
