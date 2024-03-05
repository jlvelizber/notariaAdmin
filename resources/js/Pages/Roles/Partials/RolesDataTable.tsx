import React, { FC } from "react";
import { Role } from "@/types";
import { DataGrid, GridColDef, GridValueGetterParams } from "@mui/x-data-grid";
import { ActionDataTableButtons } from "@/Components";
import { router } from "@inertiajs/react";

export const RolesDataTable: FC<{ roles: Role[]; onDelete: (role: Role) => void }> = ({
    roles,
    onDelete,
}) => {
    const onEditRole = (role: Role) => {
        router.get(`roles/${role}/edit`);
    };

    const onDeleteRole = (role: Role) => {
        onDelete(role);
    };

    const columns: GridColDef[] = [
        {
            field: "name",
            headerName: "Nombre",
            width: 280,
        },
        {
            field: "display_name",
            headerName: "Nombre a mostrar",
            width: 150,
        },
        {
            field: "description",
            headerName: "Descripción",
            width: 300,
        },
        {
            field: "is_deletetable",
            headerName: "Es Eliminable",
            valueGetter: (params: GridValueGetterParams) =>
                params.row.is_deletetable ? "Si" : "No",
            width: 150,
        },
        {
            field: "actions",
            headerName: "Acciones",
            width: 300,
            renderCell: (params) => (
                <ActionDataTableButtons
                    id={params.row.id}
                    isDelete={params.row.is_deletetable}
                    isEdit={true}
                    onEditHandler={() => onEditRole(params.row.id)}
                    onDeleteHandler={() => onDeleteRole(params.row)}
                />
            ),
        },
    ];

    return (
        <DataGrid
            checkboxSelection
            disableRowSelectionOnClick
            columns={columns}
            rows={roles}
        />
    );
};
