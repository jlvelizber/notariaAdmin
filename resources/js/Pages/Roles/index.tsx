import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { RolePageProps } from "@/types";
import RolesTableData from "./RolesTableData";

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

            <RolesTableData roles={roles} />
        </AuthenticatedLayout>
    );
}
