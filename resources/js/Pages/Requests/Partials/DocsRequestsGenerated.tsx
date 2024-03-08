import { FC } from "react";
import { Button } from "@mui/material";
import { useFormRequests } from "@/Hooks/useFormRequests";
import DescriptionIcon from "@mui/icons-material/Description";
import { UserFormRequest } from "@/types";

export const DocsRequestsGenerated: FC<{
    requestId: Partial<UserFormRequest["id"]>;
}> = ({ requestId }) => {
    const { printReport: printReportPdf, printMinute: printMinutePdf } =
        useFormRequests();

    const printReport = async () => {
        await printReportPdf(requestId);
    };

    const printMinute = async () => {
        await printMinutePdf(requestId);
    };
    return (
        <div>
            <Button
                variant="contained"
                color="success"
                onClick={printReport}
                title="Documento"
            >
                <DescriptionIcon />
            </Button>
            <Button
                variant="contained"
                color="success"
                onClick={printMinute}
                title="Acta"
            >
                <DescriptionIcon />
            </Button>
        </div>
    );
};
