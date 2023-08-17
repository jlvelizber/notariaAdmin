import React, { useState } from "react";
import {
    Dialog,
    DialogTitle,
    DialogContent,
    DialogActions,
    Button,
} from "@mui/material";
import DeleteIcon from '@mui/icons-material/Delete';
import { DeleteModalProps } from "@/types/Components.interface";

const DeleteModal: React.FC<DeleteModalProps> = ({
    isOpen,
    onClose,
    onDelete,
    resourceName,
}) => {
    return (
        <Dialog open={isOpen} onClose={onClose}>
            <DialogTitle>Delete {resourceName}</DialogTitle>
            <DialogContent>
                <div className="flex items-center space-x-2">
                    <DeleteIcon className="w-6 h-6 text-red-500" />
                    <p>Estás seguro de eliminar <strong>{resourceName}?</strong> </p>
                </div>
            </DialogContent>
            <DialogActions>
                <Button onClick={onClose} color="primary">
                    Cancel
                </Button>
                <Button onClick={onDelete} color="error">
                    Delete
                </Button>
            </DialogActions>
        </Dialog>
    );
};

export default DeleteModal;
