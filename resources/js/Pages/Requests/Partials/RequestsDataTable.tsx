import React, { FC } from "react";
import { Role, UserFormRequest } from "@/types";
import { DataGrid, GridColDef, GridValueGetterParams } from "@mui/x-data-grid";
import ActionDataTableButtons from "@/Components/ActionDataTableButtons";
import { Link, router } from "@inertiajs/react";
import { get } from "http";

const RequestsDataTable: FC<{ requests: UserFormRequest[] }> = ({
    requests,
}) => {
    const onEditRole = (role: Role) => {
        // router.get(`roles/${role}/edit`);
    };

    const onDeleteRole = (role: Role) => {
        // onDelete(role)
    };

    const columns: GridColDef[] = [
        {
            field: "form_type",
            headerName: "Formulario",
            width: 150,
        },
        {
            field: "customer",
            headerName: "Cliente",
            width: 280,
        },

        {
            field: "status",
            headerName: "Estado",
            width: 300,
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
            rows={requests}
        />
    );
};

export default RequestsDataTable;
