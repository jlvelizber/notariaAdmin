import SecondaryButton from "@/Components/SecondaryButton";
import React, { FC } from "react";
import { useFormRequests } from "@/Hooks/useFormRequests";
import { UserFormRequest } from "@/types";
import { Link } from "@inertiajs/react";
import { Button, ButtonGroup } from "@mui/material";

export const ActionRequestTable: FC<{
    status: "requerido" | "proceso" | "finalizado";
    requestObject: UserFormRequest;
}> = ({ status, requestObject }) => {
    const { processForm: hookProcessForm } = useFormRequests();

    const processForm = async () => {
        await hookProcessForm(requestObject.id);
    };

    const finalizeRequest = async () => {
        await hookProcessForm(requestObject.id, "finalizado");
    };

    return (
        <div>
            <ButtonGroup size="small">
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
                {status === "finalizado" && (
                    <>
                        <Button variant="contained" color="success">
                            Generar/Imprimir
                        </Button>
                    </>
                )}
            </ButtonGroup>
        </div>
    );
};