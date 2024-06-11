<style>
    .contenedor {
        font-family: 'Arial', sans-serif;
        background-color: white;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .contenedor-centro {
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
        max-width: 100px;
    }

    .titulo-reporte {
        text-align: right;
    }

    .titulo-reporte h1 {
        color: #f97316;
        margin: 0;
        font-size: 24px;
    }

    .detalles {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .detalles-universidad h2 {
        color: #f97316;
        margin: 0 0 10px 0;
    }

    .detalles-estudiante p {
        margin: 0;
    }

    .contenido-reporte {
        margin-bottom: 20px;
    }

    .contenido-reporte h2 {
        color: #f97316;
        margin-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f97316;
        color: white;
    }

    footer {
        text-align: center;
        font-size: 14px;
        margin-top: 20px;
        color: #777;
    }
</style>



<div class="contenedor">
    <div class="contenedor-centro">
        <div class="caja-reporte">
            <header>
                <div class="logo">
                    <img src='../../../public/images/uni-logo2.png' alt="Logo de la Universidad">
                </div>
                <div class="titulo-reporte">
                    <h1>Universidad Franz Tamayo</h1>
                    <p>Fecha: <?php echo date('d/m/y'); ?></p>

                </div>
            </header>

            <section class="contenido-reporte">
                <h2>Reporte de Sucuarsales</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Número</th>
                            <th>Correo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($campuses as $campus)
                            <tr>
                                <td>{{ $campus->id }}</td>
                                <td>{{ $campus->name }}</td>
                                <td>{{ $campus->direction }}</td>
                                <td>{{ $campus->number }}</td>
                                <td>{{ $campus->email }}</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </section>
            <footer>
                <p>Universidad Franz Tamayo</p>
            </footer>
        </div>
    </div>
</div>
