import React, { FC, FormEventHandler } from "react";
import { Role } from "@/types";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import { useForm } from "@inertiajs/react";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
import SecondaryButton from "@/Components/SecondaryButton";
import { useDispatch } from "react-redux";
import { onOpenSnack } from "@/store/slices/SnackBarSlice/SnackBarSlice";

export default function FormAdminRole({ role }: { role: Role | null }) {
    const { data, setData, post, put, errors, processing, recentlySuccessful } =
        useForm({
            name: role?.name || "",
            display_name: role?.display_name || "",
            description: role?.description || "",
        });

    const dispatch = useDispatch();

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        if (!role) {
            post(route("roles.store"), {
                onSuccess: () =>
                    dispatch(
                        onOpenSnack({
                            message: "Rol Guardado",
                            severity: "success",
                        })
                    ),
            });
        } else {
            put(route("roles.update", { id: role!?.id }), {
                onSuccess: () =>
                    dispatch(
                        onOpenSnack({
                            message: "Rol Actualizado Correctamente",
                            severity: "success",
                        })
                    ),
            });
        }
    };

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
                    isFocused={!role?.id}
                    autoComplete="name"
                    disabled={role?.id && !role?.is_deletetable ? true : false}
                    readOnly={role?.id && !role?.is_deletetable ? true : false}
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
                    isFocused={!role?.id}
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
            <SecondaryButton href={route("roles.index")}>
                Regresar
            </SecondaryButton>
        </form>
    );
}
