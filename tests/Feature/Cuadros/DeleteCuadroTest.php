<?php

namespace Tests\Feature\Cuadros;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cuadro;
use Tests\TestCase;

class DeleteCuadroTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_delete_cuadro()
    {
        $cuadro = factory(Cuadro::class)->create();

        $response = $this->withHeaders([
            'X-HTTP-USER-ID' => '1',
        ])->deleteJson(route('api.v1.cuadros.delete', $cuadro));

        $response->assertStatus(200);
    }
}
