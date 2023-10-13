import { onOpenSnack } from "@/store/slices/SnackBarSlice/SnackBarSlice";
import { Inertia } from "@inertiajs/inertia";
import { useDispatch } from "react-redux";

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

    return {
        processForm,
    };
};
