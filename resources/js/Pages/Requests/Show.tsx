import { Fragment } from "react";
import { Head, usePage } from "@inertiajs/react";
import { Tab } from "@headlessui/react";
import { ListEditShowRequestPageProps, PageProps } from "@/types";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { DocRequestForm } from "./Partials/DocRequestForm";
import { DocsRequestsGenerated, HistoryLogDataTable } from "./Partials";

export default function Show() {
    const { request } = usePage<ListEditShowRequestPageProps>().props;
    const {
        auth: { user },
    } = usePage<PageProps>().props;

    return (
        <AuthenticatedLayout
            user={user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Solicitudes - Ver Solicitud {`<${request.doc.name}>`}
                </h2>
            }
        >
            <Head title="Solicitudes" />
            <div className="p-3">
                <div className="overflow-hidden">
                    <Tab.Group>
                        <Tab.List className="w-full flex">
                            <Tab as={Fragment}>
                                {({ selected }) => (
                                    /* Use the `selected` state to conditionally style the selected tab. */
                                    <button
                                        className={`rounded-tl-md rounded-tr-md  cursor-pointer px-4 py-2  text-gray-600 hover:border-gray-300 hover:border-b-2 focus:outline-none  ${
                                            selected
                                                ? "bg-gray-200"
                                                : "bg-white"
                                        }`}
                                    >
                                        Solicitud
                                    </button>
                                )}
                            </Tab>
                            <Tab as={Fragment}>
                                {({ selected }) => (
                                    /* Use the `selected` state to conditionally style the selected tab. */
                                    <button
                                        className={`rounded-tl-md rounded-tr-md  cursor-pointer px-4 py-2  text-gray-600 hover:border-gray-300 hover:border-b-2 focus:outline-none  ${
                                            selected
                                                ? "bg-gray-200"
                                                : "bg-white"
                                        }`}
                                    >
                                        Historial
                                    </button>
                                )}
                            </Tab>

                            {request.doc.category.name === "permiso_salida" && (
                                <Tab as={Fragment}>
                                    {({ selected }) => (
                                        /* Use the `selected` state to conditionally style the selected tab. */
                                        <button
                                            className={`rounded-tl-md rounded-tr-md  cursor-pointer px-4 py-2  text-gray-600 hover:border-gray-300 hover:border-b-2 focus:outline-none  ${
                                                selected
                                                    ? "bg-gray-200"
                                                    : "bg-white"
                                            }`}
                                        >
                                            Documentación
                                        </button>
                                    )}
                                </Tab>
                            )}
                        </Tab.List>
                        <Tab.Panels className="pt-3">
                            <Tab.Panel>
                                <DocRequestForm
                                    request={request}
                                    isEditable={false}
                                />
                            </Tab.Panel>
                            <Tab.Panel>
                                <HistoryLogDataTable
                                    rows={request?.logs || []}
                                />
                            </Tab.Panel>

                            {request.doc.category.name === "permiso_salida" && request.status.code === "finalizado" && (
                                <Tab.Panel>
                                    <DocsRequestsGenerated
                                        requestId={request.id}
                                    />
                                </Tab.Panel>
                            )}
                        </Tab.Panels>
                    </Tab.Group>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
