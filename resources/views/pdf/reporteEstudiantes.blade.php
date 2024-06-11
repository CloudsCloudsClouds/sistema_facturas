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
                    {{-- <img src="../../images/uni-logo1.png" alt="Universidad Franz Tamayo" /> --}}

                    <img src="https://scontent.flpb3-2.fna.fbcdn.net/v/t39.jcsQ7kNvgG8r0kJ&_nc_ht=scontent.flpb3-2.fna&oh=00_AYBmY27DkaCsGy2uOTUBh-ckMYF4D9LpWzQ0zjlxeZ9JnA&oe=666178CA" alt="Logo de la Universidad">
                </div>
                <div class="titulo-reporte">
                    <h1>Universidad Franz Tamayo</h1>
                    <p>Fecha: <?php echo date('d/m/Y'); ?></p>

                </div>
            </header>

            <section class="contenido-reporte">
                <h2>Reporte de Estudiantes</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Email</th>
                            <th>Código</th>
                            <th>Plan de Pago</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estudiantes as $estudiante)
                        <tr>
                            <td>{{ $estudiante->id }}</td>
                            <td>{{ $estudiante->first_name }} {{ $estudiante->second_name }} {{ $estudiante->middle_name }} {{ $estudiante->last_name }}</td>
                            <td>{{ $estudiante->email }}</td>
                            <td>{{ $estudiante->code }}</td>
                            <td>{{ $estudiante->payment_plan_identifier }}</td>


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
