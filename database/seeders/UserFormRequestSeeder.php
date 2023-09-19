<?php

namespace Database\Seeders;

use App\Models\FormDoc;
use App\Models\User;
use App\Models\UserFormRequest;
use App\Models\UserFormStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserFormRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $userRnd = User::select('id')->inRandomOrder()->first();
        $formRnd = FormDoc::select('id')->inRandomOrder()->first();
        $statusFormRnd = UserFormStatus::select('id')->inRandomOrder()->first();
        
        $userFormRequests = [
            [
                'user_id' => $userRnd->id,
                'form_request_body' => json_encode(['nombre' => 'Jorge Luis Veliz'], true),
                'form_doc_id' => $formRnd->id,
                'status_id' => $statusFormRnd->id
            ],
            [
                'user_id' => $userRnd->id,
                'form_request_body' => json_encode(['nombre' => 'Karen Pacheco'], true),
                'form_doc_id' => $formRnd->id,
                'status_id' => $statusFormRnd->id
            ],
            [
                'user_id' => $userRnd->id,
                'form_request_body' => json_encode(['nombre' => 'Samantha Veliz'], true),
                'form_doc_id' => $formRnd->id,
                'status_id' => $statusFormRnd->id
            ],
        ];

        foreach ($userFormRequests as $formReque) {
            UserFormRequest::create($formReque);
        }
    }
}
