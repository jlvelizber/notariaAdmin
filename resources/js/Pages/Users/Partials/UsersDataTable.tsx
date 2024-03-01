import React, { FC } from "react";
import { PageProps, User } from "@/types";
import { DataGrid, GridColDef, GridValueGetterParams } from "@mui/x-data-grid";
import {ActionDataTableButtons} from "@/Components";
import { router, usePage } from "@inertiajs/react";
import { humanizeDate } from "@/Helpers/dates";

export const UsersDataTable: FC<{ users: User[]; onDelete: (user: User) => void }> = ({
    users,
    onDelete,
}) => {
    // Con esto optienes el usuario en linea
    const { auth } = usePage<PageProps>().props;

    const onEditRole = (user: User) => {
        router.get(`users/${user}/edit`);
    };

    const onDeleteUser = (user: User) => {
        onDelete(user);
    };

    const columns: GridColDef[] = [
        {
            field: "name",
            headerName: "Nombre",
            width: 380,
            valueGetter: ({ row }: GridValueGetterParams) =>
                `${row.name} ${row.midle_name} ${row.first_last_name} ${row.second_last_name}`,
        },
        {
            field: "email",
            headerName: "Correo electrónico",
            width: 300,
        },
        {
            field: "role",
            headerName: "Rol",
            width: 180,
            valueGetter: ({ row }: GridValueGetterParams) =>
                row.role_name ? `${row.role_name}` : "Sin Rol",
        },
        {
            field: "created_at",
            headerName: "Fecha de registro",
            width: 300,
            valueGetter: ({ row }: GridValueGetterParams) =>
                humanizeDate(row.created_at),
        },
        {
            field: "updated_at",
            headerName: "Fecha de actualizacion",
            width: 300,
            valueGetter: ({ row }: GridValueGetterParams) =>
                humanizeDate(row.updated_at),
        },
        {
            field: "actions",
            headerName: "Acciones",
            width: 300,
            renderCell: (params) => (
                <ActionDataTableButtons
                    id={params.row.id}
                    isDelete={auth.user.id !== params.row.id}
                    isEdit={true}
                    isShow={false}
                    onEditHandler={() => onEditRole(params.row.id)}
                    onDeleteHandler={() => onDeleteUser(params.row)}
                />
            ),
        },
    ];

    return (
        <DataGrid
            checkboxSelection
            disableRowSelectionOnClick
            columns={columns}
            rows={users}
        />
    );
};
