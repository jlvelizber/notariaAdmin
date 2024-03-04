import { useEffect, FormEventHandler } from "react";
import GuestLayout from "@/Layouts/GuestLayout";
import { InputError, InputLabel, PrimaryButton } from "@/Components/Common";
import TextInput from "@/Components/Common/TextInput";
import { Head, Link, useForm } from "@inertiajs/react";

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: "",
        midle_name: "",
        email: "",
        password: "",
        first_last_name: "",
        second_last_name: "",
        password_confirmation: "",
    });

    useEffect(() => {
        return () => {
            reset("password", "password_confirmation");
        };
    }, []);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("register"));
    };

    return (
        <GuestLayout>
            <Head title="Register" />

            <form onSubmit={submit}>
                <div>
                    <InputLabel htmlFor="name" value="Name" />

                    <TextInput
                        id="name"
                        name="name"
                        value={data.name}
                        className="mt-1 block w-full"
                        autoComplete="name"
                        isFocused={true}
                        onChange={(e) => setData("name", e.target.value)}
                        required
                    />

                    <InputError message={errors.name} className="mt-2" />
                </div>
                <div className="mt-4">
                    <InputLabel htmlFor="midle_name" value="Middlename" />

                    <TextInput
                        id="midle_name"
                        name="midle_name"
                        value={data.midle_name}
                        className="mt-1 block w-full"
                        autoComplete="midle_name"
                        onChange={(e) => setData("midle_name", e.target.value)}
                        required
                    />

                    <InputError message={errors.midle_name} className="mt-2" />
                </div>
                <div className="mt-4">
                    <InputLabel
                        htmlFor="first_last_name"
                        value="First Lastname"
                    />

                    <TextInput
                        id="first_last_name"
                        name="first_last_name"
                        value={data.first_last_name}
                        className="mt-1 block w-full"
                        autoComplete="first_last_name"
                        onChange={(e) =>
                            setData("first_last_name", e.target.value)
                        }
                        required
                    />

                    <InputError
                        message={errors.first_last_name}
                        className="mt-2"
                    />
                </div>
                <div className="mt-4">
                    <InputLabel
                        htmlFor="second_last_name"
                        value="First Lastname"
                    />

                    <TextInput
                        id="second_last_name"
                        name="second_last_name"
                        value={data.second_last_name}
                        className="mt-1 block w-full"
                        autoComplete="second_last_name"
                        onChange={(e) =>
                            setData("second_last_name", e.target.value)
                        }
                        required
                    />

                    <InputError
                        message={errors.second_last_name}
                        className="mt-2"
                    />
                </div>

                <div className="mt-4">
                    <InputLabel htmlFor="email" value="Email" />

                    <TextInput
                        id="email"
                        type="email"
                        name="email"
                        value={data.email}
                        className="mt-1 block w-full"
                        autoComplete="username"
                        onChange={(e) => setData("email", e.target.value)}
                        required
                    />

                    <InputError message={errors.email} className="mt-2" />
                </div>

                <div className="mt-4">
                    <InputLabel htmlFor="password" value="Password" />

                    <TextInput
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                        onChange={(e) => setData("password", e.target.value)}
                        required
                    />

                    <InputError message={errors.password} className="mt-2" />
                </div>

                <div className="mt-4">
                    <InputLabel
                        htmlFor="password_confirmation"
                        value="Confirm Password"
                    />

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        value={data.password_confirmation}
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                        onChange={(e) =>
                            setData("password_confirmation", e.target.value)
                        }
                        required
                    />

                    <InputError
                        message={errors.password_confirmation}
                        className="mt-2"
                    />
                </div>

                <div className="flex items-center justify-end mt-4">
                    <Link
                        href={route("login")}
                        className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Already registered?
                    </Link>

                    <PrimaryButton className="ml-4" disabled={processing}>
                        Register
                    </PrimaryButton>
                </div>
            </form>
        </GuestLayout>
    );
}
