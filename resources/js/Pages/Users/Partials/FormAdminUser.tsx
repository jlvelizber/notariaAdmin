import React, { FC, FormEventHandler } from "react";
import { User } from "@/types";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import { useForm } from "@inertiajs/react";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
import SecondaryButton from "@/Components/SecondaryButton";
import { useDispatch } from "react-redux";
import { onOpenSnack } from "@/store/slices/SnackBarSlice/SnackBarSlice";
import { Grid } from "@mui/material";
import { FormBarActions } from "@/Components/FormBarActions";

export default function FormAdminUser({ user }: { user: User | null }) {
    const { data, setData, post, put, errors, processing, recentlySuccessful } =
        useForm({
            name: user?.name,
            email: user?.email,
            midle_name: user?.midle_name,
            first_last_name: user?.first_last_name,
            second_last_name: user?.second_last_name,
            password: user?.password,
            password_confirmation: ''
        });

    const dispatch = useDispatch();

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        if (!user) {
            post(route("users.store"), {
                onSuccess: () =>
                    dispatch(
                        onOpenSnack({
                            message: "Usuario Guardado",
                            severity: "success",
                        })
                    ),
            });
        } else {
            put(route("users.update", { id: user!?.id }), {
                onSuccess: () =>
                    dispatch(
                        onOpenSnack({
                            message: "Usuario Actualizado Correctamente",
                            severity: "success",
                        })
                    ),
            });
        }
    };

    return (
        <form onSubmit={submit} className="mt-6 space-y-6">
            <Grid container spacing={2}>
                <Grid item xs={12}>
                    <h3 className="font-bold">Datos Personales</h3>
                </Grid>
                {/* Primer Nombre */}

                <Grid item xs={12} md={6} lg={3}>
                    <InputLabel htmlFor="name" value="Nombre" />

                    <TextInput
                        id="name"
                        className="mt-1 block w-full"
                        value={data.name}
                        onChange={(e) => setData("name", e.target.value)}
                        required
                        isFocused={!user?.id}
                        autoComplete="name"
                    />

                    <InputError className="mt-2" message={errors.name} />
                </Grid>
                {/* Segundo Nombre */}

                <Grid item xs={12} md={6} lg={3}>
                    <InputLabel htmlFor="midle_name" value="Segundo Nombre" />

                    <TextInput
                        id="midle_name"
                        className="mt-1 block w-full"
                        value={data.midle_name}
                        onChange={(e) => setData("midle_name", e.target.value)}
                        required
                        autoComplete="midle_name"
                    />

                    <InputError className="mt-2" message={errors.midle_name} />
                </Grid>

                {/* Primer Apellido */}

                <Grid item xs={12} md={6} lg={3}>
                    <InputLabel
                        htmlFor="first_last_name"
                        value="Primer Apellido"
                    />

                    <TextInput
                        id="first_last_name"
                        className="mt-1 block w-full"
                        value={data.first_last_name}
                        onChange={(e) =>
                            setData("first_last_name", e.target.value)
                        }
                        required
                        autoComplete="first_last_name"
                    />

                    <InputError className="mt-2" message={errors.first_last_name} />
                </Grid>

                {/* Segundo Apellido */}
                <Grid item xs={12} md={6} lg={3}>
                    <InputLabel
                        htmlFor="second_last_name"
                        value="Segundo Apellido"
                    />

                    <TextInput
                        id="second_last_name"
                        className="mt-1 block w-full"
                        value={data.second_last_name}
                        onChange={(e) =>
                            setData("second_last_name", e.target.value)
                        }
                        required
                        autoComplete="second_last_name"
                    />

                    <InputError className="mt-2" message={errors.second_last_name} />
                </Grid>
            </Grid>

            <Grid container spacing={2}>
                <Grid item xs={12}>
                    <h3 className="font-bold">Configuración de usuario</h3>
                </Grid>

                 {/* Email */}
                 <Grid item xs={12}  lg={3}>
                    <InputLabel
                        htmlFor="email"
                        value="Correo electrónico"
                    />

                    <TextInput
                        id="email"
                        className="mt-1 block w-full"
                        value={data.email}
                        onChange={(e) =>
                            setData("email", e.target.value)
                        }
                        required
                        autoComplete="email"
                    />

                    <InputError className="mt-2" message={errors.email} />
                </Grid>
                 
                 {/* Contrasea */}
                 <Grid item xs={12}  lg={3}>
                    <InputLabel
                        htmlFor="password"
                        value="Contraseña"
                    />

                    <TextInput
                        type="password"
                        id="password"
                        className="mt-1 block w-full"
                        value={data.password}
                        onChange={(e) =>
                            setData("password", e.target.value)
                        }
                        required
                        autoComplete="password"
                    />

                    <InputError className="mt-2" message={errors.password} />
                </Grid>
                 {/* COnfirmar Contrasea */}
                 <Grid item xs={12}  lg={3}>
                    <InputLabel
                        htmlFor="password_confirmation"
                        value="Confirmar Contraseña"
                    />

                    <TextInput
                        type="password"
                        id="password_confirmation"
                        className="mt-1 block w-full"
                        value={data.password_confirmation}
                        onChange={(e) =>
                            setData("password_confirmation", e.target.value)
                        }
                        required
                        autoComplete="password_confirmation"
                    />

                    <InputError className="mt-2" message={errors.password_confirmation} />
                </Grid>
            </Grid>

            <FormBarActions routeBack="users.index" saveAction={() =>submit}/>
            
        </form>
    );
}
