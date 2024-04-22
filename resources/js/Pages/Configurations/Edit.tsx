import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { EditConfigurationPageProps, PageProps } from "@/types";
import { Head, usePage } from "@inertiajs/react";
import FormAdminConfiguration from "./Partials/FormAdminConfiguration";

export default function Create() {
    const { auth } = usePage<PageProps>().props;
    const { configuration } = usePage<EditConfigurationPageProps>().props;

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    {configuration.id
                        ? `Configuración - Editar Configuración<${configuration.label}>`
                        : `Configuración - Nueva Configuración`}
                </h2>
            }
        >
            <Head title="Configuración" />

            <div className="p-3">
                <div className="w-full">
                    <FormAdminConfiguration
                        configuration={configuration}
                    />
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
