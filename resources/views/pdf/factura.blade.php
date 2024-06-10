<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
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
                    <img src="https://scontent.flpb3-2.fna.fbcdn.net/v/t39.30808-6/359830903_292716540085967_8746830458050815562_n.jpg?stp=dst-jpg_s960x960&_nc_cat=104&ccb=1-7&_nc_sid=5f2048&_nc_ohc=yUOZEUudjcsQ7kNvgG8r0kJ&_nc_ht=scontent.flpb3-2.fna&oh=00_AYBmY27DkaCsGy2uOTUBh-ckMYF4D9LpWzQ0zjlxeZ9JnA&oe=666178CA" alt="Logo de la Universidad">
                </div>
                <div class="factura-titulo">
                    <h1>Universidad Franz Tamayo</h1>
                    <p>Factura N: {{ $bills->id }}</p>
                    <p>C. Héroes del Acre esq. Landaeta, No. 1855</p>
                    <p>La Paz-Bolivia</p>
                    <p>Tel: +591 (2) 2487700</p>
                </div>
            </header>
            <section class="detalles">
                <div class="universidad-detalles"></div>
                <div class="estudiante-detalles">
                    <p><strong>Fecha:</strong> {{ $bills->created_at->format('d/m/Y') }}</p>
                    <p><strong>Nombre Estudiante:</strong> </p>
                    <p><strong>ID Estudiante:</strong> </p>
                    <p><strong>Razón Social:</strong> {{ $bills->social_reason }}</p>
                    <p><strong>NIT:</strong> {{ $bills->nit }}</p>
                </div>
            </section>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Descuento</th>
                        <th>SubTotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $bills->bill_code }}</td>
                        <td>1.00</td>
                        <td>{{ number_format($bills->paid_ammount, 2) }}</td>
                        <td>0.00</td>
                        <td>{{ number_format($bills->paid_ammount, 2) }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"><strong>Total</strong></td>
                        <td><strong>{{ number_format($bills->paid_ammount, 2) }}</strong></td>
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
