import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { NewEditUserPageProps } from "@/types";
import { Head } from "@inertiajs/react";

import FormAdminUser from "./Partials/FormAdminUser";

export default function Create({ auth, user }: NewEditUserPageProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    {user?.id
                        ? `Usuarios - Editar Usuario<${user.name}>`
                        : `Usuarios - Nuevo Usuario`}
                </h2>
            }
        >
            <Head title="Usuarios del sistema" />

            <div className="p-3">
                <div className="w-full">
                    <FormAdminUser user={user || null} />
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
