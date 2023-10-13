import React from "react";
import { Head, usePage } from "@inertiajs/react";
import { ListEditShowRequestPageProps, PageProps } from "@/types";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { DocRequestForm } from "./Partials/DocRequestForm";
import { Button, Grid, Link } from "@mui/material";
import { FormBarActions } from "@/Components/FormBarActions";
import SecondaryButton from "@/Components/SecondaryButton";
import { useFormRequests } from "@/Hooks/useFormRequests";

export default function Show() {
    const { request } = usePage<ListEditShowRequestPageProps>().props;
    const { processForm: hookProcessForm } = useFormRequests();
    const {
        auth: { user },
    } = usePage<PageProps>().props;

    const processForm = async () => {
        await hookProcessForm(request.id);
    };

    const finalizeRequest = async () => {
        await hookProcessForm(request.id, "finalizado");
    };

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
                        isEditable={false}
                    />
                    <Grid item rowSpacing={2} sx={{ paddingY: 5 }}>
                        <FormBarActions routeBack="requests.index">
                            {/* <SecondaryButton
                                variant="contained"
                                color="secondary"
                                onClick={processForm}
                            >
                                Procesar
                            </SecondaryButton> */}
                            {request.status.code === "requerido" && (
                                <>
                                    <Button variant="contained" color="primary">
                                        <Link
                                            href={route("requests.edit", {
                                                id: request.id,
                                            })}
                                        >
                                            Editar
                                        </Link>
                                    </Button>

                                    <Button
                                        variant="contained"
                                        color="secondary"
                                        onClick={processForm}
                                    >
                                        Procesar
                                    </Button>
                                </>
                            )}

                            {request.status.code === "proceso" && (
                                <>
                                    <Button
                                        variant="contained"
                                        color="secondary"
                                        onClick={finalizeRequest}
                                    >
                                        Finalizar
                                    </Button>
                                </>
                            )}
                            {request.status.code === "finalizado" && (
                                <>
                                    <Button variant="contained" color="success">
                                        Generar/Imprimir
                                    </Button>
                                </>
                            )}
                        </FormBarActions>
                    </Grid>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
