import { FC } from "react";
import { Button } from "@mui/material";
import DescriptionIcon from "@mui/icons-material/Description";
import { useFormRequests } from "@/Hooks/useFormRequests";
import { PDFViewer } from "@/Components";
import { UserFormRequest } from "@/types";

export const DocsRequestsGenerated: FC<{
    requestId: Partial<UserFormRequest["id"]>;
}> = ({ requestId: id }) => {
    const { printReport: printReportPdf, printMinute: printMinutePdf } =
        useFormRequests();

    const printReport = async () => {
        await printReportPdf(id);
    };

    const printMinute = async () => {
        await printMinutePdf(id);
    };
    return (
        <div className="flex justify-between space-x-4">
            <div className="basis-1/2 space-y-2">
                <h3 className="font-semibold">Reporte</h3>
                <PDFViewer url={route("requests.generate-report", { id })} />
                <Button
                    variant="contained"
                    color="success"
                    onClick={printReport}
                    title="Documento"
                    fullWidth
                    className="py-2"
                >
                    <DescriptionIcon /> Descargar
                </Button>
            </div>
            <div className="basis-1/2 space-y-2">
                <h3 className="font-semibold">Minuta</h3>
                <PDFViewer url={route("requests.generate-minute", { id })} />
                <Button
                    variant="contained"
                    color="success"
                    onClick={printMinute}
                    title="Acta"
                    fullWidth
                    className="py-2"
                >
                    <DescriptionIcon /> Descargar
                </Button>
            </div>
        </div>
    );
};
