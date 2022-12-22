<?php

namespace Tests\Feature\Cuadros;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cuadro;
use Tests\TestCase;

class FilterCuadroTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_filter_cuadros()
    {
        $cuadros[] = factory(Cuadro::class)->create(['painter' => 'H.R. Giger']);
        $cuadros[] = factory(Cuadro::class)->create(['painter' => 'H.R. Giger']);
        factory(Cuadro::class)->create();
        factory(Cuadro::class)->create();

        $response = $this->withHeaders([
            'X-HTTP-USER-ID' => '1',
        ])->getJson(route('api.v1.cuadros.index', ['filters' => ['painter' => 'H.R. Giger']]));

        $response->assertExactJson([
            'data' => [
                        [
                            'type' => 'cuadros',
                            'id' => (string) $cuadros[0]->getRouteKey(),
                            'attributes' => [
                                'name' => $cuadros[0]->name,
                                'painter' => 'H.R. Giger',
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
                                'painter' => 'H.R. Giger',
                                'country' => $cuadros[1]->country,
                            ],
                            'links' => [
                                'self' => route('api.v1.cuadros.show', $cuadros[1])
                            ]
                        ]
                    ],
                    'links' => [
                        'self' => route('api.v1.cuadros.index')
                    ]
        ]);
    }
}
