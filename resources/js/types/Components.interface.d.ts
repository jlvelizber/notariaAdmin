import { ReactElement, ReactNode } from "react";
import { ModalProps } from "@mui/material";

export interface SackAppInterface {
    open: boolean;
    message?: string;
    severity: "error" | "warning" | "success" | "info";
}

export interface DeleteModalProps {
    isOpen: boolean;
    onClose: () => void;
    onDelete: () => void;
    resourceName: string;
}

export interface FormBarActionsInterface {
    saveAction?: () => void;
    deleteAction?: () => void;
    routeBack: string | void;
    children?: ReactNode;
}

export interface HistoryModalProps {
    isOpen: boolean;
    requestId: number;
    onClose: () => void;
    children?: ReactNode;
}

export interface CustomModalProps extends ModalProps {
    size?: "small" | "medium" | "large"; // Custom size options
    closable?: boolean; // Indicates whether to show the close icon
    autoClose?: boolean; // Indicates whether
    closeable?: boolean;
    children: ReactElement;
    onClose: () => void; //
}