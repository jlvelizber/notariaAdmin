import { Head, usePage } from "@inertiajs/react";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import { ListIndexConfigurationPageProps, PageProps } from "@/types";
import { ConfigurationDataTable } from "../Partials";

export default function Index() {
    const { auth } = usePage<PageProps>().props;
    const { configurations } = usePage<ListIndexConfigurationPageProps>().props;
    return (
        <Authenticated
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Configuración General
                </h2>
            }
        >
            <Head title="Configuración General" />
            <div className="p-3">
                <ConfigurationDataTable configurations={configurations} />
            </div>
        </Authenticated>
    );
}
