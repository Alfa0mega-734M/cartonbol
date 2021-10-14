@extends('layouts.principal')
<link rel="stylesheet" href="{{ asset('css/principal.css') }}">
@section('contenido')
    

    <section>
        <div class="form-container" id="app">
            
            <img class="logo" src="{{ asset('images/logoH.png') }}" alt="Logo CARTONBOL" />

            <form id="formulario-iniciar-sesion">
      
                <div class="control">
                    <!--<label for="exampleInputEmail1">Nombre:</label>-->
                    <input type="text" name='nombre' class="form-control" placeholder="Ingrese su nombre completo" v-model="nombre">
                </div>
                <div class="control">
                    <input type="email" name='email' class="form-control" placeholder="Ingrese su correo electrónico" v-model="email">
                </div>
                <div class="control">
                    <input type="password" name='contrasena' class="form-control" placeholder="Ingrese su contraseña" v-model="pass1">
                </div>
                <div class="control">
                    <input type="password" name='contrasena_confirmacion' class="form-control" placeholder="Verificar su contraseña" v-model="pass2">
                </div>
                <div class="control">
                    <input type="number" name='celular' class="form-control" placeholder="Ingrese su número de celular" v-model="celular">
                </div>
                <div class="control">
                    <button @click="crearCuenta()" type="button" class="btn btn-primary btn-block mt-4">Regístrate</button>
                </div>
            </form>
            <p class="mt-3">
                ¿Ya tienes una cuenta? <a href="{{ route('login') }}">¡Inicia sesión!</a>
            </p>
        </div>
    </section>

@endsection

@section('scripts')
    
    <script>
        
       var app = new Vue({
           el:'#app',
           data:{
               nombre:'',
               email:'',
               pass1:'',
               pass2:'',
               celular:''
           },
           methods:{
               crearCuenta: function(){
                let _this = this;
                    $.ajax({
                        method: 'post',
                        url: '{{ route('registro') }}',
                        data: {
                            nombre:this.nombre,
                            email:this.email,
                            contrasena:this.pass1,
                            contrasena_confirmation:this.pass2,
                            celular:this.celular
                        },
                        success: function(res) {
                            _this.nombre = '';
                            _this.email = '';
                            _this.pass1 = '';
                            _this.pass2 = '';
                            _this.celular = '';
                            swal({
                                title: 'Te has registrado',
                                text: 'Tu cuenta ha sido creada',
                                icon: 'success',
                                closeOnEsc: false,
                                closeOnClickOutside: false,
                            }).then( function () {
                                location.reload();
                            }); // success, info, error y warning
                        },
                        error: function(error) {
                            let errores = error.responseJSON.errors;
                            let mensaje = 'Error en el servidor';
                            if (errores.hasOwnProperty('nombre')){
                                mensaje = errores.nombre[0];
                            }else  if (errores.hasOwnProperty('email')){ 
                                mensaje = errores.email[0];
                                    
                            }else  if (errores.hasOwnProperty('contrasena')){ 
                                mensaje = errores.contrasena[0];
                                    
                            }else{
                                mensaje = errores.login[0];
                            }
                            swal('Error', mensaje,'error');
                        }
                    });
               }
           }
       });
    </script>

@endsection