import { UserFormRequest } from "@/types";
import { Link } from "@inertiajs/react";
import { Button, ButtonGroup } from "@mui/material";
import React, { FC } from "react";

export const ActionRequestTable: FC<{
    status: "requerido" | "proceso" | "finalizado";
    requestObject: UserFormRequest;
}> = ({ status, requestObject }) => {
    return (
        <div>
            <ButtonGroup size="small">
                {status === "requerido" && (
                    <Button variant="contained" color="primary">
                        <Link
                            href={route("requests.edit", {
                                id: requestObject.id,
                            })}
                        >
                            {" "}
                            Editar
                        </Link>
                    </Button>
                )}
                {status === "proceso" && (
                    <>
                        <Button variant="contained" color="info">
                            {" "}
                            Ver
                        </Button>
                        <Button variant="contained" color="primary">
                            {" "}
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
