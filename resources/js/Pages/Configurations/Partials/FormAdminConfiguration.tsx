import { FormEventHandler } from "react";
import { useDispatch } from "react-redux";
import { ConfigurationInterface } from "@/types";
import { InputLabel, InputError } from "@/Components/Common";
import TextInput from "@/Components/Common/TextInput";
import { useForm } from "@inertiajs/react";
import { onOpenSnack } from "@/store/slices/SnackBarSlice/SnackBarSlice";
import { FormBarActions } from "@/Components/FormBarActions";

export default function FormAdminConfiguration({
    configuration,
}: {
    configuration: ConfigurationInterface;
}) {
    const { data, setData, put, errors } = useForm({
        value: configuration.value || "",
        label: configuration.label || "",
    });

    const dispatch = useDispatch();

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        put(route("settings.types.update", { id: configuration.id }), {
            onSuccess: () =>
                dispatch(
                    onOpenSnack({
                        message: "Configuración Actualizado Correctamente",
                        severity: "success",
                    })
                ),
        });
    };

    return (
        <form onSubmit={submit} className="mt-6 space-y-6">
            {/* Valor */}
            <div>
                <InputLabel htmlFor="name" value="Valor" />

                <TextInput
                    id="value"
                    className="mt-1 block w-full"
                    value={data.value}
                    onChange={(e) => setData("value", e.target.value)}
                    required
                    isFocused={!configuration.id}
                />

                <InputError className="mt-2" message={errors.value} />
            </div>
            {/* Actions save or back */}
            <FormBarActions routeBack="configuration.index" saveAction={() => submit} />
        </form>
    );
}
