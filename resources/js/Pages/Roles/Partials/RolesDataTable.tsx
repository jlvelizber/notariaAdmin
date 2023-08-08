import React, { FC } from "react";
import { Role } from "@/types";
import { DataGrid, GridColDef, GridValueGetterParams } from "@mui/x-data-grid";
import ActionDataTableButtons from "@/Components/ActionDataTableButtons";

const RolesDataTable: FC<{ roles: Role[] }> = ({ roles }) => {
    const columns: GridColDef[] = [
        {
            field: "name",
            headerName: "Nombre",
            width: 130,
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
            width:300,
            renderCell: (params) => (
                <ActionDataTableButtons
                    id={params.row.id}
                    isDelete={true}
                    isEdit={true}
                    isShow={true}
                />
            ),
        },
    ];

    return <DataGrid checkboxSelection columns={columns} rows={roles} />;
};

export default RolesDataTable;
