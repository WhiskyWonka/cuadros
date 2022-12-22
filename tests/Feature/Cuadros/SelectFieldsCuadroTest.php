<?php

namespace Tests\Feature\Cuadros;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cuadro;
use Tests\TestCase;

class SelectFieldsCuadroTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_fetch_specific_fields()
    {
        $cuadros = factory(Cuadro::class)->times(3)->create();

        $response = $this->withHeaders([
            'X-HTTP-USER-ID' => '1',
        ])->getJson(route('api.v1.cuadros.index', ['fields' => 'name,painter']));

        $response->assertExactJson([
            'data' => [
                        [
                            'type' => 'cuadros',
                            'id' => (string) $cuadros[0]->getRouteKey(),
                            'attributes' => [
                                'name' => $cuadros[0]->name,
                                'painter' => $cuadros[0]->painter,
                            ],
                            'links' => [
                                'self' => route('api.v1.cuadros.show', $cuadros[0])
                            ]
                        ],
                        [
                            'type' => 'cuadros',
                            'id' => (string) $cuadros[1]->getRouteKey(),
                            'attributes' => [
                                'name' => $cuadros[1]->name,
                                'painter' => $cuadros[1]->painter,
                            ],
                            'links' => [
                                'self' => route('api.v1.cuadros.show', $cuadros[1])
                            ]
                        ],
                        [
                            'type' => 'cuadros',
                            'id' => (string) $cuadros[2]->getRouteKey(),
                            'attributes' => [
                                'name' => $cuadros[2]->name,
                                'painter' => $cuadros[2]->painter,
                            ],
                            'links' => [
                                'self' => route('api.v1.cuadros.show', $cuadros[2])
                            ]
                        ]
                    ],
                    'links' => [
                        'self' => route('api.v1.cuadros.index')
                    ]
        ]);
    }
}
