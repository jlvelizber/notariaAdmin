import React, { Key, useState } from "react";
import {ApplicationLogo} from "@/Components/Common";
import NavLink from "@/Components/Common/NavLink";
import { Link, usePage } from "@inertiajs/react";
import { DocFormType, PageProps } from "@/types";
import { Button, Menu, MenuItem } from "@mui/material";

export default function AuthenticatedNavigation() {
    const { form_types } = usePage<PageProps>().props;

    const [anchorEl, setAnchorEl] = useState<null | HTMLElement>(null);
    const open = Boolean(anchorEl);
    const handleClick = (event: React.MouseEvent<HTMLButtonElement>) => {
        setAnchorEl(event.currentTarget);
    };
    const handleClose = () => {
        setAnchorEl(null);
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
                {/* <NavLink href={""} active={route().current("requests.*")}> */}
                <Button
                    id="basic-button"
                    aria-controls={open ? "basic-menu" : undefined}
                    aria-haspopup="true"
                    aria-expanded={open ? "true" : undefined}
                    onClick={handleClick}
                    classes={{
                        root: "inline-flex items-center px-1 pt-1 !text-gray-500 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none !capitalize",
                    }}
                >
                    Solicitudes
                    <Menu
                        id="basic-menu"
                        anchorEl={anchorEl}
                        open={open}
                        onClose={handleClose}
                        MenuListProps={{
                            "aria-labelledby": "basic-button",
                        }}
                    >
                        {form_types.map((menuItem: DocFormType, key: Key) => (
                            <MenuItem key={key}>
                                <NavLink
                                    href={route("requests.formDocType.index", {
                                        id: menuItem.route_name,
                                    })}
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
                        ))}
                    </Menu>
                </Button>
                {/* </NavLink> */}

                <NavLink
                    href={route("users.index")}
                    active={route().current("users.*")}
                >
                    Usuarios
                </NavLink>
                <NavLink
                    href={route("roles.index")}
                    active={route().current("roles.*")}
                >
                    Roles
                </NavLink>
            </div>
        </div>
    );
}
