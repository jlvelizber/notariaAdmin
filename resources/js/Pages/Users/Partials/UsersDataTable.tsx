import React, { FC } from "react";
import { User } from "@/types";
import { DataGrid, GridColDef, GridValueGetterParams } from "@mui/x-data-grid";
import ActionDataTableButtons from "@/Components/ActionDataTableButtons";
import { router } from "@inertiajs/react";

const UsersDataTable: FC<{ users: User[]; onDelete: (role: User) => void }> = ({
    users,
    onDelete,
}) => {
    const onEditRole = (user: User) => {
        router.get(`users/${user}/edit`);
    };

    const onDeleteUser = (user: User) => {
        onDelete(user);
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
                    onDeleteHandler={() => onDeleteUser(params.row)}
                />
            ),
        },
    ];

    return (
        <DataGrid
            checkboxSelection
            disableRowSelectionOnClick
            columns={columns}
            rows={users}
        />
    );
};

export default UsersDataTable;
