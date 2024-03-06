import { Head} from "@inertiajs/react";
import { PageProps } from "@/types";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { DataGrid, GridColDef } from "@mui/x-data-grid";
import { humanizeDate } from "@/Helpers";
import { Grid } from "@mui/material";
import { FormBarActions } from "@/Components/FormBarActions";

export default function HistoryLog({
    auth: { user },
    history,
    docName,
    routeName,
}: PageProps) {
    const columns: GridColDef[] = [
        {
            field: "user",
            headerName: "Usuario",
            width: 320,
            renderCell: (params) =>
                `${params.row.user.name} ${params.row.user.first_last_name} ${params.row.user.second_last_name}`,
        },
        {
            field: "action",
            headerName: "Acción",
            width: 350,
            renderCell: (params) => params.row.description,
        },

        {
            field: "created_at",
            headerName: "Fecha",
            width: 280,
            renderCell: (params) => `${humanizeDate(params.row.created_at)}`,
        },
    ];

    return (
        <AuthenticatedLayout
            user={user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Solicitudes - Ver Historial {`<${docName}>`}
                </h2>
            }
        >
            <Head title="Solicitudes" />
            <div className="p-3">
                <div className="w-full">
                    <DataGrid
                        columns={columns}
                        //@ts-expect-error "set history"
                        rows={history}
                        autoHeight={true}
                        localeText={{
                            noRowsLabel: "Sin resultados",
                        }}
                    />

                    <Grid item rowSpacing={2} sx={{ paddingY: 5 }}>
                        <FormBarActions
                            routeBack={route("requests.formDocType.index", {
                                id: routeName as string,
                            })}
                        />
                    </Grid>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
