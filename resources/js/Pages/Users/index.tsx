import { Head, router } from "@inertiajs/react";
import { IndexUserPageProps, User } from "@/types";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import UsersDataTable from "./Partials/UsersDataTable";
import PrimaryButton from "@/Components/PrimaryButton";
import { useState } from "react";
import DeleteModal from "@/Components/DeleteModal";
import { useDispatch } from "react-redux";
import { onOpenSnack } from "@/store/slices/SnackBarSlice/SnackBarSlice";

export default function Index({ users, auth }: IndexUserPageProps) {
    const [showModal, setshowModal] = useState<boolean>(false);
    const [userName, setUserName] = useState<String>("");
    const [userId, setUserId] = useState<number | null>(null);
    const dispatch = useDispatch();

    const handleDeleteUser = (user: User) => {
        setshowModal(true);
        setUserName(user.name);
        setUserId(user.id);
    };

    const handleAcceptDeleteRole = () => {
        setshowModal(false);
        router.delete(route("users.destroy", { id: userId! }), {
            onSuccess: () =>
                dispatch(
                    onOpenSnack({
                        message: `Usuario ${userName} eliminado correctamente`,
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
                    Usuarios
                </h2>
            }
        >
            <Head title="Usuarios del sistema" />

            <DeleteModal
                isOpen={showModal}
                onClose={() => setshowModal(() => false)}
                onDelete={handleAcceptDeleteRole}
                resourceName={`Usuario ${userName}`}
                key={1}
            />

            <div className="p-3">
                <div className="w-full">
                    <PrimaryButton
                        className="w-full text-center h-10 !my-5 !p-6"
                        variant="contained"
                        href={route("users.create")}
                    >
                        Nuevo Usuario
                    </PrimaryButton>
                </div>

                <UsersDataTable
                    users={users}
                    onDelete={(user: User) => handleDeleteUser(user)}
                />
            </div>
        </AuthenticatedLayout>
    );
}
