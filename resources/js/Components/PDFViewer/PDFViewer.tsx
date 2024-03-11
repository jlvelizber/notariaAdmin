import { PDFViewerInterface } from "@/types/Components.interface";
import { FC } from "react";

export const PDFViewer: FC<PDFViewerInterface> = ({ url }) => {
    return (
        <div>
            <iframe src={url} width="100%" style={{ minHeight:'600px' }} />
        </div>
    );
};
