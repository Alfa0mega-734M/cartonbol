@extends('layouts.principal')
<link rel="stylesheet" href="{{ asset('css/principal.css') }}">
@section('contenido')
    

    <section>
        <div class="form-container">
            <img class="logo" src="{{ asset('images/logoV.png') }}" alt="Logo CARTONBOL" />

            <form id="formulario-iniciar-sesion">
            
                <div class="control">
                    <!--<label for="exampleInputEmail1">Email:</label>-->
                    <input type="email" name="email" class="form-control" placeholder="Ingrese su correo electrónico">
                </div>
                <div class="control">
                    <input type="password" name="contrasena" class="form-control" placeholder="Ingrese su contraseña">
                </div>
                <div class="control">
                    <button id="btn-enviar-formulario" type="button" class="btn btn-primary btn-block mt-4">Iniciar Sesión</button>
                </div>
            </form>
            <p class="mt-3">
                ¿No tienes una cuenta? <a href="{{ route('registro') }}">¡Regístrate!</a>
            </p>
        </div>
    </section>

@endsection

@section('scripts')
    
    <script>
        
        $('#btn-enviar-formulario').click(function(){
            let formulario = $('#formulario-iniciar-sesion').serialize();
            
            $.ajax({
                method: 'post',
                url: '/validacion-iniciar-sesion',
                data: formulario,
                success: function(res) {
                    location.reload();
                },
                error: function(error) {
                    let errores = error.responseJSON.errors;
                    let mensaje = 'Error en el servidor';
                    if ( errores.hasOwnProperty('email') ) {
                        mensaje = errores.email[0];
                    }else if(errores.hasOwnProperty('contrasena') ) {
                        mensaje = errores.contrasena[0];
                    }else{
                        mensaje = errores.login[0];
                    }
                    swal('Error', mensaje,'error');
                }
            });
        });
    </script>

@endsection