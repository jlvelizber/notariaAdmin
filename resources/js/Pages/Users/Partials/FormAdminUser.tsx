import { FormBarActions } from "@/Components/FormBarActions";
import InputError from "@/Components/Common/InputError";
import InputLabel from "@/Components/Common/InputLabel";
import TextInput from "@/Components/Common/TextInput";
import { onOpenSnack } from "@/store/slices/SnackBarSlice/SnackBarSlice";
import { Role, User } from "@/types";
import { useForm } from "@inertiajs/react";
import { Grid, MenuItem, Select } from "@mui/material";
import React, { FormEventHandler } from "react";
import { useDispatch } from "react-redux";

export default function FormAdminUser({
    user,
    roles,
}: {
    user: User | null;
    roles: Role[];
}) {
    const { data, setData, post, put, errors, processing, recentlySuccessful } =
        useForm({
            id: user?.id,
            name: user?.name || "",
            email: user?.email || "",
            midle_name: user?.midle_name || "",
            first_last_name: user?.first_last_name || "",
            second_last_name: user?.second_last_name || "",
            password: user?.password || undefined,
            password_confirmation: user?.password || undefined,
            role: user?.role?.id || "",
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

                    <InputError
                        className="mt-2"
                        message={errors.first_last_name}
                    />
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

                    <InputError
                        className="mt-2"
                        message={errors.second_last_name}
                    />
                </Grid>
            </Grid>

            <Grid container spacing={2}>
                <Grid item xs={12}>
                    <h3 className="font-bold">Configuración de usuario</h3>
                </Grid>

                {/* Email */}
                <Grid item xs={12} lg={3}>
                    <InputLabel htmlFor="email" value="Correo electrónico" />

                    <TextInput
                        id="email"
                        className="mt-1 block w-full"
                        value={data.email}
                        onChange={(e) => setData("email", e.target.value)}
                        required
                        autoComplete="email"
                    />

                    <InputError className="mt-2" message={errors.email} />
                </Grid>

                {/* Roles */}
                <Grid item xs={12} lg={3}>
                    <InputLabel
                        htmlFor="rol"
                        value="Rol"
                        className="mb-[2px]"
                    />

                    <Select
                        labelId="demo-simple-select-label"
                        id="demo-simple-select"
                        // @ts-ignore
                        defaultValue={parseInt(data?.role)}
                        value={data?.role}
                        onChange={(e) => setData("role", e.target.value)}
                        fullWidth
                    >
                        {roles.map((role: Role, idx: React.Key) => (
                            <MenuItem key={idx} value={role.id}>
                                {role.name}
                            </MenuItem>
                        ))}
                    </Select>

                    <InputError className="mt-2" message={errors.role} />
                </Grid>
                {/* Contrasea */}
                <Grid item xs={12} lg={3}>
                    <InputLabel htmlFor="password" value="Contraseña" />

                    <TextInput
                        type="password"
                        id="password"
                        className="mt-1 block w-full"
                        value={data.password}
                        onChange={(e) => setData("password", e.target.value)}
                        required={data?.id ? false : true}
                        autoComplete="password"
                    />

                    <InputError className="mt-2" message={errors.password} />
                </Grid>
                {/* COnfirmar Contrasea */}
                <Grid item xs={12} lg={3}>
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
                        required={data?.id ? false : true}
                        autoComplete="password_confirmation"
                    />

                    <InputError
                        className="mt-2"
                        message={errors.password_confirmation}
                    />
                </Grid>
            </Grid>

            <FormBarActions routeBack="users.index" saveAction={() => submit} />
        </form>
    );
}
