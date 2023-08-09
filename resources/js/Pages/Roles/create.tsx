import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { NewRolePageProps, RolePageProps } from "@/types";
import { Head } from "@inertiajs/react";

import FormAdminRole from "./Partials/FormAdminRole";

export default function Create({
    auth,
    role,
}: NewRolePageProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Roles - Nuevo Rol
                </h2>
            }
        >
            <Head title="Roles del sistema" />

            <div className="p-3">
                <div className="w-full">
                    <FormAdminRole role={null}/>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
