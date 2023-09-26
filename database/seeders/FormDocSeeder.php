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
                'field_requests' => "[{'fields': [  {'name': 'padre_madre', 'label': 'Padre o Madre del menor', 'type': 'select', 'options': [{ 'value': 'Padre', 'label': 'Padre'},{ 'value': 'Madre', 'label': 'Madre' }]  }]},   
                {'name': 'Datos del Menor', 'fields': [   {'name': 'nombres_menor', 'label': 'Nombres del Menor','type': 'text'  },  {'name': 'apellidos_menor', 'label': 'Apellidos del Menor' ,'type': 'text'  },  {'name': 'cedula_menor', 'label': 'Cédula del Menor' ,'type': 'text'  }  ] },
                {'name': 'Autoriza a (Acompañante)', 'fields': [   {'name': 'nombres_autoriza', 'label': 'Nombres','type': 'text'  },  {'name': 'apellidos_autoriza', 'label': 'Apellidos' ,'type': 'text'  }, {'name': 'cedula_autoriza', 'label': 'Cédula de autorización' ,'type': 'text'  }  ] },
                {'name': 'Destino', 'fields': [   {'name': 'pais_destino', 'label': 'País','type': 'text'  },  {'name': 'ciudad_destino', 'label': 'Ciudad' ,'type': 'text'  }, {'name': 'motivo_destino', 'label': 'Motivo' ,'type': 'text'  }, {'name': 'fecha_salida_pais', 'label': 'Fecha de Salida del País' ,'type': 'date'  }, {'name': 'fecha_retorno_pais', 'label': 'Fecha de regreso del País' ,'type': 'date'  }, {'name': 'direccion_destino', 'label': 'Dirección de destino' ,'type': 'text'  }  ] }
                ]",
                'body' => 'Permiso de Salida - Autorizando Cont ${nombre}',
                'form_type_id' => $permisoSalidaTypeForm->id
            ],
            [
                'name' => 'Permiso de Salida - Menor viaja solo',
                'code_name' => 'menor-edad-viaja-solo',
                'field_requests' => "[{'fields': [  {'name': 'nombres_padres_madre', 'label': 'Nombres del Representante', 'type': 'text'}, {'name': 'apellido_padres_madre', 'label': 'Apellidos del Representante','type': 'text'}, {'name': 'nacionalidad_padres_madre', 'label': 'Nacionalidad del Representante','type': 'text'}, {'name': 'identificacion_padres_madre', 'label': 'Identificación del Representante','type': 'text'} ]},   
                {'name': 'Datos del Menor', 'fields': [   {'name': 'nombres_menor', 'label': 'Nombres del Menor','type': 'text'  },  {'name': 'apellidos_menor', 'label': 'Apellidos del Menor' ,'type': 'text'  },  {'name': 'cedula_menor', 'label': 'Cédula del Menor' ,'type': 'text'  }  ] },
                {'name': 'Destino', 'fields': [   {'name': 'pais_destino', 'label': 'País','type': 'text'  },  {'name': 'ciudad_destino', 'label': 'Ciudad' ,'type': 'text'  }, {'name': 'motivo_destino', 'label': 'Motivo' ,'type': 'text'  }, {'name': 'fecha_salida_pais', 'label': 'Fecha de Salida del País' ,'type': 'date'  }, {'name': 'fecha_retorno_pais', 'label': 'Fecha de regreso del País' ,'type': 'date'  }, {'name': 'direccion_destino', 'label': 'Dirección de destino' ,'type': 'text'  }, {'name': 'telefono_destino', 'label': 'Teléfono de destino' ,'type': 'text'  }  ] }
                ]",
                'body' => 'Permiso de Salida - Autorizando Cont ${nombre}',
                'form_type_id' => $permisoSalidaTypeForm->id
            ],
            [
                'name' => 'Permiso de Salida - Poder especial',
                'code_name' => 'poder-especial',
                'field_requests' => "[
                    {
                       'fields':[
                          {
                             'name':'nombres_padres_madre',
                             'label':'Nombres del Representante',
                             'type':'text'
                          },
                          {
                             'name':'apellido_padres_madre',
                             'label':'Apellidos del Representante',
                             'type':'text'
                          },
                          {
                             'name':'nacionalidad_padres_madre',
                             'label':'Nacionalidad del Representante',
                             'type':'text'
                          },
                          {
                             'name':'identificacion_padres_madre',
                             'label':'Identificación del Representante',
                             'type':'text'
                          }
                       ]
                    },
                 {
                       'name':'Parte que cede poder especial',
                       'fields':[
                          {
                             'name':'nombres_representante',
                             'label':'Nombres del Representante',
                             'type':'text'
                          },
                          {
                             'name':'apellidos_representante',
                             'label':'Apellidos del Representante',
                             'type':'text'
                          },
                          {
                             'name':'cedula_representante',
                             'label':'Cédula del Representante',
                             'type':'text'
                          }
                       ]
                    },
                 
                    {
                       'name':'Datos del Menor',
                       'fields':[
                          {
                             'name':'nombres_menor',
                             'label':'Nombres del Menor',
                             'type':'text'
                          },
                          {
                             'name':'apellidos_menor',
                             'label':'Apellidos del Menor',
                             'type':'text'
                          },
                          {
                             'name':'cedula_menor',
                             'label':'Cédula del Menor',
                             'type':'text'
                          }
                       ]
                    },
                 {
                       'name':'Autoriza',
                       'fields':[
                          {
                             'name':'nombres_acompaniante',
                             'label':'Nombres del Acompañante',
                             'type':'text'
                          },
                          {
                             'name':'apellidos_acompaniante',
                             'label':'Apellidos del Acompañante',
                             'type':'text'
                          },
                          {
                             'name':'cedula_acompaniante',
                             'label':'Cédula del Acompañante',
                             'type':'text'
                          }
                       ]
                    },
                    {
                       'name':'Destino',
                       'fields':[
                          {
                             'name':'pais_destino',
                             'label':'País',
                             'type':'text'
                          },
                          {
                             'name':'ciudad_destino',
                             'label':'Ciudad',
                             'type':'text'
                          },
                          {
                             'name':'motivo_destino',
                             'label':'Motivo',
                             'type':'text'
                          },
                          {
                             'name':'fecha_salida_pais',
                             'label':'Fecha de Salida del País',
                             'type':'date'
                          },
                          {
                             'name':'fecha_retorno_pais',
                             'label':'Fecha de regreso del País',
                             'type':'date'
                          },
                          {
                             'name':'direccion_destino',
                             'label':'Dirección de destino',
                             'type':'date'
                          }
                       ]
                    }
                 ]",
                'body' => 'Permiso de Salida - Autorizando Cont ${nombre}',
                'form_type_id' => $permisoSalidaTypeForm->id
            ],
        ];

        foreach ($formsDocs as $formDoc) {

            FormDoc::create($formDoc);
        }
    }
}
