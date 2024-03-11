import { FC } from "react";
import { DataGrid, GridColDef } from "@mui/x-data-grid";
import { Chip, ChipOwnProps } from "@mui/material";
import { UserFormRequest } from "@/types";
import { ColorStatusRequestFile } from "@/Contants";
import { humanizeDate } from "@/Helpers/dates";
import { ActionRequestTable } from "./ActionRequestTable";

const getColorChip = (statusCode: string) => {
    return (
        (ColorStatusRequestFile[statusCode] as ChipOwnProps) ||
        (ColorStatusRequestFile.finalizado as ChipOwnProps)
    );
};

export const RequestsDataTable: FC<{
    requests: UserFormRequest[];
    onShowHistory(request: UserFormRequest): void;
    onShowDoc(requestId: UserFormRequest, typeDoc: "report" | "minute"): void;
}> = ({ requests, onShowHistory, onShowDoc }) => {
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
            renderCell: (params) => (
                <Chip
                    label={params.row.status.name}
                    //@ts-expect-error "Default value"
                    color={getColorChip(params.row.status.code)}
                    size="small"
                />
            ),
        },
        {
            field: "actions",
            headerName: "Acciones",
            width: 350,
            renderCell: (params) => (
                <ActionRequestTable
                    status={params.row.status.code}
                    requestObject={params.row}
                    onShowHistory={(request: UserFormRequest) =>
                        onShowHistory(request)
                    }
                    onShowMinute={(request: UserFormRequest) =>
                        onShowDoc(request, "minute")
                    }
                    onShowReport={(request: UserFormRequest) =>
                        onShowDoc(request, "report")
                    }
                />
            ),
        },
    ];

    return (
        <DataGrid
            disableRowSelectionOnClick
            columns={columns}
            rows={requests}
            autoHeight={true}
        />
    );
};
