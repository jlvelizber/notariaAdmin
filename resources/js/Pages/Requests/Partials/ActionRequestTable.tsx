import SecondaryButton from "@/Components/SecondaryButton";
import React, { FC } from "react";
import { useFormRequests } from "@/Hooks/useFormRequests";
import { UserFormRequest } from "@/types";
import { Link, router } from "@inertiajs/react";
import { Button, ButtonGroup } from "@mui/material";

export const ActionRequestTable: FC<{
    status: "requerido" | "proceso" | "finalizado";
    requestObject: UserFormRequest;
}> = ({ status, requestObject }) => {
    const { processForm: hookProcessForm, printReport: printReportPdf, printMinute: printMinutePdf } =
        useFormRequests();

    const processForm = async () => {
        await hookProcessForm(requestObject.id);
    };

    const finalizeRequest = async () => {
        await hookProcessForm(requestObject.id, "finalizado");
    };

    const printReport = async () => {
        await printReportPdf(requestObject.id);
    };

    const printMinute = async () => {
        await printMinutePdf(requestObject.id);
    }

    return (
        <div className="flex w-full flex-row">
            <div className="flex w-full  justify-around ">
                    {status === "requerido" && (
                        <>
                            <Button variant="contained" color="primary">
                                <Link
                                    href={route("requests.edit", {
                                        id: requestObject.id,
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
                    {status === "proceso" && (
                        <>
                            <Button
                                variant="contained"
                                color="info"
                                href={route("requests.show", {
                                    id: requestObject.id,
                                })}
                            >
                                Ver
                            </Button>
                            <Button
                                variant="contained"
                                color="secondary"
                                onClick={finalizeRequest}
                            >
                                Finalizar
                            </Button>
                        </>
                    )}
                    {status === "finalizado" &&
                        requestObject.doc.category.name === "permiso_salida" && (
                            <>
                                <Button
                                    variant="contained"
                                    color="success"
                                    onClick={printReport}
                                >
                                    Documento
                                </Button>
                                <Button
                                    variant="contained"
                                    color="success"
                                    onClick={printMinute}
                                >
                                    Acta
                                </Button>
                            </>
                        )}
                
            </div>
        </div>
    );
};
