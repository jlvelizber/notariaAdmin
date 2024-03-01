import GuestLayout from "@/Layouts/GuestLayout";
import PrimaryButton from "@/Components/Common/PrimaryButton";
import { Head, Link, useForm } from "@inertiajs/react";
import { FormEventHandler } from "react";

export default function VerifyEmail({ status }: { status?: string }) {
    const { post, processing } = useForm({});

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("verification.send"));
    };

    return (
        <GuestLayout>
            <Head title="Email Verification" />

            <div className="mb-4 text-sm text-gray-600">
                Gracias por registrarte! Antes de comenzar, ¿podría verificar su
                dirección de correo electrónico haciendo clic en el enlace que
                le acabamos de enviar por correo electrónico? Si no recibió el
                correo electrónico, con gusto le enviaremos otro.
            </div>

            {status === "verification-link-sent" && (
                <div className="mb-4 font-medium text-sm text-green-600">
                    Se ha enviado un nuevo enlace de verificación a la dirección
                    de correo electrónico. que proporcionó durante el registro.
                </div>
            )}

            <form onSubmit={submit}>
                <div className="mt-4 flex items-center justify-between">
                    <PrimaryButton disabled={processing}>
                        Reenviar correo electrónico de verificación
                    </PrimaryButton>

                    <Link
                        href={route("logout")}
                        method="post"
                        as="button"
                        className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Salir
                    </Link>
                </div>
            </form>
        </GuestLayout>
    );
}
