import { FC } from "react";
import { Link } from "@inertiajs/react";
import { useFormRequests } from "@/Hooks/useFormRequests";
import { UserFormRequest } from "@/types";
import { Button, ButtonGroup } from "@mui/material";
import HistoryIcon from "@mui/icons-material/History";
import VisibilityIcon from "@mui/icons-material/Visibility";
import EditIcon from "@mui/icons-material/Edit";
import DescriptionIcon from "@mui/icons-material/Description";
import CachedIcon from "@mui/icons-material/Cached";
import CheckIcon from "@mui/icons-material/Check";

export const ActionRequestTable: FC<{
    status: "requerido" | "proceso" | "finalizado";
    requestObject: UserFormRequest;
    onShowHistory: (requestObject: UserFormRequest) => void;
    onShowReport: (requestId: UserFormRequest) => void;
    onShowMinute: (requestId: UserFormRequest) => void;
}> = ({ status, requestObject, onShowHistory, onShowMinute, onShowReport }) => {
    const { processForm: hookProcessForm } = useFormRequests();

    const processForm = async () => {
        await hookProcessForm(requestObject.id);
    };

    const finalizeRequest = async () => {
        await hookProcessForm(requestObject.id, "finalizado");
    };

    const showReport = async () => {
        onShowReport(requestObject);
    };

    const showMinute = async () => {
        onShowMinute(requestObject);
    };

    const showHistory = async () => {
        onShowHistory(requestObject);
    };

    return (
        <div className="flex w-full">
            <div className="self-center">
                <ButtonGroup>
                    {status === "requerido" && (
                        <>
                            <Button
                                variant="contained"
                                color="primary"
                                title="Editar Solicitud"
                            >
                                <Link
                                    href={route("requests.edit", {
                                        id: requestObject.id,
                                    })}
                                >
                                    <EditIcon />
                                </Link>
                            </Button>

                            <Button
                                variant="contained"
                                color="secondary"
                                onClick={processForm}
                                title="Procesar"
                            >
                                <CachedIcon />
                            </Button>
                        </>
                    )}
                    {status === "proceso" && (
                        <>
                            <Button
                                variant="contained"
                                color="info"
                                title="Ver"
                            >
                                <Link
                                    href={route("requests.show", {
                                        id: requestObject.id,
                                    })}
                                >
                                    <VisibilityIcon />
                                </Link>
                            </Button>
                            <Button
                                variant="contained"
                                color="secondary"
                                onClick={finalizeRequest}
                                title="Finalizar"
                            >
                                <CheckIcon />
                            </Button>
                        </>
                    )}

                    {status === "finalizado" && (
                        <Button variant="contained" color="info" title="Ver">
                            <Link
                                href={route("requests.show", {
                                    id: requestObject.id,
                                })}
                            >
                                <VisibilityIcon />
                            </Link>
                        </Button>
                    )}
                    {status === "finalizado" &&
                        requestObject.doc.category.name ===
                            "permiso_salida" && (
                            <>
                                <Button
                                    variant="contained"
                                    color="success"
                                    onClick={showReport}
                                    title="Documento"
                                >
                                    <DescriptionIcon />
                                </Button>
                                <Button
                                    variant="contained"
                                    color="success"
                                    onClick={showMinute}
                                    title="Acta"
                                >
                                    <DescriptionIcon />
                                </Button>
                            </>
                        )}

                    <Button
                        variant="contained"
                        color="inherit"
                        onClick={showHistory}
                        title="Historial"
                        size="small"
                    >
                        <HistoryIcon />
                    </Button>
                </ButtonGroup>
            </div>
        </div>
    );
};
