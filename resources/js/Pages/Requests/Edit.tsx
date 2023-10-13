import React from "react";
import { Head, usePage } from "@inertiajs/react";
import { ListEditShowRequestPageProps, PageProps } from "@/types";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { FormDataUserApplicant } from "@/Components/FormDataUserApplicant";
import { DocRequestForm } from "./Partials/DocRequestForm";

export default function Edit() {
    const { request } = usePage<ListEditShowRequestPageProps>().props;
    const {
        auth: { user },
    } = usePage<PageProps>().props;
    
    return (
        <AuthenticatedLayout
            user={user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    {request?.id
                        ? `Solicitudes - Editar Solicitud <${request.doc.name}>`
                        : `Solicitudes - Nuevo Rol`}
                </h2>
            }
        >
            <Head title="Solicitudes" />
            <div className="p-3">
                <div className="w-full">
                    <DocRequestForm
                        sections={request.doc.field_requests}
                        customer={request.customer}
                        requestId={request.id}
                        formData={request.form_request_body}
                    />
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
