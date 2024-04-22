<?php

namespace App\Http\Controllers;

use App\Enums\ConfigTypeEnum;
use App\Models\Configuration;
use App\Http\Requests\StoreConfigurationRequest;
use App\Http\Requests\UpdateConfigurationRequest;
use Inertia\Inertia;

class ConfigurationController extends Controller
{
    private $pathFolder ;
    /**
     * Display a listing of the resource.
     */
    public function index(string $key)
    {
        // Llama a la lista de usuarios con su rol principal o primer rol
        $parent = Configuration::select('id', 'key')->with('children')->where('key', $key)->first();

        if (!$parent) return abort(404);

        $configurations = $parent->children;
        // $pathFolder = '';
        switch ($parent->key) {
            case ConfigTypeEnum::CONFIGURACION_GENERAL_KEY->value:
                $this->pathFolder = 'General';
                break;

            default:
                # code...
                break;
        }


        return Inertia::render("Configurations/$this->pathFolder/index", ['configurations' => $configurations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConfigurationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Configuration $configuration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Configuration $configuration)
    {
        return Inertia::render("Configurations/Edit", ['configuration' => $configuration]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConfigurationRequest $request, Configuration $configuration)
    {
        
        $request->validate([
            'value' => ['required','string','max:255'],
        ]);


        $configuration->fill($request->all());
        $configuration->save();

        return redirect()->route('settings.types.index',['parentKey' => 'general_config']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Configuration $configuration)
    {
        //
    }
}
