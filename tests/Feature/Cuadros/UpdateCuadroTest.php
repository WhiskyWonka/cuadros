<?php

namespace Tests\Feature\Cuadros;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cuadro;
use Tests\TestCase;

class UpdateCuadroTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_update_cuadro()
    {
        $cuadro = factory(Cuadro::class)->create();

        $attributes = [
            1,
            'painter' => 'Juan Carlos',
        ];

        $response = $this->withHeaders([
            'X-HTTP-USER-ID' => '1',
        ])->putJson(route('api.v1.cuadros.update', $attributes));

        $response->assertExactJson([
            'data' => [
                'type' => 'cuadros',
                'id' => (string) $cuadro->getRouteKey(),
                'attributes' => [
                    'name' => $cuadro->name,
                    'painter' => $attributes['painter'],
                    'country' => $cuadro->country,
                ],
                'links' => [
                    'self' => route('api.v1.cuadros.show', $cuadro)
                ]
            ]
        ]);
    }
}
