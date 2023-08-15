import { ReactNode } from "react";

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