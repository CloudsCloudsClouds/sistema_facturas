<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
<style>
        /* Estilos CSS */
        .contenedor {
            font-family: 'Arial', sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #f97316;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 150px;
        }
        .factura-titulo {
            text-align: right;
        }
        .factura-titulo h1 {
            color: #f97316;
            margin: 0;
            font-size: 24px;
        }
        .detalles {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .universidad-detalles h2 {
            color: #f97316;
            margin: 0 0 10px 0;
        }
        .estudiante-detalles p {
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f97316;
            color: white;
        }
        tfoot td {
            font-weight: bold;
            background-color: #f9f9f9;
        }
        footer {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <div class="factura-box">
            <header>
                <div class="logo">
                    <img src="URL_DEL_LOGO" alt="Logo de la Universidad">
                </div>
                <div class="factura-titulo">
                    <h1>Universidad Franz Tamayo</h1>
                    <p>Factura N: {{ $bill->bill_code }}</p>
                    <p>C. Héroes del Acre esq. Landaeta, No. 1855</p>
                    <p>La Paz-Bolivia</p>
                    <p>Tel: +591 (2) 2487700</p>
                </div>
            </header>
            <section class="detalles">
                <div class="universidad-detalles"></div>
                <div class="estudiante-detalles">
                    <p><strong>Fecha:</strong> {{ $bill->created_at->format('d/m/Y') }}</p>
                    <p><strong>Nombre Estudiante:</strong> {{ $person->name }}</p>
                    <p><strong>ID Estudiante:</strong> {{ $person->ci }}</p>
                    <p><strong>Carrera:</strong> {{ $career->name }}</p>
                    <p><strong>Razón Social:</strong> {{ $bill->social_reazon }}</p>
                    <p><strong>NIT:</strong> {{ $bill->nit }}</p>
                </div>
            </section>
                <table>
                    <thead>
                        <tr>
                            <th>Items</th>
                            <th>Precio Unitario</th>
                            <th>SubTotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $cumulativeTotal = 0; @endphp
                        @foreach($payments as $payment)
                            @php
                                $cumulativeTotal += $payment->ammount; // Sumar el monto del pago al acumulador
                            @endphp
                            <tr>
                                <td>{{ $payment->debt->description }}</td>
                                <td>Bs. {{ number_format($payment->ammount, 2) }}</td>
                                <td>Bs. {{ number_format($cumulativeTotal, 2) }}</td> <!-- Mostrar el acumulador -->
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"><strong>Total</strong></td>
                            <td><strong>Bs. {{ number_format($cumulativeTotal, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            <footer>
                <p>Gracias por su pago.</p>
            </footer>
        </div>
    </div>
</body>
</html>
