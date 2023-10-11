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
            width: 350,
            renderCell: (params) => params.row.doc.name,
        },
        {
            field: "customer",
            headerName: "Cliente",
            width: 350,
            renderCell: (params) =>
                `${params.row.customer.name} ${params.row.customer.first_last_name} ${params.row.customer.second_last_name}`,
        },

        {
            field: "status",
            headerName: "Estado",
            width: 300,
            renderCell: (params) => params.row.status.name,
        },
        {
            field: "actions",
            headerName: "Acciones",
            width: 300,
            renderCell: (params) => (
                <ActionDataTableButtons id={params.row.id} isShow={true} />
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
