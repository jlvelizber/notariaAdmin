import React, { Key, useState } from "react";
import { ApplicationLogo } from "@/Components/Common";
import NavLink from "@/Components/Common/NavLink";
import { Link, usePage } from "@inertiajs/react";
import { ConfigurationInterface, DocFormType, PageProps } from "@/types";
import { Button, Menu, MenuItem } from "@mui/material";

export default function AuthenticatedNavigation() {
    const {
        form_types,
        auth: {
            permissions: {
                can_access_requests,
                can_access_roles,
                can_access_settings,
                can_access_users,
            },
        },
        top_configurations
    } = usePage<PageProps>().props;

    const [anchorElMenuRequests, setanchorElMenuRequests] =
        useState<null | HTMLElement>(null);
    const openReq = Boolean(anchorElMenuRequests);
    const handleClickRequests = (
        event: React.MouseEvent<HTMLButtonElement>
    ) => {
        setanchorElMenuRequests(event.currentTarget);
    };
    const handleCloseRequests = () => {
        setanchorElMenuRequests(null);
    };

    const [anchorElMenuConfig, setanchorElMenuConfig] =
        useState<null | HTMLElement>(null);
    const openConfig = Boolean(anchorElMenuConfig);

    const handleClickConfig = (event: React.MouseEvent<HTMLButtonElement>) => {
        setanchorElMenuConfig(event.currentTarget);
    };

    const handleCloseConfig = () => {
        setanchorElMenuConfig(null);
    };

    return (
        <div className="flex">
            <div className="shrink-0 flex items-center">
                <Link href="/">
                    <ApplicationLogo className="block h-16 w-auto fill-current text-gray-800" />
                </Link>
            </div>

            <div className="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <NavLink
                    href={route("dashboard")}
                    active={route().current("dashboard")}
                >
                    Inicio
                </NavLink>
                {can_access_requests && (
                    <>
                        <Button
                            id="basic-button"
                            aria-controls={openReq ? "basic-menu" : undefined}
                            aria-haspopup="true"
                            aria-expanded={openReq ? "true" : undefined}
                            onClick={handleClickRequests}
                            classes={{
                                root: "inline-flex items-center px-1 pt-1 !text-gray-500 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none !capitalize",
                            }}
                        >
                            Solicitudes
                            <Menu
                                id="basic-menu"
                                anchorEl={anchorElMenuRequests}
                                open={openReq}
                                onClose={handleCloseRequests}
                                MenuListProps={{
                                    "aria-labelledby": "basic-button",
                                }}
                            >
                                {form_types.map(
                                    (menuItem: DocFormType, key: Key) => (
                                        <MenuItem key={key}>
                                            <NavLink
                                                href={route(
                                                    "requests.formDocType.index",
                                                    {
                                                        id: menuItem.route_name,
                                                    }
                                                )}
                                                active={route().current(
                                                    "requests.formDocType.index",
                                                    {
                                                        id: menuItem.route_name,
                                                    }
                                                )}
                                            >
                                                {menuItem.display_name}
                                            </NavLink>
                                        </MenuItem>
                                    )
                                )}
                            </Menu>
                        </Button>
                    </>
                )}

                {can_access_users && (
                    <>
                        <NavLink
                            href={route("users.index")}
                            active={route().current("users.*")}
                        >
                            Usuarios
                        </NavLink>
                    </>
                )}

                {can_access_roles && (
                    <>
                        <NavLink
                            href={route("roles.index")}
                            active={route().current("roles.*")}
                        >
                            Roles
                        </NavLink>
                    </>
                )}

                {can_access_settings && (
                    <Button
                        id="basic-button"
                        aria-controls={openConfig ? "basic-menu" : undefined}
                        aria-haspopup="true"
                        aria-expanded={openConfig ? "true" : undefined}
                        onClick={handleClickConfig}
                        classes={{
                            root: "inline-flex items-center px-1 pt-1 !text-gray-500 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none !capitalize",
                        }}
                    >
                        Configuración
                        <Menu
                            id="basic-menu"
                            anchorEl={anchorElMenuConfig}
                            open={openConfig}
                            onClose={handleCloseConfig}
                            MenuListProps={{
                                "aria-labelledby": "basic-button",
                            }}
                        >
                            {top_configurations.map(
                                (config: ConfigurationInterface) => {
                                    return (
                                        <MenuItem key={config.id}>
                                            <NavLink
                                                href={route(
                                                    "settings.types.index",
                                                    {
                                                        id: config.key,
                                                    }
                                                )}
                                                active={route().current(
                                                    "settings.types.index",
                                                    {
                                                        id: config.key,
                                                    }
                                                )}
                                            >
                                                {config.label}
                                            </NavLink>
                                        </MenuItem>
                                    );
                                }
                            )}
                        </Menu>
                    </Button>
                )}
            </div>
        </div>
    );
}
