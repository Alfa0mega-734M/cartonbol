@extends('layouts.principal')
@section('styles')
    <style>
        .nav-principal{
            box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
        }

        .logo-productos{
            width: 180px;
        }

        .buscador{
            width: 90px !important;
        }

        .btn-registrate{
            border:1px solid #707070;
            border-radius: 10px;
            padding: 7px 15px !important;
        }

        .img-caja{
            width: 270px;
            height: 270px;
            margin: 0 auto;
            object-fit: cover;
        }     
    </style>
@endsection

@section('contenido')

<nav class="navbar navbar-expand-lg navbar-light bg-light nav-principal">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logoH.png') }}" class="logo-productos" alt="">
        </a>
        
        <div class="table-responsive col-md-8 mt-2">

            <h4 class="text-center">DETALLE DEL PRODUCTO SELECCIONADO</h4>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        

        <div class="collapse navbar-collapse justify-content-between align-items-center" id="navbarTogglerDemo03">
            

            <ul class="navbar-nav mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cerrar-sesion') }}">Cerrar Sesión</a>
                </li>
            </ul>
            
        </div>

    </div>

</nav>

<section class="container">    
    <div class="row mb-5" v-show='!mostrandoCarrito'>   

        <div class="col-md-2 mt-5"></div>
        <div class="col-md-3 mt-5">
            <img src="{{ asset('images/caja.png') }}" class="img-caja img-thumbnail img-responsive" alt="">                            
        </div>
        <div class="col-md-6 mt-4">
            

            <h4 class="text-left font-weight-bold" v-text='seleccionado.nombre'></h4>
             <p><strong> Precio: </strong> Bs./ <span>@{{ seleccionado.precio_unitario_act }}</span></p>
             <p>
                <strong> Ancho: </strong><span>@{{ seleccionado.ancho }}</span> </p>
               <strong> Largo: </strong><span>@{{ seleccionado.largo }}</span>
                <strong> Alto: </strong><span>@{{ seleccionado.alto }}</span>
            </p>            


            
             <p>
                <strong v-if='seleccionado.calidad'> Calidad: </strong><span>@{{ seleccionado.calidad.nombre }}</span> 
                <strong> Tipo lamina: </strong><span>@{{ seleccionado.tipo_lamina.nombre }}</span>
            </p>  

            <p>
                <strong> Cantidad disponible: </strong> <span>@{{ seleccionado.ordenes_de_produccion[0].cant_act }}</span>
            </p>
            



            <h6 class="text-left">Cantidad solicitada: </h6>
            
            <div class="input-group col-md-5">
                <input class="form-control" type="number" step="50" value="50" min="50" pattern="^[0-9]+" v-model="cantidad">
                <div class="input-group-append">
                  <span class="input-group-text">Unidades</span>
                </div>
              </div>
            
            <a class="btn btn-primary mt-3" href="#" role="button" @click.prevent="agregarCarrito(seleccionado)">AÑADIR PRODUCTO</a>
            <a class="btn btn-success mt-3" href="{{ route('index') }}" role="button">SEGUIR BUSCANDO</a>



            <p class="mt-3">
                <a class="btn btn-danger" id="detalleVenta" @click.prevent="mostrarCarrito" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Mostrar productos añadidos</a>
            </p>

        </div>

    </div>      











    <div class="row mb-5 detalleCompra" v-show='mostrandoCarrito' >   

        <div class="col-11 text-right">
            <a class="btn btn-success mt-3" href="{{ route('index') }}" role="button">SEGUIR BUSCANDO</a>
        </div>
        
        <div class="table-responsive col-md-12 mt-5">
            <h6 v-if="carrito.length>1">Su carrito contiene: @{{ carrito.length}} productos</h6>
            <h6 v-else>Su carrito contiene: @{{ carrito.length}} producto</h6>
                <table class="table table-hover text-center">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio Unitario</th>
                        <th scope="col">Sub Total</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="item in carrito">
                        <th scope="row" v-text="item.id"></th>
                        <td v-text="item.nombre"></td>
                        <td v-text="item.cantidad"></td>
                        <td v-text="item.precioU"></td>
                        <td v-text="item.subTotal"></td>
                        <td><a class="btn btn-success mt-3" href="{{ route('index') }}" role="button">EDITAR</a></td>
                        <td><a class="btn btn-danger mt-3" role="button" @click="eliminar(carrito)">ELIMINAR</a></td>
                      </tr>
                    </tbody>
                </table>
            
              <h5>Total a pagar: @{{ suma }}</h5>
        </div>
        <div class="col text-center">
            <a class="btn btn-primary mt-3" href="{{ route('comprobantePDF') }}" role="button" onclick="generarComprobante()" target="_blank">REALIZAR COMPRA</a>
        </div>
        
    </div>



   
  </section>


