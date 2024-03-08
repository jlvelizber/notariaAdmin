import { useState } from "react";
import { Head, usePage } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { ModalHistoryRequestLog, RequestsDataTable } from "./Partials";
import { ListIndexRequestPageProps, PageProps, UserFormRequest } from "@/types";

export default function Index() {
    const { auth } = usePage<PageProps>().props;
    const { requests } = usePage<ListIndexRequestPageProps>().props;
    const [isOpenModal, setIsOpenModal] = useState<boolean>(false);
    const [requestHistoryId, setrequestHistoryId] = useState<number>(0);

    const onShowHistiryRequest = async (id: number) => {
        setIsOpenModal(true);
        setrequestHistoryId(id);
    };

    const onCloseModalHistory = () => {
        setIsOpenModal(false);
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
            <ModalHistoryRequestLog
                isOpen={isOpenModal}
                onClose={onCloseModalHistory}
                requestId={requestHistoryId}
            />
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
