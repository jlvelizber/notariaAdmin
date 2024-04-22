import { FC } from "react";
import { Link } from "@inertiajs/react";
import { DataGrid, GridColDef } from "@mui/x-data-grid";
import { Button } from "@mui/material";
import EditIcon from "@mui/icons-material/Edit";
import { ConfigurationInterface } from "@/types";
import { humanizeDate } from "@/Helpers";

export const ConfigurationDataTable: FC<{
    configurations: ConfigurationInterface[];
}> = ({ configurations }) => {
    const columns: GridColDef[] = [
        {
            field: "label",
            headerName: "Opción",
            width: 370,
        },
        {
            field: "value",
            headerName: "Valor",
            width: 600,
        },

        {
            field: "updated_at",
            headerName: "Última modificación",
            width: 200,
            filterable: false,
            renderCell: (params) => `${humanizeDate(params.row.created_at)}`,
        },
        {
            field: "actions",
            headerName: "Acciones",
            width: 80,
            renderCell: (params) => (
                <Button
                    key={params.row.id}
                    color="primary"
                    variant="contained"
                    title="Editar Configuración"
                    size="small"
                >
                    <Link
                        href={route("settings.types.edit", {
                            id: params.row.id,
                        })}
                    >
                        <EditIcon />
                    </Link>
                </Button>
            ),
        },
    ];

    return (
        <DataGrid columns={columns} rows={configurations} autoHeight={true} />
    );
};
