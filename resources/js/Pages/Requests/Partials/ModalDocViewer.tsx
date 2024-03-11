import { FC } from "react";
import { Modal } from "@/Components/Common";
import { ModalDocViewerInterface } from "@/types/Components.interface";
import { PDFViewer } from "@/Components";

export const ModalDocViewer: FC<ModalDocViewerInterface> = ({
    isOpen,
    onClose,
    url,
    title
}) => {
    return (
        <Modal
            open={isOpen}
            onClose={onClose}
            size="large"
            autoClose={true}
            closable
            disablePortal
        >
            <>
                <h2 className="font-semibold">{title}</h2>
                <PDFViewer url={url} />
            </>
        </Modal>
    );
};
