import React, { FC } from "react";
import { InertiaFormProps } from "@inertiajs/react/types/useForm";
import { Role } from "@/types";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import { useForm } from "@inertiajs/react";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";

export default function FormAdminRole( {role} :{ role: Role | null} ) {  
    const {
        data,
        setData,
        post,
        errors,
        processing,
        recentlySuccessful,
    }: InertiaFormProps<Role> = useForm({
        name: role?.name || '',
        display_name: role?.display_name || '',
        description: role?.description || '',
    });

    const submit = () => {};

    return (
        <form onSubmit={submit} className="mt-6 space-y-6">
            {/* Nombre */}
            <div>
                <InputLabel htmlFor="name" value="Nombre" />

                <TextInput
                    id="name"
                    className="mt-1 block w-full"
                    value={data.name}
                    onChange={(e) => setData("name", e.target.value)}
                    required
                    isFocused
                    autoComplete="name"
                />

                <InputError className="mt-2" message={errors.name} />
            </div>
            {/* Display Name */}
            <div>
                <InputLabel htmlFor="display_name" value="Nombre a mostrar" />

                <TextInput
                    id="display_name"
                    className="mt-1 block w-full"
                    value={data.display_name}
                    onChange={(e) => setData("display_name", e.target.value)}
                    required
                    autoComplete="display_name"
                />

                <InputError className="mt-2" message={errors.display_name} />
            </div>
            {/*Descripcion */}
            <div>
                <InputLabel htmlFor="name" value="Descripcion" />

                <TextInput
                    id="description"
                    className="mt-1 block w-full"
                    value={data.description}
                    onChange={(e) => setData("description", e.target.value)}
                    required
                    autoComplete="description"
                />

                <InputError className="mt-2" message={errors.description} />
            </div>
            <PrimaryButton onClick={submit}>Guardar</PrimaryButton>
        </form>
    );
};