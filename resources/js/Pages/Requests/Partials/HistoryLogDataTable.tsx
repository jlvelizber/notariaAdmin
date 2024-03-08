import { FC } from "react";
import { DataGrid, GridColDef, GridValidRowModel } from "@mui/x-data-grid";
import { humanizeDate } from "@/Helpers";

export const HistoryLogDataTable: FC<{ rows: GridValidRowModel[] | [] }> = ({
    rows,
}) => {
    const columns: GridColDef[] = [
        {
            field: "user",
            headerName: "Usuario",
            width: 320,
            sortable: false,
            disableColumnMenu: true,
            renderCell: (params) =>
                `${params.row.user.name} ${params.row.user.first_last_name} ${params.row.user.second_last_name}`,
            // console.log(params)
        },
        {
            field: "action",
            headerName: "Acción",
            width: 250,
            sortable: false,
            disableColumnMenu: true,
            renderCell: (params) => params.row.description,
        },

        {
            field: "created_at",
            headerName: "Fecha",
            width: 180,
            filterable: false,
            renderCell: (params) => `${humanizeDate(params.row.created_at)}`,
        },
    ];
    return (
        <DataGrid
            columns={columns}
            rows={rows}
            autoHeight={true}
        />
    );
};
