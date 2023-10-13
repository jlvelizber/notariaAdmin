import { Head, usePage } from "@inertiajs/react";
import { ListIndexRequestPageProps, PageProps } from "@/types";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import RequestsDataTable from "./Partials/RequestsDataTable";

export default function Index() {
    const { auth } = usePage<PageProps>().props;
    const { requests } = usePage<ListIndexRequestPageProps>().props;

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Solicitudes
                </h2>
            }
        >
            <Head title="Solicitudes Realizadas en la web" />

            <div className="p-3">
                <RequestsDataTable requests={requests} />
            </div>
        </AuthenticatedLayout>
    );
}
