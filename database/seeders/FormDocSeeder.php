<?php

namespace Database\Seeders;

use App\Models\FormDoc;
use App\Models\FormDocType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormDocSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {

    $permisoSalidaTypeForm = FormDocType::where('name', 'permiso_salida')->first();

    $formsDocs = [
      [
        'name' => 'Permiso de Salida - Autorizando Contraparte',
        'code_name' => 'autoriza-padre-madre',
        'field_requests' => json_encode(
          [
            [
              "fields" => [
                [
                  "name" => "padre_madre",
                  "label" => "Padre o Madre del menor",
                  "type" => "select",
                  "rules" => [
                    "required"
                  ],
                  "options" => [
                    [
                      "value" => "Padre",
                      "label" => "Padre"
                    ],
                    [
                      "value" => "Madre",
                      "label" => "Madre"
                    ]
                  ]
                ]
              ]
            ],
            [
              "name" => "Datos del Menor",
              "fields" => [
                [
                  "name" => "nombres_menor",
                  "label" => "Nombres del Menor",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "apellidos_menor",
                  "label" => "Apellidos del Menor",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "cedula_menor",
                  "label" => "Cédula del Menor",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ]
              ]
            ],
            [
              "name" => "Autoriza a (Acompañante)",
              "fields" => [
                [
                  "name" => "nombres_autoriza",
                  "label" => "Nombres",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "apellidos_autoriza",
                  "label" => "Apellidos",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "cedula_autoriza",
                  "label" => "Cédula de autorización",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ]
              ]
            ],
            [
              "name" => "Destino",
              "fields" => [
                [
                  "name" => "pais_destino",
                  "label" => "País",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "ciudad_destino",
                  "label" => "Ciudad",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "motivo_destino",
                  "label" => "Motivo",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "fecha_salida_pais",
                  "label" => "Fecha de Salida del País",
                  "type" => "date",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "fecha_retorno_pais",
                  "label" => "Fecha de regreso del País",
                  "type" => "date",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "direccion_destino",
                  "label" => "Dirección de destino",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ]
              ]
            ]
          ],
          true
        ),
        'body' => 'Permiso de Salida - Autorizando Cont ${nombre}',
        'form_type_id' => $permisoSalidaTypeForm->id
      ],
      [
        'name' => 'Permiso de Salida - Menor viaja solo',
        'code_name' => 'menor-edad-viaja-solo',
        'field_requests' => json_encode(
          [
            [
              "fields" => [
                [
                  "name" => "nombres_padres_madre",
                  "label" => "Nombres del Representante",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "apellido_padres_madre",
                  "label" => "Apellidos del Representante",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "nacionalidad_padres_madre",
                  "label" => "Nacionalidad del Representante",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "identificacion_padres_madre",
                  "label" => "Identificación del Representante",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ]
              ]
            ],
            [
              "name" => "Datos del Menor",
              "fields" => [
                [
                  "name" => "nombres_menor",
                  "label" => "Nombres del Menor",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "apellidos_menor",
                  "label" => "Apellidos del Menor",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "cedula_menor",
                  "label" => "Cédula del Menor",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ]
              ]
            ],
            [
              "name" => "Destino",
              "fields" => [
                [
                  "name" => "pais_destino",
                  "label" => "País",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "ciudad_destino",
                  "label" => "Ciudad",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "motivo_destino",
                  "label" => "Motivo",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "fecha_salida_pais",
                  "label" => "Fecha de Salida del País",
                  "type" => "date",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "fecha_retorno_pais",
                  "label" => "Fecha de regreso del País",
                  "type" => "date",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "direccion_destino",
                  "label" => "Dirección de destino",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "telefono_destino",
                  "label" => "Teléfono de destino",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ]
              ]
            ]
          ],
          true
        ),
        'body' => 'Permiso de Salida - Autorizando Cont ${nombre}',
        'form_type_id' => $permisoSalidaTypeForm->id
      ],
      [
        'name' => 'Permiso de Salida - Poder especial',
        'code_name' => 'poder-especial',
        'field_requests' => json_encode([
          [
            "fields" => [
              [
                "name" => "nombres_padres_madre",
                "label" => "Nombres del Representante",
                "type" => "text",
                "rules" => [
                  "required"
                ]
              ],
              [
                "name" => "apellido_padres_madre",
                "label" => "Apellidos del Representante",
                "type" => "text",
                "rules" => [
                  "required"
                ]
              ],
              [
                "name" => "nacionalidad_padres_madre",
                "label" => "Nacionalidad del Representante",
                "type" => "text",
                "rules" => [
                  "required"
                ]
              ],
              [
                "name" => "identificacion_padres_madre",
                "label" => "Identificación del Representante",
                "type" => "text",
                "rules" => [
                  "required"
                ]
              ]
            ]
          ],
          [
            "name" => "Parte que cede poder especial",
            "fields" => [
              [
                "name" => "nombres_representante",
                "label" => "Nombres del Representante",
                "type" => "text",
                "rules" => [
                  "required"
                ]
              ],
              [
                "name" => "apellidos_representante",
                "label" => "Apellidos del Representante",
                "type" => "text",
                "rules" => [
                  "required"
                ]
              ],
              [
                "name" => "cedula_representante",
                "label" => "Cédula del Representante",
                "type" => "text",
                "rules" => [
                  "required"
                ]
              ]
            ]
          ],
          [
            "name" => "Datos del Menor",
            "fields" => [
              [
                "name" => "nombres_menor",
                "label" => "Nombres del Menor",
                "type" => "text",
                "rules" => [
                  "required"
                ]
              ],
              [
                "name" => "apellidos_menor",
                "label" => "Apellidos del Menor",
                "type" => "text",
                "rules" => [
                  "required"
                ]
              ],
              [
                "name" => "cedula_menor",
                "label" => "Cédula del Menor",
                "type" => "text",
                "rules" => [
                  "required"
                ]
              ]
            ]
          ],
          [
            "name" => "Autoriza",
            "fields" => [
              [
                "name" => "nombres_acompaniante",
                "label" => "Nombres del Acompañante",
                "type" => "text",
                "rules" => [
                  "required"
                ]
              ],
              [
                "name" => "apellidos_acompaniante",
                "label" => "Apellidos del Acompañante",
                "type" => "text",
                "rules" => [
                  "required"
                ]
              ],
              [
                "name" => "cedula_acompaniante",
                "label" => "Cédula del Acompañante",
                "type" => "text",
                "rules" => [
                  "required"
                ]
              ]
            ]
          ],
          [
            "name" => "Destino",
            "fields" => [
              [
                "name" => "pais_destino",
                "label" => "País",
                "type" => "text",
                "rules" => [
                  "required"
                ]
              ],
              [
                "name" => "ciudad_destino",
                "label" => "Ciudad",
                "type" => "text",
                "rules" => [
                  "required"
                ]
              ],
              [
                "name" => "motivo_destino",
                "label" => "Motivo",
                "type" => "text",
                "rules" => [
                  "required"
                ]
              ],
              [
                "name" => "fecha_salida_pais",
                "label" => "Fecha de Salida del País",
                "type" => "date",
                "rules" => [
                  "required"
                ]
              ],
              [
                "name" => "fecha_retorno_pais",
                "label" => "Fecha de regreso del País",
                "type" => "date",
                "rules" => [
                  "required"
                ]
              ],
              [
                "name" => "direccion_destino",
                "label" => "Dirección de destino",
                "type" => "date",
                "rules" => [
                  "required"
                ]
              ]
            ]
          ]
        ], true),
        'body' => 'Permiso de Salida - Autorizando Cont ${nombre}',
        'form_type_id' => $permisoSalidaTypeForm->id
      ],
    ];

    foreach ($formsDocs as $formDoc) {

      FormDoc::create($formDoc);
    }
  }
}
