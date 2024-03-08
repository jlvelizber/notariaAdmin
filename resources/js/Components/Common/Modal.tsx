import { FC } from "react";
import { Modal as ModalMUI, Fade, IconButton } from "@mui/material";
import { CustomModalProps } from "@/types/Components.interface";
import CloseIcon from "@mui/icons-material/Close";

import "@styles/Modal.css";

export const Modal: FC<CustomModalProps> = ({
    children,
    size,
    open = false,
    onClose,
    closable,
    autoClose = false,
    ...params
}) => {
    const handleClose = (
        e: Event,
        reason: "backdropClick" | "escapeKeyDown"
    ) => {
        if (reason === "backdropClick" && !autoClose) return;

        onClose();
    };

    return (
        <ModalMUI id="modal" onClose={handleClose} open={open} {...params}>
            <Fade in={open}>
                <div className={`modal ${size}`}>
                    {closable && (
                        <IconButton className="close-icon" onClick={onClose}>
                            <CloseIcon />
                        </IconButton>
                    )}
                    <div className="modal-content">{children}</div>
                </div>
            </Fade>
        </ModalMUI>
    );
};
