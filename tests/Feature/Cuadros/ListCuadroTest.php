<?php

namespace Tests\Feature\Cuadros;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cuadro;
use Tests\TestCase;

class ListCuadroTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_single_cuadro()
    {
        $this->withoutExceptionHandling();

        $cuadro = factory(Cuadro::class)->create();

        $response = $this->withHeaders([
            'X-HTTP-USER-ID' => '1',
        ])->getJson(route('api.v1.cuadros.show', $cuadro));

        $response->assertExactJson([
            'data' => [
                'type' => 'cuadros',
                'id' => (string) $cuadro->getRouteKey(),
                'attributes' => [
                    'name' => $cuadro->name,
                    'painter' => $cuadro->painter,
                    'country' => $cuadro->country,
                ],
                'links' => [
                    'self' => route('api.v1.cuadros.show', $cuadro)
                ]
            ]
        ]);
    }

    /** @test */
    public function can_fetch_all_cuadros()
    {

        $cuadros = factory(Cuadro::class)->times(3)->create();

        $response = $this->withHeaders([
            'X-HTTP-USER-ID' => '1',
        ])->getJson(route('api.v1.cuadros.index'));

        $response->assertExactJson([
            'data' => [
                        [
                            'type' => 'cuadros',
                            'id' => (string) $cuadros[0]->getRouteKey(),
                            'attributes' => [
                                'name' => $cuadros[0]->name,
                                'painter' => $cuadros[0]->painter,
                                'country' => $cuadros[0]->country,
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
                                'country' => $cuadros[1]->country,
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
                                'country' => $cuadros[2]->country,
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
