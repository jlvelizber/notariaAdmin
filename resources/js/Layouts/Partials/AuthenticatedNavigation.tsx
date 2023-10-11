import React from "react";
import ApplicationLogo from "@/Components/ApplicationLogo";
import NavLink from "@/Components/NavLink";
import { Link } from "@inertiajs/react";

export default function AuthenticatedNavigation() {
    return (
        <div className="flex">
            <div className="shrink-0 flex items-center">
                <Link href="/">
                    <ApplicationLogo className="block h-9 w-auto fill-current text-gray-800" />
                </Link>
            </div>

            <div className="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <NavLink
                    href={route("dashboard")}
                    active={route().current("dashboard")}
                >
                    Dashboard
                </NavLink>
                <NavLink
                    href={route("requests.index")}
                    active={route().current("requests.*")}
                >
                    Solicitudes
                </NavLink>
                <NavLink
                    href={route("roles.index")}
                    active={route().current("roles.*")}
                >
                    Roles
                </NavLink>
                <NavLink
                    href={route("users.index")}
                    active={route().current("users.*")}
                >
                    Usuarios
                </NavLink>
            </div>
        </div>
    );
}
