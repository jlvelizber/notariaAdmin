import { Grid } from "@mui/material";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps } from "@/types";
import StatisticsCard from "@/Components/StatisticsCard";

export default function Dashboard({
    auth,
    totalCustomer,
    totalUsers,
    totalRequests
}: PageProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Inicio
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="p-6 text-gray-900">
                <Grid container classes={{ root: "flex flex-row " }}>
                    {/* Customers */}
                    <Grid item className="basis-full md:basis-1/4">
                        <StatisticsCard
                            title="Total Clientes"
                            value={totalCustomer as number}
                        />
                    </Grid>
                    <Grid className="basis-full md:basis-1/4">
                        {/* Users */}
                        <StatisticsCard
                            title="Total Usuarios"
                            value={totalUsers as number}
                        />
                    </Grid>
                    <Grid className="basis-full md:basis-1/4">
                        {/* Total requests */}
                        <StatisticsCard
                            title="Trámites del mes"
                            value={totalRequests as number}
                        />
                    </Grid>
                </Grid>
            </div>
        </AuthenticatedLayout>
    );
}
