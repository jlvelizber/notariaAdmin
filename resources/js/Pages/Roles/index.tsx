import Button from "@mui/material/Button";
import { Head } from "@inertiajs/react";
import { RolePageProps } from "@/types";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import RolesDataTable from "./Partials/RolesDataTable";

export default function Index({
    roles,
    auth,
}: RolePageProps<{ mustVerifyEmail: boolean; status?: string }>) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Roles
                </h2>
            }
        >
            <Head title="Roles del sistema" />

            <div className="p-3">
                <div className="w-full">
                    <Button className="w-full text-center h-10 !my-5 !p-6" variant="contained">
                        Nuevo Rol
                    </Button>
                </div>

                <RolesDataTable roles={roles} />
            </div>
        </AuthenticatedLayout>
    );
}
