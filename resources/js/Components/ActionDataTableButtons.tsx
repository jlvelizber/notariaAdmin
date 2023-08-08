import React, { FC } from "react";
import { Button, ButtonGroup } from "@mui/material";
import VisibilityIcon from "@mui/icons-material/Visibility";
import EditIcon from "@mui/icons-material/Edit";
import DeleteIcon from "@mui/icons-material/Delete";
const ActionDataTableButtons: FC<{
    id: number;
    isEdit: boolean;
    isDelete: boolean;
    isShow: Boolean;
}> = ({ id, isShow, isEdit, isDelete }): JSX.Element => {
    return (
        <ButtonGroup variant="contained" size="small">
            {isShow && (
                <Button>
                    <VisibilityIcon fontSize="small" /> Ver
                </Button>
            )}
            {isEdit && (
                <Button>
                    <EditIcon fontSize="small" /> Editar
                </Button>
            )}
            {isDelete && (
                <Button>
                    <DeleteIcon fontSize="small" /> Eliminar
                </Button>
            )}
        </ButtonGroup>
    );
};

export default ActionDataTableButtons;
