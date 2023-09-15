Hola {{$user->name}}
Gracias por crear tu cuenta. Por favor verifícala usando el siguiente enlace:

{{route('verify', $user->verification_token)}}