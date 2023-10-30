import React, { FC } from "react";
import { Role, UserFormRequest } from "@/types";
import { DataGrid, GridColDef, GridValueGetterParams } from "@mui/x-data-grid";
import ActionDataTableButtons from "@/Components/ActionDataTableButtons";
import { Link, router } from "@inertiajs/react";
import { get } from "http";
import { ActionRequestTable } from "./ActionRequestTable";
import { humanizeDate } from "@/Helpers/dates";

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
            field: "customer",
            headerName: "Cliente",
            width: 320,
            renderCell: (params) =>
                `${params.row.customer.name} ${params.row.customer.first_last_name} ${params.row.customer.second_last_name}`,
        },
        {
            field: "form_type",
            headerName: "Formulario",
            width: 350,
            renderCell: (params) => params.row.doc.name,
        },

        {
            field: "created_at",
            headerName: "Fecha de creación / Modificación",
            width: 280,
            renderCell: (params) =>
                `${humanizeDate(params.row.created_at)} - ${humanizeDate(
                    params.row.updated_at
                )}`,
        },

        {
            field: "status",
            headerName: "Estado",
            width: 230,
            renderCell: (params) => params.row.status.name,
        },
        {
            field: "actions",
            headerName: "Acciones",
            width: 300,
            renderCell: (params) => (
                <ActionRequestTable
                    status={params.row.status.code}
                    requestObject={params.row}
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
            autoHeight={true}
            localeText={{
                noRowsLabel: 'Sin resultados'
            }}

        />
    );
};

export default RequestsDataTable;
