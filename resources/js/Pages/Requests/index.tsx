import { useState } from "react";
import { Head, usePage } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import {
    ModalDocViewer,
    ModalHistoryRequestLog,
    RequestsDataTable,
} from "./Partials";
import { ListIndexRequestPageProps, PageProps, UserFormRequest } from "@/types";

export default function Index() {
    const { auth } = usePage<PageProps>().props;
    const { requests } = usePage<ListIndexRequestPageProps>().props;
    const [isOpenModal, setIsOpenModalHistory] = useState<boolean>(false);
    const [isOpenDocModal, setIsOpenDocModal] = useState<boolean>(false);
    const [dataDocModal, setDataDocModal] = useState<{
        url: string;
        title: string;
    }>({ url: "", title: "" });
    const [requestHistoryId, setrequestHistoryId] = useState<number>(0);

    const onShowHistoryRequest = async (id: number) => {
        setIsOpenModalHistory(true);
        setrequestHistoryId(id);
    };

    const onCloseModalHistory = () => {
        setIsOpenModalHistory(false);
    };

    const onShowDocRequest = async (
        id: number,
        typeDoc: "report" | "minute"
    ) => {
        const routeName =
            typeDoc === "report"
                ? `requests.generate-report`
                : "requests.generate-minute";
        setDataDocModal({
            url: route(routeName, { id }),
            title: typeDoc === "report" ? "Reporte" : "Minuta",
        });

        setIsOpenDocModal(true);
    };

    const onCloseModalDocViewer = () => {
        setIsOpenDocModal(false);
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
            {/* Modal History */}
            <ModalHistoryRequestLog
                isOpen={isOpenModal}
                onClose={onCloseModalHistory}
                requestId={requestHistoryId}
            />

            {/* Modal Doc */}
            <ModalDocViewer
                isOpen={isOpenDocModal}
                url={dataDocModal.url}
                title={dataDocModal.title}
                onClose={onCloseModalDocViewer}
            />

            <div className="p-3">
                <RequestsDataTable
                    requests={requests}
                    onShowHistory={(request: UserFormRequest) =>
                        onShowHistoryRequest(request.id)
                    }
                    onShowDoc={(
                        request: UserFormRequest,
                        typeDoc: "report" | "minute"
                    ) => onShowDocRequest(request.id, typeDoc)}
                />
            </div>
        </AuthenticatedLayout>
    );
}
