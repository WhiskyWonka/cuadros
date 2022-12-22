<?php

namespace Tests\Feature\Cuadros;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cuadro;
use Tests\TestCase;

class CreateCuadroTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_create_cuadro()
    {
        $attributes = [
            'name' => 'Titulo del cuadro',
            'painter' => 'Autor del cuadro',
            'country' => 'titulo-del-cuadro-1876',
        ];

        $response = $this->withHeaders([
            'X-HTTP-USER-ID' => '1',
        ])->postJson(route('api.v1.cuadros.create', $attributes));

        $response->assertExactJson([
            'data' => [
                'type' => 'cuadros',
                'id' => '1',
                'attributes' => $attributes,
                'links' => [
                    'self' => route('api.v1.cuadros.show', 1)
                ]
            ]
        ]);
    }
}
