<?php

namespace Tests\Feature\Excel;

use App\Exports\UsersExport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class UsersExportTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function it_can_export_users_to_excel()
    {
        Excel::fake(); // Simular el comportamiento de Excel

        $response = $this->get('users-excel-export'); // Reemplaza "/export/users" por la ruta a tu controlador de exportación

        $response->assertOk(); // Asegurarse de que la respuesta sea exitosa

        Excel::assertDownloaded('users.xlsx', function (UsersExport $export) {
            // Realizar aserciones sobre el contenido de la exportación si es necesario
            // Por ejemplo, puedes verificar si los datos exportados son correctos
            return true;
        });
    }
}
