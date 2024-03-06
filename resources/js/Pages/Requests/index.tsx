import { Head, usePage, router } from "@inertiajs/react";
import { ListIndexRequestPageProps, PageProps, UserFormRequest } from "@/types";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

import RequestsDataTable from "./Partials/RequestsDataTable";

export default function Index() {
    const { auth } = usePage<PageProps>().props;
    const { requests } = usePage<ListIndexRequestPageProps>().props;

    const onShowHistiryRequest = async (id: number) => {
         router.get(route( 'requests.logs' , id));
    };
    

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
                <RequestsDataTable
                    requests={requests}
                    onShowHistory={(request: UserFormRequest) =>
                        onShowHistiryRequest(request.id)
                    }
                />
            </div>
        </AuthenticatedLayout>
    );
}
