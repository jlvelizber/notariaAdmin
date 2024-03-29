import { useState } from "react";
import { useDispatch } from "react-redux";
import { Head, router } from "@inertiajs/react";
import { Role, RolePageProps } from "@/types";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import {RolesDataTable} from "./Partials";
import {PrimaryButton, DeleteModal} from "@/Components";
import { onOpenSnack } from "@/store/slices/SnackBarSlice/SnackBarSlice";

export default function Index({ roles, auth }: RolePageProps) {
    const [showModal, setshowModal] = useState<boolean>(false);
    const [roleName, setRoleName] = useState<string>("");
    const [roleId, setRoleId] = useState<number | null>(null);
    const dispatch = useDispatch();

    const handleDeleteRole = (role: Role) => {
        setshowModal(true);
        setRoleName(role.name);
        setRoleId(role.id);
    };

    const handleAcceptDeleteRole = () => {
        setshowModal(false);
        router.delete(route("roles.destroy", { id: roleId! }), {
            onSuccess: () =>
                dispatch(
                    onOpenSnack({
                        message: `Rol ${roleName} eliminado correctamente`,
                        severity: "success",
                    })
                ),
        });
    };

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

            <DeleteModal
                isOpen={showModal}
                onClose={() => setshowModal(() => false)}
                onDelete={handleAcceptDeleteRole}
                resourceName={`Role ${roleName}`}
                key={1}
            />

            <div className="p-3">
                <div className="w-full">
                    <PrimaryButton
                        className="w-full text-center h-10 !my-5 !p-6"
                        variant="contained"
                        href={route("roles.create")}
                    >
                        Nuevo Rol
                    </PrimaryButton>
                </div>

                <RolesDataTable
                    roles={roles}
                    onDelete={(role: Role) => handleDeleteRole(role)}
                />
            </div>
        </AuthenticatedLayout>
    );
}
