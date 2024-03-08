import axios, { AxiosResponse } from "axios";
import { onOpenSnack } from "@/store/slices/SnackBarSlice/SnackBarSlice";
import { Inertia } from "@inertiajs/inertia";
import { useDispatch } from "react-redux";
import { downloadResponsePDF } from "@/Helpers";
import { CustomResponseType } from "@/Contants";
import { HistoryLogInterface } from "@/types";

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

    const printReport = async (id: number) => {
        axios
            .get(`/requests/generate-report/${id}`, {
                responseType: CustomResponseType.BLOB,
            })
            .then((response) => {
                downloadResponsePDF(response);
            });
    };

    const printMinute = async (id: number) => {
        axios
            .get(`/requests/generate-minute/${id}`, {
                responseType: CustomResponseType.BLOB,
            })
            .then((response) => {
                downloadResponsePDF(response, "minute");
            });
    };

    const loadHistory = async (id: number): Promise<HistoryLogInterface[]> => {
        const data = await axios
            .get(route("requests.logs", { id }), {
                responseType: CustomResponseType.JSON,
            })
            .then(({ data }: AxiosResponse) => {
                return data as HistoryLogInterface[];
            });
        return data;
    };

    return {
        processForm,
        printReport,
        printMinute,
        loadHistory,
    };
};
