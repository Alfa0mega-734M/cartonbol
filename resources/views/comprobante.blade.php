<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Comprobante</title>
    <link rel="stylesheet" href="style.css">
    <style>

        *{
            margin: 5px 0px 0px 0px;
            padding: 0;
            box-sizing: border-box;
        }
        p, label, span, table{
            font-family: 'BrixSansRegular';
            font-size: 9pt;
        }
        .h2{
            font-family: 'BrixSansBlack';
            font-size: 23px;
            font-weight: bold;
        }
        .h3{
            font-family: 'BrixSansBlack';
            font-size: 12pt;
            display: block;
            background: #8B5B29;
            color: #FFF;
            text-align: center;
            padding: 3px;
            margin-bottom: 1px;
        }
        #page_pdf{
            width: 90%;
            margin: 15px auto 10px auto;
        }

        #factura_head, #factura_cliente, #factura_detalle{
            width: 100%;
            margin-bottom: 10px;
        }
        .logo{
            width: 30%;
        }
        .info_empresa{
            width: 50%;
            text-align: center;
        }
        .info_factura{
            width: 20%;
        }
        .info_cliente{
            width: 100%;
        }
        .datos_cliente{
            width: 100%;
        }
        .datos_cliente tr td{
            width: 95%;
        }
        .datos_cliente{
            padding: 0 5px 0 0;
            text-align: right;
        }
        .datos_cliente label{
            width: 120px;
            display: inline-block;
        }
        .datos_cliente p{
            display: inline-block;
        }

        .textright{
            text-align: right;
        }
        .textleft{
            text-align: left;
        }
        .textcenter{
            text-align: center;
        }
        .round{
            border-radius: 10px;
            border: 2px solid #BA9E66;
            overflow: hidden;
            padding-bottom: 5px;
            text-align: right;
        }
        .round p{
            padding: 0 15px;
        }

        #factura_detalle{
            border-collapse: collapse;
        }
        #factura_detalle thead th{
            background: #8B5B29;
            color: #fff;
            padding: 5px;
        }
        #detalle_productos tr:nth-child(even) {
            background: #fdd78a;
        }
        #detalle_productos tr:nth-child(odd) {
            background: #f2d7a0;
        }
        #detalle_totales span{
            font-family: 'BrixSansBlack';
        }
        .nota{
            font-size: 8pt;
        }
        .label_gracias{
            font-family: verdana;
            font-weight: bold;
            font-style: italic;
            text-align: center;
            margin-top: 20px;
        }
        .fecha{
            margin: 0 auto;
            
        }
        .fecha_{
            font-size: 16px;
            padding: 0 10px 0 10px;
        }
        hr{
            color: #8B5B29;
        }
    </style>
</head>
<body>
<div id="page_pdf">
	<table id="factura_head">
		<tr>
			<td class="logo_factura">
				<div>
					<img src="https://cartonbol.com.bo/wp-content/uploads/2021/09/2-LOGO-PNG-1024x445.png" class="logo" alt="">
				</div>
			</td>
			<td class="info_empresa">
				<div>
					<span class="h2">COMPROBANTE DE COMPRA</span>
					<p>Av. 24 de junio KM 3 1/2 carretera a Vinto</p>
					<p>Teléfonos: (+591 2) 5117709 - (+591 2) 5117712</p>
                    <p>Línea gratuita: 800 10 0077</p>
					<p>Email: ventas@cartonbol.com.bo</p>
				</div>
			</td>
            <td class="info_factura">
				<div class="round">
					<span class="h3">Información</span>
					<p><b>No.:</b> 000001</p>
                    <p><b>NIT:</b> 153462021</p>
                    <span class="h3">Fecha</span>
                        <table class="fecha">
                            <tr>                            
                                <td class="fecha_">{{ date('d') }}</td>
                                <td class="fecha_">{{ date('m') }}</td>
                                <td class="fecha_">{{ date('Y') }}</td>
                            </tr>
                        </table>
                    
					<!--<p><b>Fecha:</b> {{ date('d-m-Y') }}</p>
					<p><b>Hora:</b> {{ date('H:i:s') }}</p>-->
                    
				</div>
			</td>
		</tr>
	</table>
	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<span class="h3">Cliente</span>
					<table class="datos_cliente">
						<tr>
							<td><label><b>NIT:</b></label><p>54895468</p></td>
							<td><label><b>Celular:</b></label> <p>75426858</p></td>
						</tr>
						<tr>
							<td><label><b>Nombre:</b></label> <p>Angel Arana Cabrera</p></td>
							<td><label><b>Dirección:</b></label> <p>Calzada Buena Vista</p></td>
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>
    
	<table id="factura_detalle">
        <hr>
			<thead>
				<tr>
                    <th width="50px">Nro.</th>
					<th width="50px">Cant.</th>
					<th class="textleft">Descripción</th>
					<th class="textright" width="150px">Precio Unitario.</th>
					<th class="textright" width="150px"> Precio Total</th>                    
				</tr>
			</thead>
			<tbody id="detalle_productos">
				<tr>
                    <td class="textcenter">1</td>
					<td class="textcenter">15</td>
					<td>Caja modelo 102</td>
					<td class="textright">516.67</td>
					<td class="textright">516.67</td>
				</tr>
				<tr>
                    <td class="textcenter">2</td>
					<td class="textcenter">18</td>
					<td>Caja modelo 301</td>
					<td class="textright">516.67</td>
					<td class="textright">516.67</td>
				</tr>
				<tr>
                    <td class="textcenter">3</td>
					<td class="textcenter">3</td>
					<td>Caja modelo 3</td>
					<td class="textright">516.67</td>
					<td class="textright">516.67</td>
				</tr>
				<tr>
                    <td class="textcenter">4</td>
					<td class="textcenter">50</td>
					<td>Caja modelo 10</td>
					<td class="textright">516.67</td>
					<td class="textright">516.67</td>
				</tr>
				<tr>
                    <td class="textcenter">5</td>
					<td class="textcenter">9</td>
					<td>Caja modelo 9</td>
					<td class="textright">516.67</td>
					<td class="textright">516.67</td>
				</tr>
				<tr>
                    <td class="textcenter">6</td>
					<td class="textcenter">10</td>
					<td>Caja modelo 5</td>
					<td class="textright">516.67</td>
					<td class="textright">516.67</td>
				</tr>
			</tbody>
            
			<tfoot id="detalle_totales">
				
				<tr>
					<td colspan="4" class="textright"><span><b>TOTAL</b></span></td>
					<td class="textright"><span>12516.67</span></td>
				</tr>
		    </tfoot>
	</table>
	<div>
		<p class="nota">Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con nombre, teléfono y Email</p>
		<br>
        <h4 class="label_gracias">¡Gracias por su compra!</h4>
	</div>

</div>
</body>
</html>