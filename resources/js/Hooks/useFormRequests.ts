import axios from "axios";
import { onOpenSnack } from "@/store/slices/SnackBarSlice/SnackBarSlice";
import { Inertia } from "@inertiajs/inertia";
import { useDispatch } from "react-redux";
import { downloadResponsePDF } from "@/Helpers";

export const useFormRequests = () => {
    const dispatch = useDispatch();

    const processForm = async (
        requestId: number,
        status: "proceso" | "requerido" | "finalizado" = "proceso"
    ) => {
        await Inertia.put(route("requests.update", { id: requestId }), {
            status,
        });

        // TODO: VERIFICAR QUE TODO ESTE BIEN
        dispatch(
            onOpenSnack({
                message: "Solicitud Actualizada correctamente",
                severity: "success",
            })
        );
    };

    const printReport = (id: number) => {
        axios
            .get(`/requests/generate-report/${id}`, {
                responseType: "blob",
            })
            .then((response) => {
                downloadResponsePDF(response);
            });
    };

    const printMinute = (id: number) => {
        axios
            .get(`/requests/generate-minute/${id}`, {
                responseType: "blob",
            })
            .then((response) => {
                downloadResponsePDF(response, "minute");
            });
    };

    return {
        processForm,
        printReport,
        printMinute,
    };
};
