import React, { FC } from "react";
import { Role } from "@/types";
import { DataGrid, GridColDef, GridValueGetterParams } from "@mui/x-data-grid";
import ActionDataTableButtons from "@/Components/ActionDataTableButtons";
import { Link, router } from "@inertiajs/react";
import { get } from "http";

const RolesDataTable: FC<{ roles: Role[] }> = ({ roles }) => {
    const onShowRole = (idRole: number) => {};

    const onEditRole = (role: Role) => {
        router.get(`roles/edit/${role}`);
        //    get( route('roles.edit', [ role ]));
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
                    onShowHandler={() => onShowRole(params.row.id)}
                    onEditHandler={() => onEditRole(params.row.id)}
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

export default RolesDataTable;