@endsection 

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>

    function productoAgregado(){
        swal({
            closeOnClickOutside: false,
            closeOnEsc: false,
            title: "¡Producto añadido!",
            text: "Se ha añadido la cantidad indicada",
            icon: "success",
            button: "Aceptar!",
        });
    }

    function generarComprobante(){
        swal({
            closeOnClickOutside: false,
            closeOnEsc: false,
            title: "¡Compra realizada!",
            text: "Generando comprobante...",
            icon: "success",
            button: "Aceptar!",
        });
    }

    function noSeleccionado(){
        swal({
            closeOnClickOutside: false,
            closeOnEsc: false,
            title: "Oops...",
            text: "¡Debe seleccionar un producto!",
            icon: "error",
            button: "Ok"
        })
        .then((value) => {
            window.location="/";
        });
    }

    function productoEliminado(){
        swal({
            title: "¿Esta seguro?",
            text: "El producto seleccionado se eliminará",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            swal("¡El producto ha sido eliminado", {
            icon: "success",
            });
        } else {
            swal("¡El producto no se eliminó!",{
                icon: "error"
            });
            
        }
        });
    }

    function limpiar(){
        localStorage.clear();
    }


    $(".detalleCompra").hide();
    
    function mostrarDetalleVenta(){
        let text = "";
        if($("#detalleVenta").text() === "Mostrar productos añadidos"){
            $(".row").hide();
            $(".detalleCompra").show();
            text = "Seguir añadiendo productos";
        }else{
            $(".row").show();
            $(".detalleCompra").hide();
            text = "Mostrar productos añadidos";
        }
        $("#detalleVenta").html(text);
    }


    const app = new Vue({
        el: '#app',
        data:{
            seleccionado: null,
            carrito: [],
            cantidad: 0,
            mostrandoCarrito:false
        },
        mounted(){     
            
            if (localStorage.length > 0){
                this.seleccionado = JSON.parse(localStorage.getItem('producto'))
            }else{
                noSeleccionado()
                    
            }
        },
        methods: {
            agregarCarrito: function(seleccionado){  
                                
                productoAgregado();
                this.carrito.push(
                    {
                        id:seleccionado.codigo,
                        nombre:seleccionado.nombre,
                        cantidad:Number(this.cantidad),
                        precioU:seleccionado.precio_unitario_act,
                        subTotal:seleccionado.precio_unitario_act*this.cantidad,
                    }
                )  
                localStorage.setItem('carrito',JSON.stringify(this.carrito))
                
            },
            eliminar: function(carrito){
                productoEliminado();
                carrito.splice(0,1)
                this.mostrandoCarrito=true;
                localStorage.setItem('carrito',JSON.stringify(this.carrito))                
            },
            mostrarCarrito(){
                this.mostrandoCarrito=true;
            },
            ocultarCarrito(){
                this.mostrandoCarrito=false;
            }
        },
        
        computed:{
			suma(){
				var total = 0
				for (var i=0;i<this.carrito.length;i++) {
			    	total+=parseFloat(this.carrito[i].subTotal)
				}
				return total	
			}
        }
					
        
    })


</script>


@endsection