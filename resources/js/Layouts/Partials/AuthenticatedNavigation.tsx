import React, { Key, useEffect } from "react";
import ApplicationLogo from "@/Components/ApplicationLogo";
import NavLink from "@/Components/NavLink";
import { Link, usePage } from "@inertiajs/react";
import { useProps } from "@mui/x-data-grid/internals";
import { DocFormType, PageProps } from "@/types";
import Dropdown from "@/Components/Dropdown";

export default function AuthenticatedNavigation() {
    const { form_types } = usePage<PageProps>().props;

    console.log(form_types);
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
                <NavLink href={"#"} active={route().current("requests.*")}>
                    <Dropdown>
                        <Dropdown.Trigger>
                            <span className="inline-flex rounded-md">
                                <button
                                    type="button"
                                    className="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                >
                                    Solicitudes
                                    <svg
                                        className="ml-2 -mr-0.5 h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fillRule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clipRule="evenodd"
                                        />
                                    </svg>
                                </button>
                            </span>
                        </Dropdown.Trigger>
                        <Dropdown.Content align="right">
                            {form_types.map(
                                (formType: DocFormType, key: Key) => {
                                    return (
                                        <Dropdown.Link
                                            key={key}
                                            href={route(
                                                `requests.formDocType.index`,
                                                { id: formType.route_name }
                                            )}
                                        >
                                            {formType.display_name}
                                        </Dropdown.Link>
                                    );
                                }
                            )}
                        </Dropdown.Content>
                    </Dropdown>
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
