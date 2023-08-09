import React, { FC } from "react";
import { Role } from "@/types";
import { DataGrid, GridColDef, GridValueGetterParams } from "@mui/x-data-grid";
import ActionDataTableButtons from "@/Components/ActionDataTableButtons";

const RolesDataTable: FC<{ roles: Role[] }> = ({ roles }) => {


    const onShowRole = (idRole: number) => {
        console.log(idRole);
    }

    const onEditRole = (idRole: number) => {
        route("roles.edit", idRole)
    }



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
                    isDelete={params.row.id.is_deletetable}
                    isEdit={true}
                    isShow={true}
                    onShowHandler={() => onShowRole(params.row.id)}
                    onDeleteHandler={() => onEditRole(params.row.id)}
                />
            ),
        },
    ];

    return <DataGrid checkboxSelection columns={columns} rows={roles} />;
};

export default RolesDataTable;
