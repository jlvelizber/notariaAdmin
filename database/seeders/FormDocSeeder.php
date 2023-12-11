<?php

namespace Database\Seeders;

use App\Models\Country;
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
    $countries = Country::selectRaw('name as value, name as label')->get()->toArray();


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
                ],
                [
                  "name" => "file_copia_cedula_solicitante", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
                  "label" => "Cédula del Solicitante",
                  "type" => "file",
                  "rules" => [
                    "required",
                    "mimetypes:application/pdf",
                    "min:2",
                    "max:4000",
                  ],

                ],
                [
                  "name" => "file_copia_cert_votacion_solicitante", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
                  "label" => "Certificado de votación del Solicitante",
                  "type" => "file",
                  "rules" => [
                    "required",
                    "mimetypes:application/pdf",
                    "min:2",
                    "max:4000",
                  ],

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
                ],
                [
                  "name" => "file_copia_cedula_menor", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
                  "label" => "Copia de cédula del Menor",
                  "type" => "file",
                  "rules" => [
                    "required",
                    "mimetypes:application/pdf",
                    "min:2",
                    "max:4000",
                  ],

                ],
                
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
                ],
                [
                  "name" => "contraparte_padre_madre",
                  "label" => "Parentezco con el menor",
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
                    ],
                    [
                      "value" => "Tio(a)",
                      "label" => "Tio(a)"
                    ],
                    [
                      "value" => "Abuelo(a)",
                      "label" => "Abuelo(a)"
                    ]
                  ]
                ],
                [
                  "name" => "nacionalidad_autoriza",
                  "label" => "Nacionalidad del Representante",
                  "type" => "select",
                  "rules" => [
                    "required"
                  ],
                  "options" => $countries,
                ],
                [
                  "name" => "file_copia_cedula_contraparte", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
                  "label" => "Cédula de la contraparte",
                  "type" => "file",
                  "rules" => [
                    "required",
                    "mimetypes:application/pdf",
                    "min:2",
                    "max:4000",
                  ],

                ],
                [
                  "name" => "file_copia_cert_votacion_contraparte", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
                  "label" => "Certificado de votación de la Contraparte",
                  "type" => "file",
                  "rules" => [
                    "required",
                    "mimetypes:application/pdf",
                    "min:2",
                    "max:4000",
                  ],

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
        'body' => '<html> <head> <meta content="text/html; charset=UTF-8" http-equiv="content-type"/> <style type="text/css"> @import url(https://themes.googleusercontent.com/fonts/css?kit=zqpv9qCntOqpqyzFcziM2jFXDelBu2lgpLV8Tx-HAlRP75axLavRt4ieiCjvg-DrxZ7lh1QoVH6YDMyH8cRI-xXqLjx64WtpvUDIJXcBSs0); ol{margin: 0; padding: 0;}table td, table th{padding: 0;}.doc-content{text-align: justify;}.c9{padding-top: 0pt; padding-bottom: 10pt; line-height: 1; orphans: 2; widows: 2; text-align: left;}.c5{padding-top: 0pt; padding-bottom: 0pt; line-height: 1.6666666666666667; orphans: 2; widows: 2; text-align: justify;}.c2{color: #000000; text-decoration: none; vertical-align: baseline; font-size: 12pt; font-style: normal;}.c7{background-color: #ffffff; /* max-width: 474.5pt; */ padding: 80pt 56.7pt 80pt 63.8pt;}.c3{font-weight: 400; font-family: "Calibri";}.c1{font-weight: 400; font-family: "Bookman Old Style";}.c0{font-weight: 700; font-family: "Bookman Old Style";}.c4{font-size: 13pt;}.c6{height: 12pt;}.c8{color: #ff0000;}.title{padding-top: 24pt; color: #000000; font-weight: 700; font-size: 36pt; padding-bottom: 6pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}.subtitle{padding-top: 18pt; color: #666666; font-size: 24pt; padding-bottom: 4pt; font-family: "Georgia"; line-height: 1; page-break-after: avoid; font-style: italic; orphans: 2; widows: 2; text-align: left;}li{color: #000000; font-size: 12pt; font-family: "Calibri";}p{margin: 0; color: #000000; font-size: 12pt; font-family: "Calibri";}h1{padding-top: 24pt; color: #000000; font-weight: 700; font-size: 24pt; padding-bottom: 6pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}h2{padding-top: 18pt; color: #000000; font-weight: 700; font-size: 18pt; padding-bottom: 4pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}h3{padding-top: 14pt; color: #000000; font-weight: 700; font-size: 14pt; padding-bottom: 4pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}h4{padding-top: 12pt; color: #000000; font-weight: 700; font-size: 12pt; padding-bottom: 2pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}h5{padding-top: 11pt; color: #000000; font-weight: 700; font-size: 11pt; padding-bottom: 2pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}h6{padding-top: 10pt; color: #000000; font-weight: 700; font-size: 10pt; padding-bottom: 2pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}</style> </head> <body class="c7 doc-content"> <p class="c5"> <span class="c2 c0">AB. MARIA DEL CARMEN CARVAJAL AYALA</span> </p><p class="c5"> <span class="c2 c0" >NOTARIA TITULAR CUARTA &nbsp;DEL CANT&Oacute;N DAULE</span > </p><p class="c5 c6"><span class="c2 c0"></span></p><p class="c5"> <span class="c1">Yo</span ><span class="c0">, $requestName, </span ><span class="c1">de nacionalidad $countryName,</span ><span class="c0">&nbsp;</span ><span class="c1" >portador de la c&eacute;dula de ciudadan&iacute;a n&uacute;mero</span ><span class="c0">&nbsp;$identification_num</span><span class="c1">,</span ><span class="c0">&nbsp;</span ><span class="c1" >por sus propios y personales derechos, como $padre_madre y representante del menor </span ><span class="c0">$nombres_menor $apellidos_menor, </span ><span class="c1" >portador de la c&eacute;dula de ciudadan&iacute;a n&uacute;mero </span ><span class="c0">$cedula_menor, </span ><span class="c1">solicito a usted,</span><span>&nbsp;</span ><span class="c1" >al tenor de lo dispuesto en el C&oacute;digo de la Ni&ntilde;ez y de la Adolescencia, se sirva dar tr&aacute;mite para la Autorizaci&oacute;n de salida del pa&iacute;s a favor del menor de edad </span ><span class="c0">$nombres_menor $apellidos_menor, </span ><span class="c1" >portador de la c&eacute;dula de ciudadan&iacute;a n&uacute;mero </span ><span class="c0">$cedula_menor,</span ><span class="c1" >&nbsp;quien viajar&aacute; en compa&ntilde;&iacute;a de su se&ntilde;or(a) $contraparte_padre_madre </span ><span class="c0">$nombres_autoriza $apellidos_autoriza</span ><span class="c1" >, con c&eacute;dula de ciudadan&iacute;a n&uacute;mero </span ><span class="c0">$cedula_autoriza</span><span class="c1">, </span ><span class="c1 c4">con destino a </span ><span class="c0 c4">$ciudad_destino &ndash; $pais_destino</span ><span class="c1 c4">, &nbsp;por motivo de </span ><span class="c0 c4">$motivo_destino</span ><span class="c1 c4">, saliendo fuera del pa&iacute;s el d&iacute;a </span ><span class="c0 c4" >$fecha_salida_pais, y retorna el d&iacute;a, $fecha_retorno_pais.</span ><span class="c1 c4">&nbsp;Tendr&aacute;n como direcci&oacute;n: </span ><span class="c0 c4" >$direccion_destino</span ><span class="c0 c4 c8">&nbsp;</span> </p><p class="c5 c6"><span class="c2 c1"></span></p><p class="c5 c6"><span class="c2 c1"></span></p><p class="c5 c6"><span class="c2 c0"></span></p><p class="c5 c6"><span class="c2 c0"></span></p><p class="c5"><span class="c2 c0">$requestName</span></p><p class="c5" id="h.gjdgxs"> <span class="c2 c0">C.C. No. $identification_num</span> </p></body></html>',
        'affidavit' =>'<html><head> <meta content="text/html; charset=UTF-8" http-equiv="content-type"/> <meta name="Generator" content="Microsoft Word 15 (filtered)"><style>@font-face{font-family:SimSun;panose-1:2 1 6 0 3 1 1 1 1 1}@font-face{font-family:"Cambria Math";panose-1:2 4 5 3 5 4 6 3 2 4}@font-face{font-family:Calibri;panose-1:2 15 5 2 2 2 4 3 2 4}@font-face{font-family:"Segoe UI";panose-1:2 11 5 2 4 2 4 2 2 3}@font-face{font-family:Cambria;panose-1:2 4 5 3 5 4 6 3 2 4}@font-face{font-family:"\@SimSun";panose-1:2 1 6 0 3 1 1 1 1 1}@font-face{font-family:Garamond;panose-1:2 2 4 4 3 3 1 1 8 3}div."MsoNormal",li."MsoNormal",p."MsoNormal"{margin-top:0;margin-right:0;margin-bottom:10pt;margin-left:0;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif}.MsoChpDefault{font-family:Calibri,sans-serif}.MsoPapDefault{margin-bottom:10pt;line-height:115%}@page WordSection1{size:595.3pt 841.9pt;margin:70.85pt 85.05pt 70.85pt 85.05pt}div.WordSection1{page:WordSection1}</style></head><body lang="EN-US" style="word-wrap:break-word"><div class="WordSection1"><p class="MsoNormal" align="center" style="text-align:center;line-height:150%"><b><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">ACTA NOTARIAL</span></b></p><p class="MsoNormal" align="center" style="text-align:center;line-height:150%"><b><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">AUTORIZACIÓN DE SALIDA DEL MENOR</span></b></p><p class="MsoNormal" align="center" style="text-align:center;line-height:150%"><b><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">$nombres_menor $apellidos_menor</span></b></p><p class="MsoNormal" style="text-align:justify;line-height:150%"><a name="_Hlk145588729"><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">En el Cantón Daule, siendo el día $fecha_solicitud, vista la solicitud presentada por el señor<b>$requestName ,</b>$countryName, portador de las cédula de ciudadanía número<b>$identification_num ,</b>como $padre_madre y representante legal de su hijo(a) menor de edad,<b>$nombres_menor $apellidos_menor</b>, portador de la cédula de ciudadanía número<b>$cedula_menor</b>; y por cumplir con los requisitos establecidos en el Artículo 109 del Código de la Niñez y la Adolescencia, se admite la misma y de conformidad con lo que establece el Artículo 110 del Código de la Niñez y la Adolescencia y la Ley Notarial Vigente,<b>DOY FE</b>de la autorización que se concede al menor de edad de nombre<b>$nombres_menor $apellidos_menor, quien viajará en compañía de su $contraparte_padre_madre, de nombre $nombres_autoriza $apellidos_autoriza, de nacionalidad $nacionalidad_autoriza, portadora de la cedula $cedula_autoriza, solo con destino a $ciudad_destino, $pais_destino, por motivo $motivo_destino, a partir del día $fecha_salida_pais y regresará el día $fecha_retorno_pais. Tendrá como dirección $direccion_destino, $ciudad_destino, $pais_destino.</b></span></a></p><p class="MsoNormal" style="text-align:justify;line-height:150%"><b><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">De todo lo cual doy FE por así constarme.-</span></b></p><p class="MsoNormal" style="text-align:justify;line-height:150%"><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">&nbsp;</span></p><p class="MsoNormal" align="center" style="margin-bottom:0;text-align:center"><b><span lang="ES" style="font-size:14pt;line-height:115%;font-family:Garamond,serif">AB. MARIA DEL CARMEN CARVAJAL AYALA</span></b></p><p class="MsoNormal" align="center" style="margin-bottom:0;text-align:center"><b><span lang="ES" style="font-size:14pt;line-height:115%;font-family:Garamond,serif">NOTARIA CUARTA DEL CANTÓN DAULE</span></b></p></div></body></html>',
        'form_type_id' => $permisoSalidaTypeForm->id,
      ],
      [
        'name' => 'Permiso de Salida - Menor viaja solo',
        'code_name' => 'menor-edad-viaja-solo',
        'field_requests' => json_encode(
          [
            [
              "name" => "Datos del Representante",
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
                  "type" => "select",
                  "rules" => [
                    "required"
                  ],
                  "options" => $countries,
                ],
                [
                  "name" => "identificacion_padres_madre",
                  "label" => "Identificación del Representante",
                  "type" => "text",
                  "rules" => [
                    "required"
                  ]
                ],
                [
                  "name" => "file_copia_cedula_padres_madre", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
                  "label" => "Copia de cédula del Representante",
                  "type" => "file",
                  "rules" => [
                    "required",
                    "mimetypes:application/pdf",
                    "min:2",
                    "max:4000",
                  ],

                ],
                [
                  "name" => "file_copia_cert_votacion_padres_madre", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
                  "label" => "Certificado de votación del Representante",
                  "type" => "file",
                  "rules" => [
                    "required",
                    "mimetypes:application/pdf",
                    "min:2",
                    "max:4000",
                  ],

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
                ],
                [
                  "name" => "genero_menor",
                  "label" => "Género del menor",
                  "type" => "select",
                  "rules" => [
                    "required"
                  ],
                  "options" => [
                    [
                      "value" => "hija",
                      "label" => "Femenino"
                    ],
                    [
                      "value" => "hijo",
                      "label" => "Masculino"
                    ]
                  ]
                ],
                [
                  "name" => "file_copia_cedula_menor", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
                  "label" => "Copia de cédula del Menor",
                  "type" => "file",
                  "rules" => [
                    "required",
                    "mimetypes:application/pdf",
                    "min:2",
                    "max:4000",
                  ],

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
        'body' => '<html> <head> <meta content="text/html; charset=UTF-8" http-equiv="content-type"/> <style type="text/css"> @import url(https://themes.googleusercontent.com/fonts/css?kit=zqpv9qCntOqpqyzFcziM2jFXDelBu2lgpLV8Tx-HAlRP75axLavRt4ieiCjvg-DrxZ7lh1QoVH6YDMyH8cRI-xXqLjx64WtpvUDIJXcBSs0); ol{margin: 0; padding: 0;}table td, table th{padding: 0;}.c3{padding-top: 0pt; padding-bottom: 0pt; line-height: 2; orphans: 2; widows: 2; text-align: justify;}.c9{padding-top: 0pt; padding-bottom: 0pt; line-height: 1.5; orphans: 2; widows: 2; text-align: justify;}.c1{padding-top: 0pt; padding-bottom: 10pt; line-height: 1.5; orphans: 2; widows: 2; text-align: justify;}.c8{padding-top: 0pt; padding-bottom: 10pt; line-height: 1; orphans: 2; widows: 2; text-align: left;}.c2{padding-top: 0pt; padding-bottom: 0pt; line-height: 1; orphans: 2; widows: 2; text-align: justify;}.c6{color: #000000; text-decoration: none; vertical-align: baseline; font-style: normal;}.c5{font-size: 13pt; font-family: "Bookman Old Style"; font-weight: 700;}.c7{background-color: #ffffff; /* max-width: 474.5pt; */ padding: 50pt 56.7pt 50pt 59.8pt;}.c0{font-size: 13pt; font-family: "Bookman Old Style"; font-weight: 400;}.c11{font-weight: 400; font-family: "Calibri";}.c10{font-size: 13pt;}.c4{height: 12pt;}.title{padding-top: 24pt; color: #000000; font-weight: 700; font-size: 36pt; padding-bottom: 6pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}.subtitle{padding-top: 18pt; color: #666666; font-size: 24pt; padding-bottom: 4pt; font-family: "Georgia"; line-height: 1; page-break-after: avoid; font-style: italic; orphans: 2; widows: 2; text-align: left;}li{color: #000000; font-size: 12pt; font-family: "Calibri";}p{margin: 0; color: #000000; font-size: 12pt; font-family: "Calibri";}h1{padding-top: 24pt; color: #000000; font-weight: 700; font-size: 24pt; padding-bottom: 6pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}h2{padding-top: 18pt; color: #000000; font-weight: 700; font-size: 18pt; padding-bottom: 4pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}h3{padding-top: 14pt; color: #000000; font-weight: 700; font-size: 14pt; padding-bottom: 4pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}h4{padding-top: 12pt; color: #000000; font-weight: 700; font-size: 12pt; padding-bottom: 2pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}h5{padding-top: 11pt; color: #000000; font-weight: 700; font-size: 11pt; padding-bottom: 2pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}h6{padding-top: 10pt; color: #000000; font-weight: 700; font-size: 10pt; padding-bottom: 2pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}</style> </head> <body class="c7 doc-content"> <p class="c3"> <span class="c6 c5">AB. MARIA CELESTE VALDIVIESO GRIMER</span> </p><p class="c3"> <span class="c6 c5" >NOTARIA &nbsp;TITULAR CUARTA &nbsp;DEL CANT&Oacute;N DAULE</span > </p><p class="c3 c4"><span class="c6 c5"></span></p><p class="c1"> <span class="c0">Nosotros</span ><span class="c5">, $requestName, &nbsp;</span ><span class="c0">$countryName,</span><span class="c5">&nbsp;</span ><span class="c0">portador de la c&eacute;dula &nbsp;n&uacute;mero</span ><span class="c5">&nbsp; $identification_num, &nbsp;</span ><span class="c0">y </span ><span class="c5">$nombres_padres_madre $apellido_padres_madre, </span ><span class="c0">$nacionalidad_padres_madre,</span><span class="c5">&nbsp;</span ><span class="c0">portadora de la c&eacute;dula</span ><span class="c5">&nbsp;$identificacion_padres_madre,</span ><span class="c0" >&nbsp;como padres &nbsp;y representantes de la menor </span ><span class="c5">$nombres_menor $apellidos_menor, </span ><span class="c0">&nbsp;portadora de la c&eacute;dula n&uacute;mero </span ><span class="c5">$cedula_menor, </span ><span class="c0">solicitamos a usted,</span ><span class="c10">&nbsp;</span ><span class="c0" >al tenor de lo dispuesto en el C&oacute;digo de la Ni&ntilde;ez y de la Adolescencia, se sirva dar tr&aacute;mite para la Autorizaci&oacute;n de salida del pa&iacute;s a favor de nuestro(a) $genero_menor menor de edad &nbsp;</span ><span class="c5">$nombres_menor $apellidos_menor</span ><span class="c0" >, quien &nbsp;viajar&aacute; &nbsp;sola, &nbsp; con destino a </span ><span class="c5">$ciudad_destino - $pais_destino</span ><span class="c0">, &nbsp;por motivo de </span ><span class="c5">$motivo_destino</span ><span class="c0" >, saliendo fuera del pa&iacute;s a partir del d&iacute;a </span ><span class="c5" >$fecha_salida_pais y regresar&aacute; el $fecha_retorno_pais.</span ><span class="c6 c0" >&nbsp;Tendr&aacute;n como direcci&oacute;n: $direccion_destino $ciudad_destino tel&eacute;fono $telefono_destino</span > </p><p class="c4 c9"><span class="c0 c6"></span></p><p class="c3"><span class="c6 c5">FIRMAS</span></p><p class="c3 c4"><span class="c6 c5"></span></p><p class="c3"><span class="c6 c5">$requestName</span></p><p class="c2"><span class="c6 c5">C.C. $identification_num</span></p><p class="c2 c4"><span class="c6 c5"></span></p><p class="c2 c4"><span class="c6 c5"></span></p><p class="c2 c4"><span class="c6 c5"></span></p><p class="c2"><span class="c6 c5">$nombres_padres_madre $apellido_padres_madre</span></p><p class="c2"><span class="c6 c5">C.C. $identificacion_padres_madre</span></p></body></html>',
        'affidavit'=>'<html><head><meta content="text/html; charset=UTF-8"><meta name="Generator" content="Microsoft Word 15 (filtered)"><style>@font-face{font-family:SimSun;panose-1:2 1 6 0 3 1 1 1 1 1}@font-face{font-family:"Cambria Math";panose-1:2 4 5 3 5 4 6 3 2 4}@font-face{font-family:Calibri;panose-1:2 15 5 2 2 2 4 3 2 4}@font-face{font-family:Cambria;panose-1:2 4 5 3 5 4 6 3 2 4}@font-face{font-family:"Segoe UI";panose-1:2 11 5 2 4 2 4 2 2 3}@font-face{font-family:"\@SimSun";panose-1:2 1 6 0 3 1 1 1 1 1}@font-face{font-family:Garamond;panose-1:2 2 4 4 3 3 1 1 8 3}div.MsoNormal,li.MsoNormal,p.MsoNormal{margin-top:0;margin-right:0;margin-bottom:10pt;margin-left:0;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif}.MsoChpDefault{font-family:Calibri,sans-serif}.MsoPapDefault{margin-bottom:10pt;line-height:115%}@page WordSection1{size:595.3pt 841.9pt;margin:70.85pt 85.05pt 70.85pt 85.05pt}div.WordSection1{page:WordSection1}</style></head><body lang="EN-US" style="word-wrap:break-word"><div class="WordSection1"><p class="MsoNormal" align="center" style="text-align:center;line-height:150%"><b><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">ACTA NOTARIAL</span></b></p><p class="MsoNormal" align="center" style="text-align:center;line-height:150%"><b><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">AUTORIZACIÓN DE SALIDA DEL MENOR</span></b></p><p class="MsoNormal" align="center" style="text-align:center;line-height:150%"><b><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">$nombres_menor $apellidos_menor</span></b></p><p class="MsoNormal" style="text-align:justify;line-height:150%"><a name="_Hlk145588729"><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">En el Cantón Daule, siendo el día $fecha_solicitud, vista la solicitud presentada por los señores<b>$requestName Y $nombres_padres_madre</b>, $nacionalidad_padres_madre, portadores de las cédula de ciudadanía números<b>$identification_num y $identificacion_padres_madre</b>respectivamente, como padres y representantes legales de nuestro hijo menor de edad,<b>$nombres_menor $apellidos_menor</b>, portador de la cédula de ciudadanía número<b>$cedula_menor</b>; y por cumplir con los requisitos establecidos en el Artículo 109 del Código de la Niñez y la Adolescencia, se admite la misma y de conformidad con lo que establece el Artículo 110 del Código de la Niñez y la Adolescencia y la Ley Notarial Vigente,<b>DOY FE</b>de la autorización que se concede al menor de edad de nombre<b>$nombres_menor $apellidos_menor, quien viajará solo con destino a $ciudad_destino, $pais_destino, por motivo de $motivo_destino, a partir del día $fecha_salida_pais y regresará el día $fecha_retorno_pais. Tendrá como dirección $direccion_destino, Teléfono: $telefono_destino, $ciudad_destino, $pais_destino.</b></span></a></p><p class="MsoNormal" style="text-align:justify;line-height:150%"><b><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">De todo lo cual doy FE por así constarme.-</span></b></p><p class="MsoNormal" style="text-align:justify;line-height:150%"><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">&nbsp;</span></p><p class="MsoNormal" align="center" style="margin-bottom:0;text-align:center"><b><span lang="ES" style="font-size:14pt;line-height:115%;font-family:Garamond,serif">AB. MARIA DEL CARMEN CARVAJAL AYALA</span></b></p><p class="MsoNormal" align="center" style="margin-bottom:0;text-align:center"><b><span lang="ES" style="font-size:14pt;line-height:115%;font-family:Garamond,serif">NOTARIA CUARTA DEL CANTÓN DAULE</span></b></p></div></body></html>',
        'form_type_id' => $permisoSalidaTypeForm->id,
      ],
      [
        'name' => 'Permiso de Salida - Poder especial',
        'code_name' => 'poder-especial',
        'field_requests' => json_encode([
          [
            "fields" => [
              [
                "name" => "contraparte_padre_madre",
                "label" => "Parentezco con el menor",
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
              ],
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
              ],
              [
                "name" => "file_copia_cedula_padres_madre", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
                "label" => "Copia de cédula del Representante",
                "type" => "file",
                "rules" => [
                  "required",
                  "mimetypes:application/pdf",
                  "min:2",
                  "max:4000",
                ],

              ],
              [
                "name" => "file_copia_cert_votacion_padres_madre", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
                "label" => "Certificado de votación del Representante",
                "type" => "file",
                "rules" => [
                  "required",
                  "mimetypes:application/pdf",
                  "min:2",
                  "max:4000",
                ],

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
              ],
              [
                "name" => "file_copia_cedula_menor", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
                "label" => "Copia de cédula del Menor",
                "type" => "file",
                "rules" => [
                  "required",
                  "mimetypes:application/pdf",
                  "min:2",
                  "max:4000",
                ],

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
              ],
              [
                "name" => "file_copia_cedula_acompaniante", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
                "label" => "Copia de cédula del Acompañante",
                "type" => "file",
                "rules" => [
                  "required",
                  "mimetypes:application/pdf",
                  "min:2",
                  "max:4000",
                ],

              ],
              [
                "name" => "file_copia_cert_votacion_acompaniante", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
                "label" => "Certificado de votación del Acompañante",
                "type" => "file",
                "rules" => [
                  "required",
                  "mimetypes:application/pdf",
                  "min:2",
                  "max:4000",
                ],

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
        ], true),
        'body' => '<html> <head> <meta content="text/html; charset=UTF-8" http-equiv="content-type"/> <style type="text/css"> @import url(https://themes.googleusercontent.com/fonts/css?kit=zqpv9qCntOqpqyzFcziM2jFXDelBu2lgpLV8Tx-HAlRP75axLavRt4ieiCjvg-DrxZ7lh1QoVH6YDMyH8cRI-xXqLjx64WtpvUDIJXcBSs0); .lst-kix_list_1-3 > li:before{content: "\0025cf ";}.lst-kix_list_1-4 > li:before{content: "o ";}ul.lst-kix_list_1-0{list-style-type: none;}.lst-kix_list_1-7 > li:before{content: "o ";}.lst-kix_list_1-5 > li:before{content: "\0025aa ";}.lst-kix_list_1-6 > li:before{content: "\0025cf ";}ul.lst-kix_list_1-3{list-style-type: none;}.lst-kix_list_1-0 > li:before{content: "- ";}ul.lst-kix_list_1-4{list-style-type: none;}.lst-kix_list_1-8 > li:before{content: "\0025aa ";}ul.lst-kix_list_1-1{list-style-type: none;}ul.lst-kix_list_1-2{list-style-type: none;}ul.lst-kix_list_1-7{list-style-type: none;}.lst-kix_list_1-1 > li:before{content: "o ";}.lst-kix_list_1-2 > li:before{content: "\0025aa ";}ul.lst-kix_list_1-8{list-style-type: none;}ul.lst-kix_list_1-5{list-style-type: none;}ul.lst-kix_list_1-6{list-style-type: none;}ol{margin: 0; padding: 0;}table td, table th{padding: 0;}.c0{padding-top: 0pt; padding-bottom: 0pt; line-height: 1.4166666666666667; orphans: 2; widows: 2; text-align: justify; height: 12pt;}.c4{padding-top: 0pt; padding-bottom: 0pt; line-height: 1.4166666666666667; orphans: 2; widows: 2; text-align: justify;}.c5{color: #000000; text-decoration: none; vertical-align: baseline; font-size: 12pt; font-style: normal;}.c2{font-size: 13pt; font-family: "Bookman Old Style"; font-weight: 400;}.c7{background-color: #ffffff; /* max-width: 474.5pt; */ padding: 80pt 56.7pt 80pt 63.8pt;}.c3{font-weight: 400; font-family: "Bookman Old Style";}.c1{font-weight: 700; font-family: "Bookman Old Style";}.c6{font-size: 13pt;}.title{padding-top: 24pt; color: #000000; font-weight: 700; font-size: 36pt; padding-bottom: 6pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}.subtitle{padding-top: 18pt; color: #666666; font-size: 24pt; padding-bottom: 4pt; font-family: "Georgia"; line-height: 1; page-break-after: avoid; font-style: italic; orphans: 2; widows: 2; text-align: left;}li{color: #000000; font-size: 12pt; font-family: "Calibri";}p{margin: 0; color: #000000; font-size: 12pt; font-family: "Calibri";}h1{padding-top: 24pt; color: #000000; font-weight: 700; font-size: 24pt; padding-bottom: 6pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}h2{padding-top: 18pt; color: #000000; font-weight: 700; font-size: 18pt; padding-bottom: 4pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}h3{padding-top: 14pt; color: #000000; font-weight: 700; font-size: 14pt; padding-bottom: 4pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}h4{padding-top: 12pt; color: #000000; font-weight: 700; font-size: 12pt; padding-bottom: 2pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}h5{padding-top: 11pt; color: #000000; font-weight: 700; font-size: 11pt; padding-bottom: 2pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}h6{padding-top: 10pt; color: #000000; font-weight: 700; font-size: 10pt; padding-bottom: 2pt; font-family: "Calibri"; line-height: 1; page-break-after: avoid; orphans: 2; widows: 2; text-align: left;}</style> </head> <body class="c7 doc-content"> <p class="c4"> <span class="c5 c1">AB. MARIA DEL CARMEN CARVAJAL AYALA</span> </p><p class="c4"> <span class="c5 c1" >NOTARIA TITULAR CUARTA &nbsp;DEL CANT&Oacute;N DAULE</span > </p><p class="c0"><span class="c5 c1"></span></p><p class="c4"> <span class="c3">Yo</span ><span class="c1">, $requestName, </span ><span class="c3">de nacionalidad $countryName,</span ><span class="c1">&nbsp;</span ><span class="c3" >portadora de la c&eacute;dula de ciudadan&iacute;a n&uacute;mero</span ><span class="c1">&nbsp;$identification_num,</span ><span class="c3" >&nbsp;por sus propios y personales derechos y por los que representa como apoderada especial del se&ntilde;or </span ><span class="c1">$nombres_representante $apellidos_representante</span ><span class="c3" >poder que se adjunta como documento habilitante, como madre y representante de la menor </span ><span class="c1">$nombres_menor $apellidos_menor, </span ><span class="c3" >portadora de la c&eacute;dula de ciudadan&iacute;a n&uacute;mero </span ><span class="c1">$cedula_menor, </span ><span class="c3">solicito a usted,</span><span>&nbsp;</span ><span class="c3" >al tenor de lo dispuesto en el C&oacute;digo de la Ni&ntilde;ez y de la Adolescencia, se sirva dar tr&aacute;mite para la Autorizaci&oacute;n de salida del pa&iacute;s a favor del menor de edad &nbsp;</span ><span class="c1">$nombres_menor $apellidos_menor, </span ><span class="c3" >portador de la c&eacute;dula de ciudadan&iacute;a n&uacute;mero </span ><span class="c1">$cedula_menor</span ><span class="c3" >, quien viajar&aacute; en compa&ntilde;&iacute;a de su se&ntilde;ora madre &nbsp;</span ><span class="c1">$nombres_acompaniante $apellidos_acompaniante</span ><span class="c3" >, con c&eacute;dula de ciudadan&iacute;a n&uacute;mero </span ><span class="c1">$cedula_acompaniante</span><span class="c3">, </span ><span class="c2">con destino a </span ><span class="c1 c6">$ciudad_destino &ndash; $pais_destino</span ><span class="c2">, &nbsp;por motivo de </span ><span class="c1 c6">$motivo_destino</span ><span class="c2">, saliendo fuera el d&iacute;a </span ><span class="c1 c6" >$fecha_salida_pais y retornan el $fecha_retorno_pais.</span ><span class="c2" >&nbsp;Tendr&aacute;n como direcci&oacute;n: $direccion_destino, $ciudad_destino</span > </p><p class="c0"><span class="c5 c1"></span></p><p class="c0"><span class="c5 c1"></span></p><p class="c0" id="h.gjdgxs"><span class="c5 c1"></span></p><p class="c0"><span class="c5 c1"></span></p><p class="c4"><span class="c5 c1">$requestName</span></p><p class="c4"><span class="c5 c1">C.C. No. $identification_num</span></p><p class="c4"><span class="c1 c5">APODERADA ESPECIAL</span></p><p class="c4"> <span class="c5 c1">POR $nombres_representante $apellidos_representante</span> </p><p class="c4"><span class="c5 c1">C.C. No. $identificacion_padres_madre</span></p></body></html>',
        'affidavit'=>'<html><head><meta content="text/html; charset=UTF-8"/><meta name="Generator" content="Microsoft Word 15 (filtered)"><style>@font-face{font-family:SimSun;panose-1:2 1 6 0 3 1 1 1 1 1}@font-face{font-family:"Cambria Math";panose-1:2 4 5 3 5 4 6 3 2 4}@font-face{font-family:Calibri;panose-1:2 15 5 2 2 2 4 3 2 4}@font-face{font-family:Cambria;panose-1:2 4 5 3 5 4 6 3 2 4}@font-face{font-family:"\@SimSun";panose-1:2 1 6 0 3 1 1 1 1 1}@font-face{font-family:Tahoma;panose-1:2 11 6 4 3 5 4 4 2 4}@font-face{font-family:Garamond;panose-1:2 2 4 4 3 3 1 1 8 3}div.MsoNormal,li.MsoNormal,p.MsoNormal{margin-top:0;margin-right:0;margin-bottom:10pt;margin-left:0;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif}div.MsoNoSpacing,li.MsoNoSpacing,p.MsoNoSpacing{margin:0;font-size:12pt;font-family:Calibri,sans-serif}.MsoChpDefault{font-family:Calibri,sans-serif}.MsoPapDefault{margin-bottom:10pt;line-height:115%}@page WordSection1{size:595.3pt 841.9pt;margin:70.85pt 85.05pt 70.85pt 85.05pt}div.WordSection1{page:WordSection1;margin:0 auto; width:80%}</style></head><body lang="EN-US" style="word-wrap:break-word"><div class="WordSection1"><p class="MsoNormal" align="center" style="text-align:center;line-height:150%"><b><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">ACTA NOTARIAL</span></b></p><p class="MsoNormal" align="center" style="text-align:center;line-height:150%"><b><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">PERMISO DE SALIDA DEL PAÍS A FAVOR DE LA MENOR</span></b></p><p class="MsoNoSpacing" align="center" style="text-align:center;line-height:150%"><b><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">ANACORINA ROMERO SONNE</span></b></p><p class="MsoNoSpacing" align="center" style="text-align:center;line-height:150%"><b><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">&nbsp;</span></b></p><p class="MsoNoSpacing" style="text-align:justify;line-height:150%"><span lang="ES-TRAD" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">En el cantón Daule al día $fecha_solicitud, vista la solicitud presentada por la señora<b>$requestName</b>, ecuatoriana, con cédula número<b>$identification_num,</b>por sus propios derechos como $contraparte_padre_madre y como Apoderada Especial del señor<b>$nombres_representante $apellidos_representante</b>, portador de a cedula número $cedula_representante, según Poder especial Nro 20230906004P0023, como padre y representantes legales de su hijo(a) menor de edad<b>$nombres_menor $apellidos_menor</b>, de nacionalidad ecuatoriana, con cédula número $cedula_menor; y por cumplir con los<a name="_Hlk54782101">requisitos establecidos en el Artículo 109 del Código de la Niñez y la Adolescencia, se admite la misma y de conformidad con lo que establece el Artículo 110 del Código de la Niñez y la Adolescencia y la Ley Notarial Vigente, doy fe de la autorización que se concede a la menor<b>$nombres_menor $apellidos_menor</b>, quien viajaran con su señora $contraparte_padre_madre<b>$requestName,</b>con destino<b>$ciudad_destino, $pais_destino</b>por motivo de $motivo_destino.</a><a name="_Hlk54782226">Saldrán de viaje el<b>$fecha_salida_pais y regresando el dia $fecha_retorno_pais.</b>La dirección donde se hospedarán es: $direccion_destino. $ciudad_destino, $pais_destino</a></span></p><p class="MsoNoSpacing" style="text-align:justify;line-height:150%"><b><span lang="ES-TRAD" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">De todo lo cual doy FE por así constarme.-</span></b></p><p class="MsoNormal" style="text-align:justify;line-height:150%"><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">&nbsp;</span></p><p class="MsoNormal" align="center" style="text-align:center;line-height:150%"><b><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">AB. MARIA DEL CARMEN CARVAJAL AYALA</span></b></p><p class="MsoNormal" align="center" style="text-align:center;line-height:150%"><b><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">NOTARIA CUARTA DEL CANTÓN DAULE</span></b></p><p class="MsoNormal" align="center" style="text-align:center;line-height:150%"><b><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">&nbsp;</span></b></p><p class="MsoNormal" style="text-align:justify;line-height:150%"><b><span lang="ES" style="font-size:14pt;line-height:150%;font-family:Garamond,serif">&nbsp;</span></b></p><p class="MsoNormal" style="text-align:justify;line-height:150%"><span lang="ES" style="font-size:14pt;line-height:150%">&nbsp;</span></p><p class="MsoNormal" style="text-align:justify;line-height:150%"><span lang="ES" style="font-size:14pt;line-height:150%">&nbsp;</span></p><p class="MsoNormal" style="text-align:justify;line-height:150%"><span lang="ES" style="font-size:14pt;line-height:150%">&nbsp;</span></p><p class="MsoNormal" style="text-align:justify"><span lang="ES">&nbsp;</span></p></div></body></html>',
        'form_type_id' => $permisoSalidaTypeForm->id
      ],
    ];


    foreach ($formsDocs as $formDoc) {

      FormDoc::create($formDoc);
    }

    /**
     * Copia certificada
     */

    $copiaCertificadaTypeForm = FormDocType::where('name', 'copia_certificada')->first();

    $copiaCertificada = [

      [
        'name' => 'Copia Certificada',
        'code_name' => 'copia-certificada',
        'field_requests' => json_encode(
          [
            [
              "fields" => [
                [
                  "name" => "file_copia_cedula", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
                  "label" => "Cédula del Solicitante",
                  "type" => "file",
                  "rules" => [
                    "required",
                    "mimetypes:application/pdf",
                    "min:2",
                    "max:4000",
                  ],

                ],
                [
                  "name" => "file_copia_cert_votacion", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
                  "label" => "Certificado de votación del Solicitante",
                  "type" => "file",
                  "rules" => [
                    "required",
                    "mimetypes:application/pdf",
                    "min:2",
                    "max:4000",
                  ],

                ]
              ]
            ],
          ],
          true
        ),
        'body' => '',
        'form_type_id' => $copiaCertificadaTypeForm->id

      ]
    ];

    foreach ($copiaCertificada as $formDoc) {

      FormDoc::create($formDoc);
    }
    /**
     * Declaracion juramentada
     */
    $decJuramentadaTypeForm = FormDocType::where('name', 'delcaracion_juramentada')->first();

    $declaracionJuramentada = [
      [
        'name' => 'Declaración Juramentada',
        'code_name' => 'declaracion-juramentada',
        'field_requests' => $copiaCertificada[0]['field_requests'],
        'body' => '',
        'form_type_id' => $decJuramentadaTypeForm->id
      ]
    ];

    foreach ($declaracionJuramentada as $formDoc) {

      FormDoc::create($formDoc);
    }

    /**
     * Poderes generales
     */

    $poderGeneralTypeForm = FormDocType::where('name', 'poderes_generales')->first();

    $declaracionJuramentada = [
      'name' => 'Poderes generales',
      'code_name' => 'poderes-generales',
      'field_requests' => json_encode([
        [
          "fields" => [
            [
              "name" => "direccion_solicitante",
              "label" => "Dirección del solicitante",
              "type" => "text",
              "rules" => [
                "required"
              ],
            ],
            [
              "name" => "telefono_solicitante",
              "label" => "Teléfono del solicitante",
              "type" => "tel",
              "rules" => [
                "required",
                "max:10"
              ],
            ],
            [
              "name" => "file_copia_cedula_solicitante", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
              "label" => "Copia de Cédula",
              "type" => "file",
              "rules" => [
                "required",
                "mimetypes:application/pdf",
                "min:2",
                "max:4000",
              ],

            ],
            [
              "name" => "file_copia_cert_votacion_solicitante", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
              "label" => "Copia Certificado de votación",
              "type" => "file",
              "rules" => [
                "required",
                "mimetypes:application/pdf",
                "min:2",
                "max:4000",
              ],

            ]
          ],
        ],
        [
          'name' => "Quién recibe los poderes",
          'fields' => [
            [
              "name" => "nombres_quien_recibe",
              "label" => "Nombres",
              "type" => "text",
              "rules" => [
                "required"
              ]
            ],
            [
              "name" => "apellidos_quien_recibe",
              "label" => "Apellidos",
              "type" => "text",
              "rules" => [
                "required"
              ]
            ],
            [
              "name" => "cedula_quien_recibe",
              "label" => "Cédula",
              "type" => "text",
              "rules" => [
                "required"
              ]
            ],
            [
              "name" => "direccion_quien_recibe",
              "label" => "Dirección",
              "type" => "text",
              "rules" => [
                "required"
              ]
            ],
            [
              "name" => "email_quien_recibe",
              "label" => "Correo electrónico",
              "type" => "email",
              "rules" => [
                "required"
              ]
            ],
            [
              "name" => "telefono_quien_recibe",
              "label" => "Teléfono",
              "type" => "tel",
              "rules" => [
                "required"
              ]
            ],
            [
              "name" => "file_copia_cedula_recibe", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
              "label" => "Copia de Cédula",
              "type" => "file",
              "rules" => [
                "required",
                "mimetypes:application/pdf",
                "min:2",
                "max:4000",
              ],

            ],
            [
              "name" => "file_copia_certificado_votacion_recibe", // Debemos poner un prefijo de file_* para que el front sepa que es un input file
              "label" => "Copia de Certificado de votación",
              "type" => "file",
              "rules" => [
                "required",
                "mimetypes:application/pdf",
                "min:2",
                "max:4000",
              ],

            ]
          ],
        ]
      ], true),
      'body' => '',
      'form_type_id' => $poderGeneralTypeForm->id
    ];

    FormDoc::create($declaracionJuramentada);
  }
}
