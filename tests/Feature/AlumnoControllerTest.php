<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Alumno; // Asegúrate de que esta ruta sea correcta: App\Models\Alumno

class AlumnoControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_se_listan_alumnos()
    {
        $alumnos = Alumno::factory()->count(2)->create();

        $response = $this->get('/alumnos');

        $response->assertStatus(200);
        $response->assertViewIs('alumnos.index');
        $response->assertSee($alumnos[0]->nombre);
        $response->assertSee($alumnos[1]->nombre);
    }

    public function test_se_muestra_formulario_de_creacion_de_alumno()
    {
        $response = $this->get('/alumnos/create');

        $response->assertStatus(200);
        $response->assertViewIs('alumnos.create');
    }

    public function test_se_puede_crear_un_alumno()
    {
        // === CAMBIOS AQUÍ: Se agregan todos los campos obligatorios ===
        $datosNuevoAlumno = [
            'codigo' => $this->faker->unique()->randomNumber(8),
            'nombre' => $this->faker->name,
            'correo' => $this->faker->unique()->safeEmail,
            'fecha_nacimiento' => '2000-01-01', // Usamos un valor fijo para simplificar
            'sexo' => 'M', // Usamos 'M' o 'F'
            'carrera' => 'Ingeniería en Sistemas', // Usamos una carrera válida
        ];

        $response = $this->post('/alumnos', $datosNuevoAlumno);

        // Si el controlador valida (requiere todos los campos), esto debería pasar a 302
        $response->assertStatus(302); 
        
        $this->assertDatabaseHas('alumnos', [
            'correo' => $datosNuevoAlumno['correo']
        ]);
        $response->assertRedirect('/alumnos'); 
    }

    public function test_se_muestra_detalle_de_alumno()
    {
        $alumno = Alumno::factory()->create();

        $response = $this->get('/alumnos/' . $alumno->id);

        $response->assertStatus(200);
        $response->assertViewIs('alumnos.show');
        $response->assertSee($alumno->nombre); 
    }

    public function test_se_muestra_formulario_de_edicion_de_alumno()
    {
        $alumno = Alumno::factory()->create();

        $response = $this->get('/alumnos/' . $alumno->id . '/edit');

        $response->assertStatus(200);
        $response->assertViewIs('alumnos.edit');
        $response->assertSee($alumno->nombre); 
    }

    public function test_se_puede_editar_un_alumno()
    {
        $alumno = Alumno::factory()->create();

        // === CAMBIOS AQUÍ: Se agregan todos los campos obligatorios para el PUT/PATCH ===
        // Debes enviar todos los campos que el método update de tu controlador requiera
        $nuevosDatos = [
            'codigo' => 'NUEVO_CODIGO',
            'nombre' => 'Nombre Editado',
            'correo' => $alumno->correo, // Mantener o cambiar. Si es requerido, debe estar aquí.
            'fecha_nacimiento' => $alumno->fecha_nacimiento,
            'sexo' => $alumno->sexo,
            'carrera' => 'Psicología', // Solo cambiamos la carrera
        ];

        $response = $this->put('/alumnos/' . $alumno->id, $nuevosDatos);

        $response->assertStatus(302);
        
        $this->assertDatabaseHas('alumnos', [
            'id' => $alumno->id,
            'nombre' => 'Nombre Editado', // Verificamos el cambio
            'carrera' => 'Psicología', // Verificamos el otro cambio
        ]);
        
        // Esta aserción de "DatabaseMissing" ahora falla porque el nombre anterior es diferente, pero
        // si solo queremos verificar el cambio, la aserción anterior es suficiente. 
        // La mantengo como la tenías, pero puede ser redundante.
        $this->assertDatabaseMissing('alumnos', [
            'nombre' => $alumno->nombre,
        ]);
        
        $response->assertRedirect('/alumnos');
    }

    public function test_se_puede_eliminar_un_alumno()
    {
        $alumno = Alumno::factory()->create();

        $response = $this->delete('/alumnos/' . $alumno->id);

        $response->assertStatus(302);
        $this->assertDatabaseMissing('alumnos', [
            'id' => $alumno->id,
        ]);
        $response->assertRedirect('/alumnos');
    }
}
