import React, { FC } from "react";
import { Role } from "@/types";
import { DataGrid, GridColDef } from "@mui/x-data-grid";

const RolesTableData: FC<{ roles: Role[] }> = ({ roles }) => {
    const columns: GridColDef[] = [
        {
            field: "id",
            headerName: "ID",
            width: 50,
        },
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
            width: 200,
        },
        {
            field: "is_deletetable",
            headerName: "Es Eliminable",
            width: 100,
        },
    ];

    return <DataGrid checkboxSelection columns={columns} rows={roles} />;
};

export default RolesTableData;
