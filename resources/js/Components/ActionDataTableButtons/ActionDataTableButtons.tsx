import React, { FC } from "react";
import { Button, ButtonGroup } from "@mui/material";
import VisibilityIcon from "@mui/icons-material/Visibility";
import EditIcon from "@mui/icons-material/Edit";
import DeleteIcon from "@mui/icons-material/Delete";
export const ActionDataTableButtons: FC<{
    isEdit?: boolean;
    onEditHandler?: () => void;
    isDelete?: boolean;
    onDeleteHandler?: () => void;
    isShow?: boolean | false;
    onShowHandler?: () => void;
}> = ({
    isShow,
    onShowHandler,
    isEdit,
    onEditHandler,
    isDelete,
    onDeleteHandler,
}): JSX.Element => {
    return (
        <ButtonGroup variant="contained" size="small">
            {isShow ? (
                <Button onClick={onShowHandler} title="Ver">
                    <VisibilityIcon fontSize="small" /> 
                </Button>
            ): null}
            {isEdit ? (
                <Button onClick={onEditHandler} title="Editar">
                    <EditIcon fontSize="small" /> 
                </Button>
            ): null}
            {isDelete ? (
                <Button onClick={onDeleteHandler} title="Eliminar" color="warning">
                    <DeleteIcon fontSize="small" /> 
                </Button>
            ) : null}
        </ButtonGroup>
    );
};
