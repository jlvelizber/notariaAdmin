import React, { FC } from "react";
import { Button, ButtonGroup } from "@mui/material";
import VisibilityIcon from "@mui/icons-material/Visibility";
import EditIcon from "@mui/icons-material/Edit";
import DeleteIcon from "@mui/icons-material/Delete";
const ActionDataTableButtons: FC<{
    id: number;
    isEdit: boolean;
    onEditHandler?: () => void;
    isDelete: boolean;
    onDeleteHandler?: () => void;
    isShow: Boolean;
    onShowHandler?: () => void;
}> = ({
    id,
    isShow,
    onShowHandler,
    isEdit,
    onEditHandler,
    isDelete,
    onDeleteHandler,
}): JSX.Element => {
    return (
        <ButtonGroup variant="contained" size="small">
            {isShow && (
                <Button onClick={onShowHandler}>
                    <VisibilityIcon fontSize="small" /> Ver
                </Button>
            )}
            {isEdit && (
                <Button onClick={onEditHandler}>
                    <EditIcon fontSize="small" /> Editar
                </Button>
            )}
            {isDelete && (
                <Button onClick={onDeleteHandler}>
                    <DeleteIcon fontSize="small" /> Eliminar
                </Button>
            )}
        </ButtonGroup>
    );
};

export default ActionDataTableButtons;
